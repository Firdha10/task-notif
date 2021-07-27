<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use Validator;

class BarangPerusahaanController extends BaseController
{

    public function getAllDataBarang()
    {
        $barang = BarangPerusahaan::with(['perusahaan'])
                    ->get();

        return $this->sendResponse($barang, 'Data list Barang Perusahaan berhasil diambil');
    }

    public function getBarang(Request $request)
    {
        $barang = BarangPerusahaan::with(['perusahaan'])
                    ->where('perusahaan_id', $request->get('perusahaan_id'))
                    ->get();

        return $this->sendResponse(
            $barang,
            'Data list Barang Perusahaan berhasil diambil'
        );
    }

    public function createBarang(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'nama_barang' => 'required',
            'stok_barang' => 'required',
            'jenis_barang' => 'required',
            'status_barang' => 'required',
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        if($request->file('picture_path') == '') {
            $picture_path = NULL;
        } else {
            $file = $request->file('picture_path');
            $acak  = $file->getClientOriginalExtension();
            $fileName = rand(11111,99999).'-'.'.'.$acak; 
            $request->file('picture_path')->move("barang_perusahaan", $fileName);
        }

        $input = $request->all();

        $perusahaan = Perusahaan::where('id',$request->perusahaan_id)->first();

        $barang = BarangPerusahaan::create([
            'nama_barang' => $request->get('nama_barang'),
            'stok_barang' => $request->get('stok_barang'),
            'jenis_barang' => $request->get('jenis_barang'),
            'status_barang' => $request->get('status_barang'),
            'picture_path' => $fileName,
            'perusahaan_id' => $request->get('perusahaan_id')
        ]);

        $success['id'] = $barang->id;
        $success['nama_barang'] = $barang->nama_barang;
        $success['stok_barang'] = $barang->stok_barang;
        $success['jenis_barang'] = $barang->jenis_barang;
        $success['status_barang'] = $barang->status_barang;
        $success['picture_path'] = $picture_path;
        $success['perusahaan_id'] = $perusahaan->id;
        $success['namaPerusahaan'] = $perusahaan->namaPerusahaan;
        
        return $this->sendResponse($success, 'Create Barang Perusahaan Successfully.');
    }

    public function updateBarang(Request $request, $id)
    {
        $reqdata = $request->all(); 

        $barang = BarangPerusahaan::findOrFail($id);
        
        $barang->update([
            'stok_barang' => $request['stok_barang'],
            'status_barang' => $request['status_barang']
        ]);

        if ($barang) {
            return $this->sendResponse($barang,'Barang berhasil diperbarui');
        }else{
            return 'false';
        }
    }

    public function deleteBarang($id)
    {
        BarangPerusahaan::destroy($id);

        $barang = BarangPerusahaan::with(['perusahaan'])
                    ->where('perusahaan_id', $request->get('perusahaan_id'))
                    ->get();
        
        return $this->sendResponse(
            $barang,
            'Data list Barang Perusahaan berhasil diambil'
        );
    }

}
