<?php

namespace App\Models;

use CodeIgniter\Model;

class AuthModel extends Model
{
    protected $table = 'tb_user';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['email', 'pwd', 'nama', 'is_admin', 'is_delete'];
}
