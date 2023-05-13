@extends('layouts.app')
@push('css')
    
@endpush
@section('content')

<div class="row">
    <div class="col-md-12">
        <a href="/pemohon/{{$id}}/berkas" class="btn btn-flat btn-default bg-purple"><i class="fa fa-backward"></i> Kembali</a> <br/>
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
            <i class="ion ion-clipboard"></i><h3 class="box-title">PERMOHONAN KRK /KKPR</h3>
          </div>
          <!-- /.box-header -->
          <form class="form-horizontal" method="post" action="/pemohon/{{$id}}/berkas/krk_kkpr/create" enctype="multipart/form-data">
            @csrf
            <div class="box-body">
                <div class="form-group">
                    <label class="col-sm-2 control-label"></label>
                    <div class="col-sm-10">
                        Yang bertanda Tangan Di Bawah Ini :
                    </div>
                </div>
                <div class="form-group @error('nama') has-error @enderror">
                    <label class="col-sm-2 control-label">Nama</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" name="nama" placeholder="Nama" value="{{old('nama')}}">
                    @error('nama')
                    <span class="help-block">{{$message}}</span>
                    @enderror
                    </div>
                </div>
                <div class="form-group @error('pekerjaan') has-error @enderror">
                    <label class="col-sm-2 control-label">Pekerjaan</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" name="pekerjaan" placeholder="Pekerjaan" value="{{old('pekerjaan')}}">

                    @error('pekerjaan')
                    <span class="help-block">{{$message}}</span>
                    @enderror
                    </div>
                </div>
                <div class="form-group @error('alamat') has-error @enderror">
                    <label class="col-sm-2 control-label">Alamat</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" name="alamat" placeholder="Alamat" value="{{old('alamat')}}">

                    @error('alamat')
                    <span class="help-block">{{$message}}</span>
                    @enderror
                    </div>
                </div>
                <div class="form-group @error('rt') has-error @enderror @error('rw') has-error @enderror @error('no') has-error @enderror">
                    <label class="col-sm-2 control-label">RT/RW/NO</label>
                    <div class="col-sm-1">
                    <input type="text" class="form-control"  name="rt" placeholder="RT" value="{{old('rt')}}">
                    @error('rt')
                    <span class="help-block">{{$message}}</span>
                    @enderror
                    </div>
                    <div class="col-sm-1">
                    <input type="text" class="form-control" name="rw" placeholder="RW" value="{{old('rw')}}">
                    @error('rw')
                    <span class="help-block">{{$message}}</span>
                    @enderror
                    </div>
                    <div class="col-sm-1">
                    <input type="text" class="form-control"  name="no" placeholder="NO" value="{{old('no')}}">
                    @error('no')
                    <span class="help-block">{{$message}}</span>
                    @enderror
                    </div>
                </div>
                <div class="form-group @error('kecamatan') has-error @enderror">
                    <label class="col-sm-2 control-label">Kecamatan</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control"  name="kecamatan" placeholder="Kecamatan" value="{{old('kecamatan')}}">
                    @error('kecamatan')
                    <span class="help-block">{{$message}}</span>
                    @enderror
                    </div>
                </div>
                <div class="form-group @error('kelurahan') has-error @enderror">
                    <label class="col-sm-2 control-label">Kelurahan</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control"  name="kelurahan" placeholder="Kelurahan" value="{{old('kelurahan')}}">
                    @error('kelurahan')
                    <span class="help-block">{{$message}}</span>
                    @enderror
                    </div>
                </div>
                <div class="form-group @error('telepon') has-error @enderror">
                    <label class="col-sm-2 control-label">Telepon</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control"  name="telepon" placeholder="Telepon" value="{{old('telepon')}}">
                    @error('telepon')
                    <span class="help-block">{{$message}}</span>
                    @enderror
                    </div>
                </div>
                <div class="form-group @error('atas_nama') has-error @enderror">
                    <label class="col-sm-2 control-label"></label>
                    <div class="col-sm-10">
                    Dalam hal ini bertindak dan atas nama :<input type="text" class="form-control" name="atas_nama" placeholder="Atas Nama" value="{{old('atas_nama')}}">
                    @error('atas_nama')
                    <span class="help-block">{{$message}}</span>
                    @enderror
                    Dengan Ini mengajukan permohonan untuk mendapatkan pelayanan sebagaimana tersebut di atas terhadap sebidang
                    tanah yang terletak di :
                    </div>
                </div>
                <div class="form-group @error('jalan') has-error @enderror">
                    <label class="col-sm-2 control-label">Jalan</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" name="jalan" placeholder="Jalan" value="{{old('jalan')}}">
                    @error('jalan')
                    <span class="help-block">{{$message}}</span>
                    @enderror
                    </div>
                </div>
                <div class="form-group @error('kelurahan2') has-error @enderror">
                    <label class="col-sm-2 control-label">Kelurahan</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" name="kelurahan2" placeholder="Kelurahan" value="{{old('kelurahan2')}}">
                    @error('kelurahan2')
                    <span class="help-block">{{$message}}</span>
                    @enderror
                    </div>
                </div>
                <div class="form-group @error('kecamatan2') has-error @enderror">
                    <label class="col-sm-2 control-label">Kecamatan</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" name="kecamatan2" placeholder="Kecamatan" value="{{old('kecamatan2')}}">
                    @error('kecamatan2')
                    <span class="help-block">{{$message}}</span>
                    @enderror
                    </div>
                </div>
                <div class="form-group @error('luas_tanah') has-error @enderror">
                    <label class="col-sm-2 control-label">Luas Tanah</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" name="luas_tanah" placeholder="Luas Tanah" value="{{old('luas_tanah')}}">
                    @error('luas_tanah')
                    <span class="help-block">{{$message}}</span>
                    @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Status Tanah</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" name="status_tanah" placeholder="Status Tanah">
                    </div>
                </div>
                <div class="form-group @error('nama') has-error @enderror">
                    <label class="col-sm-2 control-label">Jenis Peruntukan</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" name="jenis_peruntukan" placeholder="Jenis Peruntukan" value="{{old('jenis_peruntukan')}}">
                    @error('jenis_peruntukan')
                    <span class="help-block">{{$message}}</span>
                    @enderror
                    Sebagaimana kelengkapan bahan permohonan bersama ini di lampirkan Scan/Foto Maks (1 MB):
                    </div>
                </div>
                <div class="form-group @error('lampiran1') has-error @enderror">
                    <label class="col-sm-2 control-label">KTP</label>
                    <div class="col-sm-10">
                    <input type="file" class="form-control" name="lampiran1">
                    @error('lampiran1')
                    <span class="help-block">{{$message}}</span>
                    @enderror
                    </div>
                </div>
                <div class="form-group @error('lampiran2') has-error @enderror">
                    <label class="col-sm-2 control-label">Lunas PBB Tahun Berjalan</label>
                    <div class="col-sm-10">
                    <input type="file" class="form-control" name="lampiran2">
                    @error('lampiran2')
                    <span class="help-block">{{$message}}</span>
                    @enderror
                    </div>
                </div>
                <div class="form-group @error('lampiran3') has-error @enderror">
                    <label class="col-sm-2 control-label">Sertifikat/Surat-surat Tanah</label>
                    <div class="col-sm-10">
                    <input type="file" class="form-control" name="lampiran3">
                    @error('lampiran3')
                    <span class="help-block">{{$message}}</span>
                    @enderror
                    </div>
                </div>
                <div class="form-group @error('lampiran4') has-error @enderror">
                    <label class="col-sm-2 control-label">Surat pernyataan tidak ada masalah  atas tanah tersebut</label>
                    <div class="col-sm-10">
                    <input type="file" class="form-control" name="lampiran4">
                    @error('lampiran4')
                    <span class="help-block">{{$message}}</span>
                    @enderror
                    </div>
                </div>
                <div class="form-group @error('lampiran5') has-error @enderror">
                    <label class="col-sm-2 control-label">Gambar Rencana (Site Plan, Denah, Tampak Depan)</label>
                    <div class="col-sm-10">
                    <input type="file" class="form-control" name="lampiran5">
                    @error('lampiran5')
                    <span class="help-block">{{$message}}</span>
                    @enderror
                    </div>
                </div>
                <div class="form-group @error('lampiran6') has-error @enderror">
                    <label class="col-sm-2 control-label">NPWP (bila ada)</label>
                    <div class="col-sm-10">
                    <input type="file" class="form-control" name="lampiran6">
                    @error('lampiran6')
                    <span class="help-block">{{$message}}</span>
                    @enderror
                    </div>
                </div>
              
                <div class="form-group">
                    <label class="col-sm-2 control-label">Titik Koordinat</label>
                    <div class="col-sm-3">
                    <input type="text" class="form-control" placeholder="latitude">
                    </div>
                    <div class="col-sm-3">
                    <input type="text" class="form-control" placeholder="longitude">
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <button type="submit" class="btn bg-purple pull-right"><i class="fa fa-send"></i> Ajukan Pemohonan</button>
            </div>
            <!-- /.box-footer -->
          </form>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
</div>
@endsection
@push('js')

@endpush
