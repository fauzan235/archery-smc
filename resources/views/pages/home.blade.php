@extends('layouts.app')
@section('title', 'SMECONE Archery Club - SMK Negeri 1 Purwokerto')

@section('content')
<!-- Hero Section -->
<section class="relative w-full min-h-[75vh] lg:min-h-[80vh] flex items-center justify-center overflow-hidden bg-primary text-on-primary">
<div class="absolute inset-0 z-0 opacity-40 mix-blend-luminosity bg-cover bg-center" style="background-image:url('https://lh3.googleusercontent.com/aida-public/AB6AXuC6o_0A5Vx0NjwCqeBpT10Tnbavs_jWO8ToVooW-qQ_-S_EVWhQTWh-0O8NxfzqfYeUHCpmjWXOEdhzw2OE_Hw1gR81HJ87HdEkvo003Do4DLxf5Qz52UOzmiQOi7b7nvYAxopjJSLZ_pWkq6odiBEsx72SMlwAks0UVj8lBO15tdgYV0JTDQI6YV-KU-mtDiSQNRH7dnFhaAtLZFLb_vMirnGXx_nMh3NdTqBepyg_SVETmkEZx99469Ytq1PYyCWo9w')"></div>
<div class="absolute inset-0 z-1 bg-gradient-to-t from-primary via-primary/80 to-transparent"></div>
<div class="relative z-10 max-w-7xl mx-auto px-4 lg:px-gutter py-20 flex flex-col items-center text-center">
<span class="px-4 py-1.5 rounded-full bg-primary-container text-on-primary-container font-label-md uppercase tracking-wider mb-4 shadow-sm">SMK Negeri 1 Purwokerto</span>
<h1 class="font-headline-lg text-headline-lg-mobile md:text-headline-lg max-w-4xl tracking-tight mb-4 text-white">SMECONE ARCHERY CLUB</h1>
<p class="font-body-lg text-primary-fixed-dim italic max-w-xl mb-8">"Focus. Discipline. Precision."</p>
<div class="flex flex-wrap items-center justify-center gap-3">
@auth
<a class="bg-surface text-primary px-6 py-3 rounded-lg font-label-lg hover:bg-surface-container transition-all shadow-lg flex items-center gap-2" href="{{ route('members.index') }}">
<span>Lihat Anggota</span><span class="material-symbols-outlined text-[18px]">arrow_forward</span>
</a>
@else
<a class="bg-surface text-primary px-6 py-3 rounded-lg font-label-lg hover:bg-surface-container transition-all shadow-lg flex items-center gap-2" href="{{ route('login') }}">
<span>Masuk ke Portal</span><span class="material-symbols-outlined text-[18px]">login</span>
</a>
@endauth
</div>
</div>
</section>

<!-- Statistics -->
<section class="max-w-7xl mx-auto px-4 lg:px-gutter -mt-12 relative z-20 w-full mb-16">
<div class="grid grid-cols-2 md:grid-cols-4 gap-3 lg:gap-4">
@php $stats = [
  ['icon'=>'group','value'=>$totalMembers,'label'=>'Total Anggota'],
  ['icon'=>'calendar_month','value'=>$schedulesCount,'label'=>'Jadwal Latihan'],
  ['icon'=>'event_available','value'=>$activitiesCount,'label'=>'Kegiatan'],
  ['icon'=>'verified','value'=>$activeMembers,'label'=>'Anggota Aktif'],
]; @endphp
@foreach($stats as $s)
<div class="bg-surface-container-lowest p-4 rounded-xl shadow-[0_4px_20px_-2px_rgba(15,76,58,0.08)] flex flex-col items-center text-center">
<div class="w-11 h-11 rounded-xl bg-primary-container text-on-primary-container flex items-center justify-center mb-2">
<span class="material-symbols-outlined text-[22px]">{{ $s['icon'] }}</span>
</div>
<span class="font-headline-md text-primary">{{ $s['value'] }}</span>
<span class="font-label-md text-on-surface-variant uppercase tracking-wider mt-1 text-[10px]">{{ $s['label'] }}</span>
</div>
@endforeach
</div>
</section>

