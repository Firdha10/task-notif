<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;

class MemberProjectController extends BaseController
{
    public function getAllMemberProject()
    {
        $memberProject = MemberProject::with(['project', 'member_perusahaan'])
                            ->get();
        return $this->sendResponse($memberProject, 'Data Member Project Berhasil diambil');
    }
    
    public function getMemberByProject(Request $request)
    {
        $memberProject = MemberProject::with(['project', 'member_perusahaan'])
                            ->where('project_id', $request->get('project_id'))
                            ->get();
        return $this->sendResponse($memberProject, 'Data Member Project Berhasil diambil');
    }

    public function createMemberProject(Request $request){
        $validator = Validator::make($request->all(),[
            'type_member' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $input = $request->all();

        $memberPerusahaan = MemberPerusahaan::with(['perusahaan', 'user'])
                                ->where('id',$request->member_perusahaan_id)
                                ->first();

        $project = Project::where('id',$request->project_id)->first();

        $memberProject = MemberProject::create($input);

        $success['id'] = $memberProject->id;
        $success['member_perusahaan_id'] = $memberPerusahaan->id;
        $success['name'] = $memberPerusahaan->user->name;
        $success['nama_perusahaan'] = $memberPerusahaan->perusahaan->nama_perusahaan;
        $success['project_id'] = $project->id;
        $success['nama_project'] = $project->nama_project;
        $success['type_member'] = $memberProject->type_member;

        return $this->sendResponse($success, 'Data Berhasil Ditambahkan');
        
    }

    public function deleteMemberProject($id)
    {
        MemberProject::destroy($id);

        $memberProject = MemberProject::with(['member_perusahaan', 'user'])
                            ->get();
        
        return $this->sendResponse(
            $memberProject,
            'Data list Member Project berhasil diambil'
        );
    }
}
