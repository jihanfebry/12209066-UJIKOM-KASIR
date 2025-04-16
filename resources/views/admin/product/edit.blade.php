<x-layout>

    <div class="pagetitle">
        <h1>Edit Produk</h1>
           <nav>
               <ol class="breadcrumb">
                   <li class="breadcrumb-item"><a href="{{route('admin.product.index')}}">Daftar Produk</a></li>
                   <li class="breadcrumb-item active">Edit Produk</li>
               </ol>
           </nav>
       </div>
               
           <div class="card shadow-sm border-0 rounded-lg"> 
               <div class="card-body p-4"> 
                   <form action="{{Route('admin.product.update',  $product->id)}}" method="POST" enctype="multipart/form-data">
                       @csrf
                        @method('PUT')
    
                       <div class="mb-3">
                           <label for="product_image" class="form-label">Gambar Produk</label>
                           <input type="file" class="form-control" name="product_image" id="product_image" onchange="previewImage(event)">
                           @error('product_image') <small class="text-danger">{{$message}}</small> @enderror
                    
                            <div class="mt-2">
                                <img id="imagePreview" 
                                    src="{{ $product->product_image ? asset('storage/' . $product->product_image) : 'https://via.placeholder.com/100' }}"  
                                    width="100" height="100" 
                                    class="rounded-lg border" 
                                    style="object-fit: cover; display: none;">
                            </div>
                        </div>
                       
                       <div class="mb-3">
                           <label for="product_name" class="form-label"></label>
                           <input type="text" class="form-control" name="product_name" id="product_name" value="{{old('product_name', $product->product_name)}}">
                           @error('product_name') <small class="text-danger">{{$message}}</small> @enderror
                       </div>
       
                       <div class="mb-3">
                           <label for="price" class="form-label"></label>
                           <div class="input-group">
                               <input type="text" class="form-control" name="price" id="price" value="{{old('price', 'Rp'. number_format($product->price, 0, ',', '.'))}}" 
                               onkeyup="formatRupiah(this)" onblur="restoreRupiah(this)">
                           </div>
                           @error('price')<small class="text-danger">{{$message}}</small> @enderror
                       </div>
       
                       <div class="mb-3">
                           <label for="stock" class="form-label"></label>
                           <input type="number" class="form-control" name="stock" id="stock" value="{{old('stock',  $product->stock)}}">
                           @error('stock')<small class="text-danger">{{$message}}</small> @enderror
                       </div>
                
           
                       <button type="submit" class="btn btn-primary">Simpan</button>
                   </form>
               </div>
           </div>
           
       <x-modal-rupiah></x-modal-rupiah>
       <x-image-preview></x-image-preview>
       </x-layout>
       
       
       
       
       
       