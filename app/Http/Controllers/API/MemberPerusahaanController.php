<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\MemberPerusahaan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class MemberPerusahaanController extends BaseController
{
    public function getMemberPerusahaan(Request $request)
    {
        $member = MemberPerusahaan::with(['user', 'perusahaan'])
                    ->where('user_id', Auth::user()->id)
                    ->where('perusahaan_id', $request->get('perusahaan_id'))
                    ->get();
        return $this->sendResponse($member, 'Data Member Berhasil diambil');
    }

    public function getAllMemberPerusahaan()
    {
        $member = MemberPerusahaan::with(['user', 'perusahaan'])
                    ->where('user_id', Auth::user()->id)
                    ->get();
        return $this->sendResponse($member, 'Data Member Berhasil diambil');
    }

    public function getTugasMember(Request $request)
    {
        // $member = MemberPerusahaan::with([ 'tasks'=> function($q){
        //     $q->where('statusTugas','Dikerjakan');
        // }])

        $tugas = MemberPerusahaan::with([ 'rutinitas', 'user', 'perusahaan'])
                ->where('user_id', Auth::user()->id)
                ->where('perusahaan_id', $request->get('perusahaan_id'))
                ->first();

        return $this->sendResponseMember(
            $tugas, 'Data List Member Perusahaan berhasil diambil'
        );
    }

    public function createMemberPerusahaan(Request $request)
    {
        $validator = Validator::make($request->all(),[
           'type_user' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $input = $request->all();

        $perusahaan = Perusahaan::where('id',$request->perusahaan_id)->first();
        $user = User::where('id',$request->user_id)->first();

        $member = MemberPerusahaan::create($input);

        $success['id'] = $member->id;
        $success['perusahaan_id'] = $perusahaan->id;
        $success['nama_perusahaan'] = $perusahaan->nama_perusahaan;
        $success['user_id'] = $user->id;
        $success['name'] = $user->name;
        $success['type_user'] = $member->type_user;

        return $this->sendResponse($success, 'Data berhasil ditambah ');
    }

    public function deleteMemberPerusahaan($id)
    {
        MemberPerusahaan::destroy($id);

        $member = MemberPerusahaan::with(['perusahaan', 'user'])
                            ->get();
        
        return $this->sendResponse(
            $member,
            'Data list Member Perusahaan berhasil diambil'
        );
    }
}
