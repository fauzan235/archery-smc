@extends('layouts.app')
@section('title', 'Admin Dashboard - SMECONE Archery Club')

@section('content')
<!-- Top Banner / Editorial Header Section -->
<section class="relative bg-primary text-on-primary px-4 lg:px-gutter py-12 overflow-hidden">
<div class="absolute -right-24 -top-24 w-96 h-96 rounded-full bg-primary-container/30 blur-3xl pointer-events-none"></div>
<div class="absolute right-1/3 -bottom-32 w-80 h-80 rounded-full bg-tertiary/10 blur-3xl pointer-events-none"></div>
<div class="relative z-10 flex flex-col md:flex-row md:items-end justify-between gap-6 max-w-7xl mx-auto">
<div>
<div class="flex items-center gap-2 mb-3">
<span class="px-3 py-1 rounded-full bg-primary-container text-on-primary-container font-label-md uppercase tracking-wider">SAC Command Center</span>
<span class="text-inverse-primary text-body-sm">• Season 2024/2025</span>
</div>
<h1 class="font-headline-lg text-on-primary mb-2">Dashboard Administrator</h1>
<p class="text-inverse-primary text-body-lg max-w-xl">Kelola data anggota, presensi latihan, keuangan klub, dan jadwal kegiatan dalam satu kendali terpusat.</p>
</div>
<div class="flex flex-wrap items-center gap-3">
<a href="{{ route('members.index') }}" class="flex items-center gap-2 bg-on-tertiary text-primary hover:bg-surface-container-highest px-4 py-3 rounded-xl font-label-lg transition-all shadow-md">
<span class="material-symbols-outlined text-[20px]">group</span> Kelola Anggota
</a>
<a href="{{ route('attendances.index') }}" class="flex items-center gap-2 bg-primary-container text-on-primary-container hover:bg-primary-container/80 px-4 py-3 rounded-xl font-label-lg transition-all">
<span class="material-symbols-outlined text-[20px]">how_to_reg</span> Absensi
</a>
<a href="{{ route('schedules.index') }}" class="flex items-center gap-2 bg-tertiary-container text-on-tertiary-container hover:bg-tertiary-container/80 px-4 py-3 rounded-xl font-label-lg transition-all">
<span class="material-symbols-outlined text-[20px]">event_available</span> Jadwal
</a>
</div>
</div>
</section>

