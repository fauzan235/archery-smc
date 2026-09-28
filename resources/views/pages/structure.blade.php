@extends('layouts.app')
@section('title', 'Kepengurusan - SMECONE Archery Club')

@section('content')
<!-- Top Banner / Intro Header -->
<section class="relative bg-primary text-on-primary py-16 px-4 lg:px-gutter overflow-hidden">
<div class="absolute inset-0 opacity-10 bg-[radial-gradient(#b4efd6_1px,transparent_1px)] [background-size:16px_16px]"></div>
<div class="max-w-7xl mx-auto relative z-10 flex flex-col md:flex-row items-center justify-between gap-space-lg">
<div class="max-w-2xl">
<div class="inline-flex items-center gap-2 bg-primary-container text-on-primary-container px-3 py-1 rounded-full text-label-md mb-space-sm">
<span class="material-symbols-outlined text-[16px]">military_tech</span>
<span>Struktur Organisasi Resmi</span>
</div>
<h1 class="font-headline-lg text-headline-lg-mobile lg:text-headline-lg text-on-primary mb-space-sm">Kepengurusan SAC Periode 2024/2025</h1>
<p class="text-on-primary-container text-body-lg">Membangun kedisiplinan, fokus, dan prestasi tinggi melalui kepemimpinan yang solid di SMECONE Archery Club.</p>
</div>
<div class="flex gap-space-md">
<div class="bg-primary-container/40 backdrop-blur-md p-space-md rounded-xl text-center border border-inverse-primary/20">
<div class="font-headline-lg text-inverse-primary">19</div>
<div class="text-label-sm text-on-primary uppercase tracking-wider">Pengurus Inti & Divisi</div>
</div>
<div class="bg-primary-container/40 backdrop-blur-md p-space-md rounded-xl text-center border border-inverse-primary/20">
<div class="font-headline-lg text-inverse-primary">4</div>
<div class="text-label-sm text-on-primary uppercase tracking-wider">Departemen Utama</div>
</div>
</div>
</div>
</section>

<!-- Main Organizational Hierarchy Container -->
<section class="max-w-7xl mx-auto px-4 lg:px-gutter py-16 w-full">
<!-- 1. PEMBINA (Top Level) -->
<div class="flex flex-col items-center mb-16">
<div class="text-label-md text-primary tracking-widest uppercase mb-space-sm bg-primary-fixed px-4 py-1.5 rounded-full flex items-center gap-2">
<span class="material-symbols-outlined text-[16px]">verified</span> Pembina Klub
</div>
<div class="bg-surface-container-lowest p-space-lg rounded-xl shadow-[0_4px_20px_-2px_rgba(15,76,58,0.08)] text-center max-w-sm w-full transition-all hover:shadow-xl">
<div class="w-20 h-20 bg-primary-fixed-dim/30 rounded-xl mx-auto mb-space-md flex items-center justify-center text-primary">
<span class="material-symbols-outlined text-[36px]">school</span>
</div>
<h3 class="font-headline-sm text-on-surface mb-space-xs">Arief Ritade Aswas, S.Pd.I</h3>
<p class="text-body-sm text-on-surface-variant font-medium">Pembina SMECONE Archery Club</p>
</div>
<div class="w-0.5 h-12 bg-outline-variant/40 my-2"></div>
</div>

