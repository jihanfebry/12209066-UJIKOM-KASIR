<x-layout>
    <div class="pagetitle">
        <h1>Halaman Produk</h1>
          <nav>
              <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{ route('admin.product.index')}}">Produk</a></li>
                  <li class="breadcrumb-item active">Daftar Produk</li>
              </ol>
          </nav>
      </div>
      
      <x-alert-success></x-alert-success>
      
      <div class="card shadow-sm border-0 rounded-lg"> 
          <div class="card-body p-1">
              <div class="container mt-4">
      
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div></div>
                    <a href="{{ route('admin.product.create') }}" class="btn btn-primary">Tambah Produk</a>
                </div>
                 
                  <div class="table-responsive">
                      <table class="table table-striped align-middle w-100" style="table-layout: fixed;">
                          <thead class="table-light">
                              <tr>
                                  <th style="width: 5%;">#</th>
                                  <th style="width: 15%;">Gambar</th>
                                  <th style="width: 25%;">Nama Produk</th>
                                  <th style="width: 15%;">Harga</th>
                                  <th style="width: 10%;">Stock</th>
                                  <th style="width: 30%;" class="text-end"></th>
                              </tr>
                          </thead>
          
                          <tbody>

                              <tr>
                                  <td></td>
                                  <td><img src="" width="50" height="50" style="object-fit:cover; border-radius:5px;"></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td>
                                      <div class="d-flex justify-content-between">
                                          <a href="{{route('admin.product.edit') }}" class="btn btn-warning btn-sm">Edit</a>
                                          <button type="button" class="btn btn-info btn-sm" 
                                              data-bs-toggle="modal"
                                              data-bs-target="#updateStockModal"
                                              data-id = ""
                                              data-name = ""
                                              data-stock = "">
                                              Update Stock
                                          </button>
                                          <button type="button" class="btn btn-danger btn-sm" 
                                              data-bs-toggle="modal"
                                              data-bs-target= "#deleteModal"
                                              data-id = ""
                                              data-name = ""
                                              data-has-order="">
                                              Hapus
                                          </button>
                                      </div>
                                  </td>                    
                              </tr>

                          </tbody>
                      </table>
                  </div>
              </div>
          </div>
      </div>
      
   <x-product.modal-delete></x-product.modal-delete>
   <x-product.modal-update-stock></x-product.modal-update-stock>

</x-layout>

