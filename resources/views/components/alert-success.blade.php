@if(session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            title: 'Success!',
            text: '{{ session('success') }}',
            icon: 'success',
            confirmButtonText: 'OK',
            timer: 3000, 
            timerProgressBar: true
        });
    });
</script>
@endif

@if(session('failed'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            title: 'Error!',
            text: '{{ session('failed') }}',
            icon: 'failed',
            confirmButtonText: 'OK',
            timer: 3000, 
            timerProgressBar: true
        });
    });
</script>
@endif

