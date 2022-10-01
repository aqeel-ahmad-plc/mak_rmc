<?php
namespace App\Models;

use CodeIgniter\Model;

class Fat_model extends Model
{
    protected $table            = 'fat_data';
    protected $primaryKey       = 'sno';
    protected $allowedFields    = [
                                    'final_testing_date',
                                    'contractor_rep_name',
                                    'consultant_rep_name',
                                    'client_rep_name',
                                    'fat_result',
                                    'reason_of_rejection',
                                    'reason_of_rejection_pic_1',
                                    'reason_of_rejection_pic_2',
                                    'fat_report_pic',
                                    'pv_module_pic',
                                    'storage_inverter_module_pic',
                                    'earthing_pic',
                                    'lights_pic',
                                    'fans_pic',
                                    'distribution_board_pic',
                                    'dc_wiring_pic',
                                    'ac_wiring_pic',
                                    'testing_pic_1',
                                    'testing_pic_2',
                                    'testing_pic_3',
                                    'rep_group_pic',
                                    'site_id'
                                  ];

    public function getFats($site_id = null)
    {
        if (!$site_id) 
        {
             $query = $this->builder()->select('sites.site_id as siteid, sites.masgid, sites.district,sites.tehsil, sites.na_pk, fat_data.*')->join('sites', 'sites.id = fat_data.site_id')->get();
             return $query->getResultArray();
        }

        $query = $this->builder()->select('sites.site_id as siteid, sites.masgid, sites.district,sites.tehsil, sites.na_pk, fat_data.*')->join('sites', 'sites.id = fat_data.site_id')->where(['fat_data.site_id' => $site_id])->get();
        return $query->getResultArray();

    }

    public function updateFat($site_id, $data)
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
