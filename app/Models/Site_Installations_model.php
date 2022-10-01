<?php
namespace App\Models;

use CodeIgniter\Model;

class Site_Installations_model extends Model
{
    protected $table            = 'installation_data';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
                                    'start_date',
                                    'finish_date',
                                    'installer_id',
                                    'installer_name',
                                    'motor_connection',
                                    'pv_module_01_sno',
                                    'pv_module_02_sno',
                                    'pv_module_03_sno',
                                    'pv_module_04_sno',
                                    'inverter_sno',
                                    'battery_sno',
                                    'pv_module_pic',
                                    'storage_inverter_module_pic',
                                    'earthing_pic',
                                    'lights_pic',
                                    'fans_pic',
                                    'distribution_board_pic',
                                    'dc_wiring_pic',
                                    'ac_wiring_pic',
                                    'optional_pic_1',
                                    'optional_pic_2',
                                    'optional_pic_3',
                                    'optional_pic_4',
                                    'optional_pic_5',
                                    'site_id'
                                  ];

    public function getSiteInstallations($site_id = null)
    {
        if (!$site_id) 
        {
             $query = $this->builder()->select('sites.site_id as siteid,sites.is_installed, sites.masgid, sites.na_pk,sites.district,sites.tehsil,sites.package,sites.uc_vc_name_and_no, installation_data.*')->join('sites', 'sites.id = installation_data.site_id')->get();
             return $query->getResultArray();
        }

        $query = $this->builder()->select('sites.site_id as siteid,sites.is_installed, sites.masgid, sites.na_pk,sites.district,sites.tehsil,sites.package,sites.uc_vc_name_and_no, installation_data.*')->join('sites', 'sites.id = installation_data.site_id')->where(['installation_data.site_id' => $site_id])->get();
        return $query->getResultArray();

    }

    public function updateSiteInstallation($site_id, $data)
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
