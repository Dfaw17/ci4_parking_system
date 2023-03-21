<?php

namespace App\Controllers;

use App\Models\AuthModel;
use App\Models\PaymentModel;
use App\Models\VehicleModel;

class HomeController extends BaseController
{
    protected $db, $auth_model, $auth_builder, $payment_model, $payment_builder, $vehicle_model, $vehicle_builder;
    public function __construct()
    {
        $this->db = \Config\Database::connect();

        $this->auth_model = new AuthModel();
        $this->auth_builder = $this->db->table('tb_user');

        $this->payment_model = new PaymentModel();
        $this->payment_builder = $this->db->table('tb_pembayaran');

        $this->vehicle_model = new VehicleModel();
        $this->vehicle_builder = $this->db->table('tb_kendaraan');
    }

    public function login_page()
    {
        return view('login_views');
    }

    public function login()
    {
        $session = \Config\Services::session();
        $get_email = $this->request->getVar('email');
        $get_pwd = $this->request->getVar('pwd');
        $cek_user = $this->auth_model->where(['email' => $get_email])->first();
        if ($cek_user == null) {
            session()->setFlashdata('err', 'Login failed, user not found');
            $views = '/login';
        } elseif ($cek_user['pwd'] != $get_pwd) {
            session()->setFlashdata('err', 'Login failed, email and password not match');
            $views = '/login';
        } else {
            $session->set("expired_time", time() + 60 * 60);
            $session->set("nama", $cek_user['nama']);
            $session->set("is_admin", $cek_user['is_admin']);
            $views = '/';
        }
        return redirect()->to($views);
    }

    public function logout()
    {
        $session = \Config\Services::session();
        $session->remove('expired_time');
        return redirect()->to('/login');
    }

    public function index()
    {
        if ($this->is_logged_in()) {
            $session = \Config\Services::session();
            $total_user = $this->auth_builder->selectCount('id')->where('is_delete', '0')->get()->getResult();
            $total_pembayaran = $this->payment_builder->selectCount('id')->where('is_delete', '0')->get()->getResult();
            $total_kendaraan = $this->vehicle_builder->selectCount('id')->where('is_delete', '0')->get()->getResult();

            $now = time();
            $expired_session = $session->get('expired_time');

            $data = [
                'total_user' => $total_user,
                'total_pembayaran' => $total_pembayaran,
                'total_kendaraan' => $total_kendaraan,
                'now' => $now,
                'expired_session' => $expired_session,
            ];
            $views = 'home_views';
        } else {
            $data = [];
            $views = 'login_views';
        }
        return view($views, $data);
    }
}
