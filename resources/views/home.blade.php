@extends('layouts.app')

@section('title', 'Home - ToroGloneys | Premium Aglaonema Plants')

@section('content')
<main class="pt-20">
    <!-- Hero Section -->
    <section class="min-h-screen bg-gradient-to-br from-slate-950 via-slate-900 to-slate-950 flex items-center">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <!-- Left: Text Content -->
                <div class="fade-in">
                    <div class="inline-flex items-center space-x-2 mb-6 bg-slate-800 rounded-full px-4 py-2">
                        <span class="text-[#7FFF00]">🌿</span>
                        <span class="text-sm font-semibold text-gray-300">Koleksi Premium</span>
                    </div>
                    
                    <h1 class="text-5xl sm:text-6xl lg:text-7xl font-bold mb-6">
                        <span class="text-white">Bawa</span>
                        <span class="block glow-green">Alam ke Rumah</span>
                    </h1>
                    
                    <p class="text-xl sm:text-2xl text-gray-400 mb-4">
                        Tanaman Aglaonema Premium untuk Rumah Modern Anda
                    </p>
                    
                    <p class="text-lg text-gray-500 mb-8 leading-relaxed">
                        Kami menyediakan koleksi tanaman Aglaonema terlengkap dan berkualitas tinggi dengan harga kompetitif dan layanan terbaik.
                    </p>
                    
                    <div class="flex flex-col sm:flex-row gap-4 mb-8">
                        <button class="btn-primary">Belanja Sekarang →</button>
                        <button class="btn-secondary">Pelajari Lebih Lanjut</button>
                    </div>
                    
                    <div class="grid grid-cols-3 gap-6">
                        <div>
                            <p class="text-3xl font-bold text-[#7FFF00]">500+</p>
                            <p class="text-sm text-gray-500">Pelanggan Puas</p>
                        </div>
                        <div>
                            <p class="text-3xl font-bold text-[#7FFF00]">100+</p>
                            <p class="text-sm text-gray-500">Jenis Tanaman</p>
                        </div>
                        <div>
                            <p class="text-3xl font-bold text-[#7FFF00]">100%</p>
                            <p class="text-sm text-gray-500">Kepuasan</p>
                        </div>
                    </div>
                </div>
                
                <!-- Right: Visual -->
                <div class="fade-in relative lg:h-96">
                    <div class="bg-gradient-to-br from-slate-800 to-slate-900 rounded-2xl h-full flex items-center justify-center shadow-2xl">
                        <svg class="w-32 h-32 text-[#7FFF00] opacity-20" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm3.5-9c.83 0 1.5-.67 1.5-1.5S16.33 8 15.5 8 14 8.67 14 9.5s.67 1.5 1.5 1.5zm-7 0c.83 0 1.5-.67 1.5-1.5S9.33 8 8.5 8 7 8.67 7 9.5 7.67 11 8.5 11zm3.5 6.5c2.33 0 4.31-1.46 5.11-3.5H6.89c.8 2.04 2.78 3.5 5.11 3.5z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Categories Section -->
    <section class="py-16 sm:py-24 bg-slate-900 border-y border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-4xl sm:text-5xl font-bold mb-4">
                    <span class="text-white">Belanja</span>
                    <span class="glow-green"> Berdasarkan Kategori</span>
                </h2>
                <p class="text-lg text-gray-400">Jelajahi koleksi tanaman kami yang beragam</p>
            </div>
            
            @if(count($categories) > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($categories as $category)
                        <div class="stagger-item group bg-slate-800/50 backdrop-blur rounded-xl p-6 border border-slate-700 hover:border-[#7FFF00] transition-all duration-300 cursor-pointer hover:shadow-lg hover:shadow-[#7FFF00]/20 hover:scale-105 hover:-translate-y-2">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-lg font-semibold text-white group-hover:text-[#7FFF00] transition-colors">
                                    {{ $category->name }}
                                </h3>
                                <svg class="w-5 h-5 text-[#7FFF00] group-hover:translate-x-1 transition-transform" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M8.59 16.59L10 18l6-6-6-6-1.41 1.41L12.17 12z"/>
                                </svg>
                            </div>
                            <p class="text-sm text-gray-400">{{ $category->products_count ?? 0 }} produk</p>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    <!-- Featured Products Section -->
    <section class="py-16 sm:py-24 bg-slate-950">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-4xl sm:text-5xl font-bold mb-4">
                    <span class="text-white">Produk</span>
                    <span class="glow-green"> Unggulan</span>
                </h2>
                <p class="text-lg text-gray-400">Tanaman pilihan yang diminati pelanggan</p>
            </div>
            
            @if($featuredProducts->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-8">
                    @foreach($featuredProducts as $product)
                        <div class="stagger-item group bg-slate-800/50 backdrop-blur border border-slate-700 rounded-lg overflow-hidden hover:border-[#7FFF00] transition-all duration-300 hover:shadow-lg hover:shadow-[#7FFF00]/20 hover:scale-105 hover:-translate-y-2">
                            <div class="relative h-56 bg-slate-900 overflow-hidden">
                                @if($product->image)
                                    <img 
                                        src="{{ asset('storage/' . $product->image) }}" 
                                        alt="{{ $product->name }}"
                                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300"
                                    >
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-slate-800 to-slate-900">
                                        <svg class="w-16 h-16 text-slate-600" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/>
                                        </svg>
                                    </div>
                                @endif
                                <div class="absolute top-3 right-3">
                                    @if($product->stock > 0)
                                        <span class="inline-block bg-[#7FFF00] text-black px-3 py-1 rounded-full text-xs font-semibold">
                                            Tersedia
                                        </span>
                                    @else
                                        <span class="inline-block bg-red-500/80 text-white px-3 py-1 rounded-full text-xs font-semibold">
                                            Habis
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="p-4">
                                @if($product->category)
                                    <p class="text-xs text-gray-400 uppercase tracking-wider mb-2">
                                        {{ $product->category->name }}
                                    </p>
                                @endif
                                
                                <h3 class="text-lg font-semibold text-white mb-2 group-hover:text-[#7FFF00] transition-colors line-clamp-2">
                                    {{ $product->name }}
                                </h3>
                                
                                <p class="text-sm text-gray-400 mb-3 line-clamp-2">
                                    {{ $product->description }}
                                </p>
                                
                                <div class="flex items-center justify-between">
                                    <span class="text-2xl font-bold text-[#7FFF00]">
                                        Rp{{ number_format($product->price, 0, ',', '.') }}
                                    </span>
                                    <svg class="w-5 h-5 text-gray-400 group-hover:text-[#7FFF00] group-hover:translate-x-1 transition-all" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M8.59 16.59L10 18l6-6-6-6-1.41 1.41L12.17 12z"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <div class="text-center">
                    <button class="btn-primary">Lihat Semua Produk →</button>
                </div>
            @else
                <div class="text-center py-12">
                    <p class="text-gray-400">Produk belum tersedia.</p>
                </div>
            @endif
        </div>
    </section>

    <!-- Why Choose Us Section -->
    <section class="py-16 sm:py-24 bg-slate-900 border-y border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-4xl sm:text-5xl font-bold mb-4">
                    Mengapa Pilih <span class="glow-green">ToroGloneys</span>
                </h2>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="bg-slate-800/50 backdrop-blur rounded-lg p-8 border border-slate-700 hover:border-[#7FFF00] transition-all">
                    <div class="w-12 h-12 bg-[#7FFF00]/20 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-[#7FFF00]" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-white mb-2">100% Asli</h3>
                    <p class="text-gray-400 text-sm">Semua tanaman terjamin keaslian dan kesehatan.</p>
                </div>
                
                <div class="bg-slate-800/50 backdrop-blur rounded-lg p-8 border border-slate-700 hover:border-[#7FFF00] transition-all">
                    <div class="w-12 h-12 bg-[#7FFF00]/20 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-[#7FFF00]" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-white mb-2">Pengiriman Cepat</h3>
                    <p class="text-gray-400 text-sm">Pengiriman aman dan cepat ke seluruh Indonesia.</p>
                </div>
                
                <div class="bg-slate-800/50 backdrop-blur rounded-lg p-8 border border-slate-700 hover:border-[#7FFF00] transition-all">
                    <div class="w-12 h-12 bg-[#7FFF00]/20 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-[#7FFF00]" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm0-13c-2.76 0-5 2.24-5 5s2.24 5 5 5 5-2.24 5-5-2.24-5-5-5z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-white mb-2">Dukungan Expert</h3>
                    <p class="text-gray-400 text-sm">Dapatkan konsultasi gratis dari ahli tanaman kami.</p>
                </div>
                
                <div class="bg-slate-800/50 backdrop-blur rounded-lg p-8 border border-slate-700 hover:border-[#7FFF00] transition-all">
                    <div class="w-12 h-12 bg-[#7FFF00]/20 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-[#7FFF00]" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M18 8h-1V6c0-2.76-2.24-5-5-5s-5 2.24-5 5v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zM9 6c0-1.66 1.34-3 3-3s3 1.34 3 3v2H9V6zm9 14H6V10h12v10zm-6-3c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-white mb-2">Pembayaran Aman</h3>
                    <p class="text-gray-400 text-sm">Berbagai metode pembayaran yang aman dan terpercaya.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-16 sm:py-24 bg-slate-950">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-4xl sm:text-5xl font-bold mb-4">
                    Testimoni <span class="glow-green">Pelanggan</span>
                </h2>
                <p class="text-lg text-gray-400">Kepuasan pelanggan adalah prioritas kami</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @for($i = 1; $i <= 3; $i++)
                    <div class="bg-slate-800/50 backdrop-blur border border-slate-700 rounded-lg p-8 hover:border-[#7FFF00] transition-all">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="w-12 h-12 bg-[#7FFF00]/20 rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6 text-[#7FFF00]" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-white">Pelanggan {{ $i }}</h4>
                                <p class="text-sm text-gray-400">Jakarta</p>
                            </div>
                        </div>
                        <p class="text-yellow-400 mb-3">★★★★★</p>
                        <p class="text-gray-400 italic">"Tanaman yang saya pesan sangat sehat dan indah! Pengiriman juga cepat dan aman. Sangat puas dengan layanan ToroGloneys."</p>
                    </div>
                @endfor
            </div>
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="py-16 sm:py-24 bg-gradient-to-r from-[#7FFF00]/10 to-[#90EE90]/10 border-y border-[#7FFF00]/30">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl sm:text-4xl font-bold mb-4 text-white">
                Tetap Update
            </h2>
            <p class="text-lg text-gray-400 mb-8">
                Dapatkan penawaran spesial dan tips merawat tanaman langsung ke email Anda.
            </p>
            
            <form class="flex flex-col sm:flex-row gap-3">
                <input 
                    type="email" 
                    placeholder="Masukkan email Anda..." 
                    class="flex-1 px-6 py-3 bg-slate-800 border border-slate-700 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:border-[#7FFF00] transition-colors"
                    required
                >
                <button type="submit" class="btn-primary">
                    Subscribe
                </button>
            </form>
            
            <p class="text-sm text-gray-500 mt-4">
                Kami menghormati privasi Anda. Unsubscribe kapan saja.
            </p>
        </div>
    </section>
</main>
@endsection
