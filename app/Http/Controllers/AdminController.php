<?php

namespace App\Http\Controllers;

use App\Models\AHP;
use App\Models\Guru;
use App\Models\Kasi;
use App\Models\Role;
use App\Models\User;
use App\Models\Arsip;
use App\Models\Kepala;
use App\Models\Kategori;
use App\Models\Penyedia;
use Illuminate\Support\Arr;
use App\Models\AHP_kriteria;
use App\Models\AHP_guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use PhpOffice\PhpSpreadsheet\IOFactory;

class AdminController extends Controller
{
    public function user()
    {
        $data = User::orderBy('id', 'DESC')->paginate(15);
        return view('admin.user.index', compact('data'));
    }
    public function user_create()
    {
        return view('admin.user.create');
    }
    public function user_edit($id)
    {
        $data = User::find($id);
        return view('admin.user.edit', compact('data'));
    }
    public function user_delete($id)
    {
        if (Auth::user()->id == $id) {
            Session::flash('error', 'Tidak bisa di hapus, karena sedang digunakan');
            return back();
        } else {
            $data = User::find($id)->delete();
            Session::flash('success', 'Berhasil Dihapus');
            return back();
        }
    }
    public function user_store(Request $req)
    {
        $checkUser = User::where('username', $req->username)->first();
        $role = Role::where('name', 'superadmin')->first();
        if ($checkUser == null) {
            if ($req->password1 != $req->password2) {
                Session::flash('error', 'Password Tidak Sama');
                return back();
            } else {

                $n = new User();
                $n->name = $req->name;
                $n->username = $req->username;
                $n->password = bcrypt($req->password1);
                $n->save();

                $n->roles()->attach($role);
                Session::flash('success', 'Berhasil Disimpan, Password : ' . $req->password1);
                return redirect('/superadmin/user');
            }
        } else {
            Session::flash('error', 'Username ini sudah pernah di input');
            return back();
        }
    }
    public function user_update(Request $req, $id)
    {
        $data = User::find($id);
        if ($req->password1 == null) {
            //update tanpa password
            $data->name = $req->name;
            $data->save();
            Session::flash('success', 'Berhasil Diupdate');
            return redirect('/superadmin/user');
        } else {
            // update beserta password
            if ($req->password1 != $req->password2) {
                Session::flash('error', 'Password Tidak Sama');
                return back();
            } else {
                $data->password = bcrypt($req->password1);
                $data->name = $req->name;
                $data->save();
                Session::flash('success', 'Berhasil Diupdate, password : ' . $req->password1);
                return redirect('/superadmin/user');
            }
        }
    }

    public function kategori()
    {
        $data = Kategori::orderBy('id', 'DESC')->paginate(15);
        return view('admin.kategori.index', compact('data'));
    }
    public function kategori_create()
    {
        return view('admin.kategori.create');
    }
    public function kategori_edit($id)
    {
        $data = Kategori::find($id);
        return view('admin.kategori.edit', compact('data'));
    }
    public function kategori_delete($id)
    {
        $data = Kategori::find($id)->delete();
        Session::flash('success', 'Berhasil Dihapus');
        return back();
    }
    public function kategori_store(Request $req)
    {
        $check = Kategori::where('nama', $req->nama)->first();
        if ($check == null) {
            $n = new Kategori();
            $n->nama = $req->nama;
            $n->save();

            Session::flash('success', 'Berhasil Disimpan');
            return redirect('/superadmin/kategori');
        } else {
            Session::flash('error', 'Kategori ini sudah pernah di input');
            return back();
        }
    }
    public function kategori_update(Request $req, $id)
    {
        $data = Kategori::find($id);
        $data->nama = $req->nama;
        $data->save();
        Session::flash('success', 'Berhasil Diupdate');
        return redirect('/superadmin/kategori');
    }


