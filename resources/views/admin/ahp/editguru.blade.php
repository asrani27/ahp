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

        <form class="form-horizontal" method="post" action="/superadmin/ahp/penilaian/{{$data->id}}" enctype="multipart/form-data">
        <div class="box box-danger">
            <div class="box-header">
                <i class="ion ion-clipboard"></i>
                <h3 class="box-title">Nilai Guru</h3>
            </div>
            <!-- /.box-header -->
                @csrf
                <div class="box-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Tahun</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="tahun" value="{{$data->tahun}}" readonly>
                        </div>
                    </div>
                    
                </div>
                

        </div>
        <!-- /.box-body -->
        
        @foreach ($kategori as $key => $kt)
        <div class="box box-danger">
            <div class="box-header">
                <i class="ion ion-clipboard"></i>
                <h3 class="box-title">PENILAIAN GURU TERHADAP KRITERIA {{strtoupper($kt->nama)}}</h3>
            </div>
        
            <div class="box-body">
                @php
                $k = $countGuru;
                @endphp

                @for ($x = 0; $x < $k; $x++) 
                <input type="hidden" name="kriteria_id[]" value="{{$kt->id}}">
                <div class="form-group">
                    <div class="col-sm-4">
                        <select name="gurusatu[]" class="form-control" required>
                            <option value="">-pilih-</option>
                            @foreach ($guru as $item)
                            @if ($matrik == null)
                            <option value="{{$item->id}}">{{$item->nama}}</option>
                            @else
                            <option value="{{$item->id}}" {{$matrik->gurusatu[$key][$x] == $item->id ? 'selected':''}}>{{$item->nama}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <select name="nilai[]" class="form-control" required>
                            <option value="">-pilih-</option>
                            @if ($matrik == null)
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            @else 
                            <option value="1" {{$matrik->nilai[$key][$x] == "1" ? 'selected':''}}>1</option>
                            <option value="2" {{$matrik->nilai[$key][$x] == "2" ? 'selected':''}}>2</option>
                            <option value="3" {{$matrik->nilai[$key][$x] == "3" ? 'selected':''}}>3</option>
                            <option value="4" {{$matrik->nilai[$key][$x] == "4" ? 'selected':''}}>4</option>
                            <option value="5" {{$matrik->nilai[$key][$x] == "5" ? 'selected':''}}>5</option>
                            <option value="6" {{$matrik->nilai[$key][$x] == "6" ? 'selected':''}}>6</option>
                            <option value="7" {{$matrik->nilai[$key][$x] == "7" ? 'selected':''}}>7</option>
                            <option value="8" {{$matrik->nilai[$key][$x] == "8" ? 'selected':''}}>8</option>
                            <option value="9" {{$matrik->nilai[$key][$x] == "9" ? 'selected':''}}>9</option>
                            @endif
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <select name="gurudua[]" class="form-control" required>
                            <option value="">-pilih-</option>
                            @foreach ($guru as $item)
                            @if ($matrik == null)
                            <option value="{{$item->id}}">{{$item->nama}}</option>
                            @else
                            <option value="{{$item->id}}" {{$matrik->gurudua[$key][$x] == $item->id ? 'selected':''}}>{{$item->nama}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div> 
                </div>
                @endfor
            </div>
            

        </div>
        @endforeach
        <!-- /.box-footer -->
        
        <!-- /.box-body -->
        <div class="box-footer">
            <button type="submit" class="btn btn-danger pull-right"><i class="fa fa-save"></i> Update Nilai</button>
        </div>
        </form>

        <!-- /.box-body -->
    </div>
    <!-- /.box -->
</div>
</div>
@endsection
@push('js')

@endpush