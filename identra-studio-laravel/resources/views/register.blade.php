<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Identra Studio</title>
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
        <div class="bg-gray-950 w-full max-w-lg shadow-2xl rounded-xl flex flex-col p-8 border border-gray-800">
            <h1 class="text-white text-2xl font-sans font-bold uppercase">Buat Akun</h1>
            <h3 class="text-gray-500 text-md font-sans opacity-80">Lengkapi data diri Anda untuk bergabung.</h3>

            <form class="mt-8 space-y-4" action="{{ route('register') }}" method="POST">
                @csrf
                <div>
                    <label class="font-iceland text-white block mb-1" for="Nama">NAMA LENGKAP</label>
                    <input type="text" id="Nama" name="Nama" value="{{ old('Nama') }}" placeholder="Input Your Full Name..." class="w-full bg-transparent border border-gray-700 rounded p-2 text-white focus:border-white outline-none" required>
                    @error('Nama') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="font-iceland text-white block mb-1" for="Email">EMAIL ADDRESS</label>
                    <input type="email" id="Email" name="Email" value="{{ old('Email') }}" placeholder="Input Your Email Here..." class="w-full bg-transparent border border-gray-700 rounded p-2 text-white focus:border-white outline-none" required>
                    @error('Email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="font-iceland text-white block mb-1" for="Password">PASSWORD</label>
                    <input type="password" id="Password" name="Password" placeholder="Min. 6 characters..." class="w-full bg-transparent border border-gray-700 rounded p-2 text-white focus:border-white outline-none" required>
                    @error('Password') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div class="flex items-start mt-2">
                    <input type="checkbox" id="ketentuan" name="ketentuan" class="mt-1 mr-2" required>
                    <label class="font-iceland text-gray-400 text-sm" for="ketentuan"> 
                        Saya setuju dengan <span class="text-white">syarat & ketentuan</span> serta <span class="text-white">Kebijakan Privasi</span> Identra Studio 
                    </label>
                </div>
                
                <button type="submit" class="w-full bg-white text-black py-3 px-6 font-bold transition hover:bg-gray-200 transform hover:scale-[1.02] duration-300 uppercase">Daftar Sekarang</button>
            </form>

            <div class="flex flex-col sm:flex-row items-center justify-center mt-8 gap-2">
                <h3 class="font-sans text-gray-500 text-sm">Sudah punya akun?</h3>
                <a class="font-iceland text-white font-bold text-lg hover:underline" href="{{ route('login') }}">MASUK DISINI</a>
            </div>
        </div>
    </section>
</body>
</html>