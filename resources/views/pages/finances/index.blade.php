@extends('layouts.app')
@section('title', 'Iuran & Keuangan - SMECONE Archery Club')

@section('content')
<section class="w-full bg-primary text-on-primary py-10 px-4 lg:px-gutter relative overflow-hidden">
<div class="absolute inset-0 bg-gradient-to-br from-primary via-primary-container to-primary opacity-30"></div>
<div class="max-w-7xl mx-auto relative z-10 flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
<div>
<span class="px-3 py-1 bg-primary-container text-on-primary-container rounded-full font-label-md text-[11px] mb-2 inline-block">Keuangan Klub</span>
<h1 class="font-headline-lg text-headline-lg-mobile lg:text-headline-lg text-white">Iuran & Keuangan</h1>
<p class="text-body-md text-primary-fixed-dim mt-1">Laporan kas dan iuran anggota SAC</p>
</div>
@if(auth()->user()->isAdmin())
<div class="flex items-center gap-2">
<button class="bg-surface text-primary px-4 py-2.5 rounded-lg font-label-lg shadow-lg flex items-center gap-2" onclick="openModal('addTransactionModal')">
<span class="material-symbols-outlined text-[18px]">add_card</span><span>Tambah Transaksi</span>
</button>
<a href="{{ route('finances.export') }}" class="bg-primary-container text-on-primary-container px-4 py-2.5 rounded-lg font-label-lg flex items-center gap-2">
<span class="material-symbols-outlined text-[18px]">download</span><span class="hidden sm:inline">Export</span>
</a>
</div>
@endif
</div>
</section>

<!-- Stats -->
<section class="max-w-7xl mx-auto px-4 lg:px-gutter w-full -mt-6 mb-6 z-10 relative">
<div class="grid grid-cols-2 md:grid-cols-4 gap-3">
<div class="bg-surface-container-lowest p-3 rounded-xl shadow-sm">
<span class="text-[10px] text-on-surface-variant font-label-md uppercase">Saldo Kas</span>
<h3 class="font-headline-md text-primary mt-1">Rp {{ number_format($balance, 0, ',', '.') }}</h3>
</div>
<div class="bg-surface-container-lowest p-3 rounded-xl shadow-sm">
<span class="text-[10px] text-on-surface-variant font-label-md uppercase">Pemasukan</span>
<h3 class="font-headline-md text-primary mt-1">Rp {{ number_format($totalIncome, 0, ',', '.') }}</h3>
</div>
<div class="bg-surface-container-lowest p-3 rounded-xl shadow-sm">
<span class="text-[10px] text-on-surface-variant font-label-md uppercase">Pengeluaran</span>
<h3 class="font-headline-md text-error mt-1">Rp {{ number_format($totalExpense, 0, ',', '.') }}</h3>
</div>
<div class="bg-surface-container-lowest p-3 rounded-xl shadow-sm">
<span class="text-[10px] text-on-surface-variant font-label-md uppercase">Lunas / Total</span>
<h3 class="font-headline-md text-primary mt-1">{{ $paidMembersCount }}/{{ $totalMembers }}</h3>
</div>
</div>
</section>

<!-- Transactions Table -->
<section class="max-w-7xl mx-auto px-4 lg:px-gutter w-full mb-8">
<div class="bg-surface-container-lowest rounded-xl shadow-sm overflow-hidden">
<div class="overflow-x-auto">
<table class="w-full text-left border-collapse min-w-[700px]">
<thead>
<tr class="bg-primary text-on-primary">
<th class="py-3 px-4 text-label-md uppercase w-12 text-center">No</th>
<th class="py-3 px-4 text-label-md uppercase">Kode</th>
<th class="py-3 px-4 text-label-md uppercase">Tanggal</th>
<th class="py-3 px-4 text-label-md uppercase">Kategori</th>
<th class="py-3 px-4 text-label-md uppercase">Keterangan</th>
<th class="py-3 px-4 text-label-md uppercase text-center">Tipe</th>
<th class="py-3 px-4 text-label-md uppercase text-right">Nominal</th>
</tr>
</thead>
<tbody class="divide-y divide-outline-variant/10">
@forelse($transactions as $i => $trx)
<tr class="hover:bg-surface-container-low/50 transition-colors">
<td class="py-3 px-4 text-center text-body-sm text-on-surface-variant">{{ $i+1 }}.</td>
<td class="py-3 px-4 font-mono text-body-sm text-primary">{{ $trx->trx_code }}</td>
<td class="py-3 px-4 text-body-sm text-on-surface-variant">{{ $trx->date }}</td>
<td class="py-3 px-4 text-body-sm text-on-surface">{{ $trx->category }}</td>
<td class="py-3 px-4 text-body-sm text-on-surface-variant max-w-[200px] truncate">{{ $trx->member_name ?? $trx->description ?? '-' }}</td>
<td class="py-3 px-4 text-center">
<span class="px-2.5 py-1 rounded-full text-label-sm font-semibold uppercase {{ $trx->type==='masuk' ? 'bg-primary/10 text-primary' : 'bg-error-container text-error' }}">{{ $trx->type }}</span>
</td>
<td class="py-3 px-4 text-right font-semibold {{ $trx->type==='masuk' ? 'text-primary' : 'text-error' }}">
{{ $trx->type==='masuk' ? '+' : '-' }}Rp {{ number_format($trx->amount, 0, ',', '.') }}
</td>
</tr>
@empty
<tr><td colspan="7" class="py-12 text-center text-on-surface-variant">Belum ada data transaksi.</td></tr>
@endforelse
</tbody>
</table>
</div>
<div class="px-4 py-3 bg-surface-container-low/50 border-t border-outline-variant/10 text-body-sm text-on-surface-variant">
Total <span class="font-semibold text-on-surface">{{ $transactions->count() }}</span> transaksi
</div>
</div>
</section>

