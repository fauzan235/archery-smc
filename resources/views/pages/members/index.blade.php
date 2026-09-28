@extends('layouts.app')
@section('title', 'Daftar Anggota - SMECONE Archery Club')

@section('content')
<!-- Header Banner -->
<section class="w-full bg-primary text-on-primary py-10 px-4 lg:px-gutter relative overflow-hidden">
<div class="absolute inset-0 bg-gradient-to-br from-primary via-primary-container to-primary opacity-30"></div>
<div class="max-w-7xl mx-auto relative z-10 flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
<div>
<span class="px-3 py-1 bg-primary-container text-on-primary-container rounded-full font-label-md text-[11px] mb-2 inline-block">Anggota SAC</span>
<h1 class="font-headline-lg text-headline-lg-mobile lg:text-headline-lg text-white tracking-tight">Daftar Anggota</h1>
<p class="text-body-md text-primary-fixed-dim mt-1">Ekstrakurikuler SMECONE Archery Club — SMK Negeri 1 Purwokerto</p>
</div>
@if(auth()->user()->isAdmin())
<button class="bg-surface text-primary px-4 py-2.5 rounded-lg font-label-lg hover:bg-surface-container transition-all shadow-lg flex items-center gap-2 flex-shrink-0" onclick="openModal('addMemberModal')">
<span class="material-symbols-outlined text-[18px]">person_add</span><span>Tambah Anggota</span>
</button>
@endif
</div>
</section>

<!-- Stats -->
<section class="max-w-7xl mx-auto px-4 lg:px-gutter w-full -mt-6 mb-6 z-10 relative">
<div class="grid grid-cols-3 gap-3">
@php $cards = [
  ['label'=>'Total Anggota','val'=>$totalMembers,'icon'=>'groups','color'=>'text-primary','bg'=>'bg-primary-container/20'],
  ['label'=>'Aktif','val'=>$activeMembers,'icon'=>'verified','color'=>'text-primary','bg'=>'bg-primary/10'],
  ['label'=>'Non-Aktif','val'=>$inactiveMembers,'icon'=>'person_off','color'=>'text-secondary','bg'=>'bg-secondary-container'],
]; @endphp
@foreach($cards as $c)
<div class="bg-surface-container-lowest p-3 lg:p-4 rounded-xl shadow-sm flex items-center justify-between">
<div><span class="text-[10px] lg:text-body-sm text-on-surface-variant font-label-md uppercase tracking-wider">{{ $c['label'] }}</span><h3 class="font-headline-md {{ $c['color'] }} mt-1">{{ $c['val'] }}</h3></div>
<div class="w-10 h-10 rounded-xl {{ $c['bg'] }} flex items-center justify-center {{ $c['color'] }} flex-shrink-0"><span class="material-symbols-outlined text-[22px]" style="font-variation-settings:'FILL' 1">{{ $c['icon'] }}</span></div>
</div>
@endforeach
</div>
</section>

<!-- Search & Filter -->
<section class="max-w-7xl mx-auto px-4 lg:px-gutter w-full mb-4">
<div class="bg-surface-container-lowest p-3 rounded-xl shadow-sm flex flex-col md:flex-row items-center justify-between gap-3">
<form method="GET" action="{{ route('members.index') }}" class="relative w-full md:w-80">
<span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline text-[20px]">search</span>
<input class="w-full pl-10 pr-4 py-2 bg-surface-container-low rounded-lg text-body-md focus:outline-none focus:ring-2 focus:ring-primary transition-all" name="search" value="{{ request('search') }}" placeholder="Cari nama atau kelas...">
</form>
<div class="flex items-center gap-2">
<form method="GET" action="{{ route('members.index') }}" id="filterForm" class="flex gap-2">
<input type="hidden" name="search" value="{{ request('search') }}">
<select name="class" onchange="this.form.submit()" class="bg-surface-container-low px-3 py-2 rounded-lg text-body-sm focus:outline-none focus:ring-2 focus:ring-primary">
<option value="">Semua Kelas</option>
@foreach(['X','XI','XII'] as $k)<option value="{{ $k }}" {{ request('class')===$k?'selected':'' }}>Kelas {{ $k }}</option>@endforeach
</select>
<select name="status" onchange="this.form.submit()" class="bg-surface-container-low px-3 py-2 rounded-lg text-body-sm focus:outline-none focus:ring-2 focus:ring-primary">
<option value="">Semua Status</option>
<option value="Aktif" {{ request('status')==='Aktif'?'selected':'' }}>Aktif</option>
<option value="Non-Aktif" {{ request('status')==='Non-Aktif'?'selected':'' }}>Non-Aktif</option>
</select>
</form>
@if(auth()->user()->isAdmin())
<a href="{{ route('members.export') }}" class="bg-surface-container-low px-3 py-2 rounded-lg text-body-sm hover:bg-surface-container transition-all flex items-center gap-1.5">
<span class="material-symbols-outlined text-[16px]">download</span><span class="hidden sm:inline">Export</span>
</a>
@endif
</div>
</div>
</section>

