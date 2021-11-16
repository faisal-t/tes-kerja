@extends('layouts.admin')


@section('content')



    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <h6 class="text-primary font-weight-bold">Daftar Total Transaksi</h6>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form class="form-row mb-2 no-gutters align-items-center" action="{{ route('admin.transaksi.detail') }}"
                method="get" id="form-filter-tanggal">
                <div class="col-lg-4">
                    <input type="date" name="from" class="form-control form-control-sm"
                        value="{{ now()->subDay(1)->format('Y-m-d') }}">
                </div>
                <div class="col-auto">
                    -
                </div>
                <div class="col-lg-4">
                    <input type="date" name="to" class="form-control form-control-sm"
                        value="{{ now()->format('Y-m-d') }}">
                </div>

                <div class="col-lg-3">
                    <button class="btn btn-sm btn-info" onsubmit="">Cari</button>
                </div>
            </form>
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Jenis Barang</th>
                        <th>Jumlah Transaksi</th>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->transaksis_count }}</td>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
        </div>
    </div>

@endsection

@push('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#example').DataTable({});
        });

    </script>
@endpush
