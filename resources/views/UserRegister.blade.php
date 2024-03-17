<!doctype html>
<html lang="en">
    <head>
        <title>User Registration</title>
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
        <div class="container col-3">
            <h1 class="text-center bg-dark text-white mt-2 mb2 rounded">User Register</h1>
            <div class="card p-3">
                @if (session()->has('success'))
                    <div class="alert alert-success text-center">{{ session()->get('success') }}</div>
                @endif
                @if (session()->has('referal_code'))
                    <div class="alert alert-success text-center">{{ session()->get('referal_code') }}</div>
                @endif
                @if (session()->has('error'))
                    <div class="alert alert-danger text-center">{{ session()->get('error') }}</div>
                @endif
                @if (session()->has('verify'))
                    <div class="alert alert-success text-center">{{ session()->get('verify') }}</div>
                @endif
                <form action="" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Name</label>
                        <input
                            type="text"
                            name="name"
                            class="form-control @error('name') is-invalid   @enderror"
                            placeholder="Enter your full name"
                        />
                        @error('name')         
                        <small id="helpId" class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Email</label>
                        <input
                            type="email"
                            name="email"
                            class="form-control @error('email') is-invalid   @enderror"
                            placeholder="Enter your email"
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
                            class="form-control @error('password') is-invalid   @enderror"
                            placeholder="Enter your password"
                        />
                        @error('password')         
                        <small id="helpId" class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Confirm Password</label>
                        <input
                            type="password"
                            name="cpassword"
                            class="form-control @error('cpassword') is-invalid   @enderror"
                            placeholder="Confirm Password"
                        />
                        @error('cpassword')         
                        <small id="helpId" class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Referal Code(optional)</label>
                        <input
                            type="text"
                            name="referal_code"
                            class="form-control @error('referal_code') is-invalid   @enderror"
                            placeholder="Enter your referal code"
                        />
                        @error('referal_code')         
                        <small id="helpId" class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <button class="btn btn-primary">Register</button>
                </form>
            </div>
        </div>
    </body>
</html>
