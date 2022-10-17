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
                                'motor_sno',
                                'motor_pic',
                                'specified_temp',
                                'winding_resistance',
                                'temp_at_which_winding_resistance_measured',
                                'rated_curves',
                                'rated_curves_flag',
                                'test_description',
                                'test_status'
                              ];

      public function getMotorTest()
      {
          return $this->findAll();
      }

      //$servey_model->updateServey($this->request->getVar('site_id'), $newData);

      public function updateTestStatus($test_id, $data)
      {
          $this->where('id', $test_id)->update($this->test_id, $data);
      }
}
