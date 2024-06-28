<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <title>Document</title>
</head>
<style>
    


   
</style>
<body class="font-[Poppins]">
    <div id="container" class="max-md:p-[32px] ">
        <img src="{{ asset('img/logo_2.png') }}" alt="">
        <p class="font-[300] text-wrap w-[200px] text-[12px] text-[#828282] mb-2">Teman yang ada untuk
            membantu kesenjangan !</p>
        @if ($id_roles == 3){
            <div class="swiper mySwiper mt-20">
                <div class="swiper-wrapper ">
                    <div class="swiper-slide">
                        <div class="w-full h-[355px] bg-[#FAE588] flex items-center justify-center text-center">
                            <h1 class="text-[32px] font-semibold w-[200px] text-wrap">Video call Volunteer</h1>
                        </div>
    
                        <p class="font-[300] text-wrap w-full text-[12px] text-[#828282] flex justify-center mt-4">Slide
                            untuk mengganti mode</p>
                    </div>
                    <div class="swiper-slide">
                        <div class="w-full h-[355px] bg-[#FAE588] flex items-center justify-center text-center">
                            <h1 class="text-[32px] font-semibold w-[200px] text-wrap">Voice call Volunteer</h1>
                        </div>
    
                        <p class="font-[300] text-wrap w-full text-[12px] text-[#828282] flex justify-center mt-4">Slide
                            untuk mengganti mode</p>
                    </div>
                    <div class="swiper-slide flex flex-col items-center mt-2">
                        <div class="w-[300px] h-[285px] rounded-full bg-[#FAE588] flex items-center justify-center text-center">
                            <h1 class="text-[32px] font-semibold w-[200px] text-wrap">SOS</h1>
                        </div>
    
                        <p class="font-[300] text-wrap w-full text-[12px] text-[#828282] flex justify-center mt-4">Slide
                            untuk mengganti mode</p>
                    </div>
                    
                </div>
            </div>
        }@elseif ($id_roles == 2)
        {
            <p>ini halaman relawan</p>
        }@endif
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    var swiper = new Swiper('.mySwiper', {
        slidesPerView: 1, // Use 1 as a number, not a string
        spaceBetween: 30,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
    });
</script>
</html>