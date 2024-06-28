<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
</head>

<body class="font-[Poppins]">
    <div class="max-md:p-[32px]">
        <a href="{{ route('login', ['id_roles' => $roles]) }}" class=" flex items-center text-black text-sm font-medium ">
            <svg class="w-6 h-6 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Back
        </a>
        <h1 class="font-semibold text-[32px]">Daftar</h1>
        @if ($roles == 2)
            <p class="font-[300] text-[12px] text-[#828282] mb-2">Daftarkan akun pengguna kalian !</p>
            <form action="{{ route('authregister') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <input type="hidden" name="id_roles" value="{{ $roles }}">
                <label for="namadepan" class="text-[16px]">Nama Depan</label>
                <input type="text" name="nama_depan"
                    class="h-[40px] w-full rounded-[16px] bg-[#F1F1F0] border border-[#D3D3D3] mt-2 mb-[6px] p-4 text-[12px]"
                    placeholder="Masukkan Nama Depan">
                <label for="namabelakang" class="text-[16px]">Nama Belakang</label>
                <input type="text" name="nama_belakang"
                    class="h-[40px] w-full rounded-[16px] bg-[#F1F1F0] border border-[#D3D3D3] mt-2 mb-[6px] p-4 text-[12px]"
                    placeholder="Masukkan Nama Belakang">
                <div class="flex flex-row gap-[10px]">
                    <div>
                        <label for="umur">Umur</label>
                        <input type="number" name="umur"
                            class="h-[40px] w-full rounded-[16px] bg-[#F1F1F0] border border-[#D3D3D3] mt-2 mb-[6px] p-4 text-[12px]"
                            placeholder="Masukkan Umur">
                    </div>
                    <div>
                        <label for="jeniskelamin">Jenis Kelamin</label>
                        <select name="jenis_kelamin" id="jeniskelamin" class="h-[40px] w-full rounded-[16px] bg-[#F1F1F0] border border-[#D3D3D3] mt-2 mb-[6px] px-4 text-[12px]">
                            <option value="" class="text-[12px] text-black">Jenis Kelamin</option>
                            <option value="L" class="text-[12px] text-black">Laki-Laki</option>
                            <option value="P" class="text-[12px] text-black">Perempuan</option>
                        </select>
                       
                    </div>
                </div>
                <label for="NIK" class="text-[16px]">NIK</label>
                <input type="number" name="nik"
                    class="h-[40px] w-full rounded-[16px] bg-[#F1F1F0] border border-[#D3D3D3] mt-2 mb-[6px] p-4 text-[12px]"
                    placeholder="Masukkan NIK"> 
                <label for="kecamatan">Kecamatan</label>
                <select name="kecamatan" id="kecamatan" class="h-[40px] w-full rounded-[16px] bg-[#F1F1F0] border border-[#D3D3D3] mt-2 mb-[6px] px-4 text-[12px]">
                    <option selected disabled>Pilih Kecamatan</option>
                    @foreach ($kecamatan as $item)
                        <option value="{{ $item->nama_kecamatan }}">{{ $item->nama_kecamatan }}</option>
                    @endforeach
                </select>
                <label for="alamat">Alamat</label>
                <input type="text" name="alamat"
                    class="h-[40px] w-full rounded-[16px] bg-[#F1F1F0] border border-[#D3D3D3] mt-2 mb-[6px] p-4 text-[12px]"
                    placeholder="Masukkan Alamat">
                <label for="nohp">No Hp</label>
                <input type="number" name="no_hp"
                    class="h-[40px] w-full rounded-[16px] bg-[#F1F1F0] border border-[#D3D3D3] mt-2 mb-[6px] p-4 text-[12px]"
                    placeholder="Masukkan No HP">
                <label for="namawali">Nama Wali</label>
                <input type="text" name="nama_wali"
                    class="h-[40px] w-full rounded-[16px] bg-[#F1F1F0] border border-[#D3D3D3] mt-2 mb-[6px] p-4 text-[12px]"
                    placeholder="Masukkan Nama Wali">
                <label for="nomorwali">Nomor Wali</label>
                <input type="varchar" name="nomor_wali"
                    class="h-[40px] w-full rounded-[16px] bg-[#F1F1F0] border border-[#D3D3D3] mt-2 mb-[6px] p-4 text-[12px]"
                    placeholder="Masukkan Nomor Wali">
                <label for="email">Email</label>
                <input type="email" name="email"
                    class="h-[40px] w-full rounded-[16px] bg-[#F1F1F0] border border-[#D3D3D3] mt-2 mb-[6px] p-4 text-[12px]"
                    placeholder="Masukkan Email">
                <label for="password">Password</label>
                <input type="password" name="password"
                    class="h-[40px] w-full rounded-[16px] bg-[#F1F1F0] border border-[#D3D3D3] mt-2 mb-[20px] p-4 text-[12px]"
                    placeholder="Masukkan Password">

                    <button type="submit" class="w-full h-10 flex justify-center items-center bg-[#F9DC5C] rounded-[16px]">Daftar</button>

            </form>
        @else
            <p class="font-[300] text-[12px] text-[#828282] mb-2">Daftarkan akun relawan kalian !</p>
            <form action="{{ route('authregister') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <input type="hidden" name="id_roles" value="{{ $roles }}">
                <label for="namadepan" class="text-[16px]">Nama Depan</label>
                <input type="text" name="nama_depan"
                    class="h-[40px] w-full rounded-[16px] bg-[#F1F1F0] border border-[#D3D3D3] mt-2 mb-[6px] p-4 text-[12px]"
                    placeholder="Masukkan Nama Depan">
                <label for="namabelakang" class="text-[16px]">Nama Belakang</label>
                <input type="text" name="nama_belakang"
                    class="h-[40px] w-full rounded-[16px] bg-[#F1F1F0] border border-[#D3D3D3] mt-2 mb-[6px] p-4 text-[12px]"
                    placeholder="Masukkan Nama Belakang">
                <div class="flex flex-row gap-[10px]">
                    <div>
                        <label for="umur">Umur</label>
                        <input type="number" name="umur"
                            class="h-[40px] w-full rounded-[16px] bg-[#F1F1F0] border border-[#D3D3D3] mt-2 mb-[6px] p-4 text-[12px]"
                            placeholder="Masukkan Umur">
                    </div>
                    <div>
                        <label for="jeniskelamin">Jenis Kelamin</label>
                        <select name="jenis_kelamin" id="jeniskelamin" class="h-[40px] w-full rounded-[16px] bg-[#F1F1F0] border border-[#D3D3D3] mt-2 mb-[6px] px-4 text-[12px]">
                            <option value="" class="text-[12px] text-black">Jenis Kelamin</option>
                            <option value="L" class="text-[12px] text-black">Laki-Laki</option>
                            <option value="P" class="text-[12px] text-black">Perempuan</option>
                        </select>
                       
                    </div>
                </div>
                <label for="NIK" class="text-[16px]">NIK</label>
                <input type="number" name="nik"
                    class="h-[40px] w-full rounded-[16px] bg-[#F1F1F0] border border-[#D3D3D3] mt-2 mb-[6px] p-4 text-[12px]"
                    placeholder="Masukkan NIK"> 
                <label for="kecamatan">Kecamatan</label>
                <select name="kecamatan" id="kecamatan" class="h-[40px] w-full rounded-[16px] bg-[#F1F1F0] border border-[#D3D3D3] mt-2 mb-[6px] px-4 text-[12px]">
                    <option selected disabled>Pilih Kecamatan</option>
                    @foreach ($kecamatan as $item)
                        <option value="{{ $item->nama_kecamatan }}">{{ $item->nama_kecamatan }}</option>
                    @endforeach
                </select>
                <label for="alamat">Alamat</label>
                <input type="text" name="alamat"
                    class="h-[40px] w-full rounded-[16px] bg-[#F1F1F0] border border-[#D3D3D3] mt-2 mb-[6px] p-4 text-[12px]"
                    placeholder="Masukkan Alamat">
                <label for="nohp">No Hp</label>
                <input type="number" name="no_hp"
                    class="h-[40px] w-full rounded-[16px] bg-[#F1F1F0] border border-[#D3D3D3] mt-2 mb-[6px] p-4 text-[12px]"
                    placeholder="Masukkan No HP">
                <label for="email">Email</label>
                <input type="email" name="email"
                    class="h-[40px] w-full rounded-[16px] bg-[#F1F1F0] border border-[#D3D3D3] mt-2 mb-[6px] p-4 text-[12px]"
                    placeholder="Masukkan Email">
                <label for="password">Password</label>
                <input type="password" name="password"
                    class="h-[40px] w-full rounded-[16px] bg-[#F1F1F0] border border-[#D3D3D3] mt-2 mb-[20px] p-4 text-[12px]"
                    placeholder="Masukkan Password">

                    <button type="submit" class="w-full h-10 flex justify-center items-center bg-[#F9DC5C] rounded-[16px]">Daftar</button>

            </form>
        @endif
    </div>
</body>

</html>