    public function guru()
    {
        $data = Guru::orderBy('id', 'DESC')->paginate(15);
        return view('admin.guru.index', compact('data'));
    }
    public function guru_create()
    {
        return view('admin.guru.create');
    }
    public function guru_edit($id)
    {
        $data = Guru::find($id);
        return view('admin.guru.edit', compact('data'));
    }
    public function guru_delete($id)
    {
        $data = Guru::find($id)->delete();
        Session::flash('success', 'Berhasil Dihapus');
        return back();
    }
    public function guru_store(Request $req)
    {
        Guru::create($req->all());
        Session::flash('success', 'Berhasil Disimpan');
        return redirect('/superadmin/guru');
    }
    public function guru_update(Request $req, $id)
    {
        Guru::find($id)->update($req->all());
        Session::flash('success', 'Berhasil Diupdate');
        return redirect('/superadmin/guru');
    }

    public function ahp()
    {
        $data = ahp::orderBy('id', 'DESC')->paginate(15);
        return view('admin.ahp.index', compact('data'));
    }
    public function ahp_create()
    {
        $countKategori = Kategori::count();
        $countGuru = Guru::count();
        $kategori = Kategori::get();
        $guru = Guru::get();
        return view('admin.ahp.create', compact('countKategori', 'countGuru', 'kategori', 'guru'));
    }
    public function ahp_edit($id)
    {
        $data = ahp::find($id);
        $matrik = json_decode($data->matrik_kriteria);
        $countKategori = Kategori::count();
        $kategori = Kategori::get();

        return view('admin.ahp.edit', compact('matrik', 'data', 'countKategori', 'kategori'));
    }
    public function ahp_guru($id)
    {
        $data = ahp::find($id);
        $matrik = json_decode($data->matrik_guru);
        $countGuru = Guru::count();
        $kategori = Kategori::get();
        $guru = Guru::get();

        $matrik->kriteria_id = array_chunk($matrik->kriteria_id, 3);
        $matrik->gurusatu = array_chunk($matrik->gurusatu, 3);
        $matrik->nilai = array_chunk($matrik->nilai, 3);
        $matrik->gurudua = array_chunk($matrik->gurudua, 3);

        return view('admin.ahp.editguru', compact('matrik', 'data', 'countGuru', 'guru', 'kategori'));
    }
    public function ahp_delete($id)
    {
        $data = AHP::find($id)->delete();
        Session::flash('success', 'Berhasil Dihapus');
        return back();
    }
    public function ahp_store(Request $req)
    {

        $kriteria = json_encode($req->all());
        $n = new AHP;
        $n->tahun = $req->tahun;
        $n->matrik_kriteria = $kriteria;
        $n->save();

        Session::flash('success', 'Berhasil Disimpan');
        return redirect('/superadmin/ahp');
    }
    public function ahp_guru_store(Request $req, $id)
    {
        $guru = json_encode($req->all());

        $n = AHP::find($id);
        $n->matrik_guru = $guru;
        $n->save();

        $ahp = AHP_guru::where('ahp_id', $id)->delete();

        $k = 9;
        for ($i = 0; $i < $k; $i++) {
            $new = new AHP_guru;
            $new->guru_vertikal = $req->gurusatu[$i];
            $new->guru_horizontal = $req->gurudua[$i];
            $new->nilai = $req->nilai[$i];
            $new->ahp_id = $id;
            $new->kategori_id = $req->kriteria_id[$i];
            $new->save();
        }
        Session::flash('success', 'Berhasil Disimpan');
        return redirect('/superadmin/ahp');
    }
    public function ahp_update(Request $req, $id)
    {
        $kriteria = json_encode($req->all());
        $n = AHP::find($id);
        $n->tahun = $req->tahun;
        $n->matrik_kriteria = $kriteria;
        $n->save();
        $ahp = AHP_kriteria::where('ahp_id', $id)->delete();

        $k = Kategori::count();
        for ($i = 0; $i < $k; $i++) {
            $new = new AHP_kriteria;
            $new->kriteria_vertikal = $req->kategorisatu[$i];
            $new->kriteria_horizontal = $req->kategoridua[$i];
            $new->nilai = $req->nilai[$i];
            $new->ahp_id = $id;
            $new->save();
        }

        Session::flash('success', 'Berhasil Diupdate');
        return redirect('/superadmin/ahp');
    }

