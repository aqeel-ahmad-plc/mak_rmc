<?php
namespace App\Models;

use CodeIgniter\Model;

class Problematic_model extends Model
{
    protected $table            = 'servey';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
                                    'contractor_rep_name',
                                    'consultant_rep_name',
                                    'client_rep_name',
                                    'address',
                                    'gps_coordinates_n',
                                    'gps_coordinates_e',
                                    'khatib_caretaker_name',
                                    'khatib_caretaker_cnic',
                                    'khatib_caretaker_cell_no',
                                    'inverter_pv_modules_distance',
                                    'inverter_earth_distance',
                                    'inverter_mdb_distance',
                                    'roof_top_type',
                                    'no_of_stories',
                                    'mounting_type',
                                    'motor_hp',
                                    'motor_ampere',
                                    'motor_input_power',
                                    'motor_to_connect',
                                    'existing_no_of_fans',
                                    'existing_no_of_lights',
                                    'existing_wiring_type',
                                    'khatib_caretaker_pic_path',
                                    'site_sketch_pic_path',
                                    'roof_top_pic_01_path',
                                    'roof_top_pic_02_path',
                                    'mdb_pic_path',
                                    'inverter_placement_pic_path',
                                    'earth_point_pic_path',
                                    'motor_pic_path',
                                    'internal_wiring_pic_path',
                                    'optional_pic_01_path',
                                    'optional_pic_02_path',
                                    'optional_pic_03_path',
                                    'optional_pic_04_path',
                                    'optional_pic_05_path',
                                    'rep_group_pic_path',
                                    'line_voltage',
                                    'site_status',
                                    'problem_description',
                                    'site_feasibility',
                                    'remarks',
                                    'status',
                                    'supply_order_status',
                                    'site_id',
                                  ];

    public function getServeys($servey_id = null)
    {
        if (!$servey_id) 
        {
             $query = $this->builder()->select('sites.site_id as siteid, sites.masgid,sites.district,sites.na_pk, servey.*')->join('sites', 'sites.id = servey.site_id')->where(['servey.site_status' => 0])->get();
             return $query->getResultArray();
        }

        $query = $this->builder()->select('sites.site_id as siteid, sites.masgid,sites.district,sites.na_pk, servey.*')->join('sites', 'sites.id = servey.site_id')->where(['servey.site_id' => $servey_id])->get();
        return $query->getResultArray();

    }

    public function updateServey($site_id, $data)
    {
      	$this->where('site_id', $site_id)->update($this->id, $data);
    }

    public function updateServeyStatus($servey_id, $data)
    {
		  $this->set($data)->where('id', $servey_id)->update();

    }

    public function deleteSite($site_id)
    {
      	$this->where('site_id', $site_id)->delete();
    }

}
