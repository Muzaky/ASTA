<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
</head>

<body>
    <div id="container" class="max-md:flex h-screen justify-center items-center flex-col font-[Poppins] p-[32px]">
        <img src="{{ asset('img/logo.png') }}" alt="" class="mb-10">
        <div>
            @if ($roles == 2)
            <h1 class="max-md:font-semibold text-[28px] mb-2">Login</h1>
            @else
            <h1 class="max-md:font-semibold text-[28px] mb-2">Hi, Volunteer !</h1>
            @endif
            
            <p class="max-md:text-[12px] mb-[32px] text-[#828282]">Masuk untuk menggunakan aplikasi</p>
            <label for="" class="">Nama Pengguna</label>
            <input type="text"
                class="h-[40px] w-full rounded-[20px] bg-[#F1F1F0] border border-[#D3D3D3] mt-2 mb-4 p-4 text-[12px]"
                placeholder="Nama pengguna">
            <label for="" class="">Kata Sandi</label>
            <input type="password"
                class="h-[40px] w-full rounded-[20px] bg-[#F1F1F0] border border-[#D3D3D3] mt-2 p-4 text-[12px]"
                placeholder="Kata sandi">
            <a href="" class="text-[#F9DC5C] justify-end flex mt-2">Lupa kata sandi ?</a>
            <button
                class="max-md:w-full text-center bg-[#F9DC5C] rounded-[20px] text-[20px] font-medium py-[5px] mt-4">Masuk</button>
            <div class="flex flex-row items-center justify-center mt-2">
                <p>Belum punya akun ? </p>
                <a href="{{ route('register', ['id_roles' => $roles]) }}" class="text-[#F9DC5C]">Daftar</a>
            </div>
            
        </div>
    </div>

</body>

</html>
