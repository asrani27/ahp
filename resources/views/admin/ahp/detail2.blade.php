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
                <h3 class="box-title">Detail AHP TAHUN : {{$data->tahun}}</h3>
            </div>
            <!-- /.box-header -->
            @foreach ($kategori as $kt => $kriteria)
                
            <div class="box-body">
                <div class="form-group">
                    <div class="col-sm-12">
                        <h3>PERBANDINGAN BERPASANGAN GURU TERHADAP KRITERIA {{strtoupper($kriteria->nama)}}</h3>
                        <strong>Pairwise Comparisons</strong>
                    </div>
                </div>
                <div class="form-group">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td class="bg-danger">Kriteria</td>
                            @foreach ($guru as $item)
                                <td class="bg-danger">{{$item->nama}}</td>
                            @endforeach
                            </tr>
                            @foreach ($guru as $baris)
                                <tr>
                                    <td class="bg-danger">{{$baris->nama}}</td>
                                    @foreach ($guru as $kolom)
                                    <td>
                                        @if ($baris->id == $kolom->id)
                                            1
                                        @else
                                            {{round(langkah3guru($baris->id, $kolom->id, $kriteria->id),2)}}
                                        
                                        @endif
                                    </td>
                                    @endforeach
                                </tr>
                            @endforeach
                      </tbody>
                    </table>
                </div>

                <div class="form-group">
                    <div class="col-sm-12">
                        Pencarian Eigen Vektor Normalisasi<br/>
                    </div>
                </div>
                <div class="form-group">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td class="bg-danger" width="20%">EVN</td>
                            @foreach ($guru as $item)
                                <td class="bg-danger" width="20%">{{$item->nama}}</td>
                            @endforeach
                            <td class="bg-danger">Total</td>
                            </tr>
                            @foreach ($guru as $key => $baris)
                                <tr>
                                    <td class="bg-danger">{{$baris->nama}}</td>
                                
                                    @foreach ($data_matrik[$kt][0] as $key2 => $kolom)
                                    <td>
                                        
                                        {{$kolom * $pengali[$kt][$key][$key2]}}
                                        {{-- {{$kolom * $pengali_kategori1[$key][$key2]}} --}}
                                    </td>
                                    @endforeach
                                    <td>{{$array_sumk1[$kt][$key]}}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td>Baris 1</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="form-group">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td class="bg-danger" width="20%">EVN</td>
                            @foreach ($guru as $item)
                                <td class="bg-danger" width="20%">{{$item->nama}}</td>
                            @endforeach
                            <td class="bg-danger">Total</td>
                            
                            </tr>
                            @foreach ($guru as $key => $baris)
                                <tr>
                                    <td class="bg-danger">{{$baris->nama}}</td>
                                
                                    @foreach ($data_matrik[$kt][1] as $key2 => $kolom)
                                    <td>
                                        {{$kolom * $pengali[$kt][$key][$key2]}}
                                    </td>
                                    @endforeach
                                    <td>{{$array_sumk2[$kt][$key]}}</td>
                                    
                                </tr>
                            @endforeach
                            <tr>
                                <td>Baris 2</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="form-group">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td class="bg-danger" width="20%">EVN</td>
                            @foreach ($guru as $item)
                                <td class="bg-danger" width="20%">{{$item->nama}}</td>
                            @endforeach
                            <td class="bg-danger">Total</td>
                            </tr>
                            @foreach ($guru as $key => $baris)
                                <tr>
                                    <td class="bg-danger">{{$baris->nama}}</td>
                                
                                    @foreach ($data_matrik[$kt][2] as $key2 => $kolom)
                                    <td>
                                        {{$kolom * $pengali[$kt][$key][$key2]}}
                                    </td>
                                    @endforeach
                                    <td>{{$array_sumk3[$kt][$key]}}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td>Baris 3</td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                EVN : Eigen Vektor Normalisasi
                @if ($kt == 0)
                
                <div class="form-group">
                    <table class="table table-bordered">
                        <tbody>
                            <tr class="bg-danger">
                            <td class="bg-danger">Kriteria</td>
                            <td>Total</td>
                            <td>EVN</td>
                            </tr>
                            @foreach ($guru as $key => $item)
                                <tr>
                                    <td>{{$item->nama}}</td>
                                    <td>
                                        {{array_sum($k1_chunk[$key])}}
                                    </td>
                                    <td>{{array_sum($k1_chunk[$key]) / array_sum($sumevenk1)}}</td> 
                                </tr>
                            @endforeach
                            <tr>
                                <td></td>
                                <td>{{array_sum($sumevenk2)}}</td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                Rasio Konsistensi
                <div class="form-group">
                    <table class="table table-bordered">
                        <tbody>
                            <tr class="bg-danger">
                            <td>E-maks</td>
                            <td>CI</td>
                            <td>CR</td>
                            </tr>
                            <tr>
                                <td>{{$emaksK1}}</td>
                                <td>{{$ciK1}}</td>
                                <td>{{$crK1}}</td>
                            </tr>
                            <tr>
                                <td colspan=3>
                                    jika Nilai CR < 0,1 maka konsisten
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                @elseif($kt ==1)
        
                <div class="form-group">
                    <table class="table table-bordered">
                        <tbody>
                            <tr class="bg-danger">
                            <td class="bg-danger">Kriteria</td>
                            <td>Total</td>
                            <td>EVN</td>
                            </tr>
                            @foreach ($guru as $key => $item)
                                <tr>
                                    <td>{{$item->nama}}</td>
                                    <td>
                                        {{array_sum($k2_chunk[$key])}}
                                    </td>
                                    <td>{{array_sum($k2_chunk[$key]) / array_sum($sumevenk2)}}</td> 
                                </tr>
                            @endforeach
                            <tr>
                                <td></td>
                                <td>{{array_sum($sumevenk1)}}</td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                Rasio Konsistensi
                <div class="form-group">
                    <table class="table table-bordered">
                        <tbody>
                            <tr class="bg-danger">
                            <td>E-maks</td>
                            <td>CI</td>
                            <td>CR</td>
                            </tr>
                            <tr>
                                <td>{{$emaksK2}}</td>
                                <td>{{$ciK2}}</td>
                                <td>{{$crK2}}</td>
                            </tr>
                            <tr>
                                <td colspan=3>
                                    jika Nilai CR < 0,1 maka konsisten
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                @else

                <div class="form-group">
                    <table class="table table-bordered">
                        <tbody>
                            <tr class="bg-danger">
                            <td class="bg-danger">Kriteria</td>
                            <td>Total</td>
                            <td>EVN</td>
                            </tr>
                            @foreach ($guru as $key => $item)
                                <tr>
                                    <td>{{$item->nama}}</td>
                                    <td>
                                        {{array_sum($k3_chunk[$key])}}
                                    </td>
                                    <td>{{array_sum($k3_chunk[$key]) / array_sum($sumevenk3)}}</td> 
                                </tr>
                            @endforeach
                            <tr>
                                <td></td>
                                <td>{{array_sum($sumevenk3)}}</td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                Rasio Konsistensi
                <div class="form-group">
                    <table class="table table-bordered">
                        <tbody>
                            <tr class="bg-danger">
                            <td>E-maks</td>
                            <td>CI</td>
                            <td>CR</td>
                            </tr>
                            <tr>
                                <td>{{$emaksK3}}</td>
                                <td>{{$ciK3}}</td>
                                <td>{{$crK3}}</td>
                            </tr>
                            <tr>
                                <td colspan=3>
                                    jika Nilai CR < 0,1 maka konsisten
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                @endif

                    
            </div>
            @endforeach

                <div class="box-body">
                    <div class="form-group">
                        <div class="col-sm-12">
                            <h2>HASIL AKHIR</h2>
                        </div>
                    </div>
                    <div class="form-group">
                        <table class="table table-bordered">
                            <tbody>
                                @foreach ($hasil as $item)    
                                <tr>
                                    <td>{{$item->nama}}</td>
                                    <td>{{$item->hasil}}</td>
                                <tr>
                                @endforeach
                          </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.box-body -->
                
               
                
                
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
</div>
@endsection
@push('js')

@endpush