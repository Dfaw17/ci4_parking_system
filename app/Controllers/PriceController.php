<?php

namespace App\Controllers;

use App\Models\PriceModel;

class PriceController extends BaseController
{
    protected $db, $price_model, $price_builder, $vehicle_model, $vehicle_builder;
    public function __construct()
    {
        $this->price_model = new PriceModel();

        $this->db = \Config\Database::connect();
        $this->price_builder = $this->db->table('tb_price');
    }
    public function index()
    {
        $this->price_builder->select('*');
        $this->price_builder->where('tb_price.is_active', '1');
        $this->price_builder->join('tb_kendaraan', 'tb_kendaraan.id = tb_price.vehicle_id');
        $all_price = $this->price_builder->get()->getResult();
        $data = [
            'all_price' => $all_price
        ];
        return view('price/price_views', $data);
    }
}
