<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Landing</title>
</head>
<body class="max-md:flex justify-center items-center h-screen">
    <img src="{{ asset('img/Logo.png') }}" alt="">
    
    <script>
        document.addEventListener('click', function() {
            window.location.href = '{{ route('start') }}'; // Replace 'https://example.com' with the URL of the page you want to redirect to
        });
    </script>
</body>
</html>