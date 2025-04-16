<x-layout>

<div class="pagetitle">
    <h1>Tambah Produk</h1>
       <nav>
           <ol class="breadcrumb">
               <li class="breadcrumb-item"><a href="{{ route('admin.product.index')}}">Daftar Produk</a></li>
               <li class="breadcrumb-item active">Tambah Produk</li>
           </ol>
       </nav>
   </div>
           
       <div class="card shadow-sm border-0 rounded-lg"> 
           <div class="card-body p-4"> 
               <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
                   @csrf
   
                   <div class="mb-3">
                       <label for="product_image" class="form-label">Gambar Produk</label>
                       <input type="file" class="form-control" name="product_image" id="product_image" onchange="previewImage(event)">
                       @error('product_image') <small class="text-danger">{{ $message }}</small> @enderror

                       <x-image-preview></x-image-preview>
                   </div>
                   
                   
                   <div class="mb-3">
                       <label for="product_name" class="form-label">Nama</label>
                       <input type="text" class="form-control" name="product_name" id="product_name" value="{{ old('product_name') }}">
                       @error('product_name') <small class="text-danger">{{ $message }}</small> @enderror
                   </div>
   
                   <div class="mb-3">
                       <label for="price" class="form-label">Harga</label>
                       <div class="input-group">
                           <input type="text" class="form-control" name="price" id="price" value="{{ old('price') }}" onkeyup="formatRupiah(this)">
                       </div>
                       @error('price')<small class="text-danger">{{ $message }}</small> @enderror
                   </div>
   
                   <div class="mb-3">
                       <label for="stock" class="form-label">Stok</label>
                       <input type="number" class="form-control" name="stock" id="stock" value="{{ old('stock') }}">
                       @error('stock')<small class="text-danger">{{ $message }}</small> @enderror
                   </div>

       
                   <button type="submit" class="btn btn-primary">Simpan</button>
               </form>
           </div>
       </div>
       
   <x-modal-rupiah></x-modal-rupiah>
   <x-image-preview></x-image-preview>
   </x-layout>
   
   
   
   
   
   