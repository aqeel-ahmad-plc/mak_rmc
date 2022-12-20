<?php namespace App\Models;

use CodeIgniter\Model;

class Motor_Test_model extends Model{
  protected $table          = 'motor_test';
  protected $primaryKey     = 'id';
  protected $allowedFields  = [
                                'test_report_no',
                                'test_date',
                                'hitachi_curve',
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


      public function getMotorTestData($test_id = null)
      {


       $query = $this->builder()->select()->where(['id' => $test_id])->get();
       return $query->getResultArray();


          // $query = $this->builder()->select('sites.site_id as siteid,sites.status as is_surveyed,sites.is_installed,sites.fat_status,sites.handing_taking_status, sites.masgid,sites.district,sites.tehsil,sites.na_pk,sites.package,sites.uc_vc_name_and_no, servey.*')->join('sites', 'sites.id = servey.site_id')->where(['servey.site_id' => $servey_id])->get();
          // return $query->getResultArray();

      }

      public function updateMotorRatedData($test_id, $data)
      {
          $this->where('id', $test_id)->update($this->test_id, $data);
      }

      //$servey_model->updateServey($this->request->getVar('site_id'), $newData);

      public function updateTestStatus($test_id, $data)
      {
          $this->where('id', $test_id)->update($this->test_id, $data);
      }
}
