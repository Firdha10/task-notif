<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;

class FileProjectController extends BaseController
{
    public function getFileProject(Request $request)
    {
        $file = FileProject::with(['project'])
                    ->where('project_id', $request->get('project_id'))
                    ->get();

        return $this->sendResponse($file, 'Data File Project Ditambahkan');
    }

    public function createFileProject(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'file' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $input = $request->all();

        $project = Project::where('id',$request->project_id)->first();

        $file = FileProject::create($input);

        $success['id'] = $file->id;
        $success['file'] = $file->file;
        $success['project_id'] = $project->id;
        $success['nama_project'] = $project->nama_project;

        return $this->sendResponse($success, 'Data File Project berhasil ditambahkan');
    }

    public function deleteFileProject($id)
    {
        FileProject::destroy($id);
        
        $file = FileProject::with(['project'])
                ->get();

        return $this->sendResponse($file, 'Data File Project Ditambahkan');
    }
}
