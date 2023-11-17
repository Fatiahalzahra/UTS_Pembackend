<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasiencovid;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class PasiencovidController extends Controller
{
    public function index(){
         # menggunakan model Pasien untuk select data
		$pasiencovid = Pasiencovid::all();

		if (!empty($pasiencovid)) {
			$response = [
				'message' => 'Menampilkan Data Semua Pasien Covid',
				'data' => $pasiencovid,
			];
			return response()->json($response, 200);
		} else {
			$response = [
				'message' => 'Data is empty'
			];
			return response()->json($response, 200);
		}
    }

        #Menampilkan seluruh data Pasien
    public function store(Request $request) 
	{

		 $input = [
		 	'name' => $request->name,
		 	'id_pasien' => $request->id_pasien,
             'jenis_kelamin' => $request->jenis_kelamin,
		 	'alamat' => $request->alamat,
		 	'no_handphone' => $request->no_handphone
		 ];

		 $validateData = $request->validate([
			'name' => 'required',
		 	'id_pasien' => 'numeric|required',
            'jenis_kelamin' => 'required',
		 	'alamat' => 'required',
		 	'no_handphone' => 'numeric|required'
		 ]);

		$pasiencovid = Pasiencovid::create($request->all());

		$response = [
			'message' => 'Data Pasien Covid Berhasil Dibuat',
			'data' => $pasiencovid,
		];
        return response()->json($response, 201);
	}

    #Melihat data pasien
	public function show($id)
	{
		$pasiencovid = Pasiencovid::get($id);

		if ($pasiencovid) {
			$response = [
				'message' => 'Get detail Pasien ovid',
				'data' => $pasiencovid
			];
	
			return response()->json($response, 200);
		} else {
			$response = [
				'message' => 'Data not found'
			];
			
			return response()->json($response, 404);
		}
	}

         #Mengupdate data pasien
	public function update(Request $request, $id)
	{
		$pasiencovid = Pasiencovid::find($id);

        if (!$pasiencovid) {
            $data = [
                'message' => 'Pasien covid not found'
            ];

            return response()->json($data, 404);
        }
    

        $input = [
            'name' => $request->name ?? $pasiencovid->name,
            'id_pasien' => $request->id_pasien ?? $pasiencovid->id_pasien,
            'jenis_kelamin' => $request->jenis_kelamin ?? $pasiencovid->jenis_kelamin,
            'alamat' => $request->alamat ?? $pasiencovid->alamat,
            'no_handphone' => $request->no_handphone ?? $pasiencovid->no_handphone
        ];

        $pasiencovid->update($input);
        $data = [
            'message' => 'Pasien successfully edited',
            'data' => $pasiencovid
        ];

        return response()->json($data, 200);
	    
    }

    #Menghapus data pasien 
	public function destroy($id)
	{
		$pasiencovid = Pasiencovid::find($id);

		if ($pasiencovid) {
			$response = [
				'message' => 'Pasien is delete',
				'data' => $pasiencovid->delete()
			];

			return response()->json($response, 200); 
		} else {
			$response = [
				'message' => 'Data not found'
			];

			return response()->json($response, 404);
		}
	}


    #Mencari data pasien covid
	public function search_data_pasien($id)
	{
		$pasiencovid = Pasiencovid::find($id);

		if ($pasiencovid) {
			$response = [
				'message' => 'Get searched resource',
				'data' => 'menampilkan seluruh data yang di cari'
			];

			return response()->json($response, 200); 
		} else {
			$response = [
				'message' => 'resource not found'
			];

			return response()->json($response, 404);
		}
	}


    #Mencari data pasien yang positif covid
	public function positive(Request $request){
		#Mencari data pasien 
		$input = [
			'name' => $request->name,
			'id_pasien' => $request->id_pasien,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
            'no_handphone' => $request->no_handphone
		];
		#Menampilkan data pasien yang positif covid
        $pasiencovid = Pasiencovid::get($request->all());

		$response = [
			'message' => 'Get positive pasien',
			'data' => $pasiencovid,
            'jumlah' => Hash::make($request->jumlah)
		];
		#Mengister response JSON
		return response()->json($response, 200);
	}


    #Mencari data pasien yang sembuh dari covid
    public function recovered(Request $request){
		#Mencari data pasien
		$input = [
			'name' => $request->name,
			'id_pasien' => $request->id_pasien,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
            'no_handphone' => $request->no_handphone
			
		];
		#Menampilkan data pasien yang sembuh
		$pasiencovid = Pasiencovid::get($request->all());

		$response = [
			'message' => 'Get recorvered pasien',
			'data' => $pasiencovid,
            'jumlah' => Hash::make($request->jumlah)
		];
        #Mengister response JSON
		return response()->json($response, 200);
	}


    #Mencari data pasien yang meninggal 
    public function dead(Request $request){
		#Mencari data pasien
		$input = [
			'name' => $request->name,
			'id_pasien' => $request->id_pasien,
            'jenis_kelamin' => $request->jenis_kelamin,
		 	'alamat' => $request->alamat,
		 	'no_handphone' => $request->no_handphone
			
		];
        #menampilkan data pasien yang meninggal
		$pasiencovid = Pasiencovid::get($request->all());

		$response = [
			'message' => 'Get dead pasien',
			'data' => $pasiencovid,
            'jumlah' => Hash::make($request->jumlah)
		];
        #Mengister response JSON
		return response()->json($response, 200);
	}
}
