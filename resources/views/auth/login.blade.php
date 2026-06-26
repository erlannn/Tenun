<x-guest-layout>
    
    <!-- Kontainer Utama: Bagi 2 Kolom (Kiri dan Kanan) -->
    <div class="w-full min-h-screen flex flex-col md:flex-row">
        
        <!-- ================= SISI KIRI: BRAND IDENTITY ================= -->
        <!-- bg-[#FAF6E9] adalah warna krem lembut seperti latar belakang di Figma -->
        <div class="w-full md:w-1/2 bg-[#FAF6E9] flex flex-col items-center justify-center p-8 lg:p-16">
            
            <!-- Tulisan Selamat Datang -->
            <h1 class="text-3xl lg:text-4xl font-extrabold text-[#1B432A] mb-12 tracking-wide text-center">
                Selamat Datang!
            </h1>
            
            <!-- Kontainer Logo, Garis Pembatas, dan Teks Merk -->
            <div class="flex items-center justify-center space-x-6">
                <!-- Pastikan Anda sudah menaruh foto logo di public/images/logo-riska-sulam.png -->
                <div class="w-36 h-36 lg:w-44 lg:h-44 flex items-center justify-center">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo Riska Sulam" class="w-full h-full object-contain">
                </div>
                
                <!-- Garis Pembatas Vertikal Warna Emas -->
                <div class="w-[2px] h-24 lg:h-28 bg-[#D4AF37]"></div>
                
                <!-- Teks "RISKA SULAM" dengan Font Serif agar Elegan -->
                <div class="flex flex-col justify-center">
                    <span class="text-2xl lg:text-3.5xl font-bold text-[#1B432A] tracking-wider font-serif leading-none">RISKA</span>
                    <span class="text-2xl lg:text-3.5xl font-semibold text-[#C49A2D] tracking-widest font-serif mt-2 leading-none">SULAM</span>
                </div>
            </div>
        </div>

        <!-- ================= SISI KANAN: FORM INPUT ================= -->
        <div class="w-full md:w-1/2 bg-white flex flex-col justify-center px-8 sm:px-16 lg:px-24 py-12">
            
            <div class="max-w-md w-full mx-auto">
                <!-- Judul Utama -->
                <h2 class="text-4xl font-bold text-[#1B432A] mb-2 tracking-tight">Masuk</h2>
                <p class="text-gray-600 font-medium mb-8 text-sm lg:text-base">Masukkan Username dan Password untuk Masuk</p>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />
                
                <!-- TAG FORM: Siap Pakai Untuk Backend -->
                <form method="POST" action="{{ route('login') }}">
                    @csrf <!-- Keamanan Token Laravel -->

                    <!-- Input Box Username -->
                    <div class="mb-5">
                        <label for="username" class="block text-sm lg:text-base font-semibold text-gray-700 mb-2">Username</label>
                        <input type="text" name="username" id="username" value="{{ old('username') }}"
                               class="w-full px-4 py-3 rounded-xl border border-gray-400 bg-white text-gray-900 focus:outline-none focus:ring-2 focus:ring-[#1B432A] focus:border-transparent transition duration-200"
                               placeholder="Masukkan Username Anda" required>

                        <x-input-error :messages="$errors->get('username')" class="text-red-600 text-xs mt-1 block font-medium" />
                    </div>

                    <!-- Input Box Password -->
                    <div class="mb-8">
                        <label for="password" class="block text-sm lg:text-base font-semibold text-gray-700 mb-2">Password</label>
                        <div class="relative">
                            <input type="password" name="password" id="password"
                                   class="w-full px-4 py-3 rounded-xl border border-gray-400 bg-white text-gray-900 focus:outline-none focus:ring-2 focus:ring-[#1B432A] focus:border-transparent transition duration-200"
                                   placeholder="Masukkan Password Anda" required>
                            
                            <!-- Ikon Mata (Melihat/Sembunyi Password) -->
                            <div class="absolute inset-y-0 right-0 pr-4 flex items-center cursor-pointer text-gray-500 hover:text-[#1B432A]">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                            </div>
                        </div>
                        
                        <!-- Validasi Error Password -->
                        @error('password')
                            <span class="text-red-600 text-xs mt-1 block font-medium">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Tombol Masuk dengan Efek Gradasi (Hijau ke Emas) -->
                    <!-- bg-gradient-to-r menghasilkan efek transisi warna persis seperti tombol Figma Anda -->
                    <button type="submit" 
                            class="w-full py-3.5 rounded-xl text-white font-bold text-base lg:text-lg bg-gradient-to-r from-[#1B432A] to-[#A68D32] hover:opacity-95 shadow-md transition duration-200 transform active:scale-[0.99] cursor-pointer text-center">
                        Masuk
                    </button>
                </form>
            </div>
        </div>
    </div>

</x-guest-layout>
