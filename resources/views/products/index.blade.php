@extends('layouts.app')

@section('title', 'Products - ToroGloneys')

@section('content')
<main class="pt-24">
    <!-- Page Header -->
    <section class="bg-gradient-to-b from-slate-900 to-slate-950 border-b border-slate-800 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl sm:text-5xl font-bold text-white mb-4">
                Koleksi <span class="glow-green">Produk</span>
            </h1>
            <p class="text-gray-400 text-lg">
                Jelajahi koleksi lengkap tanaman Aglaonema premium kami
            </p>
        </div>
    </section>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Sidebar Filters -->
            <div class="lg:col-span-1">
                <div class="bg-slate-900 border border-slate-800 rounded-lg p-4 sm:p-6 sticky top-24">
                    <!-- Search -->
                    <div class="mb-6">
                        <form method="GET" action="{{ route('products.index') }}" id="filterForm">
                            <div class="mb-4">
                                <label class="block text-sm font-semibold text-white mb-2">Cari Produk</label>
                                <input 
                                    type="text" 
                                    name="search"
                                    value="{{ request('search') }}"
                                    placeholder="Cari nama produk..."
                                    class="w-full px-3 py-2 bg-slate-800 border border-slate-700 rounded text-white placeholder-gray-500 focus:outline-none focus:border-[#7FFF00] transition-colors text-sm"
                                >
                            </div>

                            <!-- Category Filter -->
                            <div class="mb-6">
                                <label class="block text-sm font-semibold text-white mb-3">Kategori</label>
                                <div class="space-y-2 max-h-48 overflow-y-auto">
                                    <label class="flex items-center">
                                        <input 
                                            type="radio" 
                                            name="category" 
                                            value="" 
                                            {{ request('category') === '' || request('category') === null ? 'checked' : '' }}
                                            class="w-4 h-4 accent-[#7FFF00]"
                                        >
                                        <span class="ml-2 text-sm text-gray-400">Semua Kategori</span>
                                    </label>
                                    @foreach($categories as $cat)
                                        <label class="flex items-center">
                                            <input 
                                                type="radio" 
                                                name="category" 
                                                value="{{ $cat->slug }}"
                                                {{ request('category') === $cat->slug ? 'checked' : '' }}
                                                class="w-4 h-4 accent-[#7FFF00]"
                                            >
                                            <span class="ml-2 text-sm text-gray-400">{{ $cat->name }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Price Range -->
                            <div class="mb-6">
                                <label class="block text-sm font-semibold text-white mb-3">Rentang Harga</label>
                                <div class="space-y-2">
                                    <input 
                                        type="number" 
                                        name="price_min" 
                                        placeholder="Harga Min"
                                        value="{{ request('price_min') }}"
                                        class="w-full px-3 py-2 bg-slate-800 border border-slate-700 rounded text-white placeholder-gray-500 focus:outline-none focus:border-[#7FFF00] transition-colors text-sm"
                                    >
                                    <input 
                                        type="number" 
                                        name="price_max" 
                                        placeholder="Harga Max"
                                        value="{{ request('price_max') }}"
                                        class="w-full px-3 py-2 bg-slate-800 border border-slate-700 rounded text-white placeholder-gray-500 focus:outline-none focus:border-[#7FFF00] transition-colors text-sm"
                                    >
                                </div>
                            </div>

                            <!-- Stock Status -->
                            <div class="mb-6">
                                <label class="flex items-center">
                                    <input 
                                        type="checkbox" 
                                        name="in_stock" 
                                        value="1"
                                        {{ request('in_stock') ? 'checked' : '' }}
                                        class="w-4 h-4 accent-[#7FFF00]"
                                    >
                                    <span class="ml-2 text-sm text-gray-400">Hanya Tersedia</span>
                                </label>
                            </div>

                            <!-- Filter Buttons -->
                            <div class="flex gap-2">
                                <button type="submit" class="flex-1 btn-primary py-2 text-sm">
                                    Terapkan
                                </button>
                                <a href="{{ route('products.index') }}" class="flex-1 btn-secondary py-2 text-sm text-center">
                                    Reset
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Products Grid -->
            <div class="lg:col-span-3">
                <!-- Sort -->
                <div class="flex justify-between items-center mb-8">
                    <p class="text-gray-400">
                        Menampilkan <span class="text-[#7FFF00] font-semibold">{{ $products->count() }}</span> produk
                        @if(request('search'))
                            untuk "<span class="text-white font-semibold">{{ request('search') }}</span>"
                        @endif
                    </p>
                    <form method="GET" action="{{ route('products.index') }}" class="flex items-center gap-2">
                        <!-- Preserve filters -->
                        <input type="hidden" name="search" value="{{ request('search') }}">
                        <input type="hidden" name="category" value="{{ request('category') }}">
                        <input type="hidden" name="price_min" value="{{ request('price_min') }}">
                        <input type="hidden" name="price_max" value="{{ request('price_max') }}">
                        <input type="hidden" name="in_stock" value="{{ request('in_stock') }}">
                        
                        <label class="text-sm text-gray-400">Urutkan:</label>
                        <select name="sort" onchange="this.form.submit()" class="px-3 py-2 bg-slate-800 border border-slate-700 rounded text-white text-sm focus:outline-none focus:border-[#7FFF00]">
                            <option value="latest" {{ request('sort') === 'latest' ? 'selected' : '' }}>Terbaru</option>
                            <option value="price_low" {{ request('sort') === 'price_low' ? 'selected' : '' }}>Harga: Terendah</option>
                            <option value="price_high" {{ request('sort') === 'price_high' ? 'selected' : '' }}>Harga: Tertinggi</option>
                            <option value="name" {{ request('sort') === 'name' ? 'selected' : '' }}>Nama (A-Z)</option>
                            <option value="popular" {{ request('sort') === 'popular' ? 'selected' : '' }}>Populer</option>
                        </select>
                    </form>
                </div>

                <!-- Products -->
                @if($products->count() > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                        @foreach($products as $product)
                            <a href="{{ route('products.show', $product->slug) }}" class="group">
                                <div class="bg-slate-800/50 backdrop-blur border border-slate-700 rounded-lg overflow-hidden hover:border-[#7FFF00] transition-all duration-300 hover:shadow-lg hover:shadow-[#7FFF00]/20">
                                    <!-- Product Image -->
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
                                        
                                        <!-- Stock Badge -->
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
                                    
                                    <!-- Product Info -->
                                    <div class="p-4">
                                        <!-- Category -->
                                        @if($product->category)
                                            <p class="text-xs text-gray-400 uppercase tracking-wider mb-2">
                                                {{ $product->category->name }}
                                            </p>
                                        @endif
                                        
                                        <!-- Name -->
                                        <h3 class="text-lg font-semibold text-white mb-2 group-hover:text-[#7FFF00] transition-colors line-clamp-2">
                                            {{ $product->name }}
                                        </h3>
                                        
                                        <!-- Description -->
                                        <p class="text-sm text-gray-400 mb-3 line-clamp-2">
                                            {{ $product->description }}
                                        </p>
                                        
                                        <!-- Price -->
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
                            </a>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="flex justify-center">
                        {{ $products->links() }}
                    </div>
                @else
                    <div class="col-span-full text-center py-12">
                        <svg class="w-16 h-16 text-gray-600 mx-auto mb-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/>
                        </svg>
                        <h3 class="text-xl font-semibold text-white mb-2">Produk Tidak Ditemukan</h3>
                        <p class="text-gray-400 mb-6">Coba ubah filter atau kata kunci pencarian Anda</p>
                        <a href="{{ route('products.index') }}" class="btn-primary inline-block">
                            Lihat Semua Produk
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</main>
@endsection
