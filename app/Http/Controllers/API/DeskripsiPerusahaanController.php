<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;

class DeskripsiPerusahaanController extends BaseController
{
    public function getDeskripsi(Request $request)
    {
        $deskripsi = DeskripsiPerusahaan::with(['perusahaan'])
                        ->where('perusahaan_id', $request->get('perusahaan_id'))
                        ->get();

        return $this->sendResponse($deskripsi, 'Data Deskripsi Perusahaan Berhasil diambil');

    }

    public function createDeskripsi(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'judul_deskripsi' => 'required',
            'isi_deskripsi' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $input = $request->all();

        $perusahaan = Perusahaan::where('id',$request->perusahaan_id)->first();

        $deskripsi = DeskripsiPerusahaan::create($input);

        $success['id'] = $deskripsi->id;
        $success['judul_deskripsi'] = $deskripsi->judul_deskripsi;
        $success['isi_dekskrispi'] = $deskripsi->isi_deskripsi;
        $success['perusahaan_id'] = $perusahaan->id;
        $success['nama_perusahaan'] = $perusahaan->nama_perusahaan;

        return $this->response($success, 'Data Deskripsi Perusahaan berhasil ditambahkan');

    }

    public function updateDeskripsi(Request $request, $id)
    {
        $deskripsi = DeskripsiPerusahaan::findOrFail($id);
        
        $deskripsi->update([
            'judul_deskripsi' => $request['judul_deskripsi'],
            'isi_deskripsi' => $request['isi_deskripsi']
        ]);

        if ($deskripsi) {
            return $this->sendResponse($deskripsi,'Deskripsi berhasil diperbarui');
        }else{
            return 'false';
        }
    }

    public function deleteDeskripsi($id)
    {
        DeskripsiPerusahaan::destroy($id);

        $deskripsi = DeskripsiPerusahaan::with(['perusahaan'])
                    ->where('perusahaan_id', $request->get('perusahaan_id'))
                    ->get();
        
        return $this->sendResponse(
            $deskripsi,
            'Data list Deskripsi Perusahaan berhasil diambil'
        );
    }

}
