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
.logo-geser {
    animation: geser 10s ease-in-out infinite alternate;
}

@keyframes geser {
    from {
        transform: translateX(0);
    }
    to {
        transform: translateX(calc(100vw - 100%));
    }
}


    </style>


@vite('resources/css/app.css')




</head>


<body>

<nav class="fixed top-0 z-50 flex justify-between w-full p-6 shadow-lg bg-gray-950">
    <h1 class="font-extrabold text-white">IDENTRA STUDIO</h1>
    <ul class="flex gap-6 font-serif text-sm text-white">
        <li onclick="location.href='{{ route('login') }}'" class="cursor-pointer hover:text-blue-800">Login / Register</li>
        <li onclick="location.href='#layanan'" class="cursor-pointer hover:text-blue-800">Layanan</li>
        <li onclick="location.href='#Cara Kerja'" class="cursor-pointer hover:text-blue-800">Cara Kerja</li>
        <li onclick="location.href='#Tentang Kami'" class="cursor-pointer hover:text-blue-800">Tentang Kami</li>

    </ul>

</nav>
<section class="relative inset-0 h-full w-full pt-20 bg-cover bg-center bg-no-repeat pb-[350px]" style="background-image: url('{{ asset('img/image.png') }}');">
         <h3 class="mx-4 text-sm text-gray-600 text-pretty atkinson-hyperlegible-mono-800">Innovative Digital Entertainment & Creative Art</h3>

    <h1 class="m-4 text-5xl font-extrabold text-left text-white">IDENTITY</h1>
    <h1 class="m-4 text-5xl font-extrabold text-left text-white">ENTERTAINMENT</h1>
    <h1 class="m-4 text-5xl font-extrabold text-left text-white">TRANSFORM</h1>
    <h1 class="m-4 text-5xl font-extrabold text-left text-gray-500">STUDIO</h1>

    <button onclick="location.href='{{ route('login') }}'" class="px-6 py-3 mx-4 mt-10 text-white duration-300 transform border rounded-lg bg-gray-950 hover:bg-gray-700 hover:scale-110 ">MASUK SEKARANG</button>



 <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" class="absolute -bottom-[2px] left-0 w-full z-0 pointer-events-none block">
  <path fill="#000000" fill-opacity="1" d="M0,64L60,74.7C120,85,240,107,360,133.3C480,160,600,192,720,197.3C840,203,960,181,1080,192C1200,203,1320,245,1380,266.7L1440,288L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z"></path>
</svg>

</section>

<section id="layanan" class="relative h-screen bg-black ">

    <h4 class="absolute text-sm text-left text-gray-500 top-40 left-10 ">01 LAYANAN</h4>
    <h2 class="p-6 pt-48 text-4xl font-bold text-left text-white text-pretty ">MEMBANGUN BRANDING <br> LEWAT VISUAL </h2>

    <div class="flex flex-row justify-center gap-10 p-6">
        <div class="container flex flex-col w-64 h-64 p-4 border border-white bg-zinc-900 rounded-xl">
            <h1 class="font-bold text-center text-white">Film Production</h1>
            <p class="font-sans text-sm text-gray-500 ">Menjadikan Perusahaan Anda
lebih memiliki Makna.</p>
                <p class="pt-6 text-sm text-white">Jasa pembuatan video untuk perusahaan,
termasuk jasa video company profile, film,
Video Safety Induction, dan iklan TV.</p>
                    <a href="{{ route('login') }}" class="pt-8 text-white cursor-pointer hover:text-gray-400">LIHAT DETAIL</a>

        </div>

        <div class="container flex flex-col w-64 h-64 p-4 border border-white bg-zinc-900 rounded-xl">
            <h1 class="font-bold text-center text-white">Video Animation</h1>
            <p class="font-sans text-sm text-gray-500 ">Membuat video dengan visual
yang menarik dan unik.</p>
                <p class="pt-6 text-sm text-white">Jasa pembuatan video animasi kami seperti:
Video Explainer, Video Presentation, Life
Shoot Animation, Greetings, dan 2D-3D
Animasi lainnya.</p>
                    <a href="{{ route('login') }}" class="pt-4 text-white cursor-pointer hover:text-gray-400">LIHAT DETAIL</a>

        </div>


        <div class="container flex flex-col w-64 h-64 p-4 border border-white bg-zinc-900 rounded-xl">
            <h1 class="font-bold text-center text-white">Design & IT Support</h1>
            <p class="font-sans text-sm text-gray-500 ">Konsultan Brand dan Kebutuhan