<!-- Member Table -->
<section class="max-w-7xl mx-auto px-4 lg:px-gutter w-full mb-8">
<div class="bg-surface-container-lowest rounded-xl shadow-sm overflow-hidden">
<div class="overflow-x-auto">
<table class="w-full text-left border-collapse min-w-[600px]">
<thead>
<tr class="bg-primary text-on-primary">
<th class="py-3 px-4 text-label-md uppercase tracking-wider w-12 text-center">No</th>
<th class="py-3 px-4 text-label-md uppercase tracking-wider">Nama</th>
<th class="py-3 px-4 text-label-md uppercase tracking-wider">Kelas</th>
<th class="py-3 px-4 text-label-md uppercase tracking-wider text-center">Status</th>
<th class="py-3 px-4 text-label-md uppercase tracking-wider text-center">Kehadiran</th>
@if(auth()->user()->isAdmin())<th class="py-3 px-4 text-label-md uppercase tracking-wider text-right">Aksi</th>@endif
</tr>
</thead>
<tbody class="divide-y divide-outline-variant/10">
@forelse($members as $i => $m)
<tr class="hover:bg-surface-container-low/50 transition-colors">
<td class="py-3 px-4 text-center text-body-md text-on-surface-variant font-semibold">{{ $i+1 }}.</td>
<td class="py-3 px-4">
<div class="flex items-center gap-3">
<div class="w-9 h-9 rounded-full bg-gradient-to-br from-surface-container-high to-outline-variant/30 flex items-center justify-center flex-shrink-0">
<span class="material-symbols-outlined text-[20px] text-outline" style="font-variation-settings:'FILL' 1">person</span>
</div>
<div class="min-w-0">
<div class="font-semibold text-on-surface text-body-md truncate">{{ $m->name }}</div>
<div class="text-body-sm text-on-surface-variant">{{ $m->member_code }} · {{ $m->division }}</div>
</div>
</div>
</td>
<td class="py-3 px-4 text-on-surface-variant text-body-md">{{ $m->class }}</td>
<td class="py-3 px-4 text-center">
<span class="px-2.5 py-1 rounded-full text-label-sm font-semibold {{ $m->status==='Aktif' ? 'bg-primary/10 text-primary' : 'bg-secondary-container text-secondary' }}">{{ $m->status }}</span>
</td>
<td class="py-3 px-4">
<div class="flex items-center justify-center gap-2">
<div class="w-16 bg-surface-container-high h-1.5 rounded-full overflow-hidden"><div class="{{ $m->attendance_rate >= 75 ? 'bg-primary' : 'bg-secondary' }} h-full rounded-full" style="width:{{ $m->attendance_rate }}%"></div></div>
<span class="text-body-sm font-semibold {{ $m->attendance_rate >= 75 ? 'text-primary' : 'text-secondary' }}">{{ $m->attendance_rate }}%</span>
</div>
</td>
@if(auth()->user()->isAdmin())
<td class="py-3 px-4 text-right">
<div class="flex items-center justify-end gap-1.5">
<button class="p-1.5 rounded-lg bg-surface-container hover:bg-primary hover:text-on-primary transition-all text-on-surface-variant" onclick="openEditModal({{ $m->id }},'{{ addslashes($m->name) }}','{{ $m->member_code }}','{{ addslashes($m->class) }}','{{ $m->division }}','{{ $m->status }}','{{ $m->nisn }}','{{ $m->phone }}','{{ $m->role }}')" title="Edit"><span class="material-symbols-outlined text-[16px]">edit</span></button>
<form method="POST" action="{{ route('members.destroy', $m) }}" onsubmit="return confirm('Hapus anggota {{ addslashes($m->name) }}?')" class="inline">@csrf @method('DELETE')
<button type="submit" class="p-1.5 rounded-lg bg-error-container text-on-error-container hover:bg-error hover:text-on-error transition-all" title="Hapus"><span class="material-symbols-outlined text-[16px]">delete</span></button>
</form>
</div>
</td>
@endif
</tr>
@empty
<tr><td colspan="{{ auth()->user()->isAdmin() ? 6 : 5 }}" class="py-12 text-center text-on-surface-variant">
<div class="flex flex-col items-center gap-3"><div class="w-16 h-16 rounded-full bg-surface-container flex items-center justify-center"><span class="material-symbols-outlined text-[32px] text-outline">group_off</span></div>
<p class="font-headline-sm text-on-surface">Belum ada anggota</p></div>
</td></tr>
@endforelse
</tbody>
</table>
</div>
<div class="px-4 py-3 bg-surface-container-low/50 border-t border-outline-variant/10 text-body-sm text-on-surface-variant">
Menampilkan <span class="font-semibold text-on-surface">{{ $members->count() }}</span> anggota
</div>
</div>
</section>

