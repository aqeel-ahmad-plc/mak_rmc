<?php
namespace App\Models;

use CodeIgniter\Model;

class Handing_Taking_model extends Model
{
    protected $table            = 'handing_taking_data';
    protected $primaryKey       = 'sno';
    protected $allowedFields    = [
                                    'handing_over_date',
                                    'handed_over_by',
                                    'take_over_by',
                                    'beneficiary_cnic',
                                    'beneficiary_pic_pv_module',
                                    'beneficiary_pic_inverter',
                                    'beneficiary_pic_fan_lights',
                                    'handing_over_certificate',
                                    'site_id'
                                  ];

    public function getHandingTakings($site_id = null)
    {
        if (!$site_id) 
        {
             $query = $this->builder()->select('sites.site_id as siteid, sites.masgid, sites.tehsil, sites.district, sites.na_pk, handing_taking_data.*')->join('sites', 'sites.id = handing_taking_data.site_id')->get();
             return $query->getResultArray();
        }

        $query = $this->builder()->select('sites.site_id as siteid, sites.masgid, sites.tehsil, sites.district, sites.na_pk, handing_taking_data.*')->join('sites', 'sites.id = handing_taking_data.site_id')->where(['handing_taking_data.site_id' => $site_id])->get();
        return $query->getResultArray();

    }

    public function updateHandingTaking($site_id, $data)
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
