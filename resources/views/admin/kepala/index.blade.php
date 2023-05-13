@extends('layouts.app')
@push('css')
    
@endpush
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="box box-success">
          <div class="box-header">
            <i class="ion ion-clipboard"></i><h3 class="box-title">Data Kepala</h3>

            <div class="box-tools">
              <a href="/superadmin/kepala/create" class="btn btn-flat btn-sm btn-success"><i class="fa fa-plus"></i> Tambah Data</a>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
              <tbody><tr>
                <th>No</th>
                <th>Nama</th>
                <th>status pegawai</th>
                <th>status kepala</th>
                
                <th>Aksi</th>
              </tr>
              @foreach ($data as $key => $item)
              <tr>
                <td>{{$data->firstItem() + $key}}</td>
                <td>{{$item->nama}}</td>
                <td>{{$item->status_pegawai}}</td>
                <td>{{$item->status_kepala}}</td>
                <td>{{\Carbon\Carbon::parse($item->tanggal_menjabat)->format('d-m-Y')}}</td>
                <td>
                  <a href="/superadmin/kepala/edit/{{$item->id}}" class="btn btn-flat btn-sm btn-success"><i class="fa fa-edit"></i> Edit</a>
                  <a href="/superadmin/kepala/delete/{{$item->id}}" class="btn btn-flat btn-sm btn-success" onclick="return confirm('Yakin ingin dihapus?');"><i class="fa fa-trash"></i> Delete</a>
                </td>
              </tr>
              @endforeach
            </tbody></table>
          </div>
          <!-- /.box-body -->
        </div>
        {{$data->links()}}
        <!-- /.box -->
      </div>
</div>

@endsection
@push('js')

@endpush
