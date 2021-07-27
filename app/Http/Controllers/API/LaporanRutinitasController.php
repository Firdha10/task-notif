<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;

class LaporanRutinitasController extends BaseController
{
    public function getLaporanRutinitas(Request $request)
    {
        $laporan = LaporanRutinitas::with(['rutinitas'])
                    ->where('rutinutas_id', $request->get('rutinitas_id'))
                    ->get();

        return $this->sendResponse($laporan, 'Laporan Rutinitas berhasil diambil');
    }

    public function createLaporanRutinitas(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'keterangan' => 'required',
            'picturePath' => 'required',
            'status_laporan' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $input = $request->all();

        $rutinitas = Rutinitas::where('id',$request->rutinitas_id)->first();

        $laporan = LaporanRutinitas::create($input);

        $success['id'] = $laporan->id;
        $success['rutinitas_id'] = $rutinitas->id;
        $success['nama_rutinitas'] = $rutinitas->nama_rutinitas;
        $success['keterangan'] = $laporan->keterangan;
        $success['picturePath'] = $laporan->picturePath;
        $success['status_laporan'] = $laporan->status_laporan;

        return $this->sendResponse($success, 'Data Berhasil Ditambahkan');
    }

    public function updateLaporanRutinitasSelesai(Request $request, $id)
    {
        $laporan = LaporanRutinitas::findOrFail($id);
        
        $laporan->update([
            'keterangan' => $request['keterangan'],
            'picturePath' => $request['picturePath'],
            'status_laporan' => 'Selesai',
        ]);

        if ($laporan) {
            return $this->sendResponse($laporan,'Laporan berhasil diperbarui');
        }else{
            return 'false';
        }
    }

    public function updateLaporanRutinitas(Request $request, $id)
    {
        $laporan = LaporanRutinitas::findOrFail($id);
        
        $laporan->update([
            'keterangan' => $request['keterangan'],
            'picturePath' => $request['picturePath'],
            'status_laporan' => $request['status_laporan'],
        ]);

        if ($laporan) {
            return $this->sendResponse($laporan,'Laporan berhasil diperbarui');
        }else{
            return 'false';
        }
    }
    
    
}
