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
                                    <td>{{array_sum($array_sumk1[$key])}}</td>
                                    <td></td>
                                    {{-- <td>{{$sumevn[$key]}}</td>
                                    <td>{{$sumevn[$key] / array_sum($sumevn)}}</td> --}}
                                </tr>
                            @endforeach
                            <tr>
                                <td></td>
                                <td></td>
                                {{-- <td>{{array_sum($sumevn)}}</td> --}}
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
{{-- 
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
                                <td>{{$emaks}}</td>
                                <td>{{$ci}}</td>
                                <td>{{$cr}}</td>
                            </tr>
                            <tr>
                                <td colspan=3>
                                    Catatan, jika Nilai CR < 0,1 maka konsisten, jika lebih dari 0,1 maka ada kesalahan dan harus di hitung ulang
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div> --}}
                    
            </div>
            @endforeach

                {{-- <div class="box-body">
                    <div class="form-group">
                        <div class="col-sm-12">
                            Pencarian Eigen Vektor Normalisasi Setiap Kriteria<br/>
                        </div>
                    </div>
                    <div class="form-group">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td class="bg-danger">EVN Terhadap Kehadiran</td>
                                @foreach ($kategori as $item)
                                    <td class="bg-danger">{{$item->nama}}</td>
                                @endforeach
                                <td>Total</td>
                                </tr>
                                @foreach ($kategori as $key => $baris)
                                    <tr>
                                        <td class="bg-danger">{{$baris->nama}}</td>
                                    
                                        @foreach ($data_matrik[0] as $key2 => $kolom)
                                        <td>
                                           {{$kolom * $pengali[$key][$key2]}}
                                        </td>
                                        @endforeach
                                        <td>{{$sumc1[$key]}}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td>Baris 1</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>{{$sumevnc1}}</td>
                                </tr>
                          </tbody>
                        </table>
                    </div>

                    <div class="form-group">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td class="bg-danger">EVN Terhadap Kreatifitas</td>
                                @foreach ($kategori as $item)
                                    <td class="bg-danger">{{$item->nama}}</td>
                                @endforeach
                                <td>Total</td>
                                </tr>
                                @foreach ($kategori as $key => $baris)
                                    <tr>
                                        <td class="bg-danger">{{$baris->nama}}</td>
                                    
                                        @foreach ($data_matrik[1] as $key2 => $kolom)
                                        <td>
                                           {{$kolom * $pengali[$key][$key2]}}
                                        </td>
                                        @endforeach
                                        <td>{{$sumc2[$key]}}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td>Baris 2</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>{{$sumevnc2}}</td>
                                </tr>
                          </tbody>
                        </table>
                    </div>

                    <div class="form-group">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td class="bg-danger">EVN Terhadap Sosial</td>
                                @foreach ($kategori as $item)
                                    <td class="bg-danger">{{$item->nama}}</td>
                                @endforeach
                                <td>Total</td>
                                </tr>
                                @foreach ($kategori as $key => $baris)
                                    <tr>
                                        <td class="bg-danger">{{$baris->nama}}</td>
                                    
                                        @foreach ($data_matrik[2] as $key2 => $kolom)
                                        <td>
                                           {{$kolom * $pengali[$key][$key2]}}
                                        </td>
                                        @endforeach
                                        <td>{{$sumc3[$key]}}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td>Baris 3</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>{{$sumevnc3}}</td>
                                </tr>
                          </tbody>
                        </table>
                    </div>

                    EVN : Eigen Vektor Normalisasi
                    <div class="form-group">
                        <table class="table table-bordered">
                            <tbody>
                                <tr class="bg-danger">
                                <td class="bg-danger">Kriteria</td>
                                <td>Total</td>
                                <td>EVN</td>
                                </tr>
                                @foreach ($kategori as $key => $item)
                                    <tr>
                                        <td>{{$item->nama}}</td>
                                        <td>{{$sumevn[$key]}}</td>
                                        <td>{{$sumevn[$key] / array_sum($sumevn)}}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td></td>
                                    <td>{{array_sum($sumevn)}}</td>
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
                                    <td>{{$emaks}}</td>
                                    <td>{{$ci}}</td>
                                    <td>{{$cr}}</td>
                                </tr>
                                <tr>
                                    <td colspan=3>
                                        Catatan, jika Nilai CR < 0,1 maka konsisten, jika lebih dari 0,1 maka ada kesalahan dan harus di hitung ulang
                                    </td>
                                </tr>
                          </tbody>
                        </table>
                    </div>
                </div> --}}
                <!-- /.box-body -->
                
               
                
                
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
</div>
@endsection
@push('js')

@endpush