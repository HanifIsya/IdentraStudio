<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Atkinson+Hyperlegible+Mono:ital,wght@0,200..800;1,200..800&family=Iceland&display=swap" rel="stylesheet">

    <style>
        .atkinson-hyperlegible-mono-800 {
  font-family: "Atkinson Hyperlegible Mono", sans-serif;
  font-optical-sizing: auto;
  font-weight: 800;
  font-style: normal;
}


    </style>


@vite('resources/css/app.css')
</head>


<body>

<nav class="fixed w-full top-0 flex justify-between shadow-lg p-6 bg-gray-950 z-50">
    <h1 class="font-extrabold text-white">IDENTRA STUDIO</h1>
    <ul class="flex gap-6 text-sm font-serif text-white">
        <li onclick="location.href='{{ route('login') }}'" class="hover:text-blue-800 cursor-pointer">Login / Register</li>
        <li onclick="location.href='#layanan'" class="hover:text-blue-800 cursor-pointer">Layanan</li>
        <li onclick="location.href='#Cara Kerja'" class="hover:text-blue-800 cursor-pointer">Cara Kerja</li>
        <li onclick="location.href='#Tentang Kami'" class="hover:text-blue-800 cursor-pointer">Tentang Kami</li>

    </ul>

</nav>
<section class="relative inset-0 h-full w-full pt-20 bg-cover bg-center bg-no-repeat pb-[350px]" style="background-image: url('{{ asset('img/image.png') }}');">
         <h3 class="text-pretty atkinson-hyperlegible-mono-800 text-gray-600 mx-4 text-sm">Innovative Digital Entertainment & Creative Art</h3>

    <h1 class="text-white text-left text-5xl m-4 font-extrabold">IDENTITY</h1>
    <h1 class="text-white text-left text-5xl m-4 font-extrabold">ENTERTAINMENT</h1>
    <h1 class="text-white text-left text-5xl m-4 font-extrabold">TRANSFORM</h1>
    <h1 class="text-gray-500 text-left text-5xl m-4 font-extrabold">STUDIO</h1>   

    <button onclick="location.href='{{ route('login') }}'" class="bg-gray-950 text-white px-6 py-3 rounded-lg mx-4 mt-10 hover:bg-gray-700 border transform hover:scale-110 duration-300 ">MASUK SEKARANG</button>



 <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" class="absolute -bottom-[2px] left-0 w-full z-0 pointer-events-none block">
  <path fill="#000000" fill-opacity="1" d="M0,64L60,74.7C120,85,240,107,360,133.3C480,160,600,192,720,197.3C840,203,960,181,1080,192C1200,203,1320,245,1380,266.7L1440,288L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z"></path>
</svg>

</section>

<section id="layanan" class="relative h-screen bg-black ">
    
    <h4 class="text-gray-500 text-sm text-left top-40 left-10 absolute ">01 LAYANAN</h4>
    <h2 class="text-white text-4xl font-bold text-left text-pretty pt-48 p-6 ">MEMBANGUN BRANDING <br> LEWAT VISUAL </h2>

    <div class="flex flex-row gap-10 p-6 justify-center">
        <div class="container border bg-zinc-900 border-white w-64 h-64 rounded-xl flex flex-col p-4">
            <h1 class="font-bold text-white text-center">Film Production</h1>
            <p class=" text-sm text-gray-500 font-sans">Menjadikan Perusahaan Anda
lebih memiliki Makna.</p>
                <p class="text-white text-sm pt-6">Jasa pembuatan video untuk perusahaan,
termasuk jasa video company profile, film,
Video Safety Induction, dan iklan TV.</p>
                    <a href="{{ route('login') }}" class="text-white cursor-pointer pt-8 hover:text-gray-400">LIHAT DETAIL</a>

        </div>

        <div class="container border bg-zinc-900 border-white w-64 h-64 rounded-xl flex flex-col p-4">
            <h1 class="font-bold text-white text-center">Video Animation</h1>
            <p class=" text-sm text-gray-500 font-sans">Membuat video dengan visual
yang menarik dan unik.</p>
                <p class="text-white text-sm pt-6">Jasa pembuatan video animasi kami seperti:
