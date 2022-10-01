<?php

namespace App\Models;
use CodeIgniter\Model;

class Stats_model extends Model
{
    protected $table = 'stats';
    protected $primaryKey = 'sno';
    protected $allowedFields = [
                                'voltage_a',
                                'voltage_b',
                                'voltage_c',
                                'voltage_ab',
                                'voltage_bc',
                                'voltage_ca',
                                'current_a',
                                'current_b',
                                'current_c',
                                'pf_a',
                                'pf_b',
                                'pf_c',
                                'power_a',
                                'power_b',
                                'power_c',
                                'frequency'
                              ];

      public function getLatestRecord(){
        $query = $this->db->query("SELECT * FROM stats ORDER BY sno DESC LIMIT 1");
        $result = $query->getResultArray();
        return $result;
      }
}
