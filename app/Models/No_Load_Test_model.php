<?php

namespace App\Models;
use CodeIgniter\Model;

class No_Load_Test_model extends Model
{
    protected $table = 'no_load_test';
    protected $primaryKey = 'sno';
    protected $allowedFields = [
                                'rpm_no_load',
                                'torque',
                                'shaft_power',
                                'loading_factor',
                                'motor_size_no_load',
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
        $query = $this->db->query("SELECT * FROM no_load_test ORDER BY sno DESC LIMIT 1");
        $result = $query->getResultArray();
        return $result;
      }
}
