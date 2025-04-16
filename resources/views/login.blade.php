<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In Form</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<body class="bg-light d-flex align-items-center" style="height: 100vh;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card shadow-sm rounded-3">
                    <div class="card-body">
                        <h3 class="text-center mb-4 fw-bold">Log In Form</h3>
                        <form method="POST" action="">
                            @csrf

                            @if (Session::has('failed'))
                                <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                                    {{ Session::get('failed') }}
                                </div>
                                @endif

                           
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" id="email" required autofocus>
                            </div>

                           
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" id="password" required>
                            </div>

                           
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Log In</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- @if(session('success'))
    <script>
        setTimeout(function () {
        Swal.fire({
            title: 'Success!',
            text: {!! json_encode(session('success')) !!},
            icon: 'success',
            confirmButtonText: 'OK',
            timer: 2000,
            timerProgressBar: true,
            backdrop: false 
        });
    }, 100); --}}
</body>
</html>



