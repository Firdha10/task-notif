<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;

class TugasProjectController extends BaseController
{
    public function getAllTugasProject()
    {
        $tugasProject = TugasProject::with(['member_project', 'project'])
                    ->get();

        return $this->sendResponse($tugasProject, 'tugasProject berhasil diambil');
    }

    public function getTugasProjectByStatus(Request $request)
    {
        $tugasProject = TugasProject::with(['member_project', 'project'])
                        ->where('status_tugas', $request->get('status_tugas'))
                    ->get();

        return $this->sendResponse($tugasProject, 'tugasProject berhasil diambil');
    } 

    // public function createTugasProject(Type $var = null)
    // {
    //     $validator = Validator::make($request->all(),[
    //         'nama_tugas' => 'required',
    //         'stat' => 'required',
    //         'jam' => 'required',
    //         'tanggal_mulai' => 'required',
    //         'tanggal_akhir' => 'required',
    //         'status_tugas' => 'required'
    //     ]);

    //     if($validator->fails()){
    //         return $this->sendError('Validation Error.', $validator->errors());       
    //     }

    //     $input = $request->all();


    //     $tugasProject = TugasProject::create($input);

        

    //     return $this->sendResponse($success, 'Data berhasil ditambah');
    // }

    public function updateStatusTugasProject(Request $request, $id)
    {
        $tugasProject = TugasProject::findOrFail($id);
        
        $tugasProject->update([
            'status_project' => $request['status_project'],
        ]);

        if ($tugasProject) {
            return $this->sendResponse($tugasProject,'Laporan berhasil diperbarui');
        }else{
            return 'false';
        }
    }

    public function deleteTugasProject($id)
    {
        TugasProject::destroy($id);

        $tugasProject = TugasProject::all();
        
        return $this->sendResponse(
            $tugasProject,
            'Data list Project berhasil diambil'
        );
    }
}
