<?php

namespace App\Controllers;

use App\Models\PaymentModel;

class PaymentController extends BaseController
{
    protected $payment_model, $db, $payment_builder;
    public function __construct()
    {
        $this->payment_model = new PaymentModel();

        $this->db = \Config\Database::connect();
        $this->payment_builder = $this->db->table('tb_pembayaran');
    }
    public function index()
    {
        $all_payment = $this->payment_builder->where('is_delete', '0')->get()->getResult();
        $data = [
            'all_payment' => $all_payment
        ];
        return view('payment/payment_views', $data);
    }
    public function create()
    {
        return view('payment/payment_create_views');
    }
    public function save()
    {
        if (!$this->validate([
            'nama' => 'required|min_length[2]|is_unique[tb_pembayaran.nama]',
            'is_active' => 'required',
        ])) {
            session()->setFlashdata('err', $this->validator->listErrors());
            return redirect()->to('/payment/create')->withInput();
        }
        $this->payment_model->save([
            'nama' => $this->request->getVar('nama'),
            'is_active' => $this->request->getVar('is_active'),
        ]);
        session()->setFlashdata('msg', 'Successfull Add Data Payment');
        return redirect()->to('/payment');
    }
    public function delete($id)
    {
        $this->payment_model->save([
            'id' => $id,
            'is_delete' => 1
        ]);
        session()->setFlashdata('msg', 'Successfull Delete Data Payment');
        return redirect()->to('/payment');
    }
    public function edit($id)
    {
        $detail = $this->payment_model->where(['id' => $id])->first();
        $data = [
            'detail' => $detail
        ];
        return view('payment/payment_edit_views', $data);
    }
    public function update($id)
    {
        $old_nama = $this->payment_model->select(['nama'])->where(['id' => $id])->first()['nama'];
        $new_nama = $this->request->getVar('nama');
        if ($old_nama == $new_nama) {
            $is_unique = '';
        } else {
            $is_unique =  '|is_unique[tb_pembayaran.nama]';
        }
        if (!$this->validate([
            'nama' => "required|min_length[2]$is_unique",
            'is_active' => 'required',
        ])) {
            session()->setFlashdata('err', $this->validator->listErrors());
            return redirect()->to("/payment/edit/$id")->withInput();
        }
        $this->payment_model->update($id, [
            'nama' => $this->request->getVar('nama'),
            'is_active' => $this->request->getVar('is_active'),
        ]);
        session()->setFlashdata('msg', 'Successfull Edit Data Payment');
        return redirect()->to('/payment');
    }
}
