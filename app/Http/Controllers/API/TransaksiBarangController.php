<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;

class TransaksiBarangController extends BaseController
{
    public function getAllTransaksiBarang()
    {
        $transaksi = TransaksiBarang::all();

        return $this->sendResponse($transaksi, 'Data berhasil diambil');
    }

    public function getTransaksiBarangByProject(Request $request)
    {
        $transaksi = TransaksiBarang::with(['project_id'])
                        ->where('project_id', $request->get('project_id'))
                        ->get();

        return $this->sendResponse($transaksi, 'Data berhasil diambil');
    }

    public function getTransaksiBarangByStatus(Request $request)
    {
        $transaksi = TransaksiBarang::with(['project_id'])
                        ->where('status_project', $request->get('status_project'))
                        ->where('project_id', $request->get('project_id'))
                        ->get();

        return $this->sendResponse($transaksi, 'Data berhasil diambil');
    }

    public function createTransaksiBarang()
    {
        $validator = Validator::make($request->all(),[
            'kode_transaksi' => 'required',
            'tgl_transaksi' => 'required',
            'status_transaksi' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $input = $request->all();

        $project = Project::where('id',$request->project_id)->first();

        $transaksi = TransaksiBarang::create($input);

        $success['id'] = $transaksi->id;
        $success['kode_transaksi'] = $transaksi->kode_transaksi;
        $success['project_id'] = $project->id;
        $success['nama_project'] = $project->nama_project;
        $success['tgl_transaksi'] = $transaksi->tgl_transaksi;
        $success['status_transaksi'] = $transaksi->status_transaksi;
        
        return $this->sendResponse($success, 'Data berhasil ditambah');
    }
}
