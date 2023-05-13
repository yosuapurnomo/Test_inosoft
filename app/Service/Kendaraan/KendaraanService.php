<?php

namespace App\Service\Kendaraan;

use App\Helper\ResponseFormatter;
use App\Models\Kendaraan;
use App\Repository\KendaraanRepository;
use Exception;
use Illuminate\Http\Request;

class KendaraanService{
    protected $kendaraanModel;
    public Kendaraan $model;

    public function __construct(KendaraanRepository $kendaraan)
    {
        $this->kendaraanModel = $kendaraan;
        $this->kendaraanModel->SetModel($this->model);
    }

    public function FunctionName(Type $var = null)
    {
        # code...
    }

    public function GetAll()
    {
        try {
            return ResponseFormatter::success(data:$this->kendaraanModel->GetAll(), message:"Get All Success");
        } catch (Exception $e) {
            return ResponseFormatter::error(message:"Get All Error", code:500);
        }
        
    }

    public function GetById(int $id)
    {
        try {
            return ResponseFormatter::success(data:$this->kendaraanModel->GetById($id), message:"Get By Id Success");
        } catch (Exception $e) {
            return ResponseFormatter::error(message:"Get By Id Error", code:500);
        }
    }
    public function Create(Request $request)
    {
        try {
            $request->validate([
                "tahun"=> "integer|required",
                "warna"=> "string|required",
                "harga"=> "integer|required"
            ]);
            $data = $this->kendaraanModel->Create($request);
            dd($data);
            return ResponseFormatter::success(data:$data, message:"Kendaraan Create Success");
        } catch (Exception $e) {
            return ResponseFormatter::error(message:"Kendaraan not Create", code:500);
        }
    }
    public function Update(Request $request, int $id)
    {
        try {
            $request->validate([
                "tahun"=> "integer|required",
                "warna"=>"string|required",
                "harga"=>"integer|required"
            ]);
            return ResponseFormatter::success(data:$this->kendaraanModel->Update($request, $id), message:"Kendaraan Create Success");
        } catch (Exception $e) {
            return ResponseFormatter::error(message:"Kendaraan not Create", code:500);
        }
    }
}