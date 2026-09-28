@extends('layouts.app')
@section('title', 'Masuk Akun')

@section('content')
<div class="min-h-[85vh] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 bg-surface relative overflow-hidden -mt-10">
<!-- Background Elements -->
<div class="absolute -left-32 -top-32 w-[30rem] h-[30rem] rounded-full bg-primary-container/20 blur-3xl pointer-events-none"></div>
<div class="absolute -right-32 -bottom-32 w-[30rem] h-[30rem] rounded-full bg-secondary-container/20 blur-3xl pointer-events-none"></div>

<div class="max-w-md w-full bg-surface-container-lowest/80 backdrop-blur-xl p-10 rounded-3xl shadow-xl border border-outline-variant/30 relative z-10">
<div class="text-center mb-8">
<div class="w-16 h-16 rounded-2xl bg-primary text-on-primary flex items-center justify-center font-headline font-bold text-3xl mx-auto mb-5 shadow-lg shadow-primary/30">
SAC
</div>
<h2 class="font-headline-lg text-2xl text-on-surface mb-2">Selamat Datang Kembali</h2>
<p class="text-sm text-on-surface-variant">Silakan masuk untuk mengakses portal SMECONE Archery Club.</p>
</div>

<!-- Standard Form -->
<form action="{{ route('login.post') }}" method="POST" class="space-y-5">
@csrf
<div>
<label class="block text-sm font-semibold text-on-surface mb-1.5">Alamat Email</label>
<div class="relative">
<span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-outline text-[20px]">mail</span>
<input type="email" name="email" value="{{ old('email') }}" required placeholder="email@smecone.sch.id" class="w-full pl-12 pr-4 py-3 bg-surface-container-low rounded-xl text-body-md border border-outline-variant/50 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all">
</div>
</div>

<div>
<label class="block text-sm font-semibold text-on-surface mb-1.5">Kata Sandi</label>
<div class="relative">
<span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-outline text-[20px]">lock</span>
<input type="password" name="password" required placeholder="••••••••" class="w-full pl-12 pr-4 py-3 bg-surface-container-low rounded-xl text-body-md border border-outline-variant/50 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all">
</div>
</div>

<div class="flex items-center justify-between text-sm">
<label class="flex items-center gap-2 cursor-pointer group">
<input type="checkbox" name="remember" class="w-4 h-4 rounded text-primary focus:ring-primary border-outline-variant group-hover:border-primary transition-colors">
<span class="text-on-surface-variant font-medium">Ingat Saya</span>
</label>
<a href="#" onclick="alert('Silakan hubungi administrator (Coach Arief) untuk mereset kata sandi Anda.')" class="text-primary font-semibold hover:text-primary/80 transition-colors">Lupa Sandi?</a>
</div>

<button type="submit" class="w-full py-3.5 rounded-xl bg-primary text-on-primary font-semibold text-label-lg hover:bg-primary/90 hover:shadow-lg hover:shadow-primary/20 transition-all flex items-center justify-center gap-2 mt-2">
<span>Masuk</span>
<span class="material-symbols-outlined text-[20px]">login</span>
</button>
</form>

<div class="mt-8 text-center text-sm text-on-surface-variant">
Belum memiliki akun? <a href="#" onclick="alert('Pendaftaran akun hanya dapat dilakukan oleh Administrator klub.')" class="text-primary font-semibold hover:underline">Hubungi Admin</a>
</div>
</div>
</div>
@endsection
