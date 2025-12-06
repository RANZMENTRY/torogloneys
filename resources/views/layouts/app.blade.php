<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ToroGloneys - Premium Aglaonema Plants')</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <style>
        ::-webkit-scrollbar {
            width: 10px;
        }
        
        ::-webkit-scrollbar-track {
            background: #0f1b0f;
        }
        
        ::-webkit-scrollbar-thumb {
            background: #7FFF00;
            border-radius: 5px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: #90EE90;
        }
        
        html {
            scroll-behavior: smooth;
        }
        
        body {
            transition: all 0.3s ease;
        }
        
        .glow-green {
            color: #7FFF00;
            text-shadow: 0 0 10px rgba(127, 255, 0, 0.5);
            animation: glowPulse 2s ease-in-out infinite;
        }
        
        @keyframes glowPulse {
            0%, 100% { text-shadow: 0 0 10px rgba(127, 255, 0, 0.5); }
            50% { text-shadow: 0 0 20px rgba(127, 255, 0, 0.8); }
        }
        
        .btn-primary {
            background-color: #7FFF00;
            color: black;
            font-weight: 600;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            box-shadow: 0 10px 15px -3px rgba(127, 255, 0, 0.3);
            transition: all 0.3s ease;
            cursor: pointer;
            border: none;
        }
        
        .btn-primary:hover {
            background-color: #90EE90;
            box-shadow: 0 20px 25px -5px rgba(127, 255, 0, 0.5);
        }
        
        .btn-primary:active {
            transform: scale(0.95);
        }
        
        .btn-secondary {
            border: 2px solid #7FFF00;
            color: #7FFF00;
            font-weight: 600;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            background-color: transparent;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .btn-secondary:hover {
            background-color: rgba(127, 255, 0, 0.1);
        }
        
        .btn-secondary:active {
            transform: scale(0.95);
        }
        
        .nav-link {
            color: #d1d5db;
            transition: color 0.3s ease;
            position: relative;
            padding-bottom: 0.5rem;
            display: inline-block;
        }
        
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background-color: #7FFF00;
            transition: width 0.3s ease;
        }
        
        .nav-link:hover {
            color: #7FFF00;
        }
        
        .nav-link:hover::after {
            width: 100%;
        }
        
        .nav-link.active {
            color: #7FFF00;
        }
        
        .nav-link.active::after {
            width: 100%;
        }
        
        .fade-in {
            animation: fadeIn 0.6s ease-in;
        }
        
        .fade-in-up {
            animation: fadeInUp 0.7s ease-out;
        }
        
        .fade-in-down {
            animation: fadeInDown 0.7s ease-out;
        }
        
        .scale-in {
            animation: scaleIn 0.5s ease-out;
        }
        
        .slide-in-left {
            animation: slideInLeft 0.6s ease-out;
        }
        
        .slide-in-right {
            animation: slideInRight 0.6s ease-out;
        }
        
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes scaleIn {
            from {
                opacity: 0;
                transform: scale(0.9);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }
        
        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        /* Hover effects for cards */
        .card-hover {
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .card-hover:hover {
            transform: scale(1.05) translateY(-8px);
        }
        
        /* Smooth page transitions */
        main {
            animation: fadeIn 0.5s ease-in;
        }
        
        /* Loading animation */
        .pulse-ring {
            animation: pulseRing 2s infinite;
        }
        
        @keyframes pulseRing {
            0% {
                box-shadow: 0 0 0 0 rgba(127, 255, 0, 0.7);
            }
            70% {
                box-shadow: 0 0 0 15px rgba(127, 255, 0, 0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(127, 255, 0, 0);
            }
        }
        
        /* Gradient animation */
        .gradient-animate {
            background: linear-gradient(
                -45deg,
                #7FFF00,
                #90EE90,
                #7FFF00
            );
            background-size: 400% 400%;
            animation: gradientShift 15s ease infinite;
        }
        
        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        /* Smooth transitions on links */
        a {
            transition: color 0.2s ease;
        }
        
        /* Form inputs focus effect */
        input:focus, textarea:focus, select:focus {
            outline: none;
            box-shadow: 0 0 0 2px rgba(127, 255, 0, 0.5), 0 0 0 4px rgba(15, 23, 15, 1);
        }
        
        /* Stagger animation for list items */
        .stagger-item {
            animation: fadeInUp 0.7s ease-out;
        }
        
        .stagger-item:nth-child(1) { animation-delay: 0.1s; }
        .stagger-item:nth-child(2) { animation-delay: 0.2s; }
        .stagger-item:nth-child(3) { animation-delay: 0.3s; }
        .stagger-item:nth-child(4) { animation-delay: 0.4s; }
        .stagger-item:nth-child(5) { animation-delay: 0.5s; }
        .stagger-item:nth-child(6) { animation-delay: 0.6s; }
    </style>
</head>
<body class="bg-slate-950 text-white">
    @include('partials.header')
    
    @yield('content')
    
    @include('partials.footer')
    
    <script>
        // Mobile menu toggle
        const menuBtn = document.getElementById('menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        
        if (menuBtn && mobileMenu) {
            menuBtn.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });
        }
        
        // Smooth scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth' });
                }
            });
        });
    </script>
</body>
</html>
