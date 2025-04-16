<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ProductExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Product::all();
    }

    public function map($product): array
    {
        return [
            $product->id,
            $product->product_name,
            $product->price,
            $product->stock ?? 0,
        ];
    }

    public function headings(): array
    {
        return [
            'ID Produk',
            'Nama Produk',
            'Harga',
            'Stok',
        ];
    }
}
