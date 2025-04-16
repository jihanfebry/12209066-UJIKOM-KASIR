<x-layout>
    <div class="container my-5">
        <div class="bg-white shadow rounded p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <a href=""  target="_blank" class="btn btn-primary me-2">Unduh</a>
                    <a href="" class="btn btn-secondary">Kembali</a>
                </div>
                <div class="text-end">
                    <p class="mb-0">Invoice – #</p>
                    <small></small>
                </div>
            </div>

                    {{-- Info Member (hanya jika customer adalah member) --}}
                    @if ()
                    <div class="mb-4">
                        <div><strong></strong></div>
                        <div>MEMBER SEJAK : </div>
                        <div>MEMBER POIN : </div>
                    </div>
                @endif
                
                


            {{-- Tabel Produk --}}
            <table class="table table-borderless">
                <thead class="border-bottom">
                    <tr>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Quantity</th>
                        <th class="text-end">Sub Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ()
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="text-end"></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- Ringkasan Pembayaran --}}
            <div class="row mt-4 align-items-center bg-light p-3 rounded">
                <div class="col-md-2">
                    <div class="text-muted small">POIN DIGUNAKAN</div>
                    <div class="fw-bold fs-5"></div>    
                </div>
                <div class="col-md-2">
                    <div class="text-muted small">KASIR</div>
                    <div class="fw-bold fs-5"></div>
                </div>                
                <div class="col-md-2">
                    <div class="text-muted small">KEMBALIAN</div>
                    <div class="fw-bold fs-5"></div>
                </div>
                <div class="col-md-2">
                    <div class="text-muted small">TOTAL BAYAR</div>
                    <div class="fw-bold fs-5"></div>
                </div>
                <div class="col-md-4 bg-dark text-white p-3 rounded text-end">
                    <div class="text-uppercase small">Total</div>
                
                    {{-- @php
                        $totalBeforeDiscount = $order->orderDetails->sum(function($item) {
                            return $item->unit_price * $item->quantity;
                        });
                    @endphp --}}
                
                    @if ()
                        {{-- Harga sebelum diskon dicoret --}}
                        <div class="fs-6 text-decoration-line-through mb-1">
                           
                        </div>
                    @endif
                
                    {{-- Harga akhir --}}
                    <div class="fs-4 fw-bold">
                      
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</x-layout>
