@extends('layouts.sb-admin')

@push('css')
{{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css"> --}}
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css">
@endpush

@section('sidebar')
<!-- Nav Item - Dashboard -->


<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
	Pengelolaan
</div>
<li class="nav-item {{ request()->routeIs('admin.jenis.*') ? 'active' : '' }}">
	<a class="nav-link" href="{{ route('admin.jenis.index') }}">
		<i class="fas fa-fw fa-book"></i>
		<span>Kelola Jenis Barang</span>
	</a>
</li>
<li class="nav-item {{ request()->routeIs('admin.barang.*') ? 'active' : '' }}">
	<a class="nav-link" href="{{ route('admin.barang.index') }}">
		<i class="fas fa-fw fa-book"></i>
		<span>Keloa Barang</span>
	</a>
</li>

<li class="nav-item {{ request()->routeIs('admin.transaksi.index') ? 'active' : '' }}">
	<a class="nav-link" href="{{ route('admin.transaksi.index') }}">
		<i class="fas fa-fw fa-book"></i>
		<span>Keloa Transaksi</span>
	</a>
</li>
<li class="nav-item {{ request()->routeIs('admin.transaksi.detail') ? 'active' : '' }}">
	<a class="nav-link" href="{{ route('admin.transaksi.detail') }}">
		<i class="fas fa-fw fa-book"></i>
		<span>Keloa Detail Penjualan</span>
	</a>
</li>




<!-- Divider -->
<hr class="sidebar-divider">
@endsection

@push('js')
<script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap4.min.js"></script>

<script type="text/javascript">
	$(function() {
		$.extend( $.fn.dataTable.defaults, {
		    responsive: true,
		} );
	})
</script>
@endpush