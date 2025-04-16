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
                            @foreach($products as $index => $product)
                            <tr>
                                <td>{{$index + 1}}</td>
                                <td><img src="{{asset ('storage/'. $product->product_image)}}" width="50" height="50" style="object-fit:cover; border-radius:5px;"></td>
                                <td>{{$product->product_name}}</td>
                                <td>Rp {{number_format($product->price, 0, ',', '.')}}</td>
                                <td>{{ $product->stock }}</td>
                                <td>
                                    <div class="d-flex justify-content-between">
                                        <a href="{{route('admin.product.edit', $product->id)}}" class="btn btn-warning btn-sm">Edit</a>
                                        <button type="button" class="btn btn-info btn-sm" 
                                            data-bs-toggle="modal"
                                            data-bs-target="#updateStockModal"
                                            data-id = "{{ $product->id}}"
                                            data-name = "{{ $product->product_name}}"
                                            data-stock = "{{$product->stock}}">
                                            Update Stock
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm" 
                                            data-bs-toggle="modal"
                                            data-bs-target= "#deleteModal"
                                            data-id = "{{$product->id}}"
                                            data-name = "{{$product->product_name}}"
                                            data-has-order="{{ $product->orderDetails->count() > 0 ? 'true' : 'false' }}">
                                            Hapus
                                        </button>
                                    </div>
                                </td>                    
                            </tr>
                            @endforeach
                          </tbody>
                      </table>
                  </div>
              </div>
          </div>
      </div>
      
   <x-product.modal-delete></x-product.modal-delete>
   <x-product.modal-update-stock></x-product.modal-update-stock>

</x-layout>

