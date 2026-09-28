@extends('layouts.app')
@section('title', 'Jadwal Latihan - SMECONE Archery Club')

@section('content')
<section class="w-full bg-primary text-on-primary py-10 px-4 lg:px-gutter relative overflow-hidden">
<div class="absolute inset-0 bg-gradient-to-br from-primary via-primary-container to-primary opacity-30"></div>
<div class="max-w-7xl mx-auto relative z-10 flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
<div>
<span class="px-3 py-1 bg-primary-container text-on-primary-container rounded-full font-label-md text-[11px] mb-2 inline-block">Agenda Klub</span>
<h1 class="font-headline-lg text-headline-lg-mobile lg:text-headline-lg text-white">Jadwal Latihan</h1>
<p class="text-body-md text-primary-fixed-dim mt-1">Jadwal kegiatan rutin SMECONE Archery Club</p>
</div>
@if(auth()->user()->isAdmin())
<button class="bg-surface text-primary px-4 py-2.5 rounded-lg font-label-lg shadow-lg flex items-center gap-2" onclick="openModal('addScheduleModal')">
<span class="material-symbols-outlined text-[18px]">event_note</span><span>Tambah Jadwal</span>
</button>
@endif
</div>
</section>

<!-- Filter -->
<section class="max-w-7xl mx-auto px-4 lg:px-gutter w-full -mt-6 mb-8 z-10 relative">
<div class="bg-surface-container-lowest p-3 rounded-xl shadow-sm inline-flex">
<form method="GET" action="{{ route('schedules.index') }}" class="flex gap-2">
<select name="category" onchange="this.form.submit()" class="bg-surface-container-low px-3 py-2 rounded-lg text-body-sm focus:outline-none focus:ring-2 focus:ring-primary min-w-[200px]">
<option value="all" {{ request('category')==='all' ? 'selected' : '' }}>Semua Kategori</option>
<option value="recurve" {{ request('category')==='recurve' ? 'selected' : '' }}>Recurve / Nasional</option>
<option value="compound" {{ request('category')==='compound' ? 'selected' : '' }}>Compound & Barebow</option>
</select>
</form>
</div>
</section>

<!-- Schedule List -->
<section class="max-w-7xl mx-auto px-4 lg:px-gutter w-full mb-12">
<div class="flex flex-col gap-4">
@forelse($schedules as $sched)
<div class="bg-surface-container-lowest p-5 rounded-xl shadow-sm flex flex-col md:flex-row gap-5 items-start md:items-center justify-between">
<div class="flex gap-4 items-start">
<div class="w-16 h-16 rounded-xl {{ \Carbon\Carbon::parse($sched->date)->isPast() ? 'bg-surface-container text-on-surface-variant' : 'bg-primary text-on-primary' }} flex flex-col items-center justify-center flex-shrink-0">
<span class="font-label-md uppercase text-[11px]">{{ $sched->day_code }}</span>
<span class="font-headline-md leading-none">{{ $sched->date_num }}</span>
</div>
<div>
<div class="flex flex-wrap items-center gap-2 mb-2">
<span class="px-2.5 py-1 rounded-md bg-primary-container text-on-primary-container font-label-sm uppercase tracking-wider text-[10px]">{{ $sched->category_label }}</span>
<span class="text-body-sm text-primary font-semibold flex items-center gap-1"><span class="material-symbols-outlined text-[14px]">schedule</span>{{ $sched->time }}</span>
</div>
<h3 class="font-headline-sm text-on-surface text-[18px] mb-1">{{ $sched->title }}</h3>
<p class="text-body-md text-on-surface-variant mb-2">{{ $sched->description }}</p>
<div class="flex flex-wrap items-center gap-4 text-body-sm text-on-surface-variant">
<span class="flex items-center gap-1.5"><span class="material-symbols-outlined text-[16px]">location_on</span>{{ $sched->location }}</span>
<span class="flex items-center gap-1.5"><span class="material-symbols-outlined text-[16px]">sports</span>Coach: {{ $sched->coach }}</span>
</div>
</div>
</div>
@if(auth()->user()->isAdmin())
<div class="flex flex-row md:flex-col gap-2 mt-4 md:mt-0 w-full md:w-auto self-end md:self-auto">
<button class="flex-1 md:flex-none px-4 py-2 rounded-lg bg-surface-container-low hover:bg-surface-container text-on-surface font-label-md transition-all flex justify-center items-center gap-1.5" onclick="openEditModal({{ $sched->id }},'{{ addslashes($sched->title) }}','{{ $sched->date }}','{{ $sched->time }}','{{ $sched->category }}','{{ addslashes($sched->location) }}','{{ addslashes($sched->coach) }}','{{ addslashes($sched->description) }}')">
<span class="material-symbols-outlined text-[16px]">edit</span> Edit
</button>
<form method="POST" action="{{ route('schedules.destroy', $sched) }}" onsubmit="return confirm('Hapus jadwal ini?')" class="flex-1 md:flex-none flex">@csrf @method('DELETE')
<button type="submit" class="w-full px-4 py-2 rounded-lg bg-error-container/50 text-error hover:bg-error hover:text-on-error font-label-md transition-all flex justify-center items-center gap-1.5">
<span class="material-symbols-outlined text-[16px]">delete</span> Hapus
</button>
</form>
</div>
@endif
</div>
@empty
<div class="bg-surface-container-lowest p-12 rounded-xl text-center text-on-surface-variant flex flex-col items-center gap-3">
<div class="w-16 h-16 rounded-full bg-surface-container flex items-center justify-center"><span class="material-symbols-outlined text-[32px] text-outline">event_busy</span></div>
<p class="font-headline-sm text-on-surface">Belum ada jadwal latihan</p>
</div>
@endforelse
</div>
</section>