<!-- 2 & 3. KETUA & WAKIL KETUA (Executive Level) -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-3xl mx-auto mb-16 relative">
<div class="absolute inset-0 flex items-center justify-center pointer-events-none hidden md:flex">
<div class="w-8 h-8 rounded-full bg-primary-container text-on-primary-container flex items-center justify-center text-xs font-bold z-10 shadow-sm">&</div>
</div>
<!-- KETUA -->
<div class="bg-surface-container-lowest rounded-xl shadow-[0_4px_20px_-2px_rgba(15,76,58,0.08)] overflow-hidden flex flex-col group transition-all hover:shadow-xl">
<div class="relative w-full h-80 bg-surface-container overflow-hidden">
<img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="Ketua" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDRMjdfY3QaI66r-BNeM6sX2olDfOopSKfw92lSDcldzWCesset8gAw3G1yRqb8gxWcLYOkJUIr26bYQZVJ5uaGbjzNzr4dCCoRBooZ4BS4oyz_wVDyL4wPwqB8OqqrC0xx3QjYYPQ0r6KTk9IlICaZntV7ci7joPu8n32SAieUz7EFEemjhP1P4uPqdc2gkWW6k-9H_QlcGc-kU9l9G2gr_HzvqLYM9n_L7B2tcW-g8QCFayfAJFBF-wvKh3fHcT67rw">
<div class="absolute top-3 left-3 bg-primary text-on-primary px-3 py-1 rounded-full text-label-sm font-semibold shadow-md">KETUA</div>
</div>
<div class="p-space-lg text-center">
<h3 class="font-headline-sm text-on-surface mb-1">Bondan Pandu Hakim</h3>
<p class="text-body-sm text-on-surface-variant font-medium">Ketua Klub SAC</p>
</div>
</div>
<!-- WAKIL KETUA -->
<div class="bg-surface-container-lowest rounded-xl shadow-[0_4px_20px_-2px_rgba(15,76,58,0.08)] overflow-hidden flex flex-col group transition-all hover:shadow-xl">
<div class="relative w-full h-80 bg-surface-container overflow-hidden">
<img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="Wakil Ketua" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBPcpahERMXVOgWRQ00zsMIorAmv3y14WOPJxMB8NJuOa692fSpoNKLoyFUkag8daLcoF3VQtTM4KOJnifOM8VmnvongfcPGNFbifuusIDSyRRsy5gYbMC5wLRzRn82PxZHWpZGQwzgJT7NwoRItWBKLsnaP1VD5ebt5g9KgV8x4t23WHRWgb__MVrBEV1D-G4aylgUAnS6Q8OeSqmKIA5No9P7Yp-Wvj_RXG1eHNXNf-8A5aQobA2uFRtgZ82NBQZ0uw">
<div class="absolute top-3 left-3 bg-secondary text-on-secondary px-3 py-1 rounded-full text-label-sm font-semibold shadow-md">WAKIL KETUA</div>
</div>
<div class="p-space-lg text-center">
<h3 class="font-headline-sm text-on-surface mb-1">Sibli Irawan Al Kaafi</h3>
<p class="text-body-sm text-on-surface-variant font-medium">Wakil Ketua Klub SAC</p>
</div>
</div>
</div>

<div class="flex justify-center mb-12">
<div class="w-0.5 h-12 bg-outline-variant/40"></div>
</div>

