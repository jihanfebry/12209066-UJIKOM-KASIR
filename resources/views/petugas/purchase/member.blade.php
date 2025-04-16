<x-layout>
    <div class="pagetitle">
        <h1>Halaman Member</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('petugas.purchase.create') }}">Pembayaran</a></li>
                <li class="breadcrumb-item active">Halaman Member</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="card shadow-sm border-0 rounded-lg">
            <div class="card-body p-4">
                <div class="row">
                    {{-- Kiri: Produk --}}
                    <div class="col-md-6">
                        <table class="table table-bordered mb-4">
                            <thead class="table-light">
                                <tr>
                                    <th>Nama Produk</th>
                                    <th>Qty</th>
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
                             
                            </tbody>
                        </table>

                        <div class="text-end fw-bold">
                            <p></p>
                            <p></p>
                        </div>
                    </div>

                    {{-- Kanan: Form Member --}}
                    <div class="col-md-6">
                        <form method="POST" action="">
                            @csrf

                            @if($isReturningCustomer)
                            <div class="mb-3">
                                <label class="form-label">Nama Member</label>
                                <input type="text" name="" value="{{ $transactionData[''] }}" class="form-control" readonly>
                            </div>
                        @else
                            <div class="mb-3">
                                <label class="form-label">Nama Member Baru</label>
                                <input type="text" name="" value="" class="form-control" required>
                            </div>
                        @endif

                            <input type="hidden" name="phone" value="{{ $transactionData[''] ?? '' }}">

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Poin </label>
                                <input type="text"
                                     value="{{ $expectedPoints . ' poin' }}"
                                    readonly class="form-control bg-light text-muted">
                            </div>

                            <div class="form-check mb-2">
                                <input type="checkbox" class="form-check-input" name="" id=""
                                    {{ $isReturningCustomer ? '' : 'disabled' }}>
                                <label class="form-check-label" for="">Gunakan poin</label>
                            </div>

                            @if (!$isReturningCustomer)
                                <div class="mb-3 text-danger small">
                                    Poin tidak dapat digunakan pada pembelanjaan pertama.
                                </div>
                            @endif

                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Selanjutnya</button>
                            </div>
                        </form>
                    </div>
                </div> {{-- row --}}
            </div>
        </div>
    </section>
</x-layout>
