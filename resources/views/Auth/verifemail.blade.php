<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="font-[Poppins]">
    <div id="container" class="flex flex-col justify-center items-center h-screen p-[32px]">
        <img src="{{ asset('img/logo.png') }}" alt="">
        <h1 class="text-[32px] font-semibold">Verifikasi Email</h1>
        <p class="text-wrap w-[320px] text-center text-[#828282] font-[300] mb-10">Satu langkah lagi untuk menggunakan
            aplikasi !, setelah verifikasi email
            kamu sudah terdaftar sebagai pengguna !</p>
        <a href="{{ route('start') }}" class="w-full h-10 flex justify-center items-center bg-[#F9DC5C] rounded-[16px]">Kembali ke laman masuk</a>
    </div>
    
</body>
</html>