<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="container" style="background-color: rgb(238, 238, 243)">
    <div class="d-flex flex-column justify-content-center align-items-center h-full" style="height: 100vh">
        <div class="shadow w-50 p-4" style="height: auto; background-color: rgb(255, 255, 255)">
            <h2 class="text-center fw-bolder mb-5">Login</h2>
            <form action="{{ route('login.auth') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="emailInput">Email</label>
                    <input type="email" id="EmailInput" name="email" class="form-control"
                        placeholder="ex: kocak@gmail.com">
                </div>
                <div class="mb-3">
                    <label for="passwordInput">Password</label>
                    <input type="password" id="passwordInput" name="password" class="form-control"
                        placeholder="Input password here!">
                </div>
                <div class="pt-2 text-center" class="">
                    <button type="submit" class="btn btn-info p-2 fw-bold text-white"
                        style="width: 10em">Login</button>
                </div>
            </form>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger mt-4 w-50">
                <ul>
                    @foreach ($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
