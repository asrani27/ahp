@extends('layouts.app')
@push('css')
    
@endpush
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="box box-success">
          <div class="box-header">
            <i class="ion ion-clipboard"></i><h3 class="box-title">Laporan</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <a href="/laporan/penyedia" class='btn btn-success btn-flat' target="_blank"><i class="fa fa-file"></i>  Laporan Penyedia</a>
            <a href="/laporan/kasi" class='btn btn-success btn-flat' target="_blank"><i class="fa fa-file"></i>  Laporan Kasi</a>
            <a href="/laporan/kepala" class='btn btn-success btn-flat' target="_blank"><i class="fa fa-file"></i>  Laporan Kepala</a>
            <a href="/laporan/arsip" class='btn btn-success btn-flat' target="_blank"><i class="fa fa-file"></i>  Laporan Arsip</a>
          </div>
          <!-- /.box-body -->
        </div>
        
        <!-- /.box -->
      </div>
</div>

@endsection
@push('js')

@endpush
