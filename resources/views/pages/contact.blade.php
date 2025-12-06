@extends('layouts.app')

@section('title', 'Hubungi Kami - ToroGloneys')

@section('content')
<main class="pt-24">
    <!-- Page Header -->
    <section class="bg-gradient-to-b from-slate-900 to-slate-950 border-b border-slate-800 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-5xl sm:text-6xl font-bold text-white mb-4">
                Hubungi <span class="glow-green">Kami</span>
            </h1>
            <p class="text-gray-400 text-xl">
                Kami siap menjawab pertanyaan dan membantu Anda menemukan produk yang sempurna
            </p>
        </div>
    </section>

    <!-- Contact Info & Form -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-12">
            <!-- Contact Info Cards -->
            <div class="lg:col-span-1 space-y-6">
                <!-- Phone -->
                <div class="bg-slate-900/50 backdrop-blur border border-slate-800 rounded-lg p-6 hover:border-[#7FFF00] hover:shadow-lg hover:shadow-[#7FFF00]/20 transition-all duration-300">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-[#7FFF00]/10 border border-[#7FFF00]/30 rounded-lg flex items-center justify-center flex-shrink-0 mt-1">
                            <svg class="w-6 h-6 text-[#7FFF00]" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-white mb-1">Telepon</h3>
                            <p class="text-gray-400">+62 812-3456-7890</p>
                            <p class="text-gray-400">+62 812-9876-5432</p>
                        </div>
                    </div>
                </div>

                <!-- Email -->
                <div class="bg-slate-900/50 backdrop-blur border border-slate-800 rounded-lg p-6 hover:border-[#7FFF00] hover:shadow-lg hover:shadow-[#7FFF00]/20 transition-all duration-300">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-[#7FFF00]/10 border border-[#7FFF00]/30 rounded-lg flex items-center justify-center flex-shrink-0 mt-1">
                            <svg class="w-6 h-6 text-[#7FFF00]" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-white mb-1">Email</h3>
                            <p class="text-gray-400">info@torogoneys.com</p>
                            <p class="text-gray-400">support@torogoneys.com</p>
                        </div>
                    </div>
                </div>

                <!-- Location -->
                <div class="bg-slate-900/50 backdrop-blur border border-slate-800 rounded-lg p-6 hover:border-[#7FFF00] hover:shadow-lg hover:shadow-[#7FFF00]/20 transition-all duration-300">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-[#7FFF00]/10 border border-[#7FFF00]/30 rounded-lg flex items-center justify-center flex-shrink-0 mt-1">
                            <svg class="w-6 h-6 text-[#7FFF00]" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm3.5-9c.83 0 1.5-.67 1.5-1.5S16.33 8 15.5 8 14 8.67 14 9.5s.67 1.5 1.5 1.5zm-7 0c.83 0 1.5-.67 1.5-1.5S9.33 8 8.5 8 7 8.67 7 9.5 7.67 11 8.5 11zm3.5 6.5c2.33 0 4.31-1.46 5.11-3.5H6.89c.8 2.04 2.78 3.5 5.11 3.5z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-white mb-1">Lokasi</h3>
                            <p class="text-gray-400">Jl. Aglaonema No. 123</p>
                            <p class="text-gray-400">Jakarta, Indonesia</p>
                        </div>
                    </div>
                </div>

                <!-- Business Hours -->
                <div class="bg-slate-900/50 backdrop-blur border border-slate-800 rounded-lg p-6 hover:border-[#7FFF00] hover:shadow-lg hover:shadow-[#7FFF00]/20 transition-all duration-300">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-[#7FFF00]/10 border border-[#7FFF00]/30 rounded-lg flex items-center justify-center flex-shrink-0 mt-1">
                            <svg class="w-6 h-6 text-[#7FFF00]" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M11.99 5V1h-1v4zm6.93 2.12h2.83l-2-2.01-1.83 2.01zM19 6.41l2.83-2.83-1.41-1.41L17.59 5zM19 11v2h4v-1h-3v-1zm2.83 6.17l2.83 2.83 1.41-1.41-2.83-2.83zM19 17.59l2.83 2.83 1.41-1.41-2.83-2.83zM12 19.99h1V23h-1zm6.17-2.83l2.83 2.83 1.41-1.41-2.83-2.83zm-11.34-6.16H1v1h4zm6.17 6.17l-2.83 2.83 1.41 1.41 2.83-2.83zM5 17.59L2.17 20.42l1.41 1.41L6.41 19zm-2.83-11.34L5 6.41 3.59 5z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-white mb-1">Jam Operasional</h3>
                            <p class="text-gray-400">Senin - Jumat: 08:00 - 18:00</p>
                            <p class="text-gray-400">Sabtu: 08:00 - 16:00</p>
                            <p class="text-gray-400">Minggu: Tutup</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="lg:col-span-2">
                <div class="bg-slate-900/50 backdrop-blur border border-slate-800 rounded-lg p-8">
                    <h2 class="text-2xl font-bold text-white mb-6">Kirim Pesan</h2>

                    @if(session('success'))
                        <div class="mb-6 p-4 bg-[#7FFF00]/10 border border-[#7FFF00]/30 rounded-lg flex items-start gap-3">
                            <svg class="w-6 h-6 text-[#7FFF00] flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                            </svg>
                            <div>
                                <p class="text-white font-semibold">Berhasil!</p>
                                <p class="text-gray-300 text-sm">{{ session('success') }}</p>
                            </div>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('contact.store') }}" class="space-y-6">
                        @csrf

                        <!-- Name Field -->
                        <div>
                            <label class="block text-sm font-semibold text-white mb-2">Nama Lengkap</label>
                            <input 
                                type="text" 
                                name="name"
                                value="{{ old('name') }}"
                                placeholder="Masukkan nama Anda"
                                class="w-full px-4 py-3 bg-slate-800 border @error('name') border-red-500 @else border-slate-700 @enderror rounded-lg text-white placeholder-gray-500 focus:outline-none focus:border-[#7FFF00] transition-colors"
                            >
                            @error('name')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email Field -->
                        <div>
                            <label class="block text-sm font-semibold text-white mb-2">Email</label>
                            <input 
                                type="email" 
                                name="email"
                                value="{{ old('email') }}"
                                placeholder="Masukkan email Anda"
                                class="w-full px-4 py-3 bg-slate-800 border @error('email') border-red-500 @else border-slate-700 @enderror rounded-lg text-white placeholder-gray-500 focus:outline-none focus:border-[#7FFF00] transition-colors"
                            >
                            @error('email')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Subject Field -->
                        <div>
                            <label class="block text-sm font-semibold text-white mb-2">Subjek</label>
                            <input 
                                type="text" 
                                name="subject"
                                value="{{ old('subject') }}"
                                placeholder="Subjek pesan Anda"
                                class="w-full px-4 py-3 bg-slate-800 border @error('subject') border-red-500 @else border-slate-700 @enderror rounded-lg text-white placeholder-gray-500 focus:outline-none focus:border-[#7FFF00] transition-colors"
                            >
                            @error('subject')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Message Field -->
                        <div>
                            <label class="block text-sm font-semibold text-white mb-2">Pesan</label>
                            <textarea 
                                name="message"
                                rows="6"
                                placeholder="Tulis pesan Anda di sini..."
                                class="w-full px-4 py-3 bg-slate-800 border @error('message') border-red-500 @else border-slate-700 @enderror rounded-lg text-white placeholder-gray-500 focus:outline-none focus:border-[#7FFF00] transition-colors resize-none"
                            >{{ old('message') }}</textarea>
                            @error('message')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" id="submit-btn" class="w-full btn-primary py-3 font-semibold text-lg" onclick="handleSubmit(event)">
                            Kirim Pesan
                        </button>

                        <p class="text-center text-sm text-gray-400">
                            Kami akan merespon pesan Anda dalam waktu 24 jam
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Social Section -->
    <section class="py-16 border-t border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-white mb-4">
                    Ikuti <span class="glow-green">Kami</span>
                </h2>
                <p class="text-gray-400 text-lg">
                    Dapatkan update terbaru dan tips perawatan tanaman dari social media kami
                </p>
            </div>

            <div class="flex justify-center gap-6 flex-wrap">
                <a href="#" class="w-16 h-16 bg-slate-900/50 backdrop-blur border border-slate-800 rounded-lg flex items-center justify-center hover:border-[#7FFF00] hover:shadow-lg hover:shadow-[#7FFF00]/20 transition-all duration-300">
                    <svg class="w-8 h-8 text-white hover:text-[#7FFF00]" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M19 3a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h14m-.5 15.5v-5.3a3.26 3.26 0 0 0-3.26-3.26c-.85 0-1.84.52-2.32 1.39v-1.11h-2.79v8.37h2.79v-4.93c0-.77.62-1.4 1.39-1.4a1.4 1.4 0 0 1 1.4 1.4v4.93h2.79M6.88 8.56a1.68 1.68 0 0 0 1.68-1.68c0-.93-.75-1.69-1.68-1.69a1.69 1.69 0 0 0-1.69 1.69c0 .93.76 1.68 1.69 1.68m1.39 9.94v-8.37H5.5v8.37h2.77"/>
                    </svg>
                </a>
                <a href="#" class="w-16 h-16 bg-slate-900/50 backdrop-blur border border-slate-800 rounded-lg flex items-center justify-center hover:border-[#7FFF00] hover:shadow-lg hover:shadow-[#7FFF00]/20 transition-all duration-300">
                    <svg class="w-8 h-8 text-white hover:text-[#7FFF00]" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 9h-4v4h-2v-4H7v-2h2V7h2v2h4v2z"/>
                    </svg>
                </a>
                <a href="#" class="w-16 h-16 bg-slate-900/50 backdrop-blur border border-slate-800 rounded-lg flex items-center justify-center hover:border-[#7FFF00] hover:shadow-lg hover:shadow-[#7FFF00]/20 transition-all duration-300">
                    <svg class="w-8 h-8 text-white hover:text-[#7FFF00]" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M22.46 6c-.87.39-1.81.65-2.8.77 1.01-.6 1.78-1.56 2.14-2.7-.94.56-1.98.96-3.09 1.19-.89-.95-2.16-1.55-3.56-1.55-2.69 0-4.87 2.18-4.87 4.87 0 .38.04.76.15 1.12-4.05-.2-7.65-2.14-10.05-5.09-.42.73-.66 1.57-.66 2.46 0 1.69.86 3.18 2.16 4.06-.8-.03-1.56-.25-2.22-.61v.06c0 2.36 1.68 4.33 3.91 4.78-.41.11-.84.17-1.29.17-.31 0-.63-.03-.93-.08.63 1.91 2.4 3.3 4.5 3.34-1.67 1.31-3.77 2.09-6.06 2.09-.39 0-.77-.02-1.15-.07 2.16 1.38 4.72 2.19 7.48 2.19 8.97 0 13.87-7.43 13.87-13.87 0-.21 0-.42-.01-.62.95-.69 1.78-1.55 2.44-2.52z"/>
                    </svg>
                </a>
                <a href="#" class="w-16 h-16 bg-slate-900/50 backdrop-blur border border-slate-800 rounded-lg flex items-center justify-center hover:border-[#7FFF00] hover:shadow-lg hover:shadow-[#7FFF00]/20 transition-all duration-300">
                    <svg class="w-8 h-8 text-white hover:text-[#7FFF00]" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M7.8 2h8.4C19.4 2 22 4.6 22 7.8v8.4c0 3.2-2.6 5.8-5.8 5.8H7.8C4.6 22 2 19.4 2 16.2V7.8C2 4.6 4.6 2 7.8 2m-.6 18h9.6c2.3 0 4.2-1.9 4.2-4.2V7.8c0-2.3-1.9-4.2-4.2-4.2H7.2c-2.3 0-4.2 1.9-4.2 4.2v8.4c0 2.3 1.9 4.2 4.2 4.2M12 7a5 5 0 0 1 5 5 5 5 0 0 1-5 5 5 5 0 0 1-5-5 5 5 0 0 1 5-5m0 1.5a3.5 3.5 0 0 0-3.5 3.5A3.5 3.5 0 0 0 12 15.5 3.5 3.5 0 0 0 15.5 12 3.5 3.5 0 0 0 12 8.5m4-2a1 1 0 1 1 2 0 1 1 0 0 1-2 0"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>
</main>

<script>
    function handleSubmit(e) {
        const btn = document.getElementById('submit-btn');
        const originalText = btn.innerText;
        
        // Visual feedback
        btn.innerText = 'Mengirim...';
        btn.disabled = true;
        btn.style.opacity = '0.7';
    }
</script>
@endsection