{{-- ===== MODALS (Admin Only) ===== --}}
@if(auth()->user()->isAdmin())
<!-- Add Modal -->
<div class="fixed inset-0 z-50 bg-inverse-surface/40 backdrop-blur-sm hidden items-center justify-center p-4" id="addMemberModal">
<div class="bg-surface-container-lowest w-full max-w-lg rounded-2xl p-6 shadow-2xl max-h-[90vh] overflow-y-auto">
<div class="flex items-center justify-between mb-4"><h3 class="font-headline-md text-primary">Tambah Anggota Baru</h3>
<button class="p-1 rounded-full hover:bg-surface-container" onclick="closeModal('addMemberModal')"><span class="material-symbols-outlined">close</span></button></div>
<form method="POST" action="{{ route('members.store') }}" class="space-y-4">@csrf
<div><label class="block text-label-md text-on-surface-variant mb-1">Nama Lengkap *</label>
<input class="w-full px-4 py-2.5 bg-surface-container-low rounded-lg text-body-md focus:outline-none focus:ring-2 focus:ring-primary" name="name" required placeholder="Nama lengkap"></div>
<div class="grid grid-cols-2 gap-3">
<div><label class="block text-label-md text-on-surface-variant mb-1">Kelas *</label>
<input class="w-full px-4 py-2.5 bg-surface-container-low rounded-lg text-body-md focus:outline-none focus:ring-2 focus:ring-primary" name="class" required placeholder="XII AKL 2"></div>
<div><label class="block text-label-md text-on-surface-variant mb-1">NISN</label>
<input class="w-full px-4 py-2.5 bg-surface-container-low rounded-lg text-body-md focus:outline-none focus:ring-2 focus:ring-primary" name="nisn" placeholder="Opsional"></div>
</div>
<div class="grid grid-cols-2 gap-3">
<div><label class="block text-label-md text-on-surface-variant mb-1">Divisi *</label>
<select class="w-full px-4 py-2.5 bg-surface-container-low rounded-lg text-body-md focus:outline-none focus:ring-2 focus:ring-primary" name="division" required>
<option value="Recurve">Recurve</option><option value="Compound">Compound</option><option value="Barebow">Barebow</option><option value="Standard Bow">Standard Bow</option></select></div>
<div><label class="block text-label-md text-on-surface-variant mb-1">Status *</label>
<select class="w-full px-4 py-2.5 bg-surface-container-low rounded-lg text-body-md focus:outline-none focus:ring-2 focus:ring-primary" name="status" required>
<option value="Aktif">Aktif</option><option value="Non-Aktif">Non-Aktif</option></select></div>
</div>
<div><label class="block text-label-md text-on-surface-variant mb-1">No HP/WA</label>
<input class="w-full px-4 py-2.5 bg-surface-container-low rounded-lg text-body-md focus:outline-none focus:ring-2 focus:ring-primary" name="phone" placeholder="Opsional"></div>
<input type="hidden" name="role" value="Anggota">
<div class="flex justify-end gap-2 pt-2">
<button type="button" class="px-5 py-2.5 rounded-lg bg-surface-container text-on-surface font-label-lg hover:bg-surface-container-highest" onclick="closeModal('addMemberModal')">Batal</button>
<button type="submit" class="px-5 py-2.5 rounded-lg bg-primary text-on-primary font-label-lg hover:bg-primary-container hover:text-on-primary-container">Simpan</button>
</div>
</form>
</div>
</div>

