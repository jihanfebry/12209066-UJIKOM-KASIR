<x-layout>

    <div class="pagetitle">
        <h1>Halaman Pengguna</h1>
          <nav>
              <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="">Pengguna</a></li>
                  <li class="breadcrumb-item active">Daftar Pengguna</li>
              </ol>
          </nav>
      </div>
      
      
      <div class="card shadow-sm border-0 rounded-lg"> 
          <div class="card-body p-1">
              <div class="container mt-4">
      
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div></div>
                    <a href="" class="btn btn-primary">Tambah Pengguna</a>
                </div>

                  <div class="table-responsive">
                      <table class="table table-striped align-middle w-100" style="table-layout: fixed;">
                          <thead class="table-light">
                              <tr>
                                  <th style="width: 5%;">#</th>
                                  <th style="width: 30%;">Nama</th>
                                  <th style="width: 30%;">Email</th>
                                  <th style="width: 15%;">Role</th>
                                  <th style="width: 20%;" class="text-end"></th>
                              </tr>
                          </thead>
          
                          <tbody>
                           
                              <tr>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td><span class="badge bg-"></span></td>
                                  <td>
                                      <div class="d-flex justify-content-between">
                                        <a href="" class="btn btn-warning btn-sm">Edit</a>
                                          <button type="button" class="btn btn-danger btn-sm" 
                                              data-bs-toggle="modal"
                                              data-bs-target= "#deleteModal"
                                              data-id = ""
                                              data-name= "">
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
      
<x-user.modal-delete></x-user.modal-delete>
</x-layout>


  