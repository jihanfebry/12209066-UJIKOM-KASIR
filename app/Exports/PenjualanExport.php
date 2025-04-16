<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PenjualanExport implements FromCollection, WithHeadings, WithMapping
{
    protected $userId;

    public function __construct($userId = null)
    {
        $this->userId = $userId;
    }

    public function collection()
    {
        $query = Order::with(['customer', 'orderDetails.product']);

        if ($this->userId) {
            $query->where('user_id', $this->userId);
        }

        return $query->get();
    }

    public function map($order): array
    {
        $produk = $order->orderDetails->map(function ($detail) {
            return $detail->product->product_name . ' (' . $detail->quantity . ' : Rp. ' . number_format($detail->subtotal, 0, ',', '.') . ')';
        })->implode(', ');

        return [
            $order->customer->name ?? 'Non-member',
            $order->customer->phone ?? '-',
            $order->customer_points_at_transaction ?? '-',
            $produk,
            'Rp. ' . number_format($order->total_price, 0, ',', '.'),
            'Rp. ' . number_format($order->amount_paid, 0, ',', '.'),
            'Rp. ' . number_format($order->discount ?? 0, 0, ',', '.'),
            'Rp. ' . number_format($order->change, 0, ',', '.'),
            $order->created_at->format('d-m-Y'),
        ];
    }

    public function headings(): array
    {
        return [
            [
                'PointKasir' 
            ],
            [
                'Nama Pelanggan',
                'No HP Pelanggan',
                'Poin Pelanggan',
                'Produk',
                'Jumlah',
                'Subtotal',
                'Total Harga',
                'Total Bayar',
                'Total Diskon Poin',
                'Total Kembalian',
                'Tanggal Pembelian'
            ]
        ];
    }

    public function startCell(): string
    {
        return 'A2'; 
    }
}


