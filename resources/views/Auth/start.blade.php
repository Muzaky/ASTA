<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
</head>

<body class="max-md:bg-gray-50 flex justify-center items-center h-screen font-[Poppins]">
    <div class="max-md:p-[32px]">
        <div>
            <img src="{{ asset('img/Asset_1.png') }}" alt="Illustration" class="max-md:mx-auto mb-4">
        </div>
        <div class="max-md:mb-[12px]">
            <img src="{{ asset('img/logo_2.png') }}" alt="Logo" class="">
        </div>
        <h1 class="max-md:font-semibold text-[28px] mb-2">Asisten Pemandu Tunanetra</h1>
        <p class="max-md:text-[12px] mb-[32px]">Aplikasi kami dirancang khusus untuk menjembatani kesenjangan dan memberi Anda kemandirian yang layak Anda dapatkan</p>
        <div id="buttoncontainer" class="max-md:flex flex-col gap-[28px]">
            <a href="{{ route('login', ['id_roles' => 2]) }}" class="max-md:w-full text-center bg-[#F9DC5C] rounded-[20px] text-[20px] font-medium py-[5px]">Masuk sebagai User</a>
            <a href="{{ route('login', ['id_roles' => 3]) }}" class="max-md:w-full text-center bg-[#F9DC5C] rounded-[20px] text-[20px] font-medium py-[5px]">Masuk sebagai Relawan</a>
        </div>
    </div>
</body>

</html>
