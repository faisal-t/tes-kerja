@extends('layouts.admin')

@section('content')

    @include('admin.barang.create')
    @include('admin.barang.edit')

    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <h6 class="text-primary font-weight-bold">Daftar Barang</h6>
                </div>
                <div class="ml-auto">
                    <button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal"
                        data-target="#modal-create">
                        <i class="fas fa-plus"></i>
                        Tambah
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>Jenis Barang</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->jenis->name}}</td>
                            <td>{{$item->stok}}</td>
                            <td>
                                <button class="btn btn-sm btn-primary mb-1" onclick="edit({{$item->id}})">
                                    <i class="fas fa-fw fa-book"></i>
                                    Edit
                                </button>
                               
                                <div class="d-inline-block">
                                    <form action="{{route('admin.barang.destroy',$item->id)}}" method="post" id="form-delete-$id" onsubmit="return confirm("Yakin ingin dihapus?")">
                                        @csrf
                                        @method('delete')
                                        <button class="d-inline-block btn btn-sm btn-danger mb-1" type="submit" onclick="return confirm('Apakah anda yakin ingin menghapus Barang?');">
                                            <i class="fas fa-fw fa-trash"></i>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
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
            $('#example').DataTable();
        });
    </script>
@endpush
