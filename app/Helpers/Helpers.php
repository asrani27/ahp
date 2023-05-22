<?php

use App\Models\AHP;
use App\Models\Tkrk;
use App\Models\AHP_guru;
use App\Models\Kategori;
use App\Models\AHP_kriteria;

function langkah3($kriteria_vertikal, $kriteria_horizontal)
{
    //Pairwise Comparisons
    $check = AHP_kriteria::where('kriteria_vertikal', $kriteria_vertikal)->where('kriteria_horizontal', $kriteria_horizontal)->first();
    if ($check != null) {
        $nilai = $check->nilai;
    } else {
        $pairwise_comparison = AHP_kriteria::where('kriteria_horizontal', $kriteria_vertikal)->where('kriteria_vertikal', $kriteria_horizontal)->first();
        if ($pairwise_comparison != null) {
            $nilai = 1 / $pairwise_comparison->nilai;
        }
    }
    return round($nilai, 2);
}
function langkah3guru($guru_vertikal, $guru_horizontal, $kriteria)
{
    //Pairwise Comparisons
    $check = AHP_guru::where('guru_vertikal', $guru_vertikal)->where('guru_horizontal', $guru_horizontal)->where('kategori_id', $kriteria)->first();
    if ($check != null) {
        $nilai = $check->nilai;
    } else {
        $pairwise_comparison = AHP_guru::where('guru_horizontal', $guru_vertikal)->where('guru_vertikal', $guru_horizontal)->where('kategori_id', $kriteria)->first();
        if ($pairwise_comparison != null) {
            $nilai = 1 / $pairwise_comparison->nilai;
        }
    }
    return round($nilai, 2);
}

function nilaibarissatu($kriteria_vertikal, $kriteria_horizontal)
{

    $langkah3 = langkah3($kriteria_vertikal, $kriteria_horizontal);

    return $langkah3;
}
function langkah4($kriteria_vertikal, $kriteria_horizontal)
{
    $langkah3 = langkah3($kriteria_vertikal, $kriteria_horizontal);
    return $langkah3;
}

function AHPKategori($id)
{
    $data = AHP::find($id);
    $kategori = Kategori::get();
    $matrik = json_decode($data->matrik_kriteria);

    $n = Kategori::count();

    $data_matrik = [];
    foreach ($kategori as $key => $baris) {
        foreach ($kategori as $key2 => $kolom) {
            if ($baris->id == $kolom->id) {
                array_push($data_matrik, 1);
            } else {
                $nilai = langkah3($baris->id, $kolom->id);
                array_push($data_matrik, $nilai);
            }
        }
    }
    $data_matrik = array_chunk($data_matrik, 3);

    $pengali_baris1 = [];
    $pengali_baris2 = [];
    $pengali_baris3 = [];
    foreach ($data_matrik as $key => $item) {
        array_push($pengali_baris1, $item[0]);
    }
    foreach ($data_matrik as $key => $item) {
        array_push($pengali_baris2, $item[1]);
    }
    foreach ($data_matrik as $key => $item) {
        array_push($pengali_baris3, $item[2]);
    }

    $pengali = array_merge($pengali_baris1, $pengali_baris2, $pengali_baris3);

    $pengali = array_chunk($pengali, 3);
    $totalc1 = [];
    $totalc2 = [];
    $totalc3 = [];
    foreach ($kategori as $key => $baris) {
        foreach ($data_matrik[0] as $key2 => $kolom) {
            $total = $kolom * $pengali[$key][$key2];
            array_push($totalc1, $total);
        }
    }
    foreach ($kategori as $key => $baris) {
        foreach ($data_matrik[1] as $key2 => $kolom) {
            $total = $kolom * $pengali[$key][$key2];
            array_push($totalc2, $total);
        }
    }
    foreach ($kategori as $key => $baris) {
        foreach ($data_matrik[2] as $key2 => $kolom) {
            $total = $kolom * $pengali[$key][$key2];
            array_push($totalc3, $total);
        }
    }
    $totalc1 = array_chunk($totalc1, 3);
    $totalc2 = array_chunk($totalc2, 3);
    $totalc3 = array_chunk($totalc3, 3);
    $sumc1 = [];
    $sumc2 = [];
    $sumc3 = [];
    foreach ($totalc1 as $item) {
        array_push($sumc1, array_sum($item));
    }
    foreach ($totalc2 as $item) {
        array_push($sumc2, array_sum($item));
    }
    foreach ($totalc3 as $item) {
        array_push($sumc3, array_sum($item));
    }

    $sumevnc1 = array_sum($sumc1);
    $sumevnc2 = array_sum($sumc2);
    $sumevnc3 = array_sum($sumc3);

    $TOTALEVN = array_sum($sumc1) + array_sum($sumc2) + array_sum($sumc3);
    $evnc1 = $sumevnc1 / $TOTALEVN;
    $evnc2 = $sumevnc2 / $TOTALEVN;
    $evnc3 = $sumevnc3 / $TOTALEVN;

    $hasil = [$evnc1, $evnc2, $evnc3];

    return $hasil;
}
