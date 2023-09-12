<x-app-layout>
    <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Welcome') }}
            </h2>
    </x-slot>
        <div class="container px-6 py-16 mx-auto">
            <div class="items-center lg:flex">
                <div class="w-full lg:w-1/2">
                    <div class="lg:max-w-lg">
                        <h1 class="text-3xl font-semibold text-gray-800 dark:text-white lg:text-4xl">Perpustakaan sekolah <br> SMKN 1 Mejayan <span class="text-blue-500 ">(SKANSA)</span></h1>

                        <p class="mt-3 text-gray-600 dark:text-gray-400">Ini adalah E-Perpus yang dibuat oleh siswa SMKN 1 Mejayan berjurusan RPL yang bertujuan untuk melatih pengalaman baik di bidang Programing Front End, Back End maupun Designer.
                        <br><br>
                            Aplikasi ini bertujuan untuk menyediakan akses mudah bagi para pengguna untuk membaca buku dengan media E-book. Selain itu, E-perpus dilengkapi dengan fitur-fitur seperti sistem pencarian buku, serta penyimpanan data pengguna dan buku-buku yang tersedia. Dengan menggunakan E-perpus, pengguna dapat dengan mudah membaca buku secara online tanpa harus datang ke perpustakaan fisik.</p>

                            <button class="w-full px-5 py-2 mt-6 text-sm tracking-wider text-white uppercase transition-colors duration-300 transform bg-blue-600 rounded-lg lg:w-auto hover:bg-blue-500 focus:outline-none focus:bg-blue-500" onclick="
                            window.location.href = '{{ route('books.index') }}'
                        ">Let's Start</button>

                    </div>
                </div>

                <div class="flex items-center justify-center w-full mt-6 lg:mt-0 lg:w-1/2">
                    <img class="w-full h-full lg:max-w-3xl" src="https://merakiui.com/images/components/Catalogue-pana.svg" alt="Catalogue-pana.svg">
                </div>
            </div>
        </div>
</x-app-layout>
