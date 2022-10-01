<?php
namespace App\Validation;
use App\Models\Auth_model;

class AuthRules
{

  public function validateUser(string $str, string $fields, array $data){
    $model = new Auth_model();
    $user = $model->where('email', $data['email'])
                  ->first();

    if(!$user)
      return false;

    return password_verify($data['password'], $user['password']);
  }
}