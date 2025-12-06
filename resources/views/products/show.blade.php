@extends('layouts.app')

@section('title', $product->name . ' - ToroGloneys')

@section('content')
<main class="pt-24">
    <!-- Breadcrumb -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="flex items-center gap-2 text-sm text-gray-400">
            <a href="{{ route('home') }}" class="hover:text-[#7FFF00] transition-colors">Home</a>
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M9 6l6 6-6 6"/></svg>
            <a href="{{ route('products.index') }}" class="hover:text-[#7FFF00] transition-colors">Produk</a>
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M9 6l6 6-6 6"/></svg>
            <span class="text-white">{{ $product->name }}</span>
        </div>
    </div>

    <!-- Product Details -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 mb-16">
            <!-- Product Image -->
            <div>
                @if($product->image)
                    <img 
                        src="{{ asset('storage/' . $product->image) }}" 
                        alt="{{ $product->name }}"
                        class="w-full h-auto rounded-lg border border-slate-700 object-cover"
                    >
                @else
                    <div class="bg-gradient-to-br from-slate-800 to-slate-900 rounded-lg border border-slate-700 p-8 flex items-center justify-center min-h-96">
                        <div class="text-center">
                            <svg class="w-32 h-32 text-slate-600 mx-auto mb-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/>
                            </svg>
                            <p class="text-gray-500">Gambar tidak tersedia</p>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Product Information -->
            <div>
                <!-- Category -->
                @if($product->category)
                    <p class="text-xs uppercase tracking-widest text-[#7FFF00] font-semibold mb-3">
                        {{ $product->category->name }}
                    </p>
                @endif

                <!-- Product Name -->
                <h1 class="text-4xl sm:text-5xl font-bold text-white mb-4">
                    {{ $product->name }}
                </h1>

                <!-- SKU -->
                <p class="text-gray-400 text-sm mb-6">SKU: <span class="text-gray-300">{{ $product->sku }}</span></p>

                <!-- Price -->
                <div class="mb-6">
                    <p class="text-gray-400 text-sm mb-2">Harga</p>
                    <p class="text-5xl font-bold text-[#7FFF00]">
                        Rp{{ number_format($product->price, 0, ',', '.') }}
                    </p>
                </div>

                <!-- Stock Status -->
                <div class="mb-8 p-4 rounded-lg border" 
                     :class="$product->stock > 0 
                         ? 'bg-[#7FFF00]/10 border-[#7FFF00]/30' 
                         : 'bg-red-500/10 border-red-500/30'"
                >
                    <div class="flex items-center gap-2">
                        @if($product->stock > 0)
                            <svg class="w-5 h-5 text-[#7FFF00]" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                            </svg>
                            <div>
                                <p class="text-sm font-semibold text-white">Tersedia</p>
                                <p class="text-xs text-gray-400">{{ $product->stock }} unit tersedia</p>
                            </div>
                        @else
                            <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/>
                            </svg>
                            <div>
                                <p class="text-sm font-semibold text-white">Tidak Tersedia</p>
                                <p class="text-xs text-gray-400">Produk sedang habis</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Quantity & Add to Cart -->
                <div class="flex gap-4 mb-8">
                    <div class="flex items-center border border-slate-700 rounded-lg overflow-hidden bg-slate-800/50">
                        <button class="px-4 py-3 hover:bg-slate-700 transition-colors" type="button" onclick="decreaseQty()">
                            <svg class="w-4 h-4 text-[#7FFF00]" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M19 13H5v-2h14v2z"/>
                            </svg>
                        </button>
                        <input 
                            type="number" 
                            id="quantity" 
                            value="1" 
                            min="1" 
                            :max="$product->stock"
                            class="flex-1 px-4 py-3 bg-transparent text-white text-center border-0 focus:outline-none w-16"
                        >
                        <button class="px-4 py-3 hover:bg-slate-700 transition-colors" type="button" onclick="increaseQty()">
                            <svg class="w-4 h-4 text-[#7FFF00]" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/>
                            </svg>
                        </button>
                    </div>
                    
                    @if($product->stock > 0)
                        <button class="flex-1 btn-primary py-3 font-semibold" onclick="addToCart()">
                            Tambah ke Keranjang
                        </button>
                    @else
                        <button class="flex-1 btn-secondary py-3 font-semibold opacity-50 cursor-not-allowed" disabled>
                            Tidak Tersedia
                        </button>
                    @endif
                </div>

                <!-- Additional Info -->
                <div class="space-y-4 pt-8 border-t border-slate-800">
                    <div class="flex gap-4">
                        <div class="flex-shrink-0">
                            <svg class="w-6 h-6 text-[#7FFF00]" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-white font-semibold text-sm">100% Produk Asli</p>
                            <p class="text-gray-400 text-xs">Semua produk kami dijamin keasliannya</p>
                        </div>
                    </div>
                    
                    <div class="flex gap-4">
                        <div class="flex-shrink-0">
                            <svg class="w-6 h-6 text-[#7FFF00]" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-white font-semibold text-sm">Pengiriman Cepat</p>
                            <p class="text-gray-400 text-xs">Dikirim dalam 1-2 hari kerja</p>
                        </div>
                    </div>
                    
                    <div class="flex gap-4">
                        <div class="flex-shrink-0">
                            <svg class="w-6 h-6 text-[#7FFF00]" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-white font-semibold text-sm">Dukungan Pelanggan</p>
                            <p class="text-gray-400 text-xs">Tim kami siap membantu Anda</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Product Description -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-16">
            <div class="lg:col-span-2">
                <div class="bg-slate-900/50 border border-slate-800 rounded-lg p-8">
                    <h2 class="text-2xl font-bold text-white mb-4">Deskripsi Produk</h2>
                    <p class="text-gray-300 leading-relaxed">
                        {{ $product->description }}
                    </p>
                </div>
            </div>

            <!-- Additional Details -->
            <div class="bg-slate-900/50 border border-slate-800 rounded-lg p-8">
                <h3 class="text-lg font-bold text-white mb-4">Informasi Produk</h3>
                <div class="space-y-4">
                    <div>
                        <p class="text-xs text-gray-400 uppercase">Kategori</p>
                        @if($product->category)
                            <p class="text-white font-semibold">{{ $product->category->name }}</p>
                        @else
                            <p class="text-gray-500">-</p>
                        @endif
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 uppercase">Harga</p>
                        <p class="text-white font-semibold text-[#7FFF00]">
                            Rp{{ number_format($product->price, 0, ',', '.') }}
                        </p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 uppercase">Stok</p>
                        <p class="text-white font-semibold">
                            @if($product->stock > 0)
                                {{ $product->stock }} unit
                            @else
                                <span class="text-red-500">Habis</span>
                            @endif
                        </p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 uppercase">SKU</p>
                        <p class="text-white font-semibold text-sm">{{ $product->sku }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Products -->
        @if($relatedProducts->count() > 0)
            <div>
                <div class="mb-8">
                    <h2 class="text-3xl font-bold text-white mb-2">
                        Produk <span class="glow-green">Terkait</span>
                    </h2>
                    <p class="text-gray-400">
                        Lihat produk serupa dari kategori {{ $product->category->name ?? 'yang sama' }}
                    </p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($relatedProducts as $related)
                        <a href="{{ route('products.show', $related->slug) }}" class="group">
                            <div class="bg-slate-800/50 backdrop-blur border border-slate-700 rounded-lg overflow-hidden hover:border-[#7FFF00] transition-all duration-300 hover:shadow-lg hover:shadow-[#7FFF00]/20">
                                <!-- Product Image -->
                                <div class="relative h-56 bg-slate-900 overflow-hidden">
                                    @if($related->image)
                                        <img 
                                            src="{{ asset('storage/' . $related->image) }}" 
                                            alt="{{ $related->name }}"
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
                                        @if($related->stock > 0)
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
                                    <!-- Name -->
                                    <h3 class="text-lg font-semibold text-white mb-2 group-hover:text-[#7FFF00] transition-colors line-clamp-2">
                                        {{ $related->name }}
                                    </h3>
                                    
                                    <!-- Description -->
                                    <p class="text-sm text-gray-400 mb-3 line-clamp-2">
                                        {{ $related->description }}
                                    </p>
                                    
                                    <!-- Price -->
                                    <div class="flex items-center justify-between">
                                        <span class="text-2xl font-bold text-[#7FFF00]">
                                            Rp{{ number_format($related->price, 0, ',', '.') }}
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
            </div>
        @endif
    </div>
</main>

<script>
    function decreaseQty() {
        const qty = document.getElementById('quantity');
        if (qty.value > 1) {
            qty.value = parseInt(qty.value) - 1;
        }
    }

    function increaseQty() {
        const qty = document.getElementById('quantity');
        const max = parseInt(qty.max);
        if (parseInt(qty.value) < max) {
            qty.value = parseInt(qty.value) + 1;
        }
    }

    function addToCart() {
        const qty = document.getElementById('quantity').value;
        alert('Produk ditambahkan: ' + qty + ' unit');
        // TODO: Implement actual cart functionality
    }
</script>
@endsection
