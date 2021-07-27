<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

use App\Models\Perusahaan;

class PerusahaanController extends BaseController
{
    public function getAllPerusahaan()
    {
       $perusahaan = Perusahaan::all();

       return $this->sendResponse($perusahaan, 'Perusahaan Berhasil diambil');
    }

    public function createPerusahaan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_perusahaan' => 'required',
            'kontak_perusahaan' => 'required'
        ]);

        if($request->file('picture_path') == '') {
            $picture_path = NULL;
        } else {
            $file = $request->file('picture_path');
            $acak  = $file->getClientOriginalExtension();
            $fileName = rand(11111,99999).'-'.'.'.$acak; 
            $request->file('picture_path')->move("perusahaan", $fileName);

            $picture_path = $fileName;
        }

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        // $input = $request->all();

        $perusahaan = Perusahaan::create([
            'nama_perusahaan'=> $request->get('nama_perusahaan'),
            'picture_path' => $fileName,
            'kontak_perusahaan' => $request->get('kontak_perusahaan')
        ]);
        $success['id'] = $perusahaan->id;
        $success['nama_perusahaan'] =  $perusahaan->nama_perusahaan;
        $success['picture_path'] = $picture_path;
        $success['kontak_perusahaan'] = $perusahaan->kontak_perusahaan;

        return $this->sendResponse($success, 'Create Perusahaan Successfully.');
    }


    public function deletePerusahaan($id)
    {
        Perusahaan::destroy($id);

        $perusahaan = Perusahaan::all();
        
        return $this->sendResponse(
            $perusahaan,
            'Data list Perusahaan berhasil diambil'
        );
    }
}
