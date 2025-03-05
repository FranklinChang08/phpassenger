<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }} | Bus Ticketing</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Righteous&display=swap"
        rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    <link rel="icon" href="{{ asset('static/img/icon.jpg') }}" type="image/jpeg">

    <link rel="stylesheet" href="{{ asset('static/css/app.css') }}">
</head>

<body class="bg-gray-100 font-poppins">
    <header class="z-50">
        @yield('header')
    </header>
    <main class="z-30">
        @yield('content')
    </main>
    <footer class="z-10">
        @yield('footer')
    </footer>
</body>

<script src="{{ asset('static/js/action.js') }}"></script>
<script src="{{ asset('static/js/order.js') }}"></script>
<script>
    let dropzone = document.getElementById('dropzone');
    let fileInput = document.getElementById('fileInput');
    let imagePreview = document.getElementById('imagePreview');

    // Click to open file picker
    dropzone.addEventListener('click', () => fileInput.click());

    // Drag & Drop Effects
    dropzone.addEventListener('dragover', (e) => {
        e.preventDefault();
        dropzone.classList.add('border-blue-500');
    });

    dropzone.addEventListener('dragleave', () => {
        dropzone.classList.remove('border-blue-500');
    });

    dropzone.addEventListener('drop', (e) => {
        e.preventDefault();
        dropzone.classList.remove('border-blue-500');

        let file = e.dataTransfer.files[0];
        if (file) {
            fileInput.files = e.dataTransfer.files;
            showImagePreview(file);
        }
    });

    // When user selects a file
    fileInput.addEventListener('change', function(event) {
        let file = event.target.files[0];
        if (file) {
            showImagePreview(file);
        }
    });

    // Function to show image preview
    function showImagePreview(file) {
        let reader = new FileReader();
        reader.onload = function(e) {
            imagePreview.src = e.target.result;
            imagePreview.classList.remove('hidden');
        };
        reader.readAsDataURL(file);
    }
</script>
<script>
    const userMenuButton = document.getElementById('userMenuButton');
    const userMenuDropdown = document.getElementById('userMenuDropdown');

    userMenuButton.addEventListener('click', () => {
        userMenuDropdown.classList.toggle('hidden'); // Toggle visibility
    });

    // Optional: Close the dropdown if clicked outside
    document.addEventListener('click', (event) => {
        if (!userMenuButton.contains(event.target) && !userMenuDropdown.contains(event.target)) {
            userMenuDropdown.classList.add('hidden');
        }
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.min.js"
    integrity="sha512-L0Shl7nXXzIlBSUUPpxrokqq4ojqgZFQczTYlGjzONGTDAcLremjwaWv5A+EDLnxhQzY5xUZPWLOLqYRkY0Cbw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

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

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script src="{{ asset('static/js/chart.js') }}"></script>

</html>
