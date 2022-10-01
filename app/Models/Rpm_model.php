<?php

namespace App\Models;
use CodeIgniter\Model;

class Rpm_model extends Model
{
    protected $table = 'motor_rpm';
    protected $primaryKey = 'sno';
    protected $allowedFields = [
                                'rpm'
                              ];

      public function getLatestRecord(){
        $query = $this->db->query("SELECT * FROM motor_rpm ORDER BY sno DESC LIMIT 1");
        $result = $query->getResultArray();
        return $result;
      }
}