<!-- Quick Access -->
<section class="max-w-7xl mx-auto px-4 lg:px-gutter mb-16">
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
<div class="bg-primary text-on-primary p-6 rounded-xl shadow-lg flex items-center justify-between relative overflow-hidden">
<div class="absolute right-0 top-0 translate-x-8 -translate-y-8 w-48 h-48 bg-primary-container/20 rounded-full blur-2xl pointer-events-none"></div>
<div class="relative z-10 max-w-sm">
<span class="px-3 py-1 rounded-full bg-primary-container text-on-primary-container font-label-sm uppercase tracking-wider mb-3 inline-block">Portal Kehadiran</span>
<h3 class="font-headline-md text-white mb-1">Absensi Latihan</h3>
<p class="font-body-md text-primary-fixed-dim mb-4">Catat kehadiran latihan rutin secara digital.</p>
@auth
<a class="inline-flex items-center gap-2 font-label-lg text-on-primary hover:text-primary-fixed-dim transition-colors" href="{{ route('attendances.index') }}">
<span>Buka Absensi</span><span class="material-symbols-outlined text-[18px]">arrow_forward</span>
</a>
@else
<a class="inline-flex items-center gap-2 font-label-lg text-on-primary hover:text-primary-fixed-dim transition-colors" href="{{ route('login') }}">
<span>Login untuk Akses</span><span class="material-symbols-outlined text-[18px]">login</span>
</a>
@endauth
</div>
<div class="hidden sm:flex w-14 h-14 rounded-full bg-primary-container items-center justify-center text-on-primary-container flex-shrink-0">
<span class="material-symbols-outlined text-[28px]">fact_check</span>
</div>
</div>
<div class="bg-surface-container-highest text-on-surface p-6 rounded-xl shadow-lg flex items-center justify-between relative overflow-hidden">
<div class="relative z-10 max-w-sm">
<span class="px-3 py-1 rounded-full bg-surface-container text-on-surface-variant font-label-sm uppercase tracking-wider mb-3 inline-block">Keuangan Klub</span>
<h3 class="font-headline-md text-on-surface mb-1">Iuran & Keuangan</h3>
<p class="font-body-md text-on-surface-variant mb-4">Cek status pembayaran iuran bulanan dan kas klub.</p>
@auth
<a class="inline-flex items-center gap-2 font-label-lg text-primary hover:text-primary-container transition-colors" href="{{ route('finances.index') }}">
<span>Lihat Keuangan</span><span class="material-symbols-outlined text-[18px]">arrow_forward</span>
</a>
@else
<a class="inline-flex items-center gap-2 font-label-lg text-primary hover:text-primary-container transition-colors" href="{{ route('login') }}">
<span>Login untuk Akses</span><span class="material-symbols-outlined text-[18px]">login</span>
</a>
@endauth
</div>
<div class="hidden sm:flex w-14 h-14 rounded-full bg-surface-container items-center justify-center text-primary flex-shrink-0">
<span class="material-symbols-outlined text-[28px]">payments</span>
</div>
</div>
</div>
</section>

