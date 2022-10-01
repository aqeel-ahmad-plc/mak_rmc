<?php
namespace App\Models;

use CodeIgniter\Model;

class Supply_Order_model extends Model
{
    protected $table            = 'supply_order';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
                                    'pv_module_ulica_ul',
                                    'inverter_growatt_spf_5000lt_hvm',
                                    'lithium_battery_hresys_vhr_tl4875_lfp',
                                    'auto_voltage_stabilizer_6_kw',
                                    'mounting_rack_with_breakers_and_internal_wiring',
                                    'pv_mounting_structure_2m',
                                    'pole_mounted_pv_mounting_structure_4m',
                                    'ss_nut_and_bolt_with_two_washers_1030',
                                    'ss_nut_and_bolt_with_two_washers_825',
                                    'rawl_bolts_1075',
                                    'dc_cable_110_mm_sq_red',
                                    'dc_cable_110_mm_sq_black',
                                    'dc_cable_110_mm_sq_yellow',
                                    'mc4_y_branch_pair_2_pcs',
                                    'mc4_connector_pair_2_pcs',
                                    'hdpe_conduit_pipe_1_inch_dia',
                                    'hdpe_elbow_1_inch_dia',
                                    'hdpe_t_joint_1_inch',
                                    'copper_thimble_1610',
                                    'pvc_shroud_1610',
                                    'copper_earthing_rod_5_ft',
                                    'jubli_clamp_75_inch',
                                    'jubli_clamp_125_inch',
                                    'nylon_cable_tie_6_inch',
                                    'cable_tie_812_inch',
                                    'duct_patti_1625_mm_3_meter_long',
                                    'pvc_coated_gi_flexible_pipe_5_inch_dia',
                                    'ac_cable_729_red',
                                    'ac_cable_729_black',
                                    'ac_cable_736_red',
                                    'ac_cable_736_black',
                                    'e27_led_light_14_watt',
                                    'e27_led_light_holder',
                                    'ceiling_fan_40_watt',
                                    'switch_board_with_base_5p',
                                    'switch_board_with_base_2p',
                                    'on_off_switch',
                                    'fan_dimmer',
                                    'steel_nail_1_inch',
                                    'black_screw_sodani_125_inch',
                                    'rawal_plug',
                                    'black_screw_sodani_25_inch',
                                    'three_pin_plug',
                                    'inauguration_board',
                                    'site_id',
                                  ];


    public function getSupplyOrders($supply_order_id = null)
    {
        if (!$supply_order_id)
        {
             $query = $this->builder()->select('supply_order.*')->join('sites', 'sites.id = supply_order.site_id')->get();
             return $query->getResultArray();
        }

        $query = $this->builder()->select('supply_order.*')->join('sites', 'sites.id = supply_order.site_id')->where(['supply_order.site_id' => $supply_order_id])->get();
        return $query->getResultArray();
    }

    public function getSupplyOrder($supply_order_id)
    {
        if (!$supply_order_id)
        {
             return NULL;
        }

        $query = $this->builder()->select('supply_order.*')->where(['supply_order.site_id' => $supply_order_id])->get();
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

    public function deleteSupplyOrder($site_id)
    {
      	$this->where('site_id', $site_id)->delete();
    }

}
