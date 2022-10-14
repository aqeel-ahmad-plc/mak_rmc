<?php

namespace App\Models;
use CodeIgniter\Model;

class Torque_model extends Model
{
    protected $table = 'motor_torque';
    protected $primaryKey = 'sno';
    protected $allowedFields = [
                                'torque'
                              ];

      public function getLatestRecord(){
        $query = $this->db->query("SELECT * FROM motor_torque ORDER BY sno DESC LIMIT 1");
        $result = $query->getResultArray();
        return $result;
      }
}
