<x-layout>
    <div class="pagetitle">
        <h1>Halaman Pembayaran</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('petugas.purchase.create') }}">Tambah Penjualan</a></li>
                <li class="breadcrumb-item active">Pembayaran</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="card shadow-sm border-0 rounded-lg">
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-md-6">
                        <h4 class="fw-bold mb-3">Produk yang Dipilih</h4>
                        <div id="selected-products"></div>
                        <h5 class="fw-bold mt-3">Total Harga <span id="total-price" class="float-end">Rp. 0</span></h5>
                    </div>

                    <div class="col-md-6">
                        <form action="{{ route('petugas.payment.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="customer-status" class="form-label">Status Customer</label>
                                <select id="customer-status" name="customer_status" class="form-select">
                                    <option value="Non-Member" {{ old('customer_status') == 'Non-Member' ? 'selected' : '' }}>Non-Member</option>
                                    <option value="Member" {{ old('customer_status') == 'Member' ? 'selected' : '' }}>Member</option>
                                </select>
                            </div>

                            <div id="phone-input-container" class="mb-3" style="display: none;">
                                <label class="form-label">No Telepon <span class="text-danger">(Daftar/gunakan member)</span></label>
                                <input type="text" id="phone" name="phone" class="form-control" value="{{ old('phone') }}" placeholder="Masukkan nomor telepon">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Jumlah Dibayar</label>
                                <input type="text" class="form-control" id="amount-paid" placeholder="Masukkan jumlah bayar">
                                <input type="hidden" name="amount_paid" id="amount-paid-clean">
                                <small id="error-message" class="text-danger d-none">Jumlah bayar kurang.</small>
                            </div>

                           
                            <input type="hidden" name="total_price" id="input-total-price">

                        
                            <div id="product-inputs"></div>

                            <button class="btn btn-primary w-100 mt-3 mb-3" id="btn-submit" disabled>Selesaikan Pembayaran</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Script --}}
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let cart = JSON.parse(localStorage.getItem("cart")) || {};
            let totalPrice = 0;

            const selectedProducts = document.getElementById("selected-products");
            const inputTotalPrice = document.getElementById("input-total-price");
            const totalPriceElement = document.getElementById("total-price");
            const amountPaidInput = document.getElementById("amount-paid");
            const amountPaidClean = document.getElementById("amount-paid-clean");
            const btnSubmit = document.getElementById("btn-submit");
            const productInputs = document.getElementById("product-inputs");
            const errorMessage = document.getElementById("error-message");
            const customerStatusDropdown = document.getElementById("customer-status");
            const phoneInputContainer = document.getElementById("phone-input-container");

            // Menampilkan produk yang ada di keranjang
            Object.values(cart).forEach(product => {
                const subtotal = product.jumlah * product.price;
                totalPrice += subtotal;

                selectedProducts.innerHTML += `
                    <div class="d-flex justify-content-between mb-2">
                        <div>
                            <strong>${product.name}</strong>
                            <div><small>Rp. ${product.price.toLocaleString("id-ID")} x ${product.jumlah}</small></div>
                        </div>
                        <div class="fw-bold">Rp. ${subtotal.toLocaleString("id-ID")}</div>
                    </div>
                `;

                productInputs.innerHTML += `
                    <input type="hidden" name="products[${product.id}][id]" value="${product.id}">
                    <input type="hidden" name="products[${product.id}][jumlah]" value="${product.jumlah}">
                `;
            });

            // Tampilkan total harga
            totalPriceElement.textContent = "Rp. " + totalPrice.toLocaleString("id-ID");
            inputTotalPrice.value = totalPrice;

            // Format rupiah ke angka
            function cleanRupiah(str) {
                return parseInt(str.replace(/[^\d]/g, "")) || 0;
            }

            // Validasi pembayaran
            function updateValidation() {
                const bayar = parseInt(amountPaidClean.value);
                if (bayar < totalPrice) {
                    errorMessage.classList.remove("d-none");
                    btnSubmit.setAttribute("disabled", true);
                } else {
                    errorMessage.classList.add("d-none");
                    btnSubmit.removeAttribute("disabled");
                }
            }

            // Input event untuk format dan update hidden
            amountPaidInput.addEventListener("input", function () {
                const cleaned = cleanRupiah(this.value);
                this.value = cleaned ? "Rp. " + cleaned.toLocaleString("id-ID") : "";
                amountPaidClean.value = cleaned;
                updateValidation();
            });

            // Submit form
            document.querySelector("form").addEventListener("submit", function (e) {
                const bayar = parseInt(amountPaidClean.value);
                if (bayar < totalPrice) {
                    e.preventDefault();
                    return;
                }
                localStorage.removeItem("cart");
            });

            // Tampilkan input no HP jika member
            function toggleCustomerInputVisibility() {
                phoneInputContainer.style.display = customerStatusDropdown.value === "Member" ? "block" : "none";
            }

            toggleCustomerInputVisibility();
            customerStatusDropdown.addEventListener("change", toggleCustomerInputVisibility);
        });
    </script>
</x-layout>