Video Explainer, Video Presentation, Life
Shoot Animation, Greetings, dan 2D-3D
Animasi lainnya.</p>
                    <a href="{{ route('login') }}" class="text-white cursor-pointer pt-4 hover:text-gray-400">LIHAT DETAIL</a>

        </div>


        <div class="container border bg-zinc-900 border-white w-64 h-64 rounded-xl flex flex-col p-4">
            <h1 class="font-bold text-white text-center">Design & IT Support</h1>
            <p class=" text-sm text-gray-500 font-sans">Konsultan Brand dan Kebutuhan
IT Perusahaan.</p>
                <p class="text-white text-sm pt-6">Menjadi konsultan Desain untuk konsep
Merek Perusahaan Anda, dan menyediakan
kebutuhan IT seperti: Website, Aplikasi, dan
Platform Digital.</p>
                    <a href="{{ route('login') }}" class="text-white cursor-pointer pt-4 hover:text-gray-400">LIHAT DETAIL</a>

        </div>




    </div>
    

</section>

<section id="Cara Kerja" class="relative h-screen bg-black">
    <h4 class="text-gray-500 text-sm text-left top-40 left-10 absolute ">02 KENAPA HARUS KAMI</h4>
    <div class="flex flex-row  pt-48 p-6">
        <h2 class="text-white text-4xl font-bold text-left text-pretty ">HOW WE DO IT</h2>
        <div class="flex justify-center flex-col gap-6 px-12">
           <div>
            <h1 class="font-bold text-2xl text-gray-600">#1 <span class="text-white text-xl"> Briefing & Brainstorming</span></h1>
            <h2 class="font-semibold text-sm text-gray-400">Tim kami sangat terbuka untuk berdiskusi tentang konsep dan menyesuaikan dengan
Permintaan Klien. Pengumpulan data Perusahaan anda pun akan aman berada di
tangan kami.</h2>
           </div>

            <div>
            <h1 class="font-bold text-2xl text-gray-600">#2 <span class="text-white text-xl"> Execution</span></h1>
            <h2 class="font-semibold text-sm text-gray-400"> Koordinasi tim dan klien dari Proses Produksi hingga Post Produksi, dengan kerja
cepat, tepat, dan akurat untuk mendapatkan hasil maksimal.</h2>
           </div>

            <div>
            <h1 class="font-bold text-2xl text-gray-600">#3 <span class="text-white text-xl"> Result</span></h1>
            <h2 class="font-semibold text-sm text-gray-400">Kepuasan klien menjadi keberhasilan tim kami. Kami selalu berusaha menjadi rekan
yang fleksibel dan dinamis. Karya yang kami hasilkan akan selalu sesuai dengan
harapan anda.</h2>
           </div>
           
        </div>
        
    </div>

</section>

<section id="Tentang Kami" class="relative h-screen bg-black flex justify-center items-center">
    <div class="flex flex-col gap-6 p-6 top-0 absolute">
        <h4 class="text-gray-500 text-sm">03 TENTANG KAMI</h4>
        <h1 class="text-white text-5xl font-serif font-bold text-pretty">"Berkembang Bersama dan Selalu Berinovasi
dengan karya. We are the decisive factor behind
your success."</h1>
    </div>
        <p class="text-gray-500 text-sm text-center text-balance">Identra Studio adalah Rumah Produksi, yang bergerak dalam bisnis ekonomi kreatif. 
Perusahaan kami didirikan pada 2026 . Kami
memiliki pengalaman bekerja pada proyek-proyek besar dari perusahaan Negar
dan Swasta.</p>


</section>

<section class="relative min-h-min bg-black">
    <div class="flex flex-col px-6">
        <h1 class="text-white font-extrabold font-sans text-2xl m-6">LET'S TALK.</h1>
        <h1 class="text-white text-sm">kontak : <span class="text-gray-400">+62 852-3373-1724</span></h1>
        <h1 class="text-white text-sm">gmail : <span class="text-gray-400">admin@identrastudio.com</span></h1>
        <h1 class="text-white text-sm">lokasi : <span class="text-gray-400">Jl. Dr. Ir. H. Soekarno, Mulyorejo, Kec. Mulyorejo, Surabaya, Jawa Timur 60115</span></h1>


    </div>
</section>

<footer class="bg-gray-950 text-white p-6 text-center py-10">
    <p class="text-gray-600 text-right">PROVIDING CREATIVE IDEAS FOR YOUR BUSINESS</p>
    <p class="text-right text-white text-sm">&copy; 2026 Identra Studio. All rights reserved.</p>

</footer>
    
</body>
</html>