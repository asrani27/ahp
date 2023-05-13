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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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
    public function ahp_update(Request $req, $id)
    {
        $kriteria = json_encode($req->all());
        $n = AHP::find($id);
        $n->tahun = $req->tahun;
        $n->matrik_kriteria = $kriteria;
        $n->save();

        Session::flash('success', 'Berhasil Diupdate');
        return redirect('/superadmin/ahp');
    }

    public function laporan()
    {
        return view('admin.laporan.index');
    }
}
