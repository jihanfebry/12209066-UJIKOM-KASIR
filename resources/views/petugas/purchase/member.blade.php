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
                                @foreach ($productDetails as $item)
                                    <tr>
                                        <td>{{ $item['name'] }}</td>
                                        <td>{{ $item['jumlah'] }}</td>
                                        <td>Rp. {{ number_format($item['price'], 0, ',', '.') }}</td>
                                        <td>Rp. {{ number_format($item['subtotal'], 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="text-end fw-bold">
                            <p>Total Harga: Rp. {{ number_format($transactionData['total_price'], 0, ',', '.') }}</p>
                            <p>Total Bayar: Rp. {{ number_format($transactionData['amount_paid'], 0, ',', '.') }}</p>
                        </div>
                    </div>

                  
                    <div class="col-md-6">
                        <form method="POST" action="{{ route('member.verify') }}">
                            @csrf

                            @if($isReturningCustomer)
                            <div class="mb-3">
                                <label class="form-label">Nama Member</label>
                                <input type="text" name="name" value="{{ $transactionData['name'] }}" class="form-control" readonly>
                            </div>
                        @else
                            <div class="mb-3">
                                <label class="form-label">Nama Member Baru</label>
                                <input type="text" name="name" value="{{ old('name') }}" class="form-control" required>
                            </div>
                        @endif

                            <input type="hidden" name="phone" value="{{ $transactionData['phone'] ?? '' }}">

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Poin </label>
                                <input type="text"
                                     value="{{ $expectedPoints . ' poin' }}"
                                    readonly class="form-control bg-light text-muted">
                            </div>

                            <div class="form-check mb-2">
                                <input type="checkbox" class="form-check-input" name="use_points" id="use_points"
                                    {{ $isReturningCustomer ? '' : 'disabled' }}>
                                <label class="form-check-label" for="use_points">Gunakan poin</label>
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
                </div>
            </div>
        </div>
    </section>
</x-layout>
