<?php

namespace App\Models;

use CodeIgniter\Model;

class PriceModel extends Model
{
    protected $table = 'tb_price';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['vehicle_id', 'first_price', 'roll_price', 'stay_price', 'max_price', 'lost_price', 'is_active'];
}
