<?php namespace App\Models;

use CodeIgniter\Model;

class Motor_Test_model extends Model{
  protected $table          = 'motor_test';
  protected $primaryKey     = 'id';
  protected $allowedFields  = [
                                'test_report_no',
                                'test_date',
                                'motor_manufacturer',
                                'motor_model',
                                'motor_type',
                                'stator_size',
                                'number_of_phase',
                                'motor_rated_kw',
                                'motor_rated_hp',
                                'motor_rated_voltage',
                                'motor_rated_frequency',
                                'motor_rated_current',
                                'motor_rated_pf',
                                'motor_rated_rpm',
                                'no_of_poles',
                                'efficiency',
                                'service_factor',
                                'insulation_class',
                                'cooling_class',
                                'ip_rating',
                                'connection_type',
                                'motor_sno'
                              ];
}
