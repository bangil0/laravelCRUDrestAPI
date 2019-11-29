<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\User;

class UserController extends Controller
{
    //! Menampilkan semua user
    public function index()
    {
        $userList = User::paginate(5);
        return  response()->json($userList, 200);

        // $user =  User::all();


        // if (count($user) > 0) { //!mengecek apakah user kosong atau tidak
        //     $res['message'] = "Success!";
        //     $res['values'] = $user;
        //     return response($res);
        // } else {
        //     $res['message'] = "Empty!";
        //     return response($res);
        // }
    }
    //! menampilkan 1 user berdasarkan id
    public function showById($id)
    {
        $data = User::where('id', $id)->get();

        if (count($data) > 0) { //mengecek apakah data kosong atau tidak
            $res['message'] = "Success!";
            $res['user'] = $data;
            return response($res);
        } else {
            $res['message'] = "Data Not Found!";
            return response($res);
        }
    }



    //! membuat user baru
    public function create(request $request)
    {
        $user = new User;
        $user->nama = $request->nama;
        $user->kelurahan = $request->kelurahan;
        $user->nik = $request->nik;
        $user->no_kk = $request->no_kk;
        $user->alamat = $request->alamat;
        $user->kecamatan = $request->kecamatan;
        $user->latitude = $request->latitude;
        $user->longitude = $request->longitude;

        if ($user->save()) {
            $res['message'] = "Success!";
            $res['user'] = "$user";
            return response($res);
        }
    }

    public function update(request $request, $id)
    {
        $nama = $request->input('nama');
        $kelurahan = $request->input('kelurahan');
        $nik = $request->input('nik');
        $no_kk = $request->input('no_kk');
        $alamat = $request->input('alamat');
        $kecamatan = $request->input('kecamatan');
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');

        $user = User::where('id', $id)->first();
        $user->nama = $nama;
        $user->kelurahan = $kelurahan;
        $user->nik = $nik;
        $user->no_kk = $no_kk;
        $user->alamat = $alamat;
        $user->kecamatan = $kecamatan;
        $user->latitude = $latitude;
        $user->longitude = $longitude;

        //!Respons Message
        if ($user->save()) {
            $res['message'] = "Success!";
            $res['value'] = "$user";
            return response($res);
        } else {
            $res['message'] = "Failed!";
            return response($res);
        }
    }

    public function delete($id)
    {
        $user = User::find($id);

        if ($user->delete()) {
            $res['message'] = "Success!";
            $res['value'] = "$user";
            return response($res);
        } else {
            $res['message'] = "Failed!";
            return response($res);
        }
    }
}
