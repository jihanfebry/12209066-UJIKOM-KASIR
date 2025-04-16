<x-layout>
    <section class="section">
        <div class="pagetitle">
            <h1>Halaman Tambah Penjualan</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('petugas.purchase.index')}}">Daftar penjualan</a></li>
                    <li class="breadcrumb-item active">Tambah penjualan</li>
                </ol>
            </nav>
        </div>
        
        <div class="row">
          
            <div class="col-md-4">
                <div class="card text-center p-3">
                    <img src="" 
                         class="card-img-top" 
                         alt="" 
                         style="height: 150px; object-fit: contain;">

                    <div class="card-body">
                        <h5 class="card-title"></h5>
                        <p class="text-muted">Stok: <span id="stock-"></span></p>
                        <p class="fw-bold"></p>

                        <div class="d-flex justify-content-center align-items-center">
                            <button class="btn btn-outline-primary btn-minus" data-id="" data-price="">-</button>
                            <span class="mx-2 jumlah" id="jumlah-">0</span>
                            <button class="btn btn-outline-primary btn-plus" data-id="" data-price="" data-stock="">+</button>
                        </div>

                        <p class="mt-2">Sub Total: <strong class="subtotal" id="subtotal-">Rp. 0</strong></p>
                    </div>
                </div>             
            </div>
      
        </div>     

        {{-- Footer dengan tombol Selanjutnya --}}
        <div class="fixed-bottom bg-white p-3 shadow-lg d-flex justify-content-center">
            <a href="" id="btn-selanjutnya" class="btn btn-secondary px-4 py-2" disabled>Selanjutnya</a>
        </div>
        

    </section>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let totalJumlah = 0;
            const btnSelanjutnya = document.getElementById("btn-selanjutnya");
            let cart = JSON.parse(localStorage.getItem("cart")) || {};
    
            function updateButtonState() {
                totalJumlah = Object.values(cart).reduce((acc, product) => acc + product.jumlah, 0);
                if (totalJumlah > 0) {
                    btnSelanjutnya.classList.remove("btn-secondary");
                    btnSelanjutnya.classList.add("btn-primary");
                    btnSelanjutnya.removeAttribute("disabled");
                } else {
                    btnSelanjutnya.classList.remove("btn-primary");
                    btnSelanjutnya.classList.add("btn-secondary");
                    btnSelanjutnya.setAttribute("disabled", "true");
                }
            }
    
            function updateLocalStorage() {
                localStorage.setItem("cart", JSON.stringify(cart));
            }
    
            function restoreCart() {
                Object.keys(cart).forEach(id => {
                    let jumlahElement = document.getElementById("jumlah-" + id);
                    let subtotalElement = document.getElementById("subtotal-" + id);
                    
                    if (jumlahElement && subtotalElement) {
                        let product = cart[id];
                        jumlahElement.textContent = product.jumlah;
                        subtotalElement.textContent = "Rp. " + (product.jumlah * product.price).toLocaleString("id-ID");
                    }
                });
                updateButtonState();
            }
    
            document.querySelectorAll(".btn-plus").forEach(button => {
                button.addEventListener("click", function () {
                    let id = this.getAttribute("data-id");
                    let price = parseInt(this.getAttribute("data-price"));
                    let stock = parseInt(this.getAttribute("data-stock"));
                    let name = this.closest(".card-body").querySelector(".card-title").textContent;
                    
                    let jumlahElement = document.getElementById("jumlah-" + id);
                    let subtotalElement = document.getElementById("subtotal-" + id);
                    let currentJumlah = parseInt(jumlahElement.textContent);
                    
                    if (currentJumlah < stock) {
                        let newJumlah = currentJumlah + 1;
                        jumlahElement.textContent = newJumlah;
                        subtotalElement.textContent = "Rp. " + (newJumlah * price).toLocaleString("id-ID");
    
                        cart[id] = { id, name, price, jumlah: newJumlah };
                        updateLocalStorage();
                        updateButtonState();
                    }
                });
            });
    
            document.querySelectorAll(".btn-minus").forEach(button => {
                button.addEventListener("click", function () {
                    let id = this.getAttribute("data-id");
                    let price = parseInt(this.getAttribute("data-price"));
    
                    let jumlahElement = document.getElementById("jumlah-" + id);
                    let subtotalElement = document.getElementById("subtotal-" + id);
                    let currentJumlah = parseInt(jumlahElement.textContent);
                    
                    if (currentJumlah > 0) {
                        let newJumlah = currentJumlah - 1;
                        jumlahElement.textContent = newJumlah;
                        subtotalElement.textContent = "Rp. " + (newJumlah * price).toLocaleString("id-ID");
    
                        if (newJumlah === 0) {
                            delete cart[id];
                        } else {
                            cart[id].jumlah = newJumlah;
                        }
                        updateLocalStorage();
                        updateButtonState();
                    }
                });
            });
    
            restoreCart(); 
        });
    </script>
    
  
</x-layout>