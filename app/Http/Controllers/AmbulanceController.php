<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Model\Ambulance;
use Illuminate\Http\Response;

class AmbulanceController extends Controller
{
    // Menampilkan semua data ambulance
    public function index()
    {
        $ambulanceList = Ambulance::paginate(5);
        return  response()->json($ambulanceList, 200);
    }

    // menampilkan 1 user berdasarkan id
    public function showById($id)
    {
        $data = Ambulance::where('id', $id)->get();

        if (count($data) > 0) {             //mengecek apakah data kosong atau tidak
            $res['message'] = "Success!";
            $res['ambulance'] = $data;
            return response($res);
        } else {
            $res['message'] = "Data Not Found!";
            return response($res);
        }
    }

    // search ambulance advance
    public function cari($namaAmbulance)
    {
        $data = Ambulance::select("id", "namaAmbulance", "rumahSakit", "alamatAsalAmbulance", "jarakAmbulance","latitude", "longitude")
            ->where("namaAmbulance", "LIKE", "$namaAmbulance%")
            ->paginate();

        return response()->json($data);
    }

    // membuat data ambulance baru
    public function create(request $request)
    {
        $ambulance = new Ambulance;
        $ambulance->namaAmbulance = $request->namaAmbulance;
        $ambulance->rumahSakit = $request->rumahSakit;
        $ambulance->alamatAsalAmbulance = $request->alamatAsalAmbulance;
        $ambulance->jarakAmbulance = $request->jarakAmbulance;
        $ambulance->latitude = $request->latitude;
        $ambulance->longitude = $request->longitude;

        if ($ambulance->save()) {
            $res['message'] = "Success!";
            $res['ambulance'] = "$ambulance";
            return response($res);
        }
    }

    // mengubah data ambulance
    public function update(request $request, $id)
    {
        $namaAmbulance = $request->input('namaAmbulance');
        $rumahSakit = $request->input('rumahSakit');
        $alamatAsalAmbulance = $request->input('alamatAsalAmbulance');
        $jarakAmbulance = $request->input('jarakAmbulance');
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');

        $ambulance = Ambulance::where('id', $id)->first();
        $ambulance->namaAmbulance = $namaAmbulance;
        $ambulance->rumahSakit = $rumahSakit;
        $ambulance->alamatAsalAmbulance = $alamatAsalAmbulance;
        $ambulance->jarakAmbulance = $jarakAmbulance;
        $ambulance->latitude = $latitude;
        $ambulance->longitude = $longitude;

        //!Respons Message
        if ($ambulance->save()) {
            $res['message'] = "Success!";
            $res['value'] = "$ambulance";
            return response($res);
        } else {
            $res['message'] = "Failed!";
            return response($res);
        }
    }

    public function delete($id)
    {
        $ambulance = Ambulance::find($id);

        if ($ambulance->delete()) {
            $res['message'] = "Success!";
            $res['value'] = "$ambulance";
            return response($res);
        } else {
            $res['message'] = "Failed!";
            return response($res);
        }
    }
}