@if(auth()->user()->isAdmin())
<!-- Add Modal -->
<div class="fixed inset-0 z-50 bg-inverse-surface/40 backdrop-blur-sm hidden items-center justify-center p-4" id="addScheduleModal">
<div class="bg-surface-container-lowest w-full max-w-lg rounded-2xl p-6 shadow-2xl max-h-[90vh] overflow-y-auto">
<div class="flex items-center justify-between mb-4"><h3 class="font-headline-md text-primary">Tambah Jadwal Baru</h3>
<button class="p-1 rounded-full hover:bg-surface-container" onclick="closeModal('addScheduleModal')"><span class="material-symbols-outlined">close</span></button></div>
<form method="POST" action="{{ route('schedules.store') }}" class="space-y-4">@csrf
<div><label class="block text-label-md text-on-surface-variant mb-1">Materi / Judul Latihan *</label>
<input name="title" required class="w-full px-4 py-2.5 bg-surface-container-low rounded-lg text-body-md focus:outline-none focus:ring-2 focus:ring-primary"></div>
<div class="grid grid-cols-2 gap-3">
<div><label class="block text-label-md text-on-surface-variant mb-1">Tanggal *</label>
<input type="date" name="date" required class="w-full px-4 py-2.5 bg-surface-container-low rounded-lg text-body-md focus:outline-none focus:ring-2 focus:ring-primary"></div>
<div><label class="block text-label-md text-on-surface-variant mb-1">Waktu *</label>
<input name="time" placeholder="15:30 - 17:30 WIB" required class="w-full px-4 py-2.5 bg-surface-container-low rounded-lg text-body-md focus:outline-none focus:ring-2 focus:ring-primary"></div>
</div>
<div class="grid grid-cols-2 gap-3">
<div><label class="block text-label-md text-on-surface-variant mb-1">Kategori *</label>
<select name="category" required class="w-full px-4 py-2.5 bg-surface-container-low rounded-lg text-body-md focus:outline-none focus:ring-2 focus:ring-primary">
<option value="all">Semua Kategori</option><option value="recurve">Recurve / Nasional</option><option value="compound">Compound & Barebow</option></select></div>
<div><label class="block text-label-md text-on-surface-variant mb-1">Coach *</label>
<input name="coach" required value="Coach Arief Ritade" class="w-full px-4 py-2.5 bg-surface-container-low rounded-lg text-body-md focus:outline-none focus:ring-2 focus:ring-primary"></div>
</div>
<div><label class="block text-label-md text-on-surface-variant mb-1">Lokasi *</label>
<input name="location" required value="Lapangan Utama SMKN 1 Purwokerto" class="w-full px-4 py-2.5 bg-surface-container-low rounded-lg text-body-md focus:outline-none focus:ring-2 focus:ring-primary"></div>
<div><label class="block text-label-md text-on-surface-variant mb-1">Keterangan / Fokus Latihan</label>
<textarea name="description" rows="2" class="w-full px-4 py-2.5 bg-surface-container-low rounded-lg text-body-md focus:outline-none focus:ring-2 focus:ring-primary"></textarea></div>
<div class="flex justify-end gap-2 pt-2">
<button type="button" class="px-5 py-2.5 rounded-lg bg-surface-container text-on-surface font-label-lg" onclick="closeModal('addScheduleModal')">Batal</button>
<button type="submit" class="px-5 py-2.5 rounded-lg bg-primary text-on-primary font-label-lg">Simpan</button>
</div>
</form></div></div>

