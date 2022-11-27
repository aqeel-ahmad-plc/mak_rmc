<?php

namespace App\Models;
use CodeIgniter\Model;

class Load_Test_model extends Model
{
    protected $table = 'load_test';
    protected $primaryKey = 'sno';
    protected $allowedFields = [
                                'rpm_load',
                                'torque',
                                'shaft_power',
                                'loading_factor',
                                'motor_size_load',
                                'voltage_a',
                                'voltage_b',
                                'voltage_c',
                                'averge_voltage',
                                'voltage_ab',
                                'voltage_bc',
                                'voltage_ca',
                                'averge_voltage_phase_to_phase',
                                'current_a',
                                'current_b',
                                'current_c',
                                'total_current',
                                'pf_a',
                                'pf_b',
                                'pf_c',
                                'average_pf',
                                'power_a',
                                'power_b',
                                'power_c',
                                'average_power',
                                'frequency',
                                'amb_temperature',
                                'motor_temperature',
                                'estimated_efficiency',
                                'motor_test_fk'
                              ];

      public function getLatestRecord(){
        $query = $this->db->query("SELECT * FROM load_test ORDER BY sno DESC LIMIT 1");
        $result = $query->getResultArray();
        return $result;
      }
      public function getLoadTestData($test_id = null)
      {
         $query = $this->builder()->select()->where(['motor_test_fk' => $test_id])->get();
         return $query->getResultArray();
      }
      public function countLoadTestData($test_id = null)
      {
         $query = $this->builder()->select("count(*) as count_load_test_record")->where(['motor_test_fk' => $test_id])->get();
         return $query->getResultArray();
      }
}