<!-- Main Content Layout -->
<section class="max-w-7xl mx-auto px-4 lg:px-gutter -mt-6 z-20 relative mb-12 space-y-6">
<!-- Metrics Grid -->
<div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-4">
<!-- Metric 1 -->
<div class="bg-surface-container-lowest p-5 rounded-xl shadow-md hover:shadow-lg transition-all flex flex-col justify-between group">
<div class="flex items-center justify-between mb-4">
<div class="w-10 h-10 rounded-xl bg-primary-container/20 text-primary flex items-center justify-center group-hover:scale-110 transition-transform">
<span class="material-symbols-outlined">group</span>
</div>
<span class="text-[10px] font-label-md text-primary bg-primary-container/30 px-2 py-0.5 rounded-full">Aktif: {{ $activeMembers }}</span>
</div>
<div>
<div class="text-[10px] text-on-surface-variant uppercase tracking-wider mb-1">Total Anggota</div>
<div class="font-headline-lg text-on-surface">{{ $totalMembers }}</div>
</div>
</div>
<!-- Metric 2 -->
<div class="bg-surface-container-lowest p-5 rounded-xl shadow-md hover:shadow-lg transition-all flex flex-col justify-between group">
<div class="flex items-center justify-between mb-4">
<div class="w-10 h-10 rounded-xl bg-primary-container/20 text-primary flex items-center justify-center group-hover:scale-110 transition-transform">
<span class="material-symbols-outlined">how_to_reg</span>
</div>
</div>
<div>
<div class="text-[10px] text-on-surface-variant uppercase tracking-wider mb-1">Hadir Hari Ini</div>
<div class="font-headline-lg text-on-surface">{{ $todayHadir }}</div>
</div>
</div>
<!-- Metric 3 -->
<div class="bg-surface-container-lowest p-5 rounded-xl shadow-md hover:shadow-lg transition-all flex flex-col justify-between group">
<div class="flex items-center justify-between mb-4">
<div class="w-10 h-10 rounded-xl bg-error-container text-error flex items-center justify-center group-hover:scale-110 transition-transform">
<span class="material-symbols-outlined">warning</span>
</div>
</div>
<div>
<div class="text-[10px] text-on-surface-variant uppercase tracking-wider mb-1">Belum Lunas Iuran</div>
<div class="font-headline-lg text-error">{{ $unpaidMembers->count() }}</div>
</div>
</div>
<!-- Metric 4 -->
<div class="bg-surface-container-lowest p-5 rounded-xl shadow-md hover:shadow-lg transition-all flex flex-col justify-between group md:col-span-2 lg:col-span-2">
<div class="flex items-center justify-between mb-4">
<div class="w-10 h-10 rounded-xl bg-primary-container/20 text-primary flex items-center justify-center group-hover:scale-110 transition-transform">
<span class="material-symbols-outlined">account_balance_wallet</span>
</div>
<span class="text-[10px] font-label-md text-primary bg-primary-container/30 px-2 py-0.5 rounded-full">Saldo: Rp {{ number_format($balance, 0, ',', '.') }}</span>
</div>
<div>
<div class="text-[10px] text-on-surface-variant uppercase tracking-wider mb-1">Total Pemasukan</div>
<div class="font-headline-md text-on-surface">Rp {{ number_format($totalIncome, 0, ',', '.') }}</div>
</div>
</div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
<!-- Recent Members -->
<div class="bg-surface-container-lowest p-6 rounded-xl shadow-sm">
<div class="flex items-center justify-between mb-4">
<h3 class="font-headline-sm text-primary">Anggota Baru</h3>
<a href="{{ route('members.index') }}" class="text-body-sm text-primary hover:underline">Lihat Semua</a>
</div>
<div class="space-y-3">
@forelse($recentMembers as $m)
<div class="flex items-center justify-between p-3 bg-surface-container-low rounded-lg">
<div class="flex items-center gap-3">
<div class="w-10 h-10 rounded-full bg-surface-container-high flex items-center justify-center text-outline">
<span class="material-symbols-outlined text-[20px]">person</span>
</div>
<div>
<div class="font-semibold text-body-md">{{ $m->name }}</div>
<div class="text-[11px] text-on-surface-variant">{{ $m->class }} - {{ $m->division }}</div>
</div>
</div>
<span class="px-2 py-1 rounded-full text-[10px] font-semibold {{ $m->status === 'Aktif' ? 'bg-primary/10 text-primary' : 'bg-surface-container text-on-surface-variant' }}">{{ $m->status }}</span>
</div>
@empty
<div class="p-4 text-center text-on-surface-variant text-body-sm">Belum ada data anggota.</div>
@endforelse
</div>
</div>

<!-- Recent Transactions -->
<div class="bg-surface-container-lowest p-6 rounded-xl shadow-sm">
<div class="flex items-center justify-between mb-4">
<h3 class="font-headline-sm text-primary">Transaksi Terakhir</h3>
<a href="{{ route('finances.index') }}" class="text-body-sm text-primary hover:underline">Lihat Semua</a>
</div>
<div class="space-y-3">
@forelse($recentTransactions as $trx)
<div class="flex items-center justify-between p-3 bg-surface-container-low rounded-lg">
<div class="flex items-center gap-3">
<div class="w-10 h-10 rounded-xl {{ $trx->type === 'masuk' ? 'bg-primary-container text-primary' : 'bg-error-container text-error' }} flex items-center justify-center">
<span class="material-symbols-outlined text-[20px]">{{ $trx->type === 'masuk' ? 'arrow_downward' : 'arrow_upward' }}</span>
</div>
<div>
<div class="font-semibold text-body-md">{{ $trx->category }}</div>
<div class="text-[11px] text-on-surface-variant">{{ $trx->date }} • {{ $trx->member_name ?? $trx->description ?? '-' }}</div>
</div>
</div>
<div class="font-semibold text-body-md {{ $trx->type === 'masuk' ? 'text-primary' : 'text-error' }}">
{{ $trx->type === 'masuk' ? '+' : '-' }}Rp {{ number_format($trx->amount, 0, ',', '.') }}
</div>
</div>
@empty
<div class="p-4 text-center text-on-surface-variant text-body-sm">Belum ada data transaksi.</div>
@endforelse
</div>
</div>
</div>
</section>
@endsection