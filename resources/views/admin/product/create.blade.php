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
               <form action="" method="POST" enctype="multipart/form-data">
                   @csrf
   
                   <div class="mb-3">
                       <label for="" class="form-label">Gambar Produk</label>
                       <input type="file" class="form-control" name="" id="" onchange="">
                       @error('') <small class="text-danger"></small> @enderror

                       <x-image-preview></x-image-preview>
                   </div>
                   
                   
                   <div class="mb-3">
                       <label for="" class="form-label">Nama</label>
                       <input type="text" class="form-control" name="" id="" value="">
                       @error('') <small class="text-danger"></small> @enderror
                   </div>
   
                   <div class="mb-3">
                       <label for="" class="form-label">Harga</label>
                       <div class="input-group">
                           <input type="text" class="form-control" name="" id="" value="" onkeyup="">
                       </div>
                       @error('')<small class="text-danger"></small> @enderror
                   </div>
   
                   <div class="mb-3">
                       <label for="" class="form-label">Stok</label>
                       <input type="number" class="form-control" name="" id="" value="">
                       @error('')<small class="text-danger"></small> @enderror
                   </div>

       
                   <button type="submit" class="btn btn-primary">Simpan</button>
               </form>
           </div>
       </div>
       
   <x-modal-rupiah></x-modal-rupiah>
   <x-image-preview></x-image-preview>
   </x-layout>
   
   
   
   
   
   