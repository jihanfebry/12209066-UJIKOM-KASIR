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
      
               
                 
                  <div class="table-responsive">
                      <table class="table table-striped align-middle w-100" style="table-layout: fixed;">
                          <thead class="table-light">
                              <tr>
                                  <th style="width: 5%;">#</th>
                                  <th style="width: 15%;">Gambar</th>
                                  <th style="width: 25%;">Nama Produk</th>
                                  <th style="width: 15%;">Harga</th>
                                  <th style="width: 10%;">Stock</th>
                                 
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
                            </tr>
                            @endforeach
                          </tbody>
                      </table>
                  </div>
              </div>
          </div>
      </div>
      
   
</x-layout>

