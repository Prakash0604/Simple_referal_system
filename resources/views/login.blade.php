<!doctype html>
<html lang="en">
    <head>
        <title>Login</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
    </head>

    <body>
        <div class="container col-4 mt-3">
            <h1 class="text-center bg-dark text-white rounded mt-3 mb-2">Login User</h1>
            <div class="card p-3">
                @if (session()->has('message'))
                    <div class="alert alert-danger text-center">{{ session()->get('message') }}</div>
                @endif
                <form action="" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Email</label>
                        <input
                            type="email"
                            name="email"
                            class="form-control @error('email') is-invalid @enderror"
                        />
                        @error('email')    
                        <small id="helpId" class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Password</label>
                        <input
                            type="password"
                            name="password"
                            class="form-control @error('password') is-invalid @enderror"
                        />
                        @error('password')    
                        <small id="helpId" class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <button class="btn btn-primary">Login</button>
                </form>
            </div>
        </div>
    </body>
</html>
