<?php

namespace App\Models;

use CodeIgniter\Model;

class VehicleModel extends Model
{
    protected $table = 'tb_kendaraan';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['nama', 'is_active', 'is_delete'];
}
