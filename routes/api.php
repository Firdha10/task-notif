<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BarangController;
use App\Http\Controllers\API\BarangPerusahaanController;
use App\Http\Controllers\API\BarangProjectController;
use App\Http\Controllers\API\DataDiriController;
use App\Http\Controllers\API\DeskripsiController;
use App\Http\Controllers\API\FileProjectController;
use App\Http\Controllers\API\LaporanRutinitasController;
use App\Http\Controllers\API\MemberPerusahaanController;
use App\Http\Controllers\API\PerusahaanController;
use App\Http\Controllers\API\ProjectController;
use App\Http\Controllers\API\RutinitasController;
use App\Http\Controllers\API\TransaksiBarangController;
use App\Http\Controllers\API\TugasProjectController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => ['auth:api']], function(){
    //User
    Route::post('user', [AuthController::class,'updateProfile']);
    Route::get('user/detail', [AuthController::class,'fetch']);
    Route::post('user/photo', [AuthController::class,'updatePhoto']);
    Route::post('logout', [AuthController::class,'logout']);

    //BarangPerusahaan
    Route::get('barang', [BarangPerusahaanController::class,'getAllDataBarang']);
    Route::get('barang-perusahaan', [BarangPerusahanController::class, 'getBarang']);
    Route::post('tambahBarang', [BarangPerusahaanController::class, 'createBarang']);
    Route::patch('updateBarang/{id}', [BarangPerusahaanController::class, 'updateBarang']);
    Route::delete('hapus-barang/{id}', [BarangPerusahaanController::class, 'deleteBarang']);

    //BarangProject
    Route::get('barang-project', [BarangProjectController::class, 'getBarangProject']);
    Route::post('tambah-barang-project', [BarangProjectController::class, 'createBarangProject']);
    Route::delete('hapus-barang-project/{id}', [BarangProjectController::class, 'deleteBarangProject']);

    //DataDiri
    Route::get('user/profile', [DataDiriController::class, 'getDataDiri']);

    //DeskripsiPerusahaan
    Route::get('deskripsi-perusahaan', [DeskripsiPerusahaanController::class, 'getDeskripsi']);
    Route::post('tambah-deskripsi', [DeskripsiPerusahaanController::class, 'createDeskripsi']);
    Route::patch('update-deskripsi/{id}', [DeskripsiPerusahaanController::class, 'updateDeskripsi']);
    Route::delete('hapus-deskripsi/{id}', [DeskripsiPerusahaanController::class, 'deleteDeskripsi']);

    //fileProject
    Route::get('file-project', [FileProjectController::class, 'getFileProject']);
    Route::post('tambah-file', [FileProjectController::class, 'createFileProject']);
    Route::patch('hapus-file/{id}', [FileProjectController::class, 'deleteFileProject']);

    //LaporanRutinitas
    Route::get('laporan-rutinitas', [LaporanRutinitasController::class, 'getLaporanRutinitas']);
    Route::post('tambah-laporan', [LaporanRutinitasController::class, 'createLaporanRutinitas']);
    Route::patch('update-status-selesai/{id}', [LaporanRutinitasController::class, 'updateLaporanRutinitasSelesai']);
    Route::patch('update-status/{id}', [LaporanRutinitasController::class, 'updateLaporanRutinitas']);

    //MemberPerusahaan
    Route::get('member-perusahaan', [MemberPerusahaanController::class, 'getTugasMember']);
    Route::get('all-member-perusahaan', [MemberPerusahaanController::class, 'getAllMemberPerusahaan']);
    Route::get('tugas-member', [MemberPerusahaanController::class, 'getTugasPerusahaan']);
    Route::post('tambah-member', [MemberPerusahaanController::class, 'createMemberPerusahaan']);
    Route::delete('hapus-member/{id}', [MemberPerusahaanController::class, 'deleteMemberPerusahaan']);

    //MemberProject
    Route::get('all-member-project', [MemberProjectController::class, 'getAllMemberProject']);
    Route::get('member-project', [MemberProjectController::class, 'getMemberByProject']);
    Route::post('tambah-member-project', [MemberProjectController::class, 'createMemberProject']);
    Route::delete('hapus-member-project/{id}', [MemberProjectController::class, 'deleteMemberProject']);

    //Perusahaan
    Route::get('perusahaan', [PerusahaanController::class, 'getAllPerusahaan']);
    Route::post('tambah-perusahaan', [PerusahaanController::class, 'createPerusahaan']);
    Route::delete('hapus-perusahaan/{id}', [PerusahaanController::class, 'deletePerusahaan']);

    //Project
    Route::get('project', [ProjectController::class, 'getAllProject']);
    Route::get('project/status-project', [ProjectController::class, 'getProjectByStatusProject']);
    Route::get('project/status-pengerjaan', [ProjectController::class, 'getProjectByStatusPengerjaan']);
    Route::post('tambah-project', [ProjectController::class, 'createProject']);
    Route::patch('update-status-project/{id}', [ProjectController::class, 'updateStatusProject']);
    Route::delete('hapus-project/{id}', [ProjectController::class, 'deleteProject']);

    //Rutinitas
    Route::get('rutinitas', [RutinitasController::class, 'getAllRutinitas']);
    Route::get('rutinitas/status',[RutinitasController::class, 'getRutinitasByStatus']);
    Route::post('tambah-rutinitas', [RutinitasController::class, 'createRutinitas']);
    Route::patch('update-status-rutinitas/{id}', [RutinitasController::class, 'updateStatusRutinitas']);
    Route::delete('hapus-rutinitas/{id}', [RutinitasController::class, 'deleteRutinitas']);

    //Transaksi
    Route::get('transaksi-barang', [TransaksiBarangController::class, 'getAllTransaksiBarang']);
    Route::get('transaksi-barang/project', [TransaksiBarangController::class, 'getTransaksiBarangByProject']);
    Route::get('transaksi-barang/status', [TransaksiBarangController::class, 'getTransaksiBarangByStatus']);
    Route::post('tambah-transaksi-barang', [TransaksiBarangController::class, 'createTransaksiBarang']);
   
    //TugasProject
    


    
});

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);