<!-- 4 & 5. SEKRETARIS & BENDAHARA (Administrative Tier) -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-12 mb-20">
<!-- SEKRETARIS -->
<div class="bg-surface-container-low p-space-lg rounded-2xl shadow-sm">
<div class="flex items-center gap-3 mb-space-lg">
<div class="w-10 h-10 rounded-xl bg-primary-container text-on-primary-container flex items-center justify-center">
<span class="material-symbols-outlined text-[20px]">edit_note</span>
</div>
<div>
<h3 class="font-headline-sm text-on-surface">Sekretaris</h3>
<p class="text-body-sm text-on-surface-variant">Administrasi & Pencatatan Klub</p>
</div>
</div>
<div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
<div class="bg-surface-container-lowest rounded-xl p-3 shadow-sm flex flex-col">
<div class="w-full h-56 rounded-lg overflow-hidden mb-3 bg-surface-container">
<img class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuD6t4oupiit8O8ZTu06NpTjMQ2RnRSIMeOLd7zYGRt3OxICWRALwO8wAq_HnkvcnsXnLa8P4u2Xaugt4eDpnCSRWhOVeaI3xwOXzRUmFGE2FDsGOAnaGpROBp5nBvWt0G-Y-sVe9bXObwX2c_LRVbVEZ7n-SXpPaVroEI9HVVMPHzKIKL_y3JWtzwuHhC44K510FocNW-0MmjvrAQtAZ8GWrys-BQjD3fxjrHA9ABFd3FfUbvHgV3MCL-Vv0JN6vCR3Yg">
</div>
<h4 class="font-headline-sm text-sm text-on-surface mb-1">Indri Clarissa Candraningtyas</h4>
<span class="text-body-sm text-on-surface-variant">Sekretaris 1</span>
</div>
<div class="bg-surface-container-lowest rounded-xl p-3 shadow-sm flex flex-col">
<div class="w-full h-56 rounded-lg overflow-hidden mb-3 bg-surface-container">
<img class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCwmpiJmqIBNK7vdsGKN8L4EEK0zFtEo2yF0VBxxe6sAw5RwrzuFThbk-PkudEuQI9GY5gwOkpxMbAnR7LcM54tf5ibMb6qQdIZB9atxJO92kS50ej0pn-M0nBnJgrszskqzGO3hBuF37o6IERkwVm5erxfupJ3yhP0fCijfML7cdpDNhbh8DFC235G-2XYx3tbw8jAyI3JCTRkC-Js2s8VOuIG2rILSFlaUYoLN4YkEQdbYrliiG3mRB68N2kdiR-YZg">
</div>
<h4 class="font-headline-sm text-sm text-on-surface mb-1">Zhahira Aqila Qirania Wiseno</h4>
<span class="text-body-sm text-on-surface-variant">Sekretaris 2</span>
</div>
</div>
</div>
<!-- BENDAHARA -->
<div class="bg-surface-container-low p-space-lg rounded-2xl shadow-sm">
<div class="flex items-center gap-3 mb-space-lg">
<div class="w-10 h-10 rounded-xl bg-tertiary-fixed text-on-tertiary-fixed flex items-center justify-center">
<span class="material-symbols-outlined text-[20px]">payments</span>
</div>
<div>
<h3 class="font-headline-sm text-on-surface">Bendahara</h3>
<p class="text-body-sm text-on-surface-variant">Keuangan & Iuran Klub</p>
</div>
</div>
<div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
<div class="bg-surface-container-lowest rounded-xl p-3 shadow-sm flex flex-col">
<div class="w-full h-56 rounded-lg overflow-hidden mb-3 bg-surface-container">
<img class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBz_MC2Egi2-rMIyE7yDjR1pTVhBJTyXNc7ul1F4MOVjDJxVcXz2MkeB00_UE6Qid6zlfqOqwnl6ar_r5aJ5gP7YOXBZoVDsXpTYVB_je8mRQHNRCewZ6fdnnukBz1m8RpZ_SXm3U33VZ-YlZWpO7fFACi7WUNPcR6cq3S0GVf__VPhftI_IRG854VEfYj_lRMjrnIZYPe2c3FWGQLdpyb9ve_o3QNh_jdlX3bho20eDG0eyJc41IcG6F9zJ1Py8AkJPw">
</div>
<h4 class="font-headline-sm text-sm text-on-surface mb-1">Maulida Caesa Kananda</h4>
<span class="text-body-sm text-on-surface-variant">Bendahara 1</span>
</div>
<div class="bg-surface-container-lowest rounded-xl p-3 shadow-sm flex flex-col">
<div class="w-full h-56 rounded-lg overflow-hidden mb-3 bg-surface-container">
<img class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuA5gSLAzl9mtfyMrtb9qFvXA4qPzr929dHsjZ3lVSi8i_fuQ_2r3UIg9XZaeC1rBkus-2HCY6Ox3USapCog7bc-ATObnNVrQK6BBNYHs3KmIMcKOZFx6joIMDy6fv2BDvzu6VoO-7TMw4PcJiPqd_3vCTyWP1kWdpqEmYvwIBwlLDsKT35o5fSVUnCyHuMFu5dBAI3D-6_nhqiCwLbkgchU9RrjmdGfyR601mXM8LWm6W7bbkBnexrSmsY7twfo6hiMUA">
</div>
<h4 class="font-headline-sm text-sm text-on-surface mb-1">Keyzara Anandya Bilqis</h4>
<span class="text-body-sm text-on-surface-variant">Bendahara 2</span>
</div>
</div>
</div>
</div>

