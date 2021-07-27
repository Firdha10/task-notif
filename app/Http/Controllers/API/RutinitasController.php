<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;

class RutinitasController extends BaseController
{
    public function getAllRutinitas()
    {
        $rutinitas = Rutinitas::with(['member_perusahaan'])
                    ->get();

        return $this->sendResponse($rutinitas, 'Rutinitas berhasil diambil');
    }

    public function getRutinitasByStatus(Request $request)
    {
        $rutinitas = Rutinitas::with(['member_perusahaan'])
                        ->where('status_rutinitas', $request->get('status_rutinitas'))
                    ->get();

        return $this->sendResponse($rutinitas, 'Rutinitas berhasil diambil');
    } 

    public function createRutinitas(Type $var = null)
    {
        $validator = Validator::make($request->all(),[
            'nama_rutinitas' => 'required',
            'stat' => 'required',
            'jam' => 'required',
            'tanggal_mulai' => 'required',
            'tanggal_akhir' => 'required',
            'status_rutinitas' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $input = $request->all();

        $memberPerusahaan = MemberPerusahaan::with(['user', 'perusahaan'])
                                ->where('id',$request->member_perusahaan_id)
                                ->get();

        $rutinitas = Rutinitas::create($input);

        $success['id'] = $rutinitas->id;
        $success['nama_rutinitas'] = $rutinitas->nama_rutinitas;
        $success['stat'] = $rutinitas->stat;
        $success['jam'] = $rutinitas->jam;
        $success['tanggal_mulai'] = $rutinitas->tanggal_mulai;
        $success['tanggal_akhir'] = $rutinitas->tanggal_akhir;
        $success['member_perusahaan_id'] = $memberPerusahaan->id;
        $success['name'] = $memberPerusahaan->user->name;
        $success['nama_perusahaan'] = $memberPerusahaan->perusahaan->nama_perusahaan;
        $success['status_rutinitas'] = $rutinitas->status_rutinitas;

        return $this->sendResponse($success, 'Data berhasil ditambah');
    }

    public function updateStatusRutinitas(Request $request, $id)
    {
        $rutinitas = Rutinitas::findOrFail($id);
        
        $rutinitas->update([
            'status_project' => $request['status_project'],
        ]);

        if ($rutinitas) {
            return $this->sendResponse($rutinitas,'Laporan berhasil diperbarui');
        }else{
            return 'false';
        }
    }

    public function deleteRutinitas($id)
    {
        Rutinitas::destroy($id);

        $rutinitas = Rutinitas::all();
        
        return $this->sendResponse(
            $rutinitas,
            'Data list Project berhasil diambil'
        );
    }

    
}
