<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;

class BarangProjectController extends BaseController
{
    public function getBarangProject()
    {
        $barangProject = BarangProject::with(['barang_perusahaan', 'transaksi_barang'])
                            ->get();

        return $this->sendResponse($barangProject, 'Data Barang Project Berhasil Diambil');
    }

    public function createBarangProject(Request $request)
    {
        $input = $request->all();

        $barangPerusahaan = BarangPerusahaan::where('id',$request->barang_perusahaan_id)->first();
        $transaksiBarang = TransaksiBarang::where('id',$request->transaksi_barang_id)->first();

        $barangProject = BarangProject::create($input);

        $success['id'] = $barangProject->id;
        $success['barang_perusahaan_id'] = $barangPerusahaan->id;
        $success['nama_barang'] = $barangPerusahaan->nama_barang;
        $success['transaksi_barang_id'] = $transaksiBarang->id;
        $success['kode_transaksi'] = $transaksiBarang->kode_transaksi;
        $success['status_transaksi'] = $transaksiBarang->status_transaksi;

        return $this->sendResponse($success, 'Data Barang Project Berhasil ditambahkan');
    }

    public function deleteBarangProject($id)
    {
        BarangProject::destroy($id);

        $barangProject = BarangProject::with(['barang_perusahaan', 'transaksi_barang'])
                            ->get();
        
        return $this->sendResponse(
            $barangProject,
            'Data list Barang Project berhasil diambil'
        );
    }
}
