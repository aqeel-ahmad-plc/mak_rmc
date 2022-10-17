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
        $query = $this->db->query("SELECT * FROM `motor_torque` INNER JOIN motor_rpm on motor_rpm.sno=motor_torque.sno ORDER BY motor_rpm.sno DESC LIMIT 1");
        $result = $query->getResultArray();
        return $result;
      }
}