@if(auth()->user()->isAdmin())
{{-- Unpaid Members --}}
@php $unpaid = $members->where('dues_status', '!=', 'Lunas'); @endphp
@if($unpaid->count() > 0)
<section class="max-w-7xl mx-auto px-4 lg:px-gutter w-full mb-8">
<h3 class="font-headline-sm text-on-surface mb-3">Anggota Belum Lunas ({{ $unpaid->count() }})</h3>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
@foreach($unpaid as $um)
<div class="bg-surface-container-lowest p-4 rounded-xl shadow-sm flex items-center justify-between">
<div class="flex items-center gap-3">
<div class="w-9 h-9 rounded-full bg-error-container/30 flex items-center justify-center"><span class="material-symbols-outlined text-[18px] text-error">warning</span></div>
<div><div class="font-semibold text-body-md">{{ $um->name }}</div><div class="text-body-sm text-on-surface-variant">{{ $um->class }}</div></div>
</div>
<form method="POST" action="{{ route('finances.markPaid', $um) }}">@csrf
<button type="submit" class="px-3 py-1.5 rounded-lg bg-primary text-on-primary text-label-sm font-semibold hover:bg-primary-container hover:text-on-primary-container transition-all">Tandai Lunas</button>
</form>
</div>
@endforeach
</div>
</section>
@endif

{{-- Add Transaction Modal --}}
<div class="fixed inset-0 z-50 bg-inverse-surface/40 backdrop-blur-sm hidden items-center justify-center p-4" id="addTransactionModal">
<div class="bg-surface-container-lowest w-full max-w-lg rounded-2xl p-6 shadow-2xl max-h-[90vh] overflow-y-auto">
<div class="flex items-center justify-between mb-4"><h3 class="font-headline-md text-primary">Tambah Transaksi</h3>
<button class="p-1 rounded-full hover:bg-surface-container" onclick="closeModal('addTransactionModal')"><span class="material-symbols-outlined">close</span></button></div>
<form method="POST" action="{{ route('finances.store') }}" class="space-y-4">@csrf
<div class="grid grid-cols-2 gap-3">
<div><label class="block text-label-md text-on-surface-variant mb-1">Tipe *</label>
<select name="type" required class="w-full px-4 py-2.5 bg-surface-container-low rounded-lg text-body-md focus:outline-none focus:ring-2 focus:ring-primary">
<option value="masuk">Pemasukan</option><option value="keluar">Pengeluaran</option></select></div>
<div><label class="block text-label-md text-on-surface-variant mb-1">Kategori *</label>
<select name="category" required class="w-full px-4 py-2.5 bg-surface-container-low rounded-lg text-body-md focus:outline-none focus:ring-2 focus:ring-primary">
<option value="Iuran Bulanan">Iuran Bulanan</option><option value="Subsidi Sekolah">Subsidi Sekolah</option><option value="Perawatan & Alat">Perawatan & Alat</option><option value="Operasional">Operasional</option><option value="Lainnya">Lainnya</option></select></div>
</div>
<div class="grid grid-cols-2 gap-3">
<div><label class="block text-label-md text-on-surface-variant mb-1">Nominal (Rp) *</label>
<input type="number" name="amount" required min="1000" class="w-full px-4 py-2.5 bg-surface-container-low rounded-lg text-body-md focus:outline-none focus:ring-2 focus:ring-primary" placeholder="25000"></div>
<div><label class="block text-label-md text-on-surface-variant mb-1">Tanggal *</label>
<input type="date" name="date" value="{{ date('Y-m-d') }}" required class="w-full px-4 py-2.5 bg-surface-container-low rounded-lg text-body-md focus:outline-none focus:ring-2 focus:ring-primary"></div>
</div>
<div class="grid grid-cols-2 gap-3">
<div><label class="block text-label-md text-on-surface-variant mb-1">Metode Bayar *</label>
<select name="payment_method" required class="w-full px-4 py-2.5 bg-surface-container-low rounded-lg text-body-md focus:outline-none focus:ring-2 focus:ring-primary">
<option value="Tunai">Tunai</option><option value="Transfer">Transfer</option><option value="QRIS">QRIS</option></select></div>
<div><label class="block text-label-md text-on-surface-variant mb-1">Anggota</label>
<select name="member_id" class="w-full px-4 py-2.5 bg-surface-container-low rounded-lg text-body-md focus:outline-none focus:ring-2 focus:ring-primary">
<option value="">-- Tidak ada --</option>
@foreach($members as $m)<option value="{{ $m->id }}">{{ $m->name }}</option>@endforeach
</select></div>
</div>
<div><label class="block text-label-md text-on-surface-variant mb-1">Keterangan</label>
<input name="description" class="w-full px-4 py-2.5 bg-surface-container-low rounded-lg text-body-md focus:outline-none focus:ring-2 focus:ring-primary" placeholder="Opsional"></div>
<input type="hidden" name="period" value="{{ date('F Y') }}">
<div class="flex justify-end gap-2 pt-2">
<button type="button" class="px-5 py-2.5 rounded-lg bg-surface-container text-on-surface font-label-lg" onclick="closeModal('addTransactionModal')">Batal</button>
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