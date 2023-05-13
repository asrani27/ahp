@extends('layouts.app')
@push('css')
    
@endpush
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="box box-danger">
          <div class="box-header">
            <i class="ion ion-clipboard"></i><h3 class="box-title">Data Penilaian Guru</h3>

            <div class="box-tools">
              <a href="/superadmin/ahp/create" class="btn btn-flat btn-sm btn-danger"><i class="fa fa-plus"></i> Tambah Data</a>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
              <tbody><tr>
                <th>No</th>
                <th>Tahun</th>
                <th>Aksi</th>
              </tr>
              @foreach ($data as $key => $item)
              <tr>
                <td>{{$data->firstItem() + $key}}</td>
                <td>{{$item->tahun}}</td>
                <td>
                  <a href="/superadmin/ahp/detail/{{$item->file}}" target="_blank" class="btn btn-flat btn-sm btn-danger"><i class="fa fa-list"></i> Detail</a>
                  <a href="/superadmin/ahp/penilaian/{{$item->id}}" class="btn btn-flat btn-sm btn-danger"><i class="fa fa-edit"></i> Penilaian Guru</a>
                  <a href="/superadmin/ahp/edit/{{$item->id}}" class="btn btn-flat btn-sm btn-danger"><i class="fa fa-edit"></i> Edit</a>
                  <a href="/superadmin/ahp/delete/{{$item->id}}" class="btn btn-flat btn-sm btn-danger" onclick="return confirm('Yakin ingin dihapus?');"><i class="fa fa-trash"></i> Delete</a>
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
