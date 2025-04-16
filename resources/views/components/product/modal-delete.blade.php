
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus Produk</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
  
        <div class="modal-body">
        
          <div id="canDelete">
            <p>Apakah Anda yakin ingin menghapus produk <strong id="deleteProductName"></strong>?</p>
          </div>
  
         
          <div id="cannotDelete" class="d-none">
            <p class="text-danger">Produk <strong id="undeletableProductName"></strong> sudah pernah dibeli dan tidak bisa dihapus.</p>
          </div>
        </div>
  
        <div class="modal-footer">
          <form id="deleteForm" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Hapus</button>
          </form>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        </div>
      </div>
    </div>
  </div>
  

  <script>
    document.addEventListener("DOMContentLoaded", function () {
        let deleteModal = document.getElementById("deleteModal");
    
        deleteModal.addEventListener("show.bs.modal", function (event) {
            let button = event.relatedTarget;
            let productId = button.getAttribute("data-id");
            let productName = button.getAttribute("data-name");
            let hasOrder = button.getAttribute("data-has-order") === "true";
    
            let form = document.getElementById("deleteForm");
            let submitButton = deleteModal.querySelector("button[type='submit']");
    
            let canDelete = document.getElementById("canDelete");
            let cannotDelete = document.getElementById("cannotDelete");
    
            document.getElementById("deleteProductName").textContent = productName;
            document.getElementById("undeletableProductName").textContent = productName;
    
            if (hasOrder) {
                form.style.display = "none";
                submitButton.style.display = "none";
                canDelete.classList.add("d-none");
                cannotDelete.classList.remove("d-none");
            } else {
                form.style.display = "inline";
                submitButton.style.display = "inline-block";
                form.action = 
                canDelete.classList.remove("d-none");
                cannotDelete.classList.add("d-none");
            }
        });
    });
    </script>
    
    