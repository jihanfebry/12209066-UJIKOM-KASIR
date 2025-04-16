<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UserExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return User::all();
    }

    public function map($user): array
    {
        return [
            $user->id,
            $user->name,
            $user->email,
            ucfirst($user->role),
        ];
    }

    public function headings(): array
    {
        return [
            ['PointKasir | Export Data User'],
          
            [''],
            [
            'ID',
            'Nama',
            'Email',
            'Role',
            ]
            
        ];
    }

    
}
