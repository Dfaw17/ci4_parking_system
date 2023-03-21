<?php

namespace App\Models;

use CodeIgniter\Model;

class PaymentModel extends Model
{
    protected $table = 'tb_pembayaran';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['nama', 'is_active', 'is_delete'];
}
