@extends('layouts.app')
@section('title', 'Absensi - SMECONE Archery Club')

@section('content')
<!-- Header -->
<section class="w-full bg-primary text-on-primary py-10 px-4 lg:px-gutter relative overflow-hidden">
<div class="absolute inset-0 bg-gradient-to-br from-primary via-primary-container to-primary opacity-30"></div>
<div class="max-w-7xl mx-auto relative z-10 flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
<div>
<span class="px-3 py-1 bg-primary-container text-on-primary-container rounded-full font-label-md text-[11px] mb-2 inline-block">Portal Kehadiran</span>
<h1 class="font-headline-lg text-headline-lg-mobile lg:text-headline-lg text-white">Absensi Latihan</h1>
<p class="text-body-md text-primary-fixed-dim mt-1">Rekap kehadiran anggota SMECONE Archery Club</p>
</div>
<div class="flex items-center gap-2">
@if(auth()->user()->isAdmin())
<button class="bg-surface text-primary px-4 py-2.5 rounded-lg font-label-lg hover:bg-surface-container transition-all shadow-lg flex items-center gap-2 flex-shrink-0" onclick="openModal('addAttendanceModal')">
<span class="material-symbols-outlined text-[18px]">add_task</span><span>Catat Absensi</span>
</button>
<a href="{{ route('attendances.export', ['date' => $selectedDate]) }}" class="bg-primary-container text-on-primary-container px-4 py-2.5 rounded-lg font-label-lg hover:opacity-90 transition-all flex items-center gap-2">
<span class="material-symbols-outlined text-[18px]">download</span><span class="hidden sm:inline">Export</span>
</a>
@endif
</div>
</div>
</section>

<!-- Date Picker & Stats -->
<section class="max-w-7xl mx-auto px-4 lg:px-gutter w-full -mt-6 mb-6 z-10 relative">
<div class="grid grid-cols-1 md:grid-cols-5 gap-3">
<div class="bg-surface-container-lowest p-3 rounded-xl shadow-sm flex items-center gap-3 md:col-span-1">
<form method="GET" action="{{ route('attendances.index') }}" class="w-full">
<label class="block text-[10px] text-on-surface-variant font-label-md uppercase mb-1">Tanggal</label>
<input type="date" name="date" value="{{ $selectedDate }}" onchange="this.form.submit()" class="w-full px-3 py-2 bg-surface-container-low rounded-lg text-body-md focus:outline-none focus:ring-2 focus:ring-primary">
</form>
</div>
@php $statCards = [
  ['label'=>'Hadir','val'=>$hadirCount,'icon'=>'check_circle','color'=>'text-primary'],
  ['label'=>'Izin','val'=>$izinCount,'icon'=>'info','color'=>'text-tertiary'],
  ['label'=>'Sakit','val'=>$sakitCount,'icon'=>'healing','color'=>'text-secondary'],
  ['label'=>'Alpha','val'=>$alphaCount,'icon'=>'cancel','color'=>'text-error'],
]; @endphp
@foreach($statCards as $sc)
<div class="bg-surface-container-lowest p-3 rounded-xl shadow-sm flex items-center justify-between">
<div><span class="text-[10px] text-on-surface-variant font-label-md uppercase">{{ $sc['label'] }}</span><h3 class="font-headline-md {{ $sc['color'] }}">{{ $sc['val'] }}</h3></div>
<span class="material-symbols-outlined text-[24px] {{ $sc['color'] }}" style="font-variation-settings:'FILL' 1">{{ $sc['icon'] }}</span>
</div>
@endforeach
</div>
</section>