<!-- DIVISI / DEPARTEMEN SECTION -->
<div class="mb-8 text-center">
<div class="inline-flex items-center gap-2 bg-primary text-on-primary px-4 py-1.5 rounded-full text-label-md uppercase tracking-wider mb-2">
<span class="material-symbols-outlined text-[16px]">grid_view</span> Divisi & Departemen Operasional
</div>
<h2 class="font-headline-lg text-on-surface">Bidang Kerja Pengurus SAC</h2>
</div>
<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
<!-- 1. HUMAS -->
<div class="bg-surface-container-lowest p-space-lg rounded-2xl shadow-[0_4px_20px_-2px_rgba(15,76,58,0.08)]">
<div class="flex items-center justify-between mb-space-lg border-b border-surface-container pb-space-md">
<div class="flex items-center gap-3">
<div class="w-12 h-12 rounded-xl bg-primary text-on-primary flex items-center justify-center font-headline-sm">01</div>
<div>
<h3 class="font-headline-sm text-on-surface">Divisi Hubungan Masyarakat (Humas)</h3>
<p class="text-body-sm text-on-surface-variant">Komunikasi publik & relasi luar</p>
</div>
</div>
<span class="material-symbols-outlined text-primary text-[28px]">campaign</span>
</div>
<div class="space-y-4">
<div class="bg-primary-fixed/40 p-3 rounded-xl flex items-center gap-4">
<div class="w-16 h-16 rounded-lg bg-surface-container overflow-hidden shrink-0">
<div class="w-full h-full bg-primary flex items-center justify-center text-on-primary font-bold text-lg">NZ</div>
</div>
<div class="flex-1">
<div class="flex items-center gap-2 mb-1"><span class="bg-primary text-on-primary text-[10px] uppercase font-bold px-2 py-0.5 rounded-full tracking-wider">KOORDINATOR</span></div>
<h4 class="font-headline-sm text-sm text-on-surface">Nabila Zayyan Bassamah</h4>
</div>
</div>
<div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
<div class="bg-surface-container-low p-2 rounded-xl flex flex-col">
<div class="w-full h-40 rounded-lg overflow-hidden mb-2 bg-surface-container">
<img class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBc2FzlCHYY0TyGo5hMYOqhxv8D8jnphOXQzBnqmXLSrX6j2oEjk3vwV3UP3GtFAzmbrsQg_P2721n8gzFsTkueq_yK8W8suo6fZtEKd5OOt6_BFMEbblvkbiC1z_HHXW-w0N6-2luGIbrDG9C67CxsxUEMZop4cQEhERC5yZs98t8jFb4x38wdfcu9PqPnDYiPbGRv4xFVMJzajjz1shBAirOnGhBZqpax-cOD5fcePMZVO5Z3TMK9Oxya0UeMRFznCQ"></div>
<h5 class="font-semibold text-xs text-on-surface truncate">Innayatul Fitriyani</h5>
<span class="text-body-sm text-[10px] text-on-surface-variant">Anggota</span>
</div>
<div class="bg-surface-container-low p-2 rounded-xl flex flex-col">
<div class="w-full h-40 rounded-lg overflow-hidden mb-2 bg-surface-container">
<img class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDYukjzcFiXtkIZg-CIPgf1yqj1_F-ZKKVAecR_Lh7Qoi_OEG8lhXpmHy6zW-qsraGhoimU7TjzEIyf1JSFBw5ZHn4pXrZ1lAO-jWn7BS2Sia2zGOQ-UMbyl1bRBJL19f13c7O337371Tt4au4dqxaaTaD7_q7s_h4_MQ9FML0RMgBjNxOZ8bKHJ70tVI7sxbpHGaX4QNHiqHUxUOM1yESANEdd4nZbTepBvcTpX5iyg2f5eibCBirOucx6uL9oXHAACg"></div>
<h5 class="font-semibold text-xs text-on-surface truncate">Fairuz Aribah B. L.</h5>
<span class="text-body-sm text-[10px] text-on-surface-variant">Anggota</span>
</div>
<div class="bg-surface-container-low p-2 rounded-xl flex flex-col">
<div class="w-full h-40 rounded-lg overflow-hidden mb-2 bg-surface-container">
<img class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBKPAxNqXsZtgoDK-u2-FY5xxDRz6j3C-u782GJEH9tdYXxiQ8M6DMrlCvn44vAHmcOqLG6JiNT4TEbISBXNhWT3JuKa_yy4dOyjWuiE4Qc2PegXYKqnMLCgnYqr8iLZ6Y7ovE6Db-JTmmOnuXSNKN_uHIi3x5tEtpo6HC1_7bGx5LzcsC_hm5yZWnNNvxAwNl-ImnBUTub2cGKyMzHL1Upafh8LAzH4DaxhboVeFDuXaGzYZ2yhWdGnQvTVZVYpxsibw"></div>
<h5 class="font-semibold text-xs text-on-surface truncate">Fadiah Nida Naifah</h5>
<span class="text-body-sm text-[10px] text-on-surface-variant">Anggota</span>
</div>
</div>
</div>
</div>

