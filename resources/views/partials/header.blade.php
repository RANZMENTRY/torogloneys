<header class="fixed top-0 w-full z-50 bg-slate-950/80 backdrop-blur-md border-b border-slate-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex items-center space-x-2">
                <span class="text-2xl font-bold glow-green">🌿 ToroGloneys</span>
            </a>
            
            <!-- Desktop Navigation -->
            <nav class="hidden md:flex items-center space-x-8">
                <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                    Home
                </a>
                <a href="{{ route('products.index') }}" class="nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}">
                    Produk
                </a>
                <a href="{{ route('about') }}" class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}">
                    Tentang
                </a>
                <a href="{{ route('contact') }}" class="nav-link {{ request()->routeIs('contact*') ? 'active' : '' }}">
                    Hubungi
                </a>
            </nav>
            
            <!-- Right Icons -->
            <div class="flex items-center space-x-4">
                <button class="text-gray-300 hover:text-[#7FFF00] transition-colors">
                    🔍
                </button>
            </div>
            
            <!-- Mobile Menu Button -->
            <button id="menu-btn" class="md:hidden text-gray-300 hover:text-[#7FFF00]">
                ☰
            </button>
        </div>
        
        <!-- Mobile Menu -->
        <nav id="mobile-menu" class="hidden md:hidden pb-4 space-y-2">
            <a href="{{ route('home') }}" class="block px-4 py-2 text-gray-300 hover:text-[#7FFF00] rounded">
                Home
            </a>
            <a href="{{ route('products.index') }}" class="block px-4 py-2 text-gray-300 hover:text-[#7FFF00] rounded">
                Produk
            </a>
            <a href="{{ route('about') }}" class="block px-4 py-2 text-gray-300 hover:text-[#7FFF00] rounded">
                Tentang
            </a>
            <a href="{{ route('contact') }}" class="block px-4 py-2 text-gray-300 hover:text-[#7FFF00] rounded">
                Hubungi
            </a>
        </nav>
    </div>
</header>