    public function ahp_detail($id)
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

        //hitung Emaks
        $sumpengali1 = array_sum($pengali_baris1);
        $sumpengali2 = array_sum($pengali_baris2);
        $sumpengali3 = array_sum($pengali_baris3);
        $emaks = ($sumpengali1 * $evnc1) + ($sumpengali2 * $evnc2) + ($sumpengali3 * $evnc3);
        $ci = ($emaks - 3) / 2;
        $cr = $ci / 0.58;

        $sumevn = [$sumevnc1, $sumevnc2, $sumevnc3];

        return view('admin.ahp.detail', compact('kategori', 'data', 'matrik', 'data_matrik', 'pengali_baris1', 'pengali', 'sumc1', 'sumc2', 'sumc3', 'emaks', 'ci', 'cr', 'sumevnc1', 'sumevnc2', 'sumevnc3', 'sumevn'));
    }

    public function ahp_detail2($id)
    {
        $data = AHP::find($id);
        $kategori = Kategori::get();
        $guru = Guru::orderBy('id', 'DESC')->get();
        $matrik = json_decode($data->matrik_guru);

        $n = Kategori::count();

        $data_matrik = [];
        foreach ($kategori as $kt => $kat)
            foreach ($guru as $key => $baris) {
                foreach ($guru as $key2 => $kolom) {
                    if ($baris->id == $kolom->id) {
                        array_push($data_matrik, 1);
                    } else {
                        $nilai = langkah3guru($baris->id, $kolom->id, $kat->id);
                        array_push($data_matrik, $nilai);
                    }
                }
            }
        $matrik_kategori1 = array_chunk(array_chunk($data_matrik, 3), 3)[0];
        $matrik_kategori2 = array_chunk(array_chunk($data_matrik, 3), 3)[1];
        $matrik_kategori3 = array_chunk(array_chunk($data_matrik, 3), 3)[2];
        $data_matrik = array_chunk(array_chunk($data_matrik, 3), 3);


        //dd($pengali, $pengali_baris1, $data_matrik);
        //$data_matrik = array_chunk(array_chunk($data_matrik, 3), 3);
        //dd($data_matrik, $matrik_kategori1);
        $pengali_baris1_kategori1 = [];
        $pengali_baris2_kategori1 = [];
        $pengali_baris3_kategori1 = [];
        foreach ($matrik_kategori1 as $key => $item) {
            array_push($pengali_baris1_kategori1, $item[0]);
        }
        foreach ($matrik_kategori1 as $key => $item) {
            array_push($pengali_baris2_kategori1, $item[1]);
        }
        foreach ($matrik_kategori1 as $key => $item) {
            array_push($pengali_baris3_kategori1, $item[2]);
        }

        $pengali_baris1_kategori2 = [];
        $pengali_baris2_kategori2 = [];
        $pengali_baris3_kategori2 = [];
        foreach ($matrik_kategori2 as $key => $item) {
            array_push($pengali_baris1_kategori2, $item[0]);
        }
        foreach ($matrik_kategori2 as $key => $item) {
            array_push($pengali_baris2_kategori2, $item[1]);
        }
        foreach ($matrik_kategori2 as $key => $item) {
            array_push($pengali_baris3_kategori2, $item[2]);
        }

        $pengali_baris1_kategori3 = [];
        $pengali_baris2_kategori3 = [];
        $pengali_baris3_kategori3 = [];
        foreach ($matrik_kategori3 as $key => $item) {
            array_push($pengali_baris1_kategori3, $item[0]);
        }
        foreach ($matrik_kategori3 as $key => $item) {
            array_push($pengali_baris2_kategori3, $item[1]);
        }
        foreach ($matrik_kategori3 as $key => $item) {
            array_push($pengali_baris3_kategori3, $item[2]);
        }

        $pengali_kategori1 = array_merge($pengali_baris1_kategori1, $pengali_baris2_kategori1, $pengali_baris3_kategori1);
        $pengali_kategori1 = array_chunk($pengali_kategori1, 3);
        $pengali_kategori2 = array_merge($pengali_baris1_kategori2, $pengali_baris2_kategori2, $pengali_baris3_kategori2);
        $pengali_kategori2 = array_chunk($pengali_kategori2, 3);
        $pengali_kategori3 = array_merge($pengali_baris1_kategori3, $pengali_baris2_kategori3, $pengali_baris3_kategori3);
        $pengali_kategori3 = array_chunk($pengali_kategori3, 3);

        $pengali = array_chunk(array_merge($pengali_kategori1, $pengali_kategori2, $pengali_kategori3), 3);

        $totalc1k1 = [];
        $totalc2k1 = [];
        $totalc3k1 = [];

        $totalc1k2 = [];
        $totalc2k2 = [];
        $totalc3k2 = [];

        $totalc1k3 = [];
        $totalc2k3 = [];
        $totalc3k3 = [];
        foreach ($kategori as $key => $baris) {
            //KATEGORI 1
            foreach ($data_matrik[0][0] as $key2 => $kolom) {
                $total = $kolom * $pengali[0][$key][$key2];
                array_push($totalc1k1, $total);
            }
            foreach ($data_matrik[0][1] as $key2 => $kolom) {
                $total = $kolom * $pengali[0][$key][$key2];
                array_push($totalc2k1, $total);
            }
            foreach ($data_matrik[0][2] as $key2 => $kolom) {
                $total = $kolom * $pengali[0][$key][$key2];
                array_push($totalc3k1, $total);
            }

            //KATEGORI 2
            foreach ($data_matrik[1][0] as $key2 => $kolom) {
                $total = $kolom * $pengali[1][$key][$key2];
                array_push($totalc1k2, $total);
            }
            foreach ($data_matrik[1][1] as $key2 => $kolom) {
                $total = $kolom * $pengali[1][$key][$key2];
                array_push($totalc2k2, $total);
            }
            foreach ($data_matrik[1][2] as $key2 => $kolom) {
                $total = $kolom * $pengali[1][$key][$key2];
                array_push($totalc3k2, $total);
            }

            //KATEGORI 3
            foreach ($data_matrik[2][0] as $key2 => $kolom) {
                $total = $kolom * $pengali[2][$key][$key2];
                array_push($totalc1k3, $total);
            }
            foreach ($data_matrik[2][1] as $key2 => $kolom) {
                $total = $kolom * $pengali[2][$key][$key2];
                array_push($totalc2k3, $total);
            }
            foreach ($data_matrik[2][2] as $key2 => $kolom) {
                $total = $kolom * $pengali[2][$key][$key2];
                array_push($totalc3k3, $total);
            }
        }


        $totalc1k1 = array_chunk($totalc1k1, 3);
        $totalc2k1 = array_chunk($totalc2k1, 3);
        $totalc3k1 = array_chunk($totalc3k1, 3);

        $totalc1k2 = array_chunk($totalc1k2, 3);
        $totalc2k2 = array_chunk($totalc2k2, 3);
        $totalc3k2 = array_chunk($totalc3k2, 3);

        $totalc1k3  = array_chunk($totalc1k3, 3);
        $totalc2k3  = array_chunk($totalc2k3, 3);
        $totalc3k3  = array_chunk($totalc3k3, 3);
        // $totalc2 = array_chunk($totalc2, 3);
        // $totalc3 = array_chunk($totalc3, 3);
        //dd($totalc1);
        $sumc1k1 = [];
        $sumc2k1 = [];
        $sumc3k1 = [];

        $sumc1k2  = [];
        $sumc2k2  = [];
        $sumc3k2  = [];

        $sumc1k3  = [];
        $sumc2k3  = [];
        $sumc3k3  = [];

        foreach ($totalc1k1 as $item) {
            array_push($sumc1k1, array_sum($item));
        }
        foreach ($totalc2k1 as $item) {
            array_push($sumc2k1, array_sum($item));
        }
        foreach ($totalc3k1 as $item) {
            array_push($sumc3k1, array_sum($item));
        }

        foreach ($totalc1k2 as $item) {
            array_push($sumc1k2, array_sum($item));
        }
        foreach ($totalc2k2 as $item) {
            array_push($sumc2k2, array_sum($item));
        }
        foreach ($totalc3k2 as $item) {
            array_push($sumc3k2, array_sum($item));
        }

        foreach ($totalc1k3 as $item) {
            array_push($sumc1k3, array_sum($item));
        }
        foreach ($totalc2k3 as $item) {
            array_push($sumc2k3, array_sum($item));
        }
        foreach ($totalc3k3 as $item) {
            array_push($sumc3k3, array_sum($item));
        }


        $sumevnc1K1 = array_sum($sumc1k1);
        $sumevnc2K1 = array_sum($sumc2k1);
        $sumevnc3K1 = array_sum($sumc3k1);

        $sumevnc1K2 = array_sum($sumc1k2);
        $sumevnc2K2 = array_sum($sumc2k2);
        $sumevnc3K2 = array_sum($sumc3k2);

        $sumevnc1K3 = array_sum($sumc1k3);
        $sumevnc2K3 = array_sum($sumc2k3);
        $sumevnc3K3 = array_sum($sumc3k3);

        $array_sumk1 = array_merge($sumc1k1, $sumc1k2, $sumc1k3);
        $array_sumk2 = array_merge($sumc2k1, $sumc2k2, $sumc3k3);
        $array_sumk3 = array_merge($sumc3k1, $sumc3k2, $sumc3k3);
        $array_sumk1 = array_chunk($array_sumk1, 3);
        $array_sumk2 = array_chunk($array_sumk2, 3);
        $array_sumk3 = array_chunk($array_sumk3, 3);
        //$array_sumevn = array_merge($sumevnc1K1, $sumevnc2K1, $sumevnc3K1, $sumevnc1K2, $sumevnc2K2, $sumevnc3K2, $sumevnc1K3, $sumevnc2K3, $sumevnc3K3);
        //$array_sumevn = array_chunk($array_sumevn, 3);
        $totalEVNK1 = array_sum($sumc1k1) + array_sum($sumc2k1) + array_sum($sumc3k1);
        $totalEVNK2 = array_sum($sumc1k2) + array_sum($sumc2k2) + array_sum($sumc3k2);
        $totalEVNK3 = array_sum($sumc1k3) + array_sum($sumc2k3) + array_sum($sumc3k3);
        dd($array_sumk1);
        // $evnc1 = $sumevnc1 / $TOTALEVN;
        // $evnc2 = $sumevnc2 / $TOTALEVN;
        // $evnc3 = $sumevnc3 / $TOTALEVN;
        //        dd($totalEVNK1, $totalEVNK2, $totalEVNK3);
        // //hitung Emaks
        // $sumpengali1 = array_sum($pengali_baris1);
        // $sumpengali2 = array_sum($pengali_baris2);
        // $sumpengali3 = array_sum($pengali_baris3);
        // $emaks = ($sumpengali1 * $evnc1) + ($sumpengali2 * $evnc2) + ($sumpengali3 * $evnc3);
        // $ci = ($emaks - 3) / 2;
        // $cr = $ci / 0.58;

        // $sumevn = [$sumevnc1, $sumevnc2, $sumevnc3];

        return view('admin.ahp.detail2', compact(
            'kategori',
            'guru',
            'data',
            'matrik',
            'data_matrik',
            'matrik_kategori1',
            'pengali_kategori1',
            'pengali',
            'array_sumk1',
            'array_sumk2',
            'array_sumk3'
        ));
    }

    public function ahp_excel($id)
    {

        $data = AHP::find($id);
        $filename = 'metode_ahp_new.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment;filename=$filename");
        header('Cache-Control: max-age=0');

        $path = public_path('/assets/metode_ahp.xlsx');

        $reader = IOFactory::createReader('Xlsx');
        $spreadsheet = $reader->load($path);

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
        exit;
    }
    public function laporan()
    {
        return view('admin.laporan.index');
    }
}
