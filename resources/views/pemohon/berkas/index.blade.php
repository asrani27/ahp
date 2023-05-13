@extends('layouts.app')
@push('css')
    
@endpush
@section('content')

<div class="row">
    <div class="col-md-12">
        <a href="/pemohon" class="btn btn-flat btn-default bg-purple"><i class="fa fa-backward"></i> Kembali</a> <br/>
        <div class="info-box bg-purple">
            <span class="info-box-icon"><i class="fa fa-user-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">{{$data->created_at}}</span>
              <span class="info-box-number">{{$data->nama_pemohon}}</span>

              <div class="progress">
                <div class="progress-bar" style="width: 100%"></div>
              </div>
              <span class="progress-description">
                {{$data->nama_bangunan}}
                  </span>
            </div>
            <!-- /.info-box-content -->
        </div>    
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header">
            <i class="ion ion-clipboard"></i><h3 class="box-title">List Pengajuan</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
                <tbody>
                <tr>
                <th>No</th>
                <th>Jenis</th>
                <th>Status</th>
                <th>Aksi</th>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Permohonan KRK/KKPR</td>
                    <td>
                        @if ($data->krk == null)
                        
                        @else
                            @if ($data->krk->status == 0)
                            <span class="label label-danger">Di Proses</span>
                            @endif

                            @if ($data->krk->status == 1)
                            <span class="label label-success">Verified</span>
                            @endif
                        @endif
                    </td>
                    <td>
                        @if ($data->krk == null)
                        <a href="/pemohon/{{$id}}/berkas/krk_kkpr/create" class="btn bg-purple btn-xs btn-flat"><i class="fa fa-file"></i>  Isi Berkas</a>
                        @else
                            @if ($data->krk->status == 0)
                            <a href="/pemohon/{{$id}}/berkas/krk_kkpr/edit/{{$data->krk->id}}" class="btn bg-purple btn-xs btn-flat"><i class="fa fa-file"></i>  Edit Berkas</a>
                            @else
                            <a href="/pemohon/{{$id}}/berkas/krk_kkpr/pdf/{{$data->krk->id}}" class="btn bg-purple btn-xs btn-flat" target="_blank"><i class="fa fa-print"></i>  PDF</a>
                            @endif
                        @endif
                    </td>
                    
                </tr>
                <tr>
                    <td>2</td>
                    <td>Surat Pernyataan</td>
                    <td></td>
                    <td>
                    <a href="#" class="btn bg-purple btn-xs btn-flat"><i class="fa fa-file"></i>  Isi Berkas</a>
                    <a href="#" class="btn bg-purple btn-xs btn-flat"><i class="fa fa-print"></i>  PDF</a>
                    </td>
                    
                </tr>
                <tr>
                    <td>3</td>
                    <td>Berita Acara Konsultasi Kelaikan Fungsi Bangunan Gedung</td>
                    <td></td>
                    <td>
                    <a href="#" class="btn bg-purple btn-xs btn-flat"><i class="fa fa-file"></i>  Isi Berkas</a>
                    <a href="#" class="btn bg-purple btn-xs btn-flat"><i class="fa fa-print"></i>  PDF</a>
                    
                    </td>
                </tr>
                </tbody>
            </table>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
</div>
@endsection
@push('js')

@endpush
