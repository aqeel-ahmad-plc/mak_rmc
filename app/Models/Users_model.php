<?php namespace App\Models;

use CodeIgniter\Model;

class Users_model extends Model{
  protected $table          = 'users';
  protected $primaryKey     = 'id';
  protected $allowedFields  = ['firstname', 'lastname','username', 'email', 'password', 'phone', 'gender', 'role'];
  protected $beforeInsert   = ['beforeInsert'];
  protected $beforeUpdate   = ['beforeUpdate'];




  protected function beforeInsert(array $data){
    $data = $this->passwordHash($data);

    return $data;
  }

  protected function beforeUpdate(array $data){
    $data = $this->passwordHash($data);
    
    return $data;
  }

  protected function passwordHash(array $data){
    if(isset($data['data']['password']))
      $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);

    return $data;
  }

  public function getUsers($user_id = null)
  {
      if (!$user_id) {
          return $this->findAll();
      }
      
      return $this->asArray()
                  ->where(['id' => $user_id])
                  ->first();
  }
  
  public function updateUser($user_id, $data)
  {
    $this->update($user_id, $data);
  }

  public function deleteUser($user_id)
  {
    $this->delete($user_id);
  }

}