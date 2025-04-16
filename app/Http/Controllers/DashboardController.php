<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboardPetugas()
    {
        $today = Carbon::today();
        
        $totalPenjualanHariIni = Order::whereDate('created_at', $today)
        ->where('user_id', Auth::id()) 
        ->count();
        
        $waktuUpdate = Order::where('user_id', Auth::id())
        ->latest('created_at')
        ->first()?->created_at;
        
        $formattedWaktuUpdate = $waktuUpdate ? $waktuUpdate->format('d M Y H:i') : '-';
        
        return view('petugas.dashboard', [
        'totalPenjualanHariIni' => $totalPenjualanHariIni,
        'waktuUpdate' => $formattedWaktuUpdate,
        ]);
    }
    


        public function dashboardAdmin()
        {
           
            $salesPerDay = Order::select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as total_orders'))
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get();

        
            
            $productsSold = OrderDetail::join('products', 'order_details.product_id', '=', 'products.id')
                ->select('products.product_name', DB::raw('SUM(order_details.quantity) as total_qty'))
                ->groupBy('products.product_name')
                ->get();

            $totalPenjualanSemuaPetugas = Order::count();
        
            return view('admin.dashboard', [
                'salesPerDay' => $salesPerDay,
                'productsSold' => $productsSold,
                'totalPenjualanSemuaPetugas' => $totalPenjualanSemuaPetugas,
            ]);
        }
}