<!-- 2. PERLENGKAPAN -->
<div class="bg-surface-container-lowest p-space-lg rounded-2xl shadow-[0_4px_20px_-2px_rgba(15,76,58,0.08)]">
<div class="flex items-center justify-between mb-space-lg border-b border-surface-container pb-space-md">
<div class="flex items-center gap-3">
<div class="w-12 h-12 rounded-xl bg-primary text-on-primary flex items-center justify-center font-headline-sm">02</div>
<div>
<h3 class="font-headline-sm text-on-surface">Divisi Perlengkapan</h3>
<p class="text-body-sm text-on-surface-variant">Manajemen alat panahan & inventaris</p>
</div>
</div>
<span class="material-symbols-outlined text-primary text-[28px]">handyman</span>
</div>
<div class="space-y-4">
<div class="bg-primary-fixed/40 p-3 rounded-xl flex items-center gap-4">
<div class="w-16 h-16 rounded-lg bg-surface-container overflow-hidden shrink-0 flex items-center justify-center bg-primary text-on-primary font-bold text-lg">FG</div>
<div class="flex-1">
<div class="flex items-center gap-2 mb-1"><span class="bg-primary text-on-primary text-[10px] uppercase font-bold px-2 py-0.5 rounded-full tracking-wider">KOORDINATOR</span></div>
<h4 class="font-headline-sm text-sm text-on-surface">Faiq Gusti Nurfatih</h4>
</div>
</div>
<div class="grid grid-cols-2 sm:grid-cols-4 gap-2">
<div class="bg-surface-container-low p-2 rounded-xl flex flex-col">
<div class="w-full h-32 rounded-lg overflow-hidden mb-2 bg-surface-container flex items-center justify-center text-xs text-center text-on-surface-variant"><span class="p-1">Ahmad Syihabullail</span></div>
<h5 class="font-semibold text-[11px] text-on-surface truncate">Ahmad Syihabullail</h5>
<span class="text-body-sm text-[10px] text-on-surface-variant">Anggota</span>
</div>
<div class="bg-surface-container-low p-2 rounded-xl flex flex-col">
<div class="w-full h-32 rounded-lg overflow-hidden mb-2 bg-surface-container">
<img class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBkkemQBBzzXHdGszyekozoIjSQ82uejcdAaBRw6Uw39qsJ-ha2p86NNjg-42cI1GpU0WK86LaUbcXwOGwZDkB0_PQOonDfbCm5l1bX9JV0hdSCROQVQCI7-QDQhHorQQjeEFaC5yotPGk0hKPETQU9tQ5nvLMTefnSs0PCisfAeRwJySakSP65ohdyp3ue3673lEqkbXwYI-1xwgwiBGn5WctEyXcG7wz4gvzUrGP2lmJ8SzEVbScmkGjFx1mIjseVpA"></div>
<h5 class="font-semibold text-[11px] text-on-surface truncate">Kening Galih B.</h5>
<span class="text-body-sm text-[10px] text-on-surface-variant">Anggota</span>
</div>
<div class="bg-surface-container-low p-2 rounded-xl flex flex-col">
<div class="w-full h-32 rounded-lg overflow-hidden mb-2 bg-surface-container">
<img class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuASBA3wEhFw7k0SsYMQPDNWz7LW_CoHvixJGXe4okDNMIarhkEE14LJyxHf8RVw4Hw1ukdTg0t7_Uqt-k5Re2hdJeyRcvHQoDdPnGOyZ0ruvQSpi2HRaUZd61tO417-oPSyZdhdaJT0AHXtA1eNVZJHZTJ0OtA_f3TlhWeTBNNApAK1oqC8vH8XFQWmqkadShKh76p0Ms9KI8n-KxyJn7k4__FfDzDfa_OSUoL7PyoXvIYEZnvupOfFU8tOh1pPEbVoEQ"></div>
<h5 class="font-semibold text-[11px] text-on-surface truncate">Yanuar Rizki D. D.</h5>
<span class="text-body-sm text-[10px] text-on-surface-variant">Anggota</span>
</div>
<div class="bg-surface-container-low p-2 rounded-xl flex flex-col">
<div class="w-full h-32 rounded-lg overflow-hidden mb-2 bg-surface-container">
<img class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBwn3crGkKi8gxDfRjb52L0BOl4w5qGcrNkY0VbIJavCiwfQ6LVIXL2v9hlKOqk3Yz0EUiNyikw2FuJZz8mRgRGgSA9VVFLw-2QkrinbfnZU-h56t42uHidOhY5hmluKq4eR2PfYG8lqI2tBjiZ6BQWO-bdsZw4q9ZRGTds0WzlbqTv9IyyZVq3iRaWa7LPAAEPedUAx4y_SPIb28ey9h6Uq5isgcdTJoLbQp_wu9zs3dIzmZBFIcYg4ozm0tiXMKYCEQ"></div>
<h5 class="font-semibold text-[11px] text-on-surface truncate">Kenza El Ilmy M. A.</h5>
<span class="text-body-sm text-[10px] text-on-surface-variant">Anggota</span>
</div>
</div>
</div>
</div>

