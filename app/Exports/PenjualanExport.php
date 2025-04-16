<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;

class PenjualanExport implements FromCollection, WithHeadings, WithMapping, WithEvents, WithCustomStartCell
{
    protected $userId;
    protected $orders;

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

        $this->orders = $query->get();
        return collect($this->orders->flatMap(function ($order) {
            $rows = [];
            foreach ($order->orderDetails as $index => $detail) {
                $rows[] = [
                    'name' => $index === 0 ? ($order->customer->name ?? 'Non-Member') : '',
                    'phone' => $index === 0 ? ($order->customer->phone ?? '-') : '',
                    'points' => $index === 0 ? ($order->customer->points ?? '-') : '',
                    'product_name' => $detail->product->product_name,
                    'quantity' => $detail->quantity,
                    'unit_price' => 'Rp. ' . number_format($detail->unit_price, 0, ',', '.'),
                    'total_price' => $index === 0 ? 'Rp. ' . number_format($order->total_price, 0, ',', '.') : '',
                    'amount_paid' => $index === 0 ? 'Rp. ' . number_format($order->amount_paid, 0, ',', '.') : '',
                    'discount' => $index === 0 ? 'Rp. ' . number_format($order->discount ?? 0, 0, ',', '.') : '',
                    'change' => $index === 0 ? 'Rp. ' . number_format($order->change, 0, ',', '.') : '',
                    'created_at' => $index === 0 ? $order->created_at->format('d-m-Y') : '',
                ];
            }
            return $rows;
        }));
    }

    public function map($row): array
    {
        return [
            $row['name'],
            $row['phone'],
            $row['points'],
            $row['product_name'],
            $row['quantity'],
            $row['unit_price'],
            $row['total_price'],
            $row['amount_paid'],
            $row['discount'],
            $row['change'],
            $row['created_at'],
        ];
    }

    public function headings(): array
    {
        return [
            ['PointKasir | Export Data Penjualan'],
          
            [''],
           
            [
                'Nama Pelanggan',
                'No HP Pelanggan',
                'Poin Pelanggan',
                'Nama Produk',
                'Qty',
                'Harga Satuan',
                'Total Bayar',
                'Subtotal',
                'Total Diskon Poin',
                'Total Kembalian',
                'Tanggal Pembelian',
            ]
        ];
    }

    public function startCell(): string
    {
        return 'A1';
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->mergeCells('A1:K1');
                $event->sheet->getDelegate()->getStyle('A1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 16,
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                ]);
            },
        ];
    }
}
