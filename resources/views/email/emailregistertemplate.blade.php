<!doctype html>
<html lang="en">
    <head>
        <title>{{ $data['title'] }}</title>
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
     <div class="container">
        <div class="card">
            <h1 class="text-center bg-dark text-white mt-2 mb-2 rounded">Name : {{ $data['name'] }}</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Referal Link</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td scope="row">{{ $data['email'] }}</td>
                        <td>{{ $data['password'] }}</td>
                        <td><a href="{{ $data['url'] }}">Click Here</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
     </div>
    </body>
</html>
