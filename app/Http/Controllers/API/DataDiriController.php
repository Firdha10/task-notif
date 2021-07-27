<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;

class DataDiriController extends BaseController
{
   public function getDataDiri(Request $request)
   {
        $dataDiri = DataDiri::with(['user'])
                    ->where('user_id', $request->get('user_id'))
                    ->get();
        
        return $this->response($dataDiri, 'Data Diri Berhasil Diambil');
   }

   
}