<!-- Attendance Table -->
<section class="max-w-7xl mx-auto px-4 lg:px-gutter w-full mb-8">
<div class="bg-surface-container-lowest rounded-xl shadow-sm overflow-hidden">
<div class="overflow-x-auto">
<table class="w-full text-left border-collapse min-w-[600px]">
<thead>
<tr class="bg-primary text-on-primary">
<th class="py-3 px-4 text-label-md uppercase w-12 text-center">No</th>
<th class="py-3 px-4 text-label-md uppercase">Nama</th>
<th class="py-3 px-4 text-label-md uppercase">Kelas</th>
<th class="py-3 px-4 text-label-md uppercase text-center">Status</th>
<th class="py-3 px-4 text-label-md uppercase">Waktu</th>
<th class="py-3 px-4 text-label-md uppercase">Keterangan</th>
@if(auth()->user()->isAdmin())<th class="py-3 px-4 text-label-md uppercase text-right">Aksi</th>@endif
</tr>
</thead>
<tbody class="divide-y divide-outline-variant/10">
@forelse($attendances as $i => $att)
<tr class="hover:bg-surface-container-low/50 transition-colors">
<td class="py-3 px-4 text-center text-body-md text-on-surface-variant font-semibold">{{ $i+1 }}.</td>
<td class="py-3 px-4">
<div class="flex items-center gap-3">
<div class="w-9 h-9 rounded-full bg-gradient-to-br from-surface-container-high to-outline-variant/30 flex items-center justify-center flex-shrink-0">
<span class="material-symbols-outlined text-[20px] text-outline" style="font-variation-settings:'FILL' 1">person</span>
</div>
<div><div class="font-semibold text-on-surface text-body-md">{{ $att->member->name ?? '-' }}</div>
<div class="text-body-sm text-on-surface-variant">{{ $att->member->member_code ?? '-' }}</div></div>
</div>
</td>
<td class="py-3 px-4 text-on-surface-variant text-body-md">{{ $att->member->class ?? '-' }}</td>
<td class="py-3 px-4 text-center">
@php $statusColors = ['hadir'=>'bg-primary/10 text-primary','izin'=>'bg-tertiary-container text-tertiary','sakit'=>'bg-secondary-container text-secondary','alpha'=>'bg-error-container text-error']; @endphp
<span class="px-2.5 py-1 rounded-full text-label-sm font-semibold uppercase {{ $statusColors[$att->status] ?? 'bg-surface-container text-on-surface-variant' }}">{{ $att->status }}</span>
</td>
<td class="py-3 px-4 text-body-sm text-on-surface-variant">{{ $att->time ?? '-' }}</td>
<td class="py-3 px-4 text-body-sm text-on-surface-variant max-w-[200px] truncate">{{ $att->notes ?? '-' }}</td>
@if(auth()->user()->isAdmin())
<td class="py-3 px-4 text-right">
<form method="POST" action="{{ route('attendances.destroy', $att) }}" onsubmit="return confirm('Hapus data absensi ini?')" class="inline">@csrf @method('DELETE')
<button type="submit" class="p-1.5 rounded-lg bg-error-container text-on-error-container hover:bg-error hover:text-on-error transition-all"><span class="material-symbols-outlined text-[16px]">delete</span></button>
</form>
</td>
@endif
</tr>
@empty
<tr><td colspan="{{ auth()->user()->isAdmin() ? 7 : 6 }}" class="py-12 text-center text-on-surface-variant">
<div class="flex flex-col items-center gap-3"><div class="w-16 h-16 rounded-full bg-surface-container flex items-center justify-center"><span class="material-symbols-outlined text-[32px] text-outline">event_busy</span></div>
<p class="font-headline-sm text-on-surface">Belum ada data absensi untuk tanggal ini</p></div>
</td></tr>
@endforelse
</tbody>
</table>
</div>
<div class="px-4 py-3 bg-surface-container-low/50 border-t border-outline-variant/10 text-body-sm text-on-surface-variant flex justify-between">
<span>Tanggal: <span class="font-semibold text-on-surface">{{ \Carbon\Carbon::parse($selectedDate)->translatedFormat('d F Y') }}</span></span>
<span>Tingkat Kehadiran: <span class="font-semibold text-primary">{{ $rate }}%</span></span>
</div>
</div>
</section>

{{-- Add Attendance Modal (Admin Only) --}}
@if(auth()->user()->isAdmin())
<div class="fixed inset-0 z-50 bg-inverse-surface/40 backdrop-blur-sm hidden items-center justify-center p-4" id="addAttendanceModal">
<div class="bg-surface-container-lowest w-full max-w-lg rounded-2xl p-6 shadow-2xl max-h-[90vh] overflow-y-auto">
<div class="flex items-center justify-between mb-4"><h3 class="font-headline-md text-primary">Catat Kehadiran</h3>
<button class="p-1 rounded-full hover:bg-surface-container" onclick="closeModal('addAttendanceModal')"><span class="material-symbols-outlined">close</span></button></div>
<form method="POST" action="{{ route('attendances.store') }}" class="space-y-4">@csrf
<div><label class="block text-label-md text-on-surface-variant mb-1">Anggota *</label>
<select name="member_id" required class="w-full px-4 py-2.5 bg-surface-container-low rounded-lg text-body-md focus:outline-none focus:ring-2 focus:ring-primary">
<option value="">-- Pilih Anggota --</option>
@foreach($activeMembers as $am)<option value="{{ $am->id }}">{{ $am->name }} ({{ $am->class }})</option>@endforeach
</select></div>
<div class="grid grid-cols-2 gap-3">
<div><label class="block text-label-md text-on-surface-variant mb-1">Tanggal *</label>
<input type="date" name="date" value="{{ $selectedDate }}" required class="w-full px-4 py-2.5 bg-surface-container-low rounded-lg text-body-md focus:outline-none focus:ring-2 focus:ring-primary"></div>
<div><label class="block text-label-md text-on-surface-variant mb-1">Status *</label>
<select name="status" required class="w-full px-4 py-2.5 bg-surface-container-low rounded-lg text-body-md focus:outline-none focus:ring-2 focus:ring-primary">
<option value="hadir">Hadir</option><option value="izin">Izin</option><option value="sakit">Sakit</option><option value="alpha">Alpha</option>
</select></div>
</div>
<div><label class="block text-label-md text-on-surface-variant mb-1">Keterangan</label>
<textarea name="notes" rows="2" class="w-full px-4 py-2.5 bg-surface-container-low rounded-lg text-body-md focus:outline-none focus:ring-2 focus:ring-primary" placeholder="Opsional"></textarea></div>
<div class="flex justify-end gap-2 pt-2">
<button type="button" class="px-5 py-2.5 rounded-lg bg-surface-container text-on-surface font-label-lg" onclick="closeModal('addAttendanceModal')">Batal</button>
<button type="submit" class="px-5 py-2.5 rounded-lg bg-primary text-on-primary font-label-lg">Simpan</button>
</div>
</form>
</div>
</div>
@endif
@endsection

@push('scripts')
<script>
function openModal(id){document.getElementById(id).classList.remove('hidden');document.getElementById(id).classList.add('flex')}
function closeModal(id){document.getElementById(id).classList.remove('flex');document.getElementById(id).classList.add('hidden')}
</script>
@endpush