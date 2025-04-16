<x-layout>

    <div class="pagetitle">
        <h1>Edit Produk</h1>
           <nav>
               <ol class="breadcrumb">
                   <li class="breadcrumb-item"><a href="">Daftar Pengguna</a></li>
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
                           <label for="" class="form-label">Nama</label>
                           <input type="text" class="form-control" name="" id="" value="">
                           @error('') <small class="text-danger"></small> @enderror
                       </div>

                       <div class="mb-3">
                           <label for="" class="form-label"></label>
                           <input type="email" class="form-control" name="" id="" value="">
                           @error('') <small class="text-danger"></small> @enderror
                       </div>
       
                       <div class="mb-3">
                            <label for="" class="form-label">Password (Kosongkan jika tidak ingin mengubah)</label>
                            <input type="password" class="form-control" name="" id="">
                            @error('') <small class="text-danger"></small> @enderror
                       </div>
    
                    <div class="mb-3">
                        <label for="" class="form-label">Peran</label>
                        <div class="input-group">
                            <select class="form-select" name="" id="">
                                <option value="">Admin</option>
                                <option value="">Petugas</option>
                            </select>
                        </div>
                    </div>
                
           
                       <button type="submit" class="btn btn-primary">Simpan</button>
                   </form>
               </div>
           </div>
       </x-layout>
       
       
       
       
       
       