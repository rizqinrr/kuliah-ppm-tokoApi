<?php

namespace App\Controllers;
use App\Models\Member;
use App\Models\MLogin;
use App\Controllers\RestfulController;


class LoginController extends RestfulController {
  public function login() {
    $email = $this->request->getVar('email');
    $password = $this->request->getVar('password');

    $model = new Member();
    $member = $model->where(['email' => $email])->first();

    if (!$member) {
      return $this->responseHasil(400, false, "Email tidak terdaftar!");
    }
    if (!password_verify($password, $member['password'])) {
      return $this->responseHasil(400, false, "Password tidak valid!");
    }

    $login = new MLogin();
    $auth_key = $this->RandomString();
    $login->save([
      'member_id' => $member['id'],
      'auth_key' => $auth_key
    ]);
    $data = [
      'token' => $auth_key,
      'user' => ['id' => $member['id'], 'email' => $member['email']]
    ];
    return $this->responseHasil(200, true, $data);
  }

  private function RandomString($length=100) {
    $karakter = '012345678dssd9abcdefghijklmnopqrstuBCDEFGHIJKLMNOPQRSTUVWXYZ';
    $panjang_karakter = strlen($karakter);
    $str = '';
    for ($i = 0; $i < $length; $i++) {
      $str .= $karakter[rand(0, $panjang_karakter-1)];
    }
    return $str;
  }
}

