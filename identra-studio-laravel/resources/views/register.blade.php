<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
  

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Iceland&display=swap" rel="stylesheet">


<style>

.iceland-regular {
  font-family: "Iceland", sans-serif;
  font-weight: 400;
  font-style: normal;
}
</style>

<script>
      tailwind.config = {
        theme: {
          extend: {
            fontFamily: {
              iceland: ['"Iceland"', 'sans-serif'],
            },
          }
        }
      }
    </script>
  
@vite('resources/css/app.css')
</head>
<body>
    <section class="relative min-h-screen w-full flex items-center justify-center bg-black">
<div class=" bg-gray-950 container shadow-md rounded-xl flex justify-center items-center flex-col">
    <h1 class="text-white text-left text-2xl pt-6 font-sans">BUAT AKUN</h1>
    <h3 class="text-gray-500 text-left text-md font-sans opacity-80">Lengkapi data diri Anda untuk bergabung dengan Identra Studio.</h3>

    <form class="pt-10"> 

        <div class="flex flex-row justify-between">
            <div>
                 <label class="pt-3 font-iceland text-white" for="depan">NAMA DEPAN</label><br>
        <input type="text" id="depan" name="depan" placeholder="Input Your First Name..." class="border border-gray-300 text-amber-50" required>
            </div>
            <div>
                <label class="pt-3 font-iceland text-white" for="belakang"> NAMA BELAKANG</label><br>
        <input type="text" id="belakang" name="belakang" placeholder="Input Your Last Name..." class="border border-gray-300 text-amber-50" required><br>
            </div>
        </div>
             <label class="pt-3 font-iceland text-white" for="Email">Email Address</label><br>
        <input type="email" id="Email" name="Email" placeholder="Input Your Email Here..." class="border border-gray-300 w-full text-amber-50" required><br>
        <label class="pt-3 font-iceland text-white" for="pwd"> Password</label><br>
        <input type="password" id="pwd" name="pwd" placeholder="Input Your Password..." class="border border-gray-300 w-full text-amber-50" required><br>


        <input type="checkbox" id="ketentuan" name="ketentuan" required>
        <label class="font-iceland text-gray-400" for="ketentuan"> saya setuju dengan <span class="text-white">syarat & ketentuan</span> serta <span class="text-white">Kebijakan Privasi</span> Identra Studio </label><br>
        <button type="submit" class="w-full text-center border border-gray-200 bg-white py-2 px-6 font-bold transition hover:shadow-xl transform hover:scale-105 duration-300">DAFTAR SEKARANG</button>
    </form>
    <div class="flex flex-row p-6 gap-5">
        <h3 class="font-sans text-gray-500 text-md">Sudah punya akun?</h3>
        <a class="font-iceland text-white font-bold text-xl" href="{{ route('login') }}"> MASUK DISINI</a>
    </div>
    




</div>
    
</section>

</body>
</html>