<!-- Edit Modal -->
<div class="fixed inset-0 z-50 bg-inverse-surface/40 backdrop-blur-sm hidden items-center justify-center p-4" id="editScheduleModal">
<div class="bg-surface-container-lowest w-full max-w-lg rounded-2xl p-6 shadow-2xl max-h-[90vh] overflow-y-auto">
<div class="flex items-center justify-between mb-4"><h3 class="font-headline-md text-primary">Edit Jadwal</h3>
<button class="p-1 rounded-full hover:bg-surface-container" onclick="closeModal('editScheduleModal')"><span class="material-symbols-outlined">close</span></button></div>
<form id="editForm" method="POST" class="space-y-4">@csrf @method('PUT')
<div><label class="block text-label-md text-on-surface-variant mb-1">Materi / Judul Latihan *</label>
<input id="editTitle" name="title" required class="w-full px-4 py-2.5 bg-surface-container-low rounded-lg text-body-md focus:outline-none focus:ring-2 focus:ring-primary"></div>
<div class="grid grid-cols-2 gap-3">
<div><label class="block text-label-md text-on-surface-variant mb-1">Tanggal *</label>
<input id="editDate" type="date" name="date" required class="w-full px-4 py-2.5 bg-surface-container-low rounded-lg text-body-md focus:outline-none focus:ring-2 focus:ring-primary"></div>
<div><label class="block text-label-md text-on-surface-variant mb-1">Waktu *</label>
<input id="editTime" name="time" required class="w-full px-4 py-2.5 bg-surface-container-low rounded-lg text-body-md focus:outline-none focus:ring-2 focus:ring-primary"></div>
</div>
<div class="grid grid-cols-2 gap-3">
<div><label class="block text-label-md text-on-surface-variant mb-1">Kategori *</label>
<select id="editCategory" name="category" required class="w-full px-4 py-2.5 bg-surface-container-low rounded-lg text-body-md focus:outline-none focus:ring-2 focus:ring-primary">
<option value="all">Semua Kategori</option><option value="recurve">Recurve / Nasional</option><option value="compound">Compound & Barebow</option></select></div>
<div><label class="block text-label-md text-on-surface-variant mb-1">Coach *</label>
<input id="editCoach" name="coach" required class="w-full px-4 py-2.5 bg-surface-container-low rounded-lg text-body-md focus:outline-none focus:ring-2 focus:ring-primary"></div>
</div>
<div><label class="block text-label-md text-on-surface-variant mb-1">Lokasi *</label>
<input id="editLocation" name="location" required class="w-full px-4 py-2.5 bg-surface-container-low rounded-lg text-body-md focus:outline-none focus:ring-2 focus:ring-primary"></div>
<div><label class="block text-label-md text-on-surface-variant mb-1">Keterangan / Fokus Latihan</label>
<textarea id="editDescription" name="description" rows="2" class="w-full px-4 py-2.5 bg-surface-container-low rounded-lg text-body-md focus:outline-none focus:ring-2 focus:ring-primary"></textarea></div>
<div class="flex justify-end gap-2 pt-2">
<button type="button" class="px-5 py-2.5 rounded-lg bg-surface-container text-on-surface font-label-lg" onclick="closeModal('editScheduleModal')">Batal</button>
<button type="submit" class="px-5 py-2.5 rounded-lg bg-primary text-on-primary font-label-lg">Perbarui</button>
</div>
</form></div></div>
@endif
@endsection

@push('scripts')
<script>
function openModal(id){document.getElementById(id).classList.remove('hidden');document.getElementById(id).classList.add('flex')}
function closeModal(id){document.getElementById(id).classList.remove('flex');document.getElementById(id).classList.add('hidden')}
function openEditModal(id,title,date,time,cat,loc,coach,desc){
  document.getElementById('editForm').action='/jadwal/'+id;
  document.getElementById('editTitle').value=title;
  document.getElementById('editDate').value=date;
  document.getElementById('editTime').value=time;
  document.getElementById('editCategory').value=cat;
  document.getElementById('editLocation').value=loc;
  document.getElementById('editCoach').value=coach;
  document.getElementById('editDescription').value=desc||'';
  openModal('editScheduleModal');
}
</script>
@endpush