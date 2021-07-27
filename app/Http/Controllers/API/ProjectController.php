<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;

class ProjectController extends BaseController
{
    public function getAllProject()
    {
       $project = Project::all();

       return $this->sendResponse($project, 'Project Berhasil diambil');
    }

    public function getProjectByStatusProject(Request $request)
    {
       $project = Project::where('status_project', $request->get('status_project'))
                            ->get();

       return $this->sendResponse($project, 'Project Berhasil diambil');
    }

    public function getProjectByStatusPengerjaan(Request $request)
    {
       $project = Project::where('status_pengerjaan', $request->get('status_pengerjaan'))
                            ->get();

       return $this->sendResponse($project, 'Project Berhasil diambil');
    }

    public function createProject(Request $request)
    {
        $validator = Validator::make($request->all(), [
           'nama_project' => 'required',
           'desc' => 'required',
           'long_desc' => 'required',
           'tanggal_mulai' => 'required',
           'tanggal_akhir' => 'required',
           'status_project' => 'required',
           'status_pengerjaan' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $input = $request->all();
        $perusahaan = Perusahaan::where('id',$request->perusahaan_id)->first();

        $project = Project::create($input);
        $success['id'] = $project->id;
        $success['nama_project'] =  $project->nama_project;
        $success['desc'] = $project->desc;
        $success['long_desc'] = $project->long_desc;
        $success['tanggal_mulai'] =  $project->tanggal_mulai;
        $success['tanggal_akhir'] = $project->tanggal_akhir;
        $success['perusahaan_id'] = $perusahaan->id;
        $success['nama_perusahaan'] = $perusahaan->nama_perusahaan;
        $success['status_project'] = $perusahaan->status_project;
        $success['status_pengerjaan'] = $perusahaan->status_pengerjaan;

        return $this->sendResponse($success, 'Create Perusahaan Successfully.');
    }

    public function updateStatusProject(Request $request, $id)
    {
        $project = Project::findOrFail($id);
        
        $project->update([
            'status_project' => $request['status_project'],
        ]);

        if ($project) {
            return $this->sendResponse($project,'Laporan berhasil diperbarui');
        }else{
            return 'false';
        }
    }

    public function deleteProject($id)
    {
        Project::destroy($id);

        $project = Project::all();
        
        return $this->sendResponse(
            $project,
            'Data list Project berhasil diambil'
        );
    }

}
