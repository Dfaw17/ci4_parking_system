<?php

namespace App\Controllers;

use App\Models\AuthModel;
use CodeIgniter\Database\BaseBuilder;
use PSpell\Config;

class UserController extends BaseController
{
    protected $auth_model, $db, $auth_builder;
    public function __construct()
    {
        $this->auth_model = new AuthModel();

        $this->db = \Config\Database::connect();
        $this->auth_builder = $this->db->table('tb_user');
    }
    public function index()
    {
        $all_user = $this->auth_builder->where('is_delete', '0')->get()->getResult();
        $data = [
            'all_user' => $all_user
        ];
        return view('user/user_views', $data);
    }
    public function create()
    {
        return view('user/user_create_views');
    }
    public function save()
    {
        if (!$this->validate([
            'email' => 'required|valid_email|is_unique[tb_user.email]',
            'pwd' => 'required|min_length[8]',
            'nama' => 'required|min_length[8]',
            'is_admin' => 'required',
        ])) {
            session()->setFlashdata('err', $this->validator->listErrors());
            return redirect()->to('/users/create')->withInput();
        }
        $this->auth_model->save([
            'email' => $this->request->getVar('email'),
            'pwd' => $this->request->getVar('pwd'),
            'nama' => $this->request->getVar('nama'),
            'is_admin' => $this->request->getVar('is_admin'),
        ]);
        session()->setFlashdata('msg', 'Successfull Add Data User');
        return redirect()->to('/users');
    }
    public function delete($id)
    {
        $this->auth_model->save([
            'id' => $id,
            'is_delete' => 1
        ]);
        session()->setFlashdata('msg', 'Successfull Delete Data User');
        return redirect()->to('/users');
    }
    public function edit($id)
    {
        $detail = $this->auth_model->where(['id' => $id])->first();
        $data = [
            'detail' => $detail
        ];
        return view('user/user_edit_views', $data);
    }
    public function update($id)
    {
        if (!$this->validate([
            'pwd' => 'required|min_length[8]',
            'nama' => 'required|min_length[8]',
            'is_admin' => 'required',
        ])) {
            session()->setFlashdata('err', $this->validator->listErrors());
            return redirect()->to("/users/edit/$id")->withInput();
        }
        $this->auth_model->save([
            'id' => $id,
            'email' => $this->request->getVar('email'),
            'pwd' => $this->request->getVar('pwd'),
            'nama' => $this->request->getVar('nama'),
            'is_admin' => $this->request->getVar('is_admin'),
        ]);
        session()->setFlashdata('msg', 'Successfull Edit Data User');
        return redirect()->to('/users');
    }
}