<!-- 3. OLAHRAGA -->
<div class="bg-surface-container-lowest p-space-lg rounded-2xl shadow-[0_4px_20px_-2px_rgba(15,76,58,0.08)]">
<div class="flex items-center justify-between mb-space-lg border-b border-surface-container pb-space-md">
<div class="flex items-center gap-3">
<div class="w-12 h-12 rounded-xl bg-primary text-on-primary flex items-center justify-center font-headline-sm">03</div>
<div>
<h3 class="font-headline-sm text-on-surface">Divisi Olahraga & Latihan</h3>
<p class="text-body-sm text-on-surface-variant">Program latihan, teknik & kompetisi</p>
</div>
</div>
<span class="material-symbols-outlined text-primary text-[28px]">sports_score</span>
</div>
<div class="space-y-4">
<div class="bg-primary-fixed/40 p-3 rounded-xl flex items-center gap-4">
<div class="w-16 h-16 rounded-lg bg-surface-container overflow-hidden shrink-0">
<img class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAEgELTsgAc9W_hAKB6AIQx3E_CKnbSbZ8u1iO3_pkEZPTPZIZgLOxreirUGHqFkGquAXyck6GCvuKHAujQP4qrGPsnR1QheqB27Viu3JIwVFCGa0iEt_om9cfsaeDVssLjSEOcsv4HHZbQLWxuLt6EC77fp9Rrk7nnFYTmmiJCtOHECtd-qCKsX52JTlGBWCJKKQ9ahG_rDIOZ-MUn5CUNA_PSJDKhSeNcoWT3yK3m9rPyCGpQXSaJDIUqNKqUTTOqaw"></div>
<div class="flex-1">
<div class="flex items-center gap-2 mb-1"><span class="bg-primary text-on-primary text-[10px] uppercase font-bold px-2 py-0.5 rounded-full tracking-wider">KOORDINATOR</span></div>
<h4 class="font-headline-sm text-sm text-on-surface">Juniar Eris Saputra</h4>
</div>
</div>
<div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
<div class="bg-surface-container-low p-2 rounded-xl flex flex-col">
<div class="w-full h-40 rounded-lg overflow-hidden mb-2 bg-surface-container">
<img class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBllAPJMxCFdDoVxnsKu-NgpMQbnKe1JBpU6q46qMAj_kF9mGI8DWqSYW4mJponIWPLOfBqhZOz1dS82xK5TTcBQdphqQmdZ02wMnjwD9ON6QjZIGlaBHcgNYhomygeDKDQLNMio8FdHVI6DBQleO8eNdBhU5u_y_oWC7rtU52-sPlT-JLRvjfqhIJcA-SrWwJPm44Ke2Z83JPvkuQMgasdeUiWf_qQHwjS7PO2aI9FtZpTHL_XWU6a1hVZ9MxfwCX69A"></div>
<h5 class="font-semibold text-xs text-on-surface truncate">Kirey Aulia Putri</h5>
<span class="text-body-sm text-[10px] text-on-surface-variant">Anggota</span>
</div>
<div class="bg-surface-container-low p-2 rounded-xl flex flex-col">
<div class="w-full h-40 rounded-lg overflow-hidden mb-2 bg-surface-container flex items-center justify-center text-xs text-center text-on-surface-variant"><span class="p-1">Kirania Nadjwa</span></div>
<h5 class="font-semibold text-xs text-on-surface truncate">Kirania Nadjwa I.</h5>
<span class="text-body-sm text-[10px] text-on-surface-variant">Anggota</span>
</div>
<div class="bg-surface-container-low p-2 rounded-xl flex flex-col">
<div class="w-full h-40 rounded-lg overflow-hidden mb-2 bg-surface-container">
<img class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCUEqaRsgj8rVfS5iQsyN5JDznytPwtVjOhR-VPrnNmqd1ugR2PqYDhKkfewC4VaPkBAm1iIit1t-BmDCVRJKjmD7CgSQuhMTJNLzHY4pL-nFQj6SoFvL7fSHXcx527XqpIdW1wKATML1mGAG1hX0ntBWl1vrc_aeHu9-qf-4Pe6Nnb3hljGt99L-ROhDqGLIFmv3PuGfvBFCT6xMgzNyrfsMBCwDbcplx8Z3YB7xXotK9Yv2oWEt8sL19AJlJjmVk1dA"></div>
<h5 class="font-semibold text-xs text-on-surface truncate">Nathan Adirama W.</h5>
<span class="text-body-sm text-[10px] text-on-surface-variant">Anggota</span>
</div>
</div>
</div>
</div>

