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
    <a href="{{ route('start') }}"
        class=" flex items-center absolute left-4 top-4 text-black text-sm font-medium ">
        <svg class="w-6 h-6 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
        </svg>
        Back
    </a>

    <div id="container" class="max-md:flex h-screen justify-center items-center flex-col font-[Poppins] p-[32px]">
        <img src="{{ asset('img/logo.png') }}" alt="" class="mb-10">
        <div>
            @if ($roles == 2)
            <h1 class="max-md:font-semibold text-[28px] mb-2">Login</h1>
            @else
            <h1 class="max-md:font-semibold text-[28px] mb-2">Hi, Volunteer !</h1>
            @endif
            
            <p class="max-md:text-[12px] mb-[32px] text-[#828282]">Masuk untuk menggunakan aplikasi</p>
            <form action="{{ route('authlogin') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <label for="email" class="">Email</label>
                <input type="email" name="email"
                    class="h-[40px] w-full rounded-[20px] bg-[#F1F1F0] border border-[#D3D3D3] mt-2 mb-4 p-4 text-[12px]"
                    placeholder="Email">
                <label for="" class="">Kata Sandi</label>
                <input type="password" name="password"
                    class="h-[40px] w-full rounded-[20px] bg-[#F1F1F0] border border-[#D3D3D3] mt-2 p-4 text-[12px]"
                    placeholder="Kata sandi">
                <a href="" class="text-[#F9DC5C] justify-end flex mt-2">Lupa kata sandi ?</a>
                <button type="submit"
                    class="max-md:w-full text-center bg-[#F9DC5C] rounded-[20px] text-[20px] font-medium py-[5px] mt-4">Masuk</button>
                    @if ($roles == 2)
                        
                    <a href="{{ route('main') }}">Masuk ke fitur user</a>
                    @else
                        
                    @endif
            </form>
            <div class="flex flex-row items-center justify-center mt-2">
                <p>Belum punya akun ? </p>
                <a href="{{ route('register', ['id_roles' => $roles]) }}" class="text-[#F9DC5C]">Daftar</a>
            </div>
            
        </div>
    </div>

</body>

</html>