<!-- Jadwal & Pengumuman -->
<section class="max-w-7xl mx-auto px-4 lg:px-gutter mb-16">
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
<div class="lg:col-span-2 flex flex-col gap-4">
<div class="flex items-center justify-between">
<div>
<span class="font-label-sm uppercase tracking-widest text-primary">Agenda</span>
<h2 class="font-headline-md text-on-surface">Jadwal Latihan</h2>
</div>
@auth<a class="font-label-md text-primary hover:underline" href="{{ route('schedules.index') }}">Semua Jadwal</a>@endauth
</div>
@forelse($upcomingSchedules as $sched)
<div class="bg-surface-container-lowest p-4 rounded-xl shadow-sm flex items-center justify-between gap-3">
<div class="flex items-start gap-3">
<div class="w-11 h-11 rounded-xl {{ $loop->first ? 'bg-primary text-on-primary' : 'bg-surface-container text-primary' }} flex flex-col items-center justify-center flex-shrink-0">
<span class="font-label-sm uppercase text-[9px]">{{ $sched->day_code }}</span>
<span class="font-headline-sm text-[16px]">{{ $sched->date_num }}</span>
</div>
<div>
<div class="flex flex-wrap items-center gap-2 mb-1">
<span class="px-2.5 py-0.5 rounded-full bg-primary-container text-on-primary-container font-label-sm text-[10px]">{{ $sched->time }}</span>
<span class="text-on-surface-variant text-body-sm">{{ $sched->location }}</span>
</div>
<h4 class="font-headline-sm text-on-surface text-[16px]">{{ $sched->title }}</h4>
<p class="text-body-sm text-on-surface-variant mt-1">{{ Str::limit($sched->description, 80) }}</p>
</div>
</div>
</div>
@empty
<div class="bg-surface-container-lowest p-6 rounded-xl text-center text-on-surface-variant">Belum ada jadwal latihan.</div>
@endforelse
</div>
<div class="flex flex-col gap-4">
<div><span class="font-label-sm uppercase tracking-widest text-primary">Informasi</span><h2 class="font-headline-md text-on-surface">Pengumuman</h2></div>
@forelse($announcements as $ann)
<div class="bg-surface-container-lowest p-4 rounded-xl shadow-sm {{ $loop->first ? 'border-l-4 border-primary' : '' }} flex flex-col gap-2">
<div class="flex items-center justify-between">
<span class="text-body-sm text-on-surface-variant">{{ $ann->date_text }}</span>
<span class="px-2 py-0.5 rounded-full {{ $ann->tag === 'Penting' ? 'bg-primary-container/30 text-primary' : 'bg-surface-container text-on-surface-variant' }} font-label-sm text-[10px]">{{ $ann->tag }}</span>
</div>
<h4 class="font-headline-sm text-on-surface text-[16px]">{{ $ann->title }}</h4>
<p class="text-body-md text-on-surface-variant">{{ Str::limit($ann->content, 120) }}</p>
</div>
@empty
<div class="bg-surface-container-lowest p-6 rounded-xl text-center text-on-surface-variant">Belum ada pengumuman.</div>
@endforelse
</div>
</div>
</section>

<!-- Kegiatan -->
<section id="kegiatan" class="max-w-7xl mx-auto px-4 lg:px-gutter mb-20">
<div class="flex items-center justify-between mb-6">
<div><span class="font-label-sm uppercase tracking-widest text-primary">Dokumentasi</span><h2 class="font-headline-md text-on-surface">Kegiatan Terbaru</h2></div>
</div>
<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
@forelse($activities as $act)
<div class="bg-surface-container-lowest rounded-xl overflow-hidden shadow-sm flex flex-col">
<div class="h-40 w-full bg-primary-container/20 flex items-center justify-center">
<span class="material-symbols-outlined text-[48px] text-outline">photo_camera</span>
</div>
<div class="p-4 flex flex-col flex-grow">
<span class="text-body-sm text-on-surface-variant mb-1">{{ $act->date_text }}</span>
<h3 class="font-headline-sm text-on-surface mb-2 text-[16px]">{{ $act->title }}</h3>
<p class="text-body-md text-on-surface-variant flex-grow">{{ Str::limit($act->description, 100) }}</p>
</div>
</div>
@empty
<div class="col-span-3 bg-surface-container-lowest p-8 rounded-xl text-center text-on-surface-variant">Belum ada data kegiatan.</div>
@endforelse
</div>
</section>
@endsection