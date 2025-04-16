<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Customer;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $userId = Auth::user()->id;

        $orders = Auth::user()->role === 'admin'
            ? Order::with('customer', 'user')->latest()->get()
            : Order::with('customer', 'user')->where('user_id', $userId)->latest()->get();

        $view = Auth::user()->role === 'admin' ? 'admin.purchase.index' : 'petugas.purchase.index';
        return view($view, compact('orders'));
    }

    public function create()
    {
        $products = Product::all();
        return view('petugas.purchase.create', compact('products'));
    }

    public function checkout()
    {
        return view('petugas.purchase.payment');
    }

    public function store(Request $request)
    {
    $request->validate([
        'amount_paid' => 'required|numeric|min:0',
        'total_price' => 'required|numeric|min:0',
        'products' => 'required|array|min:1',
        'products.*.id' => 'required|exists:products,id',
        'products.*.jumlah' => 'required|numeric|min:1',
        'phone' => 'nullable|string',
    ]);

    $isMemberInput = !empty($request->phone);

    if (!$isMemberInput) {
        // Transaksi non-member, langsung proses
        $data = [
            'is_new' => false,
            'is_member' => false,
            'phone' => null,
            'name' => null,
            'total_price' => $request->total_price,
            'amount_paid' => $request->amount_paid,
            'products' => $request->products,
        ];

        $customer = Customer::create([
            'name' => 'Non-Member',
            'phone' => null,
            'points' => 0,
            'is_member' => false,
        ]);

        return $this->finalizeTransaction($data, $customer);
    }

    $customer = Customer::firstOrNew(['phone' => $request->phone]);
    $isNew = !$customer->exists;

    session([
        'member_data' => [
            'is_new' => $isNew,
            'phone' => $request->phone,
            'total_price' => $request->total_price,
            'amount_paid' => $request->amount_paid,
            'products' => $request->products,
            'name' => $customer?->name,
        ]
    ]);

    return redirect()->route('order.verifyMemberForm');
}


    public function verifyMemberForm()
    {
        $data = session('member_data');
        if (!$data) {
            return redirect()->route('order.create')->with('error', 'Data transaksi tidak ditemukan.');
        }

        $productDetails = collect($data['products'])->map(function ($item) {
            $product = Product::find($item['id']);
            return [
                'name' => $product->product_name,
                'jumlah' => $item['jumlah'],
                'price' => $product->price,
                'subtotal' => $product->price * $item['jumlah'],
            ];
        });

        $customer = Customer::where('phone', $data['phone'])->first();
        $currentPoints = $customer?->points ?? 0;
        $earnedPoints = floor($data['total_price'] * 0.01);
        $expectedPoints = $currentPoints;

        if (!empty($data['use_points']) && $currentPoints > 0) {
            $expectedPoints -= min($currentPoints, $data['total_price']);
        }

        $expectedPoints += $earnedPoints;

        return view('petugas.purchase.member', [
            'transactionData' => $data,
            'productDetails' => $productDetails,
            'isReturningCustomer' => !$data['is_new'],
            'expectedPoints' => $expectedPoints,
        ]);
    }

    public function verifyMember(Request $request)
    {
        $data = session('member_data');
        if (!$data) {
            return redirect()->route('order.create')->with('error', 'Data tidak tersedia.');
        }

        $customer = $data['is_new']
            ? Customer::create([
                'name' => $request->name,
                'phone' => $data['phone'],
                'points' => 0,
                'is_member' => true,
            ])
            : Customer::where('phone', $data['phone'])->first();

        if ($request->has('use_points')) {
            $data['use_points'] = true;
        }

        return $this->finalizeTransaction($data, $customer);
    }

    protected function finalizeTransaction(array $data, Customer $customer)
    {
        $totalPrice = $data['total_price'];
        $amountPaid = $data['amount_paid'];
        $isUsePoints = !empty($data['use_points']);

        $oldPoints = $customer->points;
        $earnedPoints = floor($totalPrice * 0.01); 
        $usablePoints = 0;
        $discount = 0;

        if ($isUsePoints && $customer->is_member) {
            $usablePoints = $oldPoints;
            $discount = min($usablePoints, $totalPrice);
            $customer->points = $earnedPoints;
        } else {
            if ($customer->is_member) {
                $customer->points = $oldPoints + $earnedPoints;
            }
        }

        $finalPrice = $totalPrice - $discount;
        $customer->save();

        $order = Order::create([
            'customer_id' => $customer->id,
            'total_price' => $totalPrice,
            'discount' => $discount,
            'final_price' => $finalPrice,
            'amount_paid' => $amountPaid,
            'change' => $amountPaid - $finalPrice,
            'user_id' => Auth::id(),
            'is_member' => $customer->is_member,
            'used_points' => $isUsePoints ? $usablePoints : 0,
        ]);

        foreach ($data['products'] as $item) {
            $product = Product::find($item['id']);

            OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'quantity' => $item['jumlah'],
                'unit_price' => $product->price,
                'subtotal' => $product->price * $item['jumlah'],
            ]);

            $product->decrement('stock', $item['jumlah']);
        }

        session()->forget('member_data');

        return redirect()->route('receipt.show', $order)->with('success', 'Transaksi berhasil.');
}

    
    
    public function receipt(Order $order)
    {
        $order->load('orderDetails.product');
        return view('petugas.purchase.receipt', compact('order'));
    }

    public function print($id)
    {
        $order = Order::with(['customer', 'orderDetails.product', 'user'])->findOrFail($id);
        $pdf = Pdf::loadView('petugas.purchase.receipt-pdf', compact('order'))->setPaper('A5');
        return $pdf->download("receipt-{$order->id}.pdf");
    }
}

