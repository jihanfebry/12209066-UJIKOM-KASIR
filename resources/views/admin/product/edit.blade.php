<x-layout>

<div class="pagetitle">
    <h1>Edit Produk</h1>
       <nav>
           <ol class="breadcrumb">
               <li class="breadcrumb-item"><a href="">Daftar Produk</a></li>
               <li class="breadcrumb-item active">Edit Produk</li>
           </ol>
       </nav>
   </div>
           
       <div class="card shadow-sm border-0 rounded-lg"> 
           <div class="card-body p-4"> 
               <form action="" method="POST" enctype="multipart/form-data">
                   @csrf
                    @method('PUT')

                   <div class="mb-3">
                       <label for="" class="form-label">Gambar Produk</label>
                       <input type="file" class="form-control" name="" id="" onchange="">
                       @error('') <small class="text-danger"></small> @enderror
                
                        <div class="mt-2">
                            <img id="imagePreview" 
                                src=""  
                                width="100" height="100" 
                                class="rounded-lg border" 
                                style="object-fit: cover; display: none;">
                        </div>
                    </div>
                   
                   <div class="mb-3">
                       <label for="" class="form-label"></label>
                       <input type="text" class="form-control" name="" id="" value="">
                       @error('') <small class="text-danger"></small> @enderror
                   </div>
   
                   <div class="mb-3">
                       <label for="price" class="form-label"></label>
                       <div class="input-group">
                           <input type="text" class="form-control" name="price" id="price" value="" 
                           onkeyup="" onblur="">
                       </div>
                       @error('price')<small class="text-danger"></small> @enderror
                   </div>
   
                   <div class="mb-3">
                       <label for="" class="form-label"></label>
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
   
   
   
   
   
   