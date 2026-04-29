<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Identra Studio</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Iceland&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { iceland: ['"Iceland"', 'sans-serif'] },
                }
            }
        }
    </script>
    @vite('resources/css/app.css')
</head>
<body class="bg-black">
    <section class="relative min-h-screen w-full flex items-center justify-center p-4">
        <div class="bg-gray-950 w-full max-w-md shadow-2xl rounded-xl flex flex-col p-8 border border-gray-800">
            <h1 class="text-white text-2xl font-sans font-bold">SELAMAT DATANG!</h1>
            <h3 class="text-gray-500 text-md font-sans opacity-80">Silahkan masuk ke akun Identra Studio anda.</h3>

            @if ($errors->any())
                <div class="bg-red-500 text-white p-3 rounded mt-4 text-sm">
                    {{ $errors->first() }}
                </div>
            @endif

            <form class="mt-8 space-y-4" action="{{ route('login') }}" method="POST">
                @csrf
                <div>
                    <label class="font-iceland text-white block mb-1" for="Email">Email Address</label>
                    <input type="email" id="Email" name="Email" value="{{ old('Email') }}" placeholder="Input Your Email Here..." class="w-full bg-transparent border border-gray-700 rounded p-2 text-white focus:border-white outline-none" required>
                </div>
                
                <div>
                    <label class="font-iceland text-white block mb-1" for="Password">Password</label>
                    <input type="password" id="Password" name="Password" placeholder="Input Your Password..." class="w-full bg-transparent border border-gray-700 rounded p-2 text-white focus:border-white outline-none" required>
                </div>

                <div class="flex items-center">
                    <input type="checkbox" id="remember" name="remember" class="mr-2">
                    <label class="font-iceland text-white text-sm" for="remember"> Ingat saya</label>
                </div>

                <button type="submit" class="w-full bg-white text-black py-3 px-6 font-bold transition hover:bg-gray-200 transform hover:scale-[1.02] duration-300">MASUK SEKARANG</button>
            </form>

            <div class="flex flex-col sm:flex-row items-center justify-center mt-8 gap-2">
                <h3 class="font-sans text-gray-500 text-sm text-center">Belum bergabung dengan kami?</h3>
                <a class="font-iceland text-white font-bold text-lg hover:underline" href="{{ route('register') }}">DAFTAR AKUN</a>
            </div>
        </div>
    </section>
</body>
</html>