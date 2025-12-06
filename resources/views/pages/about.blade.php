@extends('layouts.app')

@section('title', 'Tentang Kami - ToroGloneys')

@section('content')
<main class="pt-24">
    <!-- Page Header -->
    <section class="bg-gradient-to-b from-slate-900 to-slate-950 border-b border-slate-800 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-5xl sm:text-6xl font-bold text-white mb-4">
                Tentang <span class="glow-green">ToroGloneys</span>
            </h1>
            <p class="text-gray-400 text-xl max-w-2xl">
                Kami adalah distributor terpercaya tanaman Aglaonema premium dengan komitmen memberikan produk berkualitas tinggi
            </p>
        </div>
    </section>

    <!-- Our Story -->
    <section class="py-16 border-b border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-4xl font-bold text-white mb-6">
                        Kisah <span class="glow-green">Kami</span>
                    </h2>
                    <p class="text-gray-300 text-lg leading-relaxed mb-4">
                        ToroGloneys dimulai dari passion kami terhadap tanaman hias, khususnya Aglaonema. Kami percaya bahwa setiap orang berhak memiliki tanaman berkualitas tinggi yang dapat mempercantik rumah dan kantor mereka.
                    </p>
                    <p class="text-gray-300 text-lg leading-relaxed mb-4">
                        Dengan pengalaman lebih dari 10 tahun dalam bisnis tanaman hias, kami telah melayani ribuan pelanggan yang puas di seluruh Indonesia. Setiap produk yang kami tawarkan dipilih dengan cermat untuk memastikan kualitas terbaik.
                    </p>
                    <p class="text-gray-300 text-lg leading-relaxed">
                        Misi kami adalah menyediakan Aglaonema berkualitas premium dengan harga yang terjangkau, serta memberikan layanan pelanggan terbaik di kelasnya.
                    </p>
                </div>

                <div class="bg-gradient-to-br from-slate-800 to-slate-900 rounded-lg border border-slate-700 p-8 h-96 flex items-center justify-center">
                    <svg class="w-48 h-48 text-slate-600" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/>
                    </svg>
                </div>
            </div>
        </div>
    </section>

    <!-- Values Section -->
    <section class="py-16 border-b border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-white mb-4">
                    Nilai-Nilai <span class="glow-green">Kami</span>
                </h2>
                <p class="text-gray-400 text-lg max-w-2xl mx-auto">
                    Prinsip-prinsip yang memandu setiap keputusan bisnis kami
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Value 1 -->
                <div class="bg-slate-900/50 backdrop-blur border border-slate-800 rounded-lg p-6 hover:border-[#7FFF00] hover:shadow-lg hover:shadow-[#7FFF00]/20 transition-all duration-300">
                    <div class="w-14 h-14 bg-[#7FFF00]/10 border border-[#7FFF00]/30 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-[#7FFF00]" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-white mb-2">Kualitas Terjamin</h3>
                    <p class="text-gray-400 text-sm">
                        Setiap produk melalui seleksi ketat dan garansi kepuasan 100%
                    </p>
                </div>

                <!-- Value 2 -->
                <div class="bg-slate-900/50 backdrop-blur border border-slate-800 rounded-lg p-6 hover:border-[#7FFF00] hover:shadow-lg hover:shadow-[#7FFF00]/20 transition-all duration-300">
                    <div class="w-14 h-14 bg-[#7FFF00]/10 border border-[#7FFF00]/30 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-[#7FFF00]" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-white mb-2">Harga Kompetitif</h3>
                    <p class="text-gray-400 text-sm">
                        Menawarkan nilai terbaik tanpa mengorbankan kualitas produk
                    </p>
                </div>

                <!-- Value 3 -->
                <div class="bg-slate-900/50 backdrop-blur border border-slate-800 rounded-lg p-6 hover:border-[#7FFF00] hover:shadow-lg hover:shadow-[#7FFF00]/20 transition-all duration-300">
                    <div class="w-14 h-14 bg-[#7FFF00]/10 border border-[#7FFF00]/30 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-[#7FFF00]" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-white mb-2">Layanan Terbaik</h3>
                    <p class="text-gray-400 text-sm">
                        Tim profesional siap membantu Anda 24/7 dengan respons cepat
                    </p>
                </div>

                <!-- Value 4 -->
                <div class="bg-slate-900/50 backdrop-blur border border-slate-800 rounded-lg p-6 hover:border-[#7FFF00] hover:shadow-lg hover:shadow-[#7FFF00]/20 transition-all duration-300">
                    <div class="w-14 h-14 bg-[#7FFF00]/10 border border-[#7FFF00]/30 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-[#7FFF00]" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-white mb-2">Pengiriman Cepat</h3>
                    <p class="text-gray-400 text-sm">
                        Pengiriman ke seluruh Indonesia dengan packaging aman
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-16 border-b border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-6">
                <div class="text-center">
                    <p class="text-4xl sm:text-5xl font-bold glow-green mb-2">10+</p>
                    <p class="text-gray-400">Tahun Pengalaman</p>
                </div>
                <div class="text-center">
                    <p class="text-4xl sm:text-5xl font-bold glow-green mb-2">5000+</p>
                    <p class="text-gray-400">Pelanggan Puas</p>
                </div>
                <div class="text-center">
                    <p class="text-4xl sm:text-5xl font-bold glow-green mb-2">150+</p>
                    <p class="text-gray-400">Varian Produk</p>
                </div>
                <div class="text-center">
                    <p class="text-4xl sm:text-5xl font-bold glow-green mb-2">100%</p>
                    <p class="text-gray-400">Kepuasan Pelanggan</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="py-16 border-b border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-white mb-4">
                    Tim <span class="glow-green">Kami</span>
                </h2>
                <p class="text-gray-400 text-lg">
                    Profesional berpengalaman yang siap memberikan yang terbaik
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Team Member 1 -->
                <div class="bg-slate-900/50 backdrop-blur border border-slate-800 rounded-lg p-6 text-center hover:border-[#7FFF00] transition-all duration-300">
                    <div class="w-24 h-24 mx-auto mb-4 bg-gradient-to-br from-slate-800 to-slate-900 rounded-lg flex items-center justify-center">
                        <svg class="w-12 h-12 text-slate-600" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-white mb-1">Andi Wijaya</h3>
                    <p class="text-[#7FFF00] text-sm font-semibold mb-3">Founder & CEO</p>
                    <p class="text-gray-400 text-sm">
                        Memimpin dengan visi untuk menjadi distributor Aglaonema terbaik di Indonesia
                    </p>
                </div>

                <!-- Team Member 2 -->
                <div class="bg-slate-900/50 backdrop-blur border border-slate-800 rounded-lg p-6 text-center hover:border-[#7FFF00] transition-all duration-300">
                    <div class="w-24 h-24 mx-auto mb-4 bg-gradient-to-br from-slate-800 to-slate-900 rounded-lg flex items-center justify-center">
                        <svg class="w-12 h-12 text-slate-600" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-white mb-1">Siti Nurhaliza</h3>
                    <p class="text-[#7FFF00] text-sm font-semibold mb-3">Product Manager</p>
                    <p class="text-gray-400 text-sm">
                        Mengelola seleksi produk dan memastikan kualitas setiap tanaman yang dijual
                    </p>
                </div>

                <!-- Team Member 3 -->
                <div class="bg-slate-900/50 backdrop-blur border border-slate-800 rounded-lg p-6 text-center hover:border-[#7FFF00] transition-all duration-300">
                    <div class="w-24 h-24 mx-auto mb-4 bg-gradient-to-br from-slate-800 to-slate-900 rounded-lg flex items-center justify-center">
                        <svg class="w-12 h-12 text-slate-600" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-white mb-1">Budi Santoso</h3>
                    <p class="text-[#7FFF00] text-sm font-semibold mb-3">Customer Service Lead</p>
                    <p class="text-gray-400 text-sm">
                        Memastikan setiap pelanggan mendapat dukungan terbaik dan memuaskan
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-4xl font-bold text-white mb-4">
                Ingin <span class="glow-green">Berbelanja</span>?
            </h2>
            <p class="text-gray-400 text-lg mb-8">
                Jelajahi koleksi lengkap Aglaonema premium kami sekarang juga
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('products.index') }}" class="btn-primary px-8 py-3 font-semibold">
                    Belanja Sekarang
                </a>
                <a href="{{ route('contact') }}" class="btn-secondary px-8 py-3 font-semibold">
                    Hubungi Kami
                </a>
            </div>
        </div>
    </section>
</main>
@endsection
