@extends('layouts.app')
@push('css')

@endpush
@section('content')

<div class="row">
    <div class="col-md-12">
        <a href="/superadmin/ahp" class="btn btn-flat btn-danger"><i class="fa fa-backward"></i> Kembali</a> <br /><br />
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="box box-danger">
            <div class="box-header">
                <i class="ion ion-clipboard"></i>
                <h3 class="box-title">Edit Data</h3>
            </div>
            <!-- /.box-header -->
            <form class="form-horizontal" method="post" action="/superadmin/ahp/edit/{{$data->id}}" enctype="multipart/form-data">
                @csrf
                <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Tahun</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="tahun" value="{{$matrik->tahun}}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"></label>
                            <div class="col-sm-10">
                                PERBANDINGAN BERPASANGAN TERHADAP MASING2 KRITERIA
                            </div>
                        </div>
                    @php
                        $k = $countKategori;
                    @endphp    
                    
                    @for ($x = 0; $x < $k; $x++)
                    <div class="form-group">
                        <label class="col-sm-2 control-label"></label>
                        <div class="col-sm-3">
                            <select name="kategorisatu[]" class="form-control" required>
                                <option value="">-pilih-</option>
                                @foreach ($kategori as $item)
                                    <option value="{{$item->id}}" {{$matrik->kategorisatu[$x] ==$item->id ? 'selected':''}}>{{$item->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <select name="nilai[]" class="form-control" required>
                                <option value="">-pilih-</option>
                                <option value="1" {{$matrik->nilai[$x] == "1" ? 'selected':''}}>1</option>
                                <option value="2" {{$matrik->nilai[$x] == "2" ? 'selected':''}}>2</option>
                                <option value="3" {{$matrik->nilai[$x] == "3" ? 'selected':''}}>3</option>
                                <option value="4" {{$matrik->nilai[$x] == "4" ? 'selected':''}}>4</option>
                                <option value="5" {{$matrik->nilai[$x] == "5" ? 'selected':''}}>5</option>
                                <option value="6" {{$matrik->nilai[$x] == "6" ? 'selected':''}}>6</option>
                                <option value="7" {{$matrik->nilai[$x] == "7" ? 'selected':''}}>7</option>
                                <option value="8" {{$matrik->nilai[$x] == "8" ? 'selected':''}}>8</option>
                                <option value="9" {{$matrik->nilai[$x] == "9" ? 'selected':''}}>9</option>
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <select name="kategoridua[]" class="form-control" required>
                                <option value="">-pilih-</option>
                                @foreach ($kategori as $item)
                                    <option value="{{$item->id}}"  {{$matrik->kategoridua[$x] ==$item->id ? 'selected':''}}>{{$item->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @endfor
    
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" class="btn btn-danger pull-right"><i class="fa fa-save"></i> Update Data</button>
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