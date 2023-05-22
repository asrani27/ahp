<?php

use App\Models\AHP_guru;
use App\Models\AHP_kriteria;
use App\Models\Tkrk;

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
