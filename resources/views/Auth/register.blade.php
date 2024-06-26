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
        <h1 class="font-semibold text-[32px]">Daftar</h1>
        @if ($roles == 2)
            <p class="font-[300] text-[12px] text-[#828282] mb-2">Daftarkan akun pengguna kalian !</p>
            <form action="">

                <label for="namapengguna" class="text-[16px]">Nama Pengguna</label>
                <input type="text"
                    class="h-[40px] w-full rounded-[16px] bg-[#F1F1F0] border border-[#D3D3D3] mt-2 mb-[6px] p-4 text-[12px]" placeholder="Masukkan Nama Pengguna">
                <div class="flex flex-row gap-[10px]">
                    <div>
                        <label for="umur">Umur</label>
                        <input type="number"
                            class="h-[40px] w-full rounded-[16px] bg-[#F1F1F0] border border-[#D3D3D3] mt-2 mb-[6px] p-4 text-[12px]" placeholder="Masukkan Umur">
                    </div>
                    <div>
                        <label for="jeniskelamin">Jenis Kelamin</label>
                        <input type="text"
                            class="h-[40px] w-full rounded-[16px] bg-[#F1F1F0] border border-[#D3D3D3] mt-2 mb-[6px] p-4 text-[12px]" placeholder="Pilih Jenis Kelamin">
                    </div>
                </div>
                <div class="flex flex-row gap-[10px]">
                    <div>
                        <label for="kabupaten">Kabupaten</label>
                        <input type="text"
                            class="h-[40px] w-full rounded-[16px] bg-[#F1F1F0] border border-[#D3D3D3] mt-2 mb-[6px] p-4 text-[12px]" placeholder="Masukkan Kabupaten">
                    </div>
                    <div>
                        <label for="kecamatan">Kecamatan</label>
                        <input type="text"
                            class="h-[40px] w-full rounded-[16px] bg-[#F1F1F0] border border-[#D3D3D3] mt-2 mb-[6px] p-4 text-[12px]" placeholder="Masukkan Kecamatan">
                    </div>
                </div>
                <label for="alamat">Alamat</label>
                <input type="text"
                    class="h-[40px] w-full rounded-[16px] bg-[#F1F1F0] border border-[#D3D3D3] mt-2 mb-[6px] p-4 text-[12px]" placeholder="Masukkan Alamat">
                <label for="namawali">Nama Wali</label>
                <input type="text"
                    class="h-[40px] w-full rounded-[16px] bg-[#F1F1F0] border border-[#D3D3D3] mt-2 mb-[6px] p-4 text-[12px]" placeholder="Masukkan Nama Wali">
                <label for="nomorwali">Nomor Wali</label>
                <input type="varchar"
                    class="h-[40px] w-full rounded-[16px] bg-[#F1F1F0] border border-[#D3D3D3] mt-2 mb-[6px] p-4 text-[12px]" placeholder="Masukkan Nomor Wali">
                <label for="email">Email</label>
                <input type="email"
                    class="h-[40px] w-full rounded-[16px] bg-[#F1F1F0] border border-[#D3D3D3] mt-2 mb-[6px] p-4 text-[12px]" placeholder="Masukkan Email">
                <label for="password">Password</label>
                <input type="password"
                    class="h-[40px] w-full rounded-[16px] bg-[#F1F1F0] border border-[#D3D3D3] mt-2 mb-[20px] p-4 text-[12px]" placeholder="Masukkan Password">

                <button class="bg-[#F9DC5C] w-full rounded-[20px] h-10 ">Daftar</button>
            </form>

           
        @else
            <p>ini register volunteer</p>
        @endif
    </div>
</body>

</html>