<!-- 4. DOKUMENTASI -->
<div class="bg-surface-container-lowest p-space-lg rounded-2xl shadow-[0_4px_20px_-2px_rgba(15,76,58,0.08)]">
<div class="flex items-center justify-between mb-space-lg border-b border-surface-container pb-space-md">
<div class="flex items-center gap-3">
<div class="w-12 h-12 rounded-xl bg-primary text-on-primary flex items-center justify-center font-headline-sm">04</div>
<div>
<h3 class="font-headline-sm text-on-surface">Divisi Dokumentasi & Media</h3>
<p class="text-body-sm text-on-surface-variant">Publikasi visual, foto & rekaman kegiatan</p>
</div>
</div>
<span class="material-symbols-outlined text-primary text-[28px]">photo_camera</span>
</div>
<div class="space-y-4">
<div class="bg-primary-fixed/40 p-3 rounded-xl flex items-center gap-4">
<div class="w-16 h-16 rounded-lg bg-surface-container overflow-hidden shrink-0">
<img class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAW0Nsv6Rtha7AyPBeqAhSoHN4xVY5fNkxwAVihVMosUOG3xw8WFc9t_NbUgBrwecMk44k4QvgcWwPw8wDEpIv4oGgM-j8BByQSEkvpM507_MwwQxRwR3i5cEb_m0xodzLldMserNNrHMIXnV805kzPIwNEg4ORYTSZ5QnSA1Kf6RL_FBqwvqqjnZPr4B91OP172Vq1p4Ax8FAOcD064kBlk4y05tmivJp5S_cVCItbeR3u3wDqJPWQlcBE4GnTGmiP4Q"></div>
<div class="flex-1">
<div class="flex items-center gap-2 mb-1"><span class="bg-primary text-on-primary text-[10px] uppercase font-bold px-2 py-0.5 rounded-full tracking-wider">KOORDINATOR</span></div>
<h4 class="font-headline-sm text-sm text-on-surface">Muhammad Raynar Satya W.</h4>
</div>
</div>
<div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
<div class="bg-surface-container-low p-2 rounded-xl flex flex-col">
<div class="w-full h-40 rounded-lg overflow-hidden mb-2 bg-surface-container">
<img class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuB4JoKnsvuGCbGWvQ4eoPc7UZPV4Z7STyeqaubIb2lTPhgINqyttzbiR11GdfWIhTUp1inW3JNwsuoCeHGEfsDi1LQuCHTvHKkt8RKxuDEJSH3tlb_yhU4mmQ0Ui7YPJkI61gbFM_DX2VLcMkJuiDuH6ipKQKdNG1HML374mtf797UFi6pYMc3fhTS8W-YdXCS7seh_3OHNr1zk6fnVMGpFeOYBEL2-PLc6We7hTh52gykfwFTGG5V-AEP8SO71MmV27g"></div>
<h5 class="font-semibold text-xs text-on-surface truncate">Nur Aisya Khofi Rafida</h5>
<span class="text-body-sm text-[10px] text-on-surface-variant">Anggota</span>
</div>
<div class="bg-surface-container-low p-2 rounded-xl flex flex-col">
<div class="w-full h-40 rounded-lg overflow-hidden mb-2 bg-surface-container">
<img class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuC0M0Ovyp1QWCzs9K8NtcpJPOSutSyrSImnZURtwfBJQVeyXOz5P46fY7hNW6KHrtDZOe7cI0J4gYz55ZgHlG3j6woaDX6FjxdC8Z3Qa1uuq7fDjuwJ2ycasqkHRcJz_qKD4FmPLoI20juU-GWKM2UqE9wZ_YagZpY_Qvj6dF5ophonXoct5ZjW2poztfBDnMvXj1EhK6sLSdeHvY5N2EtXF2ppwkcKjpQ1YQs_VuFSXZCFc8VULrjUCcmP82uJrlGX8A"></div>
<h5 class="font-semibold text-xs text-on-surface truncate">Aisha Palupi Narewari</h5>
<span class="text-body-sm text-[10px] text-on-surface-variant">Anggota</span>
</div>
</div>
</div>
</div>
</div>
</section>
@endsection