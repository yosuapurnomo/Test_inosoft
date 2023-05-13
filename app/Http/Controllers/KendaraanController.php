<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use App\Service\Kendaraan\KendaraanService;
use Illuminate\Http\Request;

class KendaraanController extends Controller
{
    protected $kendaraanService;

    public function __construct(KendaraanService $kendaraanService)
    {
        $this->kendaraanService = $kendaraanService;
        $this->middleware('auth:api');
    }

    public function SetModel(Kendaraan $model)
    {
        $this->kendaraanService->model = $model;
    }

    public function GetAll(Request $request)
    {
        $data = $this->kendaraanService->GetAll();
        return response()->json($data, $data['meta']['code']);
    }
    public function GetById(Request $request, $id)
    {
        $data = $this->kendaraanService->GetById($id);
        return response()->json($data, $data['meta']['code']);
    }
    public function Create(Request $request)
    {
        $data = $this->kendaraanService->Create($request);
        return response()->json($data, $data['meta']['code']);
    }
    public function Update(Request $request, $id)
    {
        $data = $this->kendaraanService->Update($request, $id);
        return response()->json($data, $data['meta']['code']);
    }
}