IT Perusahaan.</p>
                <p class="pt-6 text-sm text-white">Menjadi konsultan Desain untuk konsep
Merek Perusahaan Anda, dan menyediakan
kebutuhan IT seperti: Website, Aplikasi, dan
Platform Digital.</p>
                    <a href="{{ route('login') }}" class="pt-4 text-white cursor-pointer hover:text-gray-400">LIHAT DETAIL</a>

        </div>




    </div>


</section>

<section id="Cara Kerja" class="relative h-screen bg-black">
    <h4 class="absolute text-sm text-left text-gray-500 top-40 left-10 ">02 KENAPA HARUS KAMI</h4>
    <div class="flex flex-row p-6 pt-48">
        <h2 class="text-4xl font-bold text-left text-white text-pretty ">HOW WE DO IT</h2>
        <div class="flex flex-col justify-center gap-6 px-12">
           <div>
            <h1 class="text-2xl font-bold text-gray-600">#1 <span class="text-xl text-white"> Briefing & Brainstorming</span></h1>
            <h2 class="text-sm font-semibold text-gray-400">Tim kami sangat terbuka untuk berdiskusi tentang konsep dan menyesuaikan dengan
Permintaan Klien. Pengumpulan data Perusahaan anda pun akan aman berada di
tangan kami.</h2>
           </div>

            <div>
            <h1 class="text-2xl font-bold text-gray-600">#2 <span class="text-xl text-white"> Execution</span></h1>
            <h2 class="text-sm font-semibold text-gray-400"> Koordinasi tim dan klien dari Proses Produksi hingga Post Produksi, dengan kerja
cepat, tepat, dan akurat untuk mendapatkan hasil maksimal.</h2>
           </div>

            <div>
            <h1 class="text-2xl font-bold text-gray-600">#3 <span class="text-xl text-white"> Result</span></h1>
            <h2 class="text-sm font-semibold text-gray-400">Kepuasan klien menjadi keberhasilan tim kami. Kami selalu berusaha menjadi rekan
yang fleksibel dan dinamis. Karya yang kami hasilkan akan selalu sesuai dengan
harapan anda.</h2>
           </div>

        </div>

    </div>

</section>

<section id="Tentang Kami" class="relative flex items-center justify-center h-screen bg-black">
    <div class="absolute top-0 flex flex-col gap-6 p-6">
        <h4 class="text-sm text-gray-500">03 TENTANG KAMI</h4>
        <h1 class="font-serif text-5xl font-bold text-white text-pretty">"Berkembang Bersama dan Selalu Berinovasi
dengan karya. We are the decisive factor behind
your success."</h1>
    </div>
        <p class="text-sm text-center text-gray-500 text-balance">Identra Studio adalah Rumah Produksi, yang bergerak dalam bisnis ekonomi kreatif.
Perusahaan kami didirikan pada 2026 . Kami
memiliki pengalaman bekerja pada proyek-proyek besar dari perusahaan Negar
dan Swasta.</p>


</section>

<section class="relative bg-black min-h-min">
    <div class="flex flex-col px-6">
        <h1 class="m-6 font-sans text-2xl font-extrabold text-white">LET'S TALK.</h1>
        <h1 class="text-sm text-white">kontak : <span class="text-gray-400">+62 852-3373-1724</span></h1>
        <h1 class="text-sm text-white">gmail : <span class="text-gray-400">admin@identrastudio.com</span></h1>
        <h1 class="text-sm text-white">lokasi : <span class="text-gray-400">Jl. Dr. Ir. H. Soekarno, Mulyorejo, Kec. Mulyorejo, Surabaya, Jawa Timur 60115</span></h1>


    </div>
</section>

<footer class="p-6 py-10 text-white bg-gray-950">
    <div class= "gap-4">
     <img src="{{ asset('img/logo_identra.png') }}" alt="Logo" class="w-auto h-10 mt-4 logo-geser">
    </div>

    <p class="text-right text-gray-600">PROVIDING CREATIVE IDEAS FOR YOUR BUSINESS</p>
    <p class="text-sm text-right text-white">&copy; 2026 Identra Studio. All rights reserved.</p>
</footer>

</body>
</html>
