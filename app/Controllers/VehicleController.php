<?php

namespace App\Controllers;

use App\Models\PriceModel;
use App\Models\VehicleModel;

class VehicleController extends BaseController
{
    protected $db, $vehicle_model, $vehicle_builder, $price_model, $price_builder;
    public function __construct()
    {
        $this->vehicle_model = new VehicleModel();
        $this->price_model = new PriceModel();

        $this->db = \Config\Database::connect();
        $this->vehicle_builder = $this->db->table('tb_kendaraan');
        $this->price_builder = $this->db->table('tb_price');
    }
    public function index()
    {
        $all_vehicle = $this->vehicle_builder->where('is_delete', '0')->get()->getResult();
        $data = [
            'all_vehicle' => $all_vehicle
        ];
        return view('vehicle/vehicle_views', $data);
    }
    public function create()
    {
        return view('vehicle/vehicle_create_views');
    }
    public function save()
    {
        $cek = $this->vehicle_model->where(['nama' => $this->request->getVar('nama')])->first();
        if ($cek != null) {
            $vehicle_name = $cek['nama'];
            session()->setFlashdata('reactivate', $vehicle_name);
            return redirect()->to('/vehicle/create')->withInput();
        } else {
            if (!$this->validate([
                'nama' => 'required|min_length[2]',
                'is_active' => 'required',
            ])) {
                session()->setFlashdata('err', $this->validator->listErrors());
                return redirect()->to('/vehicle/create')->withInput();
            }
            $this->vehicle_model->save([
                'nama' => $this->request->getVar('nama'),
                'is_active' => $this->request->getVar('is_active'),
            ]);

            $new_vehicle = $this->vehicle_model->where(['nama' => $this->request->getVar('nama')])->first()['id'];
            $this->price_model->save([
                'vehicle_id' => $new_vehicle,
                'is_active' => '1'
            ]);
            session()->setFlashdata('msg', 'Successfull Add Data vehicle');
            return redirect()->to('/vehicle');
        }
    }
    public function delete($id)
    {
        $this->vehicle_model->save([
            'id' => $id,
            'is_delete' => 1
        ]);

        $edit_price = $this->price_model->where(['vehicle_id' => $id])->first()['id'];
        $this->price_model->save([
            'id' => $edit_price,
            'is_active' => '0'
        ]);
        session()->setFlashdata('msg', 'Successfull Delete Data vehicle');
        return redirect()->to('/vehicle');
    }
    public function edit($id)
    {
        $detail = $this->vehicle_model->where(['id' => $id])->first();
        $data = [
            'detail' => $detail
        ];
        return view('vehicle/vehicle_edit_views', $data);
    }
    public function update($id)
    {
        $old_nama = $this->vehicle_model->select(['nama'])->where(['id' => $id])->first()['nama'];
        $new_nama = $this->request->getVar('nama');
        if ($old_nama == $new_nama) {
            $is_unique = '';
        } else {
            $is_unique =  '|is_unique[tb_kendaraan.nama]';
        }
        if (!$this->validate([
            'nama' => "required|min_length[2]$is_unique",
            'is_active' => 'required',
        ])) {
            session()->setFlashdata('err', $this->validator->listErrors());
            return redirect()->to("/vehicle/edit/$id")->withInput();
        }
        $this->vehicle_model->update($id, [
            'nama' => $this->request->getVar('nama'),
            'is_active' => $this->request->getVar('is_active'),
        ]);
        session()->setFlashdata('msg', 'Successfull Edit Data Vehicle');
        return redirect()->to('/vehicle');
    }
    public function reactivate($nama)
    {
        $cek = $this->vehicle_model->where(['nama' => $nama])->first()['id'];
        $this->vehicle_model->update($cek, [
            'is_delete' => 0,
        ]);

        $edit_price = $this->price_model->where(['vehicle_id' => $cek])->first()['id'];
        $this->price_model->save([
            'id' => $edit_price,
            'is_active' => '1'
        ]);
        session()->setFlashdata('msg', 'Successfull Re-activate Data Vehicle');
        return redirect()->to('/vehicle');
    }
}
