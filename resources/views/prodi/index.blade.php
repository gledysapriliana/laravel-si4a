@extends('layout.main') @section('title', 'Prodi') @section('content')
<!--begin::Row-->
<div class="row">
    <div class="col-12">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">List Prodi</h3>
                <div class="card-tools">
                    <button
                        type="button"
                        class="btn btn-tool"
                        data-lte-toggle="card-collapse"
                        title="Collapse"
                    >
                        <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                        <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                    </button>
                    <button
                        type="button"
                        class="btn btn-tool"
                        data-lte-toggle="card-remove"
                        title="Remove"
                    >
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <a href="{{ route('prodi.create') }}" class="btn btn-primary"> Tambah </a>
                <hr>
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>Nama</th>
                        <th>Singkatan</th>
                        <th>Kaprodi</th>
                        <th>Sekretaris</th>
                        <th>Fakultas</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($prodi as $item)
                    <tr>
                        <td>{{$item->nama}}</td>
                        <td>{{$item->singkatan}}</td>
                        <td>{{$item->kaprodi}}</td>
                        <td>{{$item->sekretaris}}</td>
                        <td>{{$item->fakultas->nama}}</td>
                        <td class="d-flex gap-2">
                            <a href="{{ route('prodi.show', $item->id) }}" class="btn btn-info">Show</a>
                            @can('update', $item)
                            <a href="{{ route('prodi.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                            @endcan
                            @can('delete', $item)
                            <form method="POST" action="{{ route('prodi.destroy', $item->id) }}">
                                @csrf
                                <input name="_method" type="hidden" value="DELETE">
                                <button type="submit" class="btn btn-xs btn-danger btn-rounded show_confirm"
                                    data-toggle="tooltip" title='Delete'
                                    data-nama='{{ $item->nama }}'>Hapus</button>
                            </form>
                            @endcan
                        </td>
                    </tr>
                    @endforeach
                </table>
                @endsection
            </div>
        </div>
    </div>
</div>
