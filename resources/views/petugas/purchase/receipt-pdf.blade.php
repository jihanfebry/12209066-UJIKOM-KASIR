<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { padding: 8px; border: 1px solid #ccc; text-align: left; }
        .text-end { text-align: right; }
        .text-center { text-align: center; }
        .no-border td { border: none; }
        .summary { margin-top: 20px; }
    </style>
</head>
<body>
    <h3>Kasir Application</h3>

    

<p>
    Member Status: <br>
    No. HP: <br>
    Bergabung Sejak:<br>
    Poin Member: 
</p>  

    <table>
        <thead style="background-color: #f2f2f2;">
            <tr>
                <th>Nama Produk</th>
                <th>QTY</th>
                <th>Harga</th>
                <th>Sub Total</th>
            </tr>
        </thead>
        <tbody>
         
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <table class="summary no-border">
        <tr>
            <td><strong>Total Harga</strong></td>
            <td class="text-end"></td>
        </tr>
        <tr>
            <td><strong>Poin Digunakan</strong></td>
            <td class="text-end"></td>
        </tr>
        <tr>
            <td><strong>Harga Setelah Poin</strong></td>
            <td class="text-end"></td>
        </tr>
        <tr>
            <td><strong>Total Bayar</strong></td>
            <td class="text-end"></td>
        </tr>
        <tr>
            <td><strong>Total Kembalian</strong></td>
            <td class="text-end"></td>
        </tr>
    </table>

    <p class="text-center" style="margin-top: 20px;">
       <br>
        <strong>Terima kasih atas pembelian Anda!</strong>
    </p>
</body>
</html>
