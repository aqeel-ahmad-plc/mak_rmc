<?php
namespace App\Models;

use CodeIgniter\Model;

class Sites_model extends Model
{
    protected $table            = 'sites';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['site_id','package','client','consultant','contractor','masgid','district','tehsil','uc_vc_name_and_no','na_pk','focal_person','contact','slug','status','is_installed','fat_status','handing_taking_status'];


    public function getSites($site_id = null)
    {
        if (!$site_id)
        {
            return $this->findAll();
        }

        return $this->asArray()
                    ->where(['site_id' => $site_id])
                    ->first();
    }

    public function getApprovedSites($site_id = null)
    {

        if (!$site_id) 
        {   
             $query = $this->builder()->select('sites.*, servey.address, servey.khatib_caretaker_name, servey.mounting_type, servey.supply_order_status')->join('servey', 'servey.site_id = sites.id')->where(['servey.status' => 1])->get();
             return $query->getResultArray();
        }

        $query = $this->builder()->select('sites.*, servey.address, servey.khatib_caretaker_name, servey.mounting_type, servey.supply_order_status')->join('servey', 'servey.site_id = sites.id')->where(['servey.site_id' => $site_id, 'servey.status' => 1])->get();
        return $query->getResultArray();
    }

    public function getSupplyOrdersGeneratedSites($site_id = null)
    {

        if (!$site_id) 
        {   
             $query = $this->builder()->select('sites.*, servey.address, servey.khatib_caretaker_name, servey.mounting_type')->join('servey', 'servey.site_id = sites.id')->join('supply_order', 'supply_order.site_id = sites.id')->where(['servey.status' => 1])->get();
             return $query->getResultArray();
        }

        $query = $this->builder()->select('sites.*, servey.address, servey.khatib_caretaker_name, servey.mounting_type')->join('servey', 'servey.site_id = sites.id')->join('supply_order', 'supply_order.site_id = sites.id')->where(['servey.site_id' => $site_id, 'servey.status' => 1])->get();
        return $query->getResultArray();
    }

    public function getInstalledSites($site_id = null)
    {

        if (!$site_id) 
        {   
             $query = $this->builder()->select('sites.*, servey.address, servey.khatib_caretaker_name, servey.mounting_type')->join('servey', 'servey.site_id = sites.id')->join('supply_order', 'supply_order.site_id = sites.id')->where(['sites.is_installed' => 1])->get();
             return $query->getResultArray();
        }

        $query = $this->builder()->select('sites.*, servey.address, servey.khatib_caretaker_name, servey.mounting_type')->join('servey', 'servey.site_id = sites.id')->join('supply_order', 'supply_order.site_id = sites.id')->where(['servey.site_id' => $site_id, 'sites.is_installed' => 1])->get();
        return $query->getResultArray();
    }

    public function getFatAcceptedSites($site_id = null)
    {

        if (!$site_id) 
        {   
             $query = $this->builder()->select('sites.*, servey.address, servey.khatib_caretaker_name, servey.mounting_type')->join('servey', 'servey.site_id = sites.id')->join('fat_data', 'fat_data.site_id = sites.id')->where(['sites.is_installed' => 1,'fat_data.fat_result' => 1])->get();
             return $query->getResultArray();
        }

        $query = $this->builder()->select('sites.*, servey.address, servey.khatib_caretaker_name, servey.mounting_type')->join('servey', 'servey.site_id = sites.id')->join('fat_data', 'fat_data.site_id = sites.id')->where(['servey.site_id' => $site_id, 'sites.is_installed' => 1,'fat_data.fat_result' => 1])->get();
        return $query->getResultArray();
    }

    public function updateSite($site_id, $data)
    {
      $this->where('site_id', $site_id)->update($this->id, $data);
    }

    public function updateSiteStatus($site_id, $data)
    {
        $this->set($data)->where('id', $site_id)->update();
    }

    public function deleteSite($site_id)
    {
      $this->where('site_id', $site_id)->delete();
    }

}
