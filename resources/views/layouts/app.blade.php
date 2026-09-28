<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<title>@yield('title', 'SMECONE Archery Club')</title>
<meta name="description" content="@yield('description', 'Portal resmi Ekstrakurikuler SMECONE Archery Club SMK Negeri 1 Purwokerto')">
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://cdn.tailwindcss.com"></script>
<script>tailwind.config = {darkMode: "class", theme: {extend: {"colors": {"on-tertiary": "#ffffff", "error-container": "#ffdad6", "surface-tint": "#306855", "surface-container-highest": "#e1e3e0", "on-background": "#191c1b", "on-surface": "#191c1b", "secondary-container": "#dee0df", "on-secondary-fixed-variant": "#444747", "surface-container-high": "#e7e9e5", "inverse-primary": "#99d3ba", "on-secondary": "#ffffff", "tertiary-container": "#683600", "on-primary-fixed-variant": "#15503e", "inverse-on-surface": "#f0f1ee", "on-primary": "#ffffff", "outline-variant": "#bfc9c3", "on-tertiary-container": "#ff9631", "error": "#ba1a1a", "primary": "#003426", "tertiary": "#482300", "surface-container-low": "#f2f4f1", "on-primary-fixed": "#002117", "inverse-surface": "#2e312f", "outline": "#707974", "secondary-fixed-dim": "#c4c7c6", "secondary-fixed": "#e1e3e2", "on-error": "#ffffff", "surface": "#f8faf6", "on-primary-container": "#82bba4", "on-tertiary-fixed-variant": "#6e3900", "on-tertiary-fixed": "#2f1500", "background": "#f8faf6", "on-secondary-container": "#606363", "surface-container": "#edeeeb", "primary-fixed-dim": "#99d3ba", "tertiary-fixed": "#ffdcc3", "secondary": "#5c5f5e", "surface-bright": "#f8faf6", "on-error-container": "#93000a", "surface-variant": "#e1e3e0", "surface-dim": "#d9dad7", "tertiary-fixed-dim": "#ffb77d", "surface-container-lowest": "#ffffff", "primary-fixed": "#b4efd6", "on-secondary-fixed": "#191c1c", "primary-container": "#0f4c3a", "on-surface-variant": "#404944"}, "borderRadius": {"DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "full": "9999px"}, "spacing": {"space-lg": "1.5rem", "space-xs": "0.25rem", "space-sm": "0.5rem", "margin": "2rem", "gutter": "1.5rem", "space-md": "1rem", "space-xl": "2.5rem"}, "fontFamily": {"body-lg": ["Plus Jakarta Sans"], "body-sm": ["Plus Jakarta Sans"], "label-md": ["Plus Jakarta Sans"], "label-sm": ["Plus Jakarta Sans"], "headline-lg-mobile": ["Lexend"], "headline-md": ["Lexend"], "headline-lg": ["Lexend"], "label-lg": ["Plus Jakarta Sans"], "headline-sm": ["Lexend"], "body-md": ["Plus Jakarta Sans"]}, "fontSize": {"body-lg": ["16px", {"lineHeight": "24px", "fontWeight": "400"}], "body-sm": ["12px", {"lineHeight": "16px", "fontWeight": "400"}], "label-md": ["12px", {"lineHeight": "16px", "letterSpacing": "0.01em", "fontWeight": "600"}], "label-sm": ["10px", {"lineHeight": "14px", "letterSpacing": "0.02em", "fontWeight": "600"}], "headline-lg-mobile": ["28px", {"lineHeight": "36px", "letterSpacing": "-0.01em", "fontWeight": "700"}], "headline-md": ["24px", {"lineHeight": "32px", "letterSpacing": "-0.01em", "fontWeight": "600"}], "headline-lg": ["36px", {"lineHeight": "44px", "letterSpacing": "-0.02em", "fontWeight": "700"}], "label-lg": ["14px", {"lineHeight": "20px", "letterSpacing": "0.01em", "fontWeight": "600"}], "headline-sm": ["18px", {"lineHeight": "24px", "fontWeight": "600"}], "body-md": ["14px", {"lineHeight": "20px", "fontWeight": "400"}]}}}};</script>
<link href="https://fonts.googleapis.com/css2?family=Lexend:wght@600;700&family=Plus+Jakarta+Sans:wght@400;600&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
<style>
@layer base{html,body{margin:0;padding:0}body{overscroll-behavior:none}main>:first-child{margin-top:0!important}main>:last-child{margin-bottom:0!important}}
::-webkit-scrollbar{display:none}
.mobile-nav{transform:translateX(100%);transition:transform .3s ease}
.mobile-nav.open{transform:translateX(0)}
.mobile-overlay{opacity:0;pointer-events:none;transition:opacity .3s ease}
.mobile-overlay.open{opacity:1;pointer-events:auto}
.toast-enter{animation:slideUp .3s ease forwards}
.toast-exit{animation:slideDown .3s ease forwards}
@keyframes slideUp{from{transform:translateY(1rem);opacity:0}to{transform:translateY(0);opacity:1}}
@keyframes slideDown{from{transform:translateY(0);opacity:1}to{transform:translateY(1rem);opacity:0}}
</style>
@stack('styles')
</head>
<body class="bg-surface font-body-md text-on-surface">

{{-- ========== HEADER ========== --}}
<header class="fixed top-0 w-full z-50 bg-surface/90 backdrop-blur-xl shadow-[0_1px_8px_rgba(0,0,0,0.04)]">
<div class="h-16 lg:h-20 max-w-7xl mx-auto px-4 lg:px-gutter flex items-center justify-between">
{{-- Logo --}}
<a href="{{ route('home') }}" class="flex items-center gap-2 lg:gap-space-md transition-opacity hover:opacity-90 flex-shrink-0">
<div class="w-9 h-9 lg:w-10 lg:h-10 rounded-xl bg-primary flex items-center justify-center text-on-primary font-headline-sm text-[14px] lg:text-[18px]">SAC</div>
<span class="font-headline-sm tracking-tight uppercase text-primary text-[14px] lg:text-[18px] hidden sm:inline">SMECONE Archery</span>
</a>

{{-- Desktop Nav --}}
<nav class="hidden xl:flex items-center gap-1">
@php $current = request()->route()->getName(); @endphp
<a class="text-[13px] {{ $current === 'home' ? 'bg-primary-container text-on-primary-container font-semibold' : 'text-on-surface-variant hover:text-on-surface hover:bg-surface-container' }} px-2.5 py-1.5 rounded-lg transition-all" href="{{ route('home') }}">Beranda</a>
<a class="text-[13px] {{ $current === 'structure.index' ? 'bg-primary-container text-on-primary-container font-semibold' : 'text-on-surface-variant hover:text-on-surface hover:bg-surface-container' }} px-2.5 py-1.5 rounded-lg transition-all" href="{{ route('structure.index') }}">Kepengurusan</a>

@auth
<a class="text-[13px] {{ $current === 'members.index' ? 'bg-primary-container text-on-primary-container font-semibold' : 'text-on-surface-variant hover:text-on-surface hover:bg-surface-container' }} px-2.5 py-1.5 rounded-lg transition-all" href="{{ route('members.index') }}">Anggota</a>
<a class="text-[13px] {{ $current === 'attendances.index' ? 'bg-primary-container text-on-primary-container font-semibold' : 'text-on-surface-variant hover:text-on-surface hover:bg-surface-container' }} px-2.5 py-1.5 rounded-lg transition-all" href="{{ route('attendances.index') }}">Absensi</a>
<a class="text-[13px] {{ $current === 'finances.index' ? 'bg-primary-container text-on-primary-container font-semibold' : 'text-on-surface-variant hover:text-on-surface hover:bg-surface-container' }} px-2.5 py-1.5 rounded-lg transition-all" href="{{ route('finances.index') }}">Iuran</a>
<a class="text-[13px] {{ $current === 'schedules.index' ? 'bg-primary-container text-on-primary-container font-semibold' : 'text-on-surface-variant hover:text-on-surface hover:bg-surface-container' }} px-2.5 py-1.5 rounded-lg transition-all" href="{{ route('schedules.index') }}">Jadwal</a>

@if(auth()->user()->isAdmin())
<a class="text-[13px] {{ $current === 'admin.dashboard' ? 'bg-primary-container text-on-primary-container font-semibold' : 'text-on-surface-variant hover:text-on-surface hover:bg-surface-container' }} px-2.5 py-1.5 rounded-lg transition-all" href="{{ route('admin.dashboard') }}">Admin</a>
@endif
@endauth
</nav>

{{-- Right Side --}}
<div class="flex items-center gap-2 lg:gap-3">
@auth
{{-- User Info --}}
<div class="hidden md:flex items-center gap-2">
<div class="w-8 h-8 rounded-full bg-primary-container flex items-center justify-center flex-shrink-0">
<span class="material-symbols-outlined text-on-primary-container text-[16px]" style="font-variation-settings:'FILL' 1">person</span>
</div>
<div class="text-right">
<div class="text-[12px] font-semibold text-on-surface leading-tight truncate max-w-[120px]">{{ auth()->user()->name }}</div>
<div class="text-[10px] text-on-surface-variant uppercase tracking-wider">{{ auth()->user()->role }}</div>
</div>
</div>
<form method="POST" action="{{ route('logout') }}" class="inline">
@csrf
<button type="submit" class="bg-surface-container text-on-surface-variant px-3 py-1.5 rounded-lg font-label-lg hover:bg-error-container hover:text-on-error-container transition-all flex items-center gap-1.5 text-[13px]">
<span class="material-symbols-outlined text-[16px]">logout</span>
<span class="hidden sm:inline">Keluar</span>
</button>
</form>
@else
<a class="bg-primary text-on-primary px-3 lg:px-space-lg py-1.5 lg:py-space-sm rounded-lg font-label-lg hover:bg-primary-container hover:text-on-primary-container transition-all shadow-[0_4px_20px_-2px_rgba(15,76,58,0.08)] flex items-center gap-1.5 text-[13px] lg:text-[14px]" href="{{ route('login') }}">
<span>Login</span>
<span class="material-symbols-outlined text-[16px] lg:text-[18px]">login</span>
</a>
@endauth

{{-- Mobile Hamburger --}}
<button class="xl:hidden p-2 rounded-lg hover:bg-surface-container transition-all" onclick="toggleMobileMenu()">
<span class="material-symbols-outlined text-[24px] text-on-surface">menu</span>
</button>
</div>
</div>
</header>

{{-- ========== MOBILE NAV ========== --}}
<div class="fixed inset-0 z-[55] bg-inverse-surface/40 mobile-overlay" id="mobileOverlay" onclick="toggleMobileMenu()"></div>
<div class="fixed top-0 right-0 h-full w-72 z-[60] bg-surface shadow-2xl mobile-nav overflow-y-auto" id="mobileNav">
<div class="flex items-center justify-between p-4 border-b border-outline-variant/20">
<span class="font-headline-sm text-primary">Menu</span>
<button class="p-1.5 rounded-lg hover:bg-surface-container transition-all" onclick="toggleMobileMenu()">
<span class="material-symbols-outlined text-[20px]">close</span>
</button>
</div>

@auth
<div class="p-4 border-b border-outline-variant/20 flex items-center gap-3">
<div class="w-10 h-10 rounded-full bg-primary-container flex items-center justify-center">
<span class="material-symbols-outlined text-on-primary-container text-[20px]" style="font-variation-settings:'FILL' 1">person</span>
</div>
<div>
<div class="text-body-md font-semibold text-on-surface">{{ auth()->user()->name }}</div>
<div class="text-body-sm text-on-surface-variant uppercase">{{ auth()->user()->role }}</div>
</div>
</div>
@endauth

<nav class="p-4 flex flex-col gap-1">
@php $current = request()->route()->getName(); @endphp
<a class="px-3 py-2.5 rounded-lg {{ $current === 'home' ? 'bg-primary-container text-on-primary-container font-semibold' : 'text-on-surface-variant hover:bg-surface-container' }} transition-all text-body-md" href="{{ route('home') }}">Beranda</a>
<a class="px-3 py-2.5 rounded-lg {{ $current === 'structure.index' ? 'bg-primary-container text-on-primary-container font-semibold' : 'text-on-surface-variant hover:bg-surface-container' }} transition-all text-body-md" href="{{ route('structure.index') }}">Kepengurusan</a>

@auth
<a class="px-3 py-2.5 rounded-lg {{ $current === 'members.index' ? 'bg-primary-container text-on-primary-container font-semibold' : 'text-on-surface-variant hover:bg-surface-container' }} transition-all text-body-md" href="{{ route('members.index') }}">Anggota</a>
<a class="px-3 py-2.5 rounded-lg {{ $current === 'attendances.index' ? 'bg-primary-container text-on-primary-container font-semibold' : 'text-on-surface-variant hover:bg-surface-container' }} transition-all text-body-md" href="{{ route('attendances.index') }}">Absensi</a>
<a class="px-3 py-2.5 rounded-lg {{ $current === 'finances.index' ? 'bg-primary-container text-on-primary-container font-semibold' : 'text-on-surface-variant hover:bg-surface-container' }} transition-all text-body-md" href="{{ route('finances.index') }}">Iuran</a>
<a class="px-3 py-2.5 rounded-lg {{ $current === 'schedules.index' ? 'bg-primary-container text-on-primary-container font-semibold' : 'text-on-surface-variant hover:bg-surface-container' }} transition-all text-body-md" href="{{ route('schedules.index') }}">Jadwal</a>

@if(auth()->user()->isAdmin())
<div class="border-t border-outline-variant/20 my-2"></div>
<span class="px-3 py-1 text-label-sm text-primary uppercase tracking-widest">Admin Panel</span>
<a class="px-3 py-2.5 rounded-lg {{ $current === 'admin.dashboard' ? 'bg-primary-container text-on-primary-container font-semibold' : 'text-on-surface-variant hover:bg-surface-container' }} transition-all text-body-md" href="{{ route('admin.dashboard') }}">Dashboard Admin</a>
@endif

<div class="border-t border-outline-variant/20 my-2"></div>
<form method="POST" action="{{ route('logout') }}">
@csrf
<button type="submit" class="w-full text-left px-3 py-2.5 rounded-lg text-error hover:bg-error-container transition-all text-body-md">Keluar</button>
</form>
@else
<div class="border-t border-outline-variant/20 my-2"></div>
<a class="px-3 py-2.5 rounded-lg bg-primary text-on-primary font-semibold text-center transition-all text-body-md" href="{{ route('login') }}">Login</a>
@endauth
</nav>
</div>

{{-- ========== MAIN ========== --}}
<main class="w-full pt-16 lg:pt-20 bg-surface min-h-screen">
@yield('content')
</main>

{{-- ========== FOOTER ========== --}}
<footer class="w-full bg-surface-container-low py-8 lg:py-12 border-t border-outline-variant/20">
<div class="max-w-7xl mx-auto px-4 lg:px-gutter flex flex-col md:flex-row items-center justify-between gap-space-md text-on-surface-variant text-body-sm">
<div>© {{ date('Y') }} SMECONE Archery Club (SAC). All rights reserved.</div>
<div class="flex gap-space-lg">
<a class="hover:text-primary transition-colors" href="#">Privacy Policy</a>
<a class="hover:text-primary transition-colors" href="#">Terms of Service</a>
<a class="hover:text-primary transition-colors" href="#">Contact</a>
</div>
</div>
</footer>

{{-- ========== TOAST NOTIFICATIONS ========== --}}
@if(session('success'))
<div class="fixed bottom-6 right-6 z-[70] bg-primary text-on-primary px-5 py-3 rounded-xl shadow-xl flex items-center gap-3 toast-enter" id="toastSuccess">
<span class="material-symbols-outlined text-[20px]" style="font-variation-settings:'FILL' 1">check_circle</span>
<span class="font-label-lg">{{ session('success') }}</span>
</div>
@endif
@if(session('error'))
<div class="fixed bottom-6 right-6 z-[70] bg-error text-on-error px-5 py-3 rounded-xl shadow-xl flex items-center gap-3 toast-enter" id="toastError">
<span class="material-symbols-outlined text-[20px]" style="font-variation-settings:'FILL' 1">error</span>
<span class="font-label-lg">{{ session('error') }}</span>
</div>
@endif
@if($errors->any())
<div class="fixed bottom-6 right-6 z-[70] bg-error text-on-error px-5 py-3 rounded-xl shadow-xl flex flex-col gap-1 toast-enter" id="toastValidation">
@foreach($errors->all() as $err)
<span class="font-label-lg text-[13px]">• {{ $err }}</span>
@endforeach
</div>
@endif

{{-- ========== SCRIPTS ========== --}}
<script>
function toggleMobileMenu(){
  const n=document.getElementById('mobileNav'),o=document.getElementById('mobileOverlay');
  n.classList.toggle('open');o.classList.toggle('open');
  document.body.style.overflow=n.classList.contains('open')?'hidden':'';
}
// Auto-hide toast after 4s
document.querySelectorAll('[id^="toast"]').forEach(t=>{
  setTimeout(()=>{t.classList.remove('toast-enter');t.classList.add('toast-exit');setTimeout(()=>t.remove(),300)},4000);
});
</script>
@stack('scripts')
</body>
</html>
