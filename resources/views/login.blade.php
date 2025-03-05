<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <div class="w-full h-screen relative flex justify-center items-center">
        <div class="form absolute top-0 left-0 z-10 bg-white w-full shadow-xl lg:w-1/2">
            <div class="h-screen w-full rounded-lg flex flex-col justify-center items-center gap-6">
                <h1 class="font-extrabold text-4xl">Login</h1>
                <form action="{{ route('loginaction') }}" method="POST" class="flex flex-col gap-3 w-2/4">
                    @csrf
                    @method('POST')
                    <input type="text" name="email"
                        class="w-full pl-2 h-10 bg-gray-200 text-black focus:outline-none" placeholder="Email">
                    <input type="password" name='password'
                        class="w-full pl-2 h-10 bg-gray-200 text-black focus:outline-none" placeholder="Password">
                    <button type="submit"
                        class="font-bold bg-sky-600 text-white rounded-md w-fit px-6 py-1">Login</button>
                </form>
                <p class="font-bold">Don't have account? <a href="{{ route('register') }}"
                        class="text-sky-600 hover:underline hover:underline-offset-2 hover:decoration-sky-600">Register</a>
                </p>
                <a href="{{ route('home') }}"
                    class="w-2/4 bg-gray-300 text-center p-1 rounded-md font-bold uppercase tracking-widest">Guest</a>
            </div>
        </div>
        <img src="{{ asset('static/img/background.jpg') }}" class="absolute top-0 left-0 z-0 h-screen w-full hidden lg:block"
            alt="">
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if (session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: "Success!",
                text: "{{ session('success') }}",
                icon: "success",
            });
        });
    </script>
@endif
@if (session('error'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: "Something Wrong!",
                text: "{{ session('error') }}",
                icon: "error",
            });
        });
    </script>
@endif

</html>