<!-- Edit Modal -->
<div class="fixed inset-0 z-50 bg-inverse-surface/40 backdrop-blur-sm hidden items-center justify-center p-4" id="editMemberModal">
<div class="bg-surface-container-lowest w-full max-w-lg rounded-2xl p-6 shadow-2xl max-h-[90vh] overflow-y-auto">
<div class="flex items-center justify-between mb-4"><h3 class="font-headline-md text-primary">Edit Anggota</h3>
<button class="p-1 rounded-full hover:bg-surface-container" onclick="closeModal('editMemberModal')"><span class="material-symbols-outlined">close</span></button></div>
<form method="POST" id="editForm" class="space-y-4">@csrf @method('PUT')
<div><label class="block text-label-md text-on-surface-variant mb-1">Nama Lengkap *</label>
<input class="w-full px-4 py-2.5 bg-surface-container-low rounded-lg text-body-md focus:outline-none focus:ring-2 focus:ring-primary" id="editName" name="name" required></div>
<div class="grid grid-cols-2 gap-3">
<div><label class="block text-label-md text-on-surface-variant mb-1">ID</label>
<input class="w-full px-4 py-2.5 bg-surface-container-low rounded-lg text-body-md text-on-surface-variant" id="editCode" readonly></div>
<div><label class="block text-label-md text-on-surface-variant mb-1">Kelas *</label>
<input class="w-full px-4 py-2.5 bg-surface-container-low rounded-lg text-body-md focus:outline-none focus:ring-2 focus:ring-primary" id="editClass" name="class" required></div>
</div>
<div class="grid grid-cols-2 gap-3">
<div><label class="block text-label-md text-on-surface-variant mb-1">Divisi *</label>
<select class="w-full px-4 py-2.5 bg-surface-container-low rounded-lg text-body-md focus:outline-none focus:ring-2 focus:ring-primary" id="editDivision" name="division" required>
<option value="Recurve">Recurve</option><option value="Compound">Compound</option><option value="Barebow">Barebow</option><option value="Standard Bow">Standard Bow</option></select></div>
<div><label class="block text-label-md text-on-surface-variant mb-1">Status *</label>
<select class="w-full px-4 py-2.5 bg-surface-container-low rounded-lg text-body-md focus:outline-none focus:ring-2 focus:ring-primary" id="editStatus" name="status" required>
<option value="Aktif">Aktif</option><option value="Non-Aktif">Non-Aktif</option></select></div>
</div>
<div class="grid grid-cols-2 gap-3">
<div><label class="block text-label-md text-on-surface-variant mb-1">NISN</label>
<input class="w-full px-4 py-2.5 bg-surface-container-low rounded-lg text-body-md focus:outline-none focus:ring-2 focus:ring-primary" id="editNisn" name="nisn"></div>
<div><label class="block text-label-md text-on-surface-variant mb-1">No HP/WA</label>
<input class="w-full px-4 py-2.5 bg-surface-container-low rounded-lg text-body-md focus:outline-none focus:ring-2 focus:ring-primary" id="editPhone" name="phone"></div>
</div>
<input type="hidden" id="editRole" name="role">
<div class="flex justify-end gap-2 pt-2">
<button type="button" class="px-5 py-2.5 rounded-lg bg-surface-container text-on-surface font-label-lg" onclick="closeModal('editMemberModal')">Batal</button>
<button type="submit" class="px-5 py-2.5 rounded-lg bg-primary text-on-primary font-label-lg">Perbarui</button>
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
function openEditModal(id,name,code,cls,div,status,nisn,phone,role){
  document.getElementById('editForm').action='/anggota/'+id;
  document.getElementById('editName').value=name;
  document.getElementById('editCode').value=code;
  document.getElementById('editClass').value=cls;
  document.getElementById('editDivision').value=div;
  document.getElementById('editStatus').value=status;
  document.getElementById('editNisn').value=nisn||'';
  document.getElementById('editPhone').value=phone||'';
  document.getElementById('editRole').value=role||'Anggota';
  openModal('editMemberModal');
}
</script>
@endpush