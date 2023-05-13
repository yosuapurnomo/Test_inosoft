<?php

namespace App\Repository;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Repository{
    public $model;

    public function SetModel(Model $model)
    {
        $this->model = $model;
    }

    public function GetAll()
    {
        return $this->model::all();
    }

    public function GetById(int $id)
    {
        return $this->model::get($id);
    }

    public function Create(Request $request)
    {
        $data = $this->model::create([
            "tahun"=>$request->tahun,
            "warna"=>$request->warna,
            "harga"=>$request->harga]);
        return $data;
    }

    public function Update(Request $request, int $id)
    {
        $data = $this->model::findOrFail($id);
        return $data->update($request->all());
    }

}