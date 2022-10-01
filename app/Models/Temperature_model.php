<?php

namespace App\Models;
use CodeIgniter\Model;

class Temperature_model extends Model
{
    protected $table = 'temperature';
    protected $primaryKey = 'sno';
    protected $allowedFields = [
                                'amb_temperature',
                                'motor_temperature'
                              ];

      public function getLatestRecord(){
        $query = $this->db->query("SELECT * FROM temperature ORDER BY sno DESC LIMIT 1");
        $result = $query->getResultArray();
        return $result;
      }
}
