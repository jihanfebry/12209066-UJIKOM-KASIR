<x-layout>
    <div class="pagetitle">
        <h1>Halaman Penjualan</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Penjualan</a></li>
                <li class="breadcrumb-item active"> Daftar penjualan</li>
            </ol>
        </nav>
    </div>

    <div class="card shadow-sm border-0 rounded-lg">
        <div class="card-body p-1">
            <div class="container mt-4">
                <div class="d-flex justify-content-between mb-3">
                    <a href="" style="height: 40px;" class="btn btn-success">Export Penjualan (.xlsx)</a>
                </div>

                <div class="table-responsive">
                    <table id="penjualanTable" class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Pelanggan</th>
                                <th>Tanggal Penjualan</th>
                                <th>Total Harga</th>
                                <th>Dibuat Oleh</th>
                                <th class="text-end"></th>
                            </tr>
                        </thead>
                        <tbody>
                           
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="text-end">
                                        <a href="#" class="btn btn-warning btn-sm">Lihat</a>
                                        <a href="#" class="btn btn-primary btn-sm">Unduh Bukti</a>
                                    </td>
                                </tr>
                           
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

        <script>
            $(document).ready(function () {
                $('#penjualanTable').DataTable();
            });
        </script>
    @endpush
</x-layout>
