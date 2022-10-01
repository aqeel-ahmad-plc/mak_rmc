<div class="container">
    <h3 class="mt-3">Site Survey Data
        <a href="" data-toggle="collapse" data-target="#demo">
            <i class="fas fa-caret-square-up" aria-hidden="true"></i>
        </a>
    </h3>
    <div id="demo" class="collapse in show">
        <table class="table table-striped table-bordered" style="width:100%">
            <tbody>
                <tr>
                    <td class="font-weight-bold">Site ID:</td>
                    <td><?= $servey[0]['siteid']; ?></td>
                    <td class="font-weight-bold">Masjid Name:</td>
                    <td><?= $servey[0]['masgid']; ?></td>
                </tr>
                <tr>
                    <td class="font-weight-bold">Contractor Rep. Name</td>
                    <td><?= $servey[0]['contractor_rep_name']; ?></td>
                    <td class="font-weight-bold">Consultant Rep. Name</td>
                    <td><?= $servey[0]['consultant_rep_name']; ?></td>
                </tr>
                <tr>
                    <td class="font-weight-bold">Client Rep. Name</td>
                    <td><?= $servey[0]['client_rep_name']; ?></td>
                    <td class="font-weight-bold">Address</td>
                    <td><?= $servey[0]['address']; ?></td>
                </tr>
                <tr>
                    <td class="font-weight-bold">GPS Coordinates (N)</td>
                    <td><?= $servey[0]['gps_coordinates_n']; ?></td>
                    <td class="font-weight-bold">GPS Coordinates (E)</td>
                    <td><?= $servey[0]['gps_coordinates_e']; ?></td>
                </tr>
                <tr>
                    <td class="font-weight-bold">Khatib/ Caretaker Name</td>
                    <td><?= $servey[0]['khatib_caretaker_name']; ?></td>
                    <td class="font-weight-bold">Khatib/ Caretaker CNIC</td>
                    <td><?= $servey[0]['khatib_caretaker_cnic']; ?></td>
                </tr>
                <tr>
                    <td class="font-weight-bold">Khatib/ Caretaker Cell No</td>
                    <td><?= $servey[0]['khatib_caretaker_cell_no']; ?></td>
                    <td class="font-weight-bold">Distance Between Inverter & PV Modules (ft.)</td>
                    <td><?= $servey[0]['inverter_pv_modules_distance']; ?></td>
                </tr>
                <tr>
                    <td class="font-weight-bold">Distance Between Inverter & Earth (ft.)</td>
                    <td><?= $servey[0]['inverter_earth_distance']; ?></td>
                    <td class="font-weight-bold">Distance Between Inverter & MDB (ft.)</td>
                    <td><?= $servey[0]['inverter_mdb_distance']; ?></td>
                </tr>
                <tr>
                    <td class="font-weight-bold">Roof Top Type</td>
                    <td>
                        <?php if($servey[0]['roof_top_type'] == 0):?>
                        <?= "Bare RCC" ?>
                        <?php elseif($servey[0]['roof_top_type'] == 1):?>
                        <?= "RCC with Brick Lining" ?>
                        <?php elseif($servey[0]['roof_top_type'] == 2):?>
                        <?= "Mud/ Choka" ?>
                        <?php endif?>
                    </td>
                    <td class="font-weight-bold">No. of Stories</td>
                    <td><?= $servey[0]['no_of_stories']; ?></td>
                </tr>
                <tr>
                    <td class="font-weight-bold">Mounting Type</td>
                    <td>
                        <?php if($servey[0]['mounting_type'] == 0):?>
                        <?= "Rooftop Anchored" ?>
                        <?php elseif($servey[0]['mounting_type'] == 1):?>
                        <?= "Rooftop Foundation" ?>
                        <?php elseif($servey[0]['mounting_type'] == 2):?>
                        <?= "Ground Fixed" ?>
                        <?php elseif($servey[0]['mounting_type'] == 3):?>
                        <?= "Ground Pole Mounted" ?>
                        <?php endif?>
                    </td>
                    <td class="font-weight-bold">Motor HP</td>
                    <td><?= $servey[0]['motor_hp']; ?></td>
                </tr>
                <tr>
                    <td class="font-weight-bold">Motor Ampere (A)</td>
                    <td><?= $servey[0]['motor_ampere']; ?></td>
                    <td class="font-weight-bold">Motor Input Power (W)</td>
                    <td><?= $servey[0]['motor_input_power']; ?></td>
                </tr>
                <tr>
                    <td class="font-weight-bold">Motor to Connect</td>
                    <td>
                        <?php if($servey[0]['motor_to_connect'] == 0):?>
                        <?= "No" ?>
                        <?php elseif($servey[0]['motor_to_connect'] == 1):?>
                        <?= "Yes" ?>
                        <?php endif?>
                    </td>
                    <td class="font-weight-bold">Existing Nos. of Fans</td>
                    <td><?= $servey[0]['existing_no_of_fans']; ?></td>
                </tr>
                <tr>
                    <td class="font-weight-bold">Existing Nos. of Lights</td>
                    <td><?= $servey[0]['existing_no_of_lights']; ?></td>
                    <td class="font-weight-bold">Existing Wiring Type</td>
                    <td>
                        <?php if($servey[0]['existing_wiring_type'] == 0):?>
                        <?= "Concealed" ?>
                        <?php elseif($servey[0]['existing_wiring_type'] == 1):?>
                        <?= "Open" ?>
                        <?php endif?>
                    </td>
                </tr>
                <tr>
                    <td class="font-weight-bold">Line Voltage</td>
                    <td><?= $servey[0]['line_voltage']; ?></td>
                    <td class="font-weight-bold">Site Feasibility</td>
                    <td>
                        <?php if($servey[0]['site_feasibility'] == 0):?>
                        <?= "No" ?>
                        <?php elseif($servey[0]['site_feasibility'] == 1):?>
                        <?= "Yes" ?>
                        <?php endif?>
                    </td>
                </tr>
                <tr>
                    <td class="font-weight-bold">Status of Site</td>
                    <td>
                        <?php if($servey[0]['site_status'] == 0):?>
                        <?= "Problematic" ?>
                        <?php elseif($servey[0]['site_status'] == 1):?>
                        <?= "Ready" ?>
                        <?php endif?>
                    </td>
                    <td class="font-weight-bold">Problem Description</td>
                    <td><?= $servey[0]['problem_description']; ?></td>
                </tr>
                <tr>
                    <td class="font-weight-bold">Remarks</td>
                    <td><?= $servey[0]['remarks']; ?></td>
                </tr>
            </tbody>
        </table>
    </div>

    <h3 class="mt-3">Supply Order</h3>
    <div>
        <form action="<?php echo base_url()."/supply_order/create/".$servey[0]['site_id']?>" method="post" enctype="multipart/form-data">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="pv_module_ulica_ul">PV MODULE ULICA UL-445M-144</label>
                    <input type="text" class="form-control" name="pv_module_ulica_ul" id="pv_module_ulica_ul" value="4"
                        placeholder="Enter PV MODULE ULICA UL-445M-144" readonly>
                </div>
                <div class="form-group col-md-6">
                    <label for="inverter_growatt_spf_5000lt_hvm">INVERTER GROWATT SPF 5000TL - HVM</label>
                    <input type="text" class="form-control" name="inverter_growatt_spf_5000lt_hvm"
                        id="inverter_growatt_spf_5000lt_hvm" value="1" placeholder="Enter INVERTER GROWATT SPF 5000TL - HVM"
                        readonly>
                </div>
                <div class="form-group col-md-6">
                    <label for="lithium_battery_hresys_vhr_tl4875_lfp">LITHIUM BATTER HRESYS VHR TL4875LFP</label>
                    <input type="text" class="form-control" name="lithium_battery_hresys_vhr_tl4875_lfp"
                        id="lithium_battery_hresys_vhr_tl4875_lfp" value="1" placeholder="Enter LITHIUM BATTER HRESYS VHR TL4875LFP"
                        readonly>
                </div>
                <div class="form-group col-md-6">
                    <label for="auto_voltage_stabilizer_6_kw">AUTO VOLTAGE STABILIZER 6.0KW</label>
                    <input type="text" class="form-control" name="auto_voltage_stabilizer_6_kw"
                        id="auto_voltage_stabilizer_6_kw" value="1" placeholder="Enter AUTO VOLTAGE STABILIZER 6.0KW"
                        readonly>
                </div>
                <div class="form-group col-md-6">
                    <label for="mounting_rack_with_breakers_and_internal_wiring">MOUNTING RACK WITH BREAKERS AND INTERNAL WIRING</label>
                    <input type="text" class="form-control" name="mounting_rack_with_breakers_and_internal_wiring"
                        id="mounting_rack_with_breakers_and_internal_wiring" value="1" placeholder="Enter MOUNTING RACK WITH BREAKERS AND INTERNAL WIRING"
                        readonly>
                </div>
                <?php if($servey[0]['mounting_type'] != 3):
                            $display = "block";
                            $value   = "2";
                ?>
                <?php else:
                            $display = "none";
                            $value   = "";
                ?>

                <?php endif?>
                <div class="form-group col-md-6" style="display: <?= $display ?>;">
                    <label for="pv_mounting_structure_2m">PV MOUNTING STRUCTURE 2M</label>
                    <input type="text" class="form-control" name="pv_mounting_structure_2m"
                        id="pv_mounting_structure_2m" value="<?= $value ?>" placeholder="Enter PV MOUNTING STRUCTURE 2M"
                        readonly>
                </div>
                <?php if($servey[0]['mounting_type'] == 3):
                            $display = "block";
                            $value   = "1";
                ?>
                <?php else:
                            $display = "none";
                            $value   = "";
                ?>

                <?php endif?>
                <div class="form-group col-md-6" style="display: <?= $display ?>;">
                    <label for="pole_mounted_pv_mounting_structure_4m">POLE MOUNTED PV MOUNTING STRUCTURE 4M</label>
                    <input type="text" class="form-control" name="pole_mounted_pv_mounting_structure_4m"
                        id="pole_mounted_pv_mounting_structure_4m" value="<?= $value ?>"
                        placeholder="Enter POLE MOUNTED PV MOUNTING STRUCTURE 4M" readonly>
                </div>
                <?php if($servey[0]['mounting_type'] != 3):
                            $display = "block";
                            $value   = "14";
                ?>
                <?php else:
                            $display = "none";
                            $value   = "";
                ?>

                <?php endif?>
                <div class="form-group col-md-6" style="display: <?= $display ?>;">
                    <label for="ss_nut_and_bolt_with_two_washers_1030">SS NUT & BOLT WITH 02 WASHERS 10 X 30</label>
                    <input type="text" class="form-control" name="ss_nut_and_bolt_with_two_washers_1030"
                        id="ss_nut_and_bolt_with_two_washers_1030" value="<?= $value ?>"
                        placeholder="Enter SS NUT & BOLT WITH 02 WASHERS 10 X 30" readonly>
                </div>
                <div class="form-group col-md-6">
                    <label for="ss_nut_and_bolt_with_two_washers_825">SS NUT & BOLT WITH 02 WASHERS 8 X 25</label>
                    <input type="text" class="form-control" name="ss_nut_and_bolt_with_two_washers_825"
                        id="ss_nut_and_bolt_with_two_washers_825" value="18"
                        placeholder="Enter SS NUT & BOLT WITH 02 WASHERS 8 X 25" readonly>
                </div>
                <?php if($servey[0]['mounting_type'] != 3):
                            $display = "block";
                            $value   = "18";
                ?>
                <?php else:
                            $display = "none";
                            $value   = "";
                ?>

                <?php endif?>
                <div class="form-group col-md-6" style="display: <?= $display ?>;">
                    <label for="rawl_bolts_1075">RAWL BOLTS 10 X 75</label>
                    <input type="text" class="form-control" name="rawl_bolts_1075" id="rawl_bolts_1075"
                        value="<?= $value ?>" placeholder="Enter RAWL BOLTS 10 X 75" readonly>
                </div>
                <div class="form-group col-md-6">
                    <label for="dc_cable_110_mm_sq_red">DC CABLE 1 X 10 MM.SQ. (RED)</label>
                    <input type="text" class="form-control" name="dc_cable_110_mm_sq_red" id="dc_cable_110_mm_sq_red"
                        value="<?= set_value('dc_cable_110_mm_sq_red') ?>"
                        placeholder="Enter DC CABLE 1 X 10 MM.SQ. (RED)">
                </div>
                <div class="form-group col-md-6">
                    <label for="dc_cable_110_mm_sq_black">DC CABLE 1 X 10 MM.SQ. (BLACK)</label>
                    <input type="text" class="form-control" name="dc_cable_110_mm_sq_black"
                        id="dc_cable_110_mm_sq_black" value="<?= set_value('dc_cable_110_mm_sq_black') ?>"
                        placeholder="Enter DC CABLE 1 X 10 MM.SQ. (BLACK)">
                </div>
                <div class="form-group col-md-6">
                    <label for="dc_cable_110_mm_sq_yellow">DC CABLE 1 X 10 MM.SQ. (YELLOW)</label>
                    <input type="text" class="form-control" name="dc_cable_110_mm_sq_yellow"
                        id="dc_cable_110_mm_sq_yellow" value="<?= set_value('dc_cable_110_mm_sq_yellow') ?>"
                        placeholder="Enter DC CABLE 1 X 10 MM.SQ. (YELLOW)">
                </div>
                <div class="form-group col-md-6">
                    <label for="mc4_y_branch_pair_2_pcs">MC4 Y-BRANCH PAIR (2 PCS)</label>
                    <input type="text" class="form-control" name="mc4_y_branch_pair_2_pcs" id="mc4_y_branch_pair_2_pcs"
                        value="1" placeholder="Enter MC4 Y-BRANCH PAIR (2 PCS)" readonly>
                </div>
                <div class="form-group col-md-6">
                    <label for="mc4_connector_pair_2_pcs">MC4 CONNECTOR PAIR (2 PCS)</label>
                    <input type="text" class="form-control" name="mc4_connector_pair_2_pcs"
                        id="mc4_connector_pair_2_pcs" value="1" placeholder="Enter MC4 CONNECTOR PAIR (2 PCS)" readonly>
                </div>
                <div class="form-group col-md-6">
                    <label for="hdpe_conduit_pipe_1_inch_dia">HDPE CONDUIT PIPE 1-INCH DIA.</label>
                    <input type="text" class="form-control" name="hdpe_conduit_pipe_1_inch_dia"
                        id="hdpe_conduit_pipe_1_inch_dia" value="<?= set_value('hdpe_conduit_pipe_1_inch_dia') ?>"
                        placeholder="Enter HDPE CONDUIT PIPE 1-INCH DIA.">
                </div>
                <div class="form-group col-md-6">
                    <label for="hdpe_elbow_1_inch_dia">HDPE ELBOW 1-INCH DIA.</label>
                    <input type="text" class="form-control" name="hdpe_elbow_1_inch_dia" id="hdpe_elbow_1_inch_dia"
                        value="6" placeholder="Enter HDPE ELBOW 1-INCH DIA." readonly>
                </div>
                <div class="form-group col-md-6">
                    <label for="hdpe_t_joint_1_inch">HDPE T-JOINT 1-INCH</label>
                    <input type="text" class="form-control" name="hdpe_t_joint_1_inch" id="hdpe_t_joint_1_inch"
                        value="1" placeholder="Enter HDPE T-JOINT 1-INCH" readonly>
                </div>
                <div class="form-group col-md-6">
                    <label for="copper_thimble_1610">COPPER THIMBLE 16 X 10</label>
                    <input type="text" class="form-control" name="copper_thimble_1610" id="copper_thimble_1610"
                        value="7" placeholder="Enter COPPER THIMBLE 16 X 10" readonly>
                </div>
                <div class="form-group col-md-6">
                    <label for="pvc_shroud_1610">PVC SHROUD 16 X 10</label>
                    <input type="text" class="form-control" name="pvc_shroud_1610" id="pvc_shroud_1610" value="7"
                        placeholder="Enter PVC SHROUD 16 X 10" readonly>
                </div>
                <div class="form-group col-md-6">
                    <label for="copper_earthing_rod_5_ft">COPPER EARTHING ROD 5FT</label>
                    <input type="text" class="form-control" name="copper_earthing_rod_5_ft"
                        id="copper_earthing_rod_5_ft" value="1" placeholder="Enter COPPER EARTHING ROD 5FT" readonly>
                </div>
                <div class="form-group col-md-6">
                    <label for="jubli_clamp_75_inch">Earthing Rod CLAMP</label>
                    <input type="text" class="form-control" name="jubli_clamp_75_inch" id="jubli_clamp_75_inch"
                        value="1" placeholder="Enter JUBLI CLAMP 0.75-INCH" readonly>
                </div>
                <div class="form-group col-md-6">
                    <label for="jubli_clamp_125_inch">JUBLI CLAMP 1.25-INCH</label>
                    <input type="text" class="form-control" name="jubli_clamp_125_inch" id="jubli_clamp_125_inch"
                        value="18" placeholder="Enter JUBLI CLAMP 1.25-INCH" readonly>
                </div>
                <div class="form-group col-md-6">
                    <label for="nylon_cable_tie_6_inch">NYLON CABLE TIE 6-INCH (Black)</label>
                    <input type="text" class="form-control" name="nylon_cable_tie_6_inch" id="nylon_cable_tie_6_inch"
                        value="25" placeholder="Enter NYLON CABLE TIE 6-INCH" readonly>
                </div>
                <div class="form-group col-md-6">
                    <label for="cable_tie_812_inch">CABLE TIE 12-INCH (Black)</label>
                    <input type="text" class="form-control" name="cable_tie_812_inch" id="cable_tie_812_inch" value="10"
                        placeholder="Enter CABLE TIE 8~12-INCH" readonly>
                </div>
                <div class="form-group col-md-6">
                    <label for="duct_patti_1625_mm_3_meter_long">DUCT PATTI 16 X 25 MM 3 METER LONG</label>
                    <input type="text" class="form-control" name="duct_patti_1625_mm_3_meter_long"
                        id="duct_patti_1625_mm_3_meter_long" value="<?= set_value('duct_patti_1625_mm_3_meter_long') ?>"
                        placeholder="Enter DUCT PATTI 16 X 25 MM 3 METER LONG">
                </div>
                <div class="form-group col-md-6">
                    <label for="pvc_coated_gi_flexible_pipe_5_inch_dia">PVC COATED GI FLEXIBLE PIPE 0.5-INCH
                        DIA.</label>
                    <input type="text" class="form-control" name="pvc_coated_gi_flexible_pipe_5_inch_dia"
                        id="pvc_coated_gi_flexible_pipe_5_inch_dia" value="10"
                        placeholder="Enter PVC COATED GI FLEXIBLE PIPE 0.5-INCH DIA." readonly>
                </div>
                <div class="form-group col-md-6">
                    <label for="ac_cable_729_red">AC CABLE 7/0.029 (RED)</label>
                    <input type="text" class="form-control" name="ac_cable_729_red" id="ac_cable_729_red"
                        value="<?= set_value('ac_cable_729_red') ?>" placeholder="Enter AC CABLE 7/0.029 (RED)">
                </div>
                <div class="form-group col-md-6">
                    <label for="ac_cable_729_black">AC CABLE 7/0.029 (BLACK)</label>
                    <input type="text" class="form-control" name="ac_cable_729_black" id="ac_cable_729_black"
                        value="<?= set_value('ac_cable_729_black') ?>" placeholder="Enter AC CABLE 7/0.029 (BLACK)">
                </div>
                <div class="form-group col-md-6">
                    <label for="ac_cable_736_red">AC CABLE 7/0.036 (RED)</label>
                    <input type="text" class="form-control" name="ac_cable_736_red" id="ac_cable_736_red"
                        value="<?= set_value('ac_cable_736_red') ?>" placeholder="Enter AC CABLE 7/0.036 (RED)">
                </div>
                <div class="form-group col-md-6">
                    <label for="ac_cable_736_black">AC CABLE 7/0.036 (BLACK)</label>
                    <input type="text" class="form-control" name="ac_cable_736_black" id="ac_cable_736_black"
                        value="<?= set_value('ac_cable_736_black') ?>" placeholder="Enter AC CABLE 7/0.036 (BLACK)">
                </div>
                <div class="form-group col-md-6">
                    <label for="e27_led_light_14_watt">E27 LED LIGHT 16W - PakLite</label>
                    <input type="text" class="form-control" name="e27_led_light_14_watt" id="e27_led_light_14_watt"
                        value="10" placeholder="Enter E27 LED LIGHT 14~15W" readonly>
                </div>
                <div class="form-group col-md-6">
                    <label for="e27_led_light_holder">E27 LED LIGHT HOLDER With Mounting BASE</label>
                    <input type="text" class="form-control" name="e27_led_light_holder" id="e27_led_light_holder"
                        value="10" placeholder="Enter E27 LED LIGHT HOLDER With Mounting BASE" readonly>
                </div>
                <div class="form-group col-md-6">
                    <label for="ceiling_fan_40_watt">CEILING FAN 40-50W -Royal Fan</label>
                    <input type="text" class="form-control" name="ceiling_fan_40_watt" id="ceiling_fan_40_watt"
                        value="6" placeholder="Enter CEILING FAN 40-50W" readonly>
                </div>
                <div class="form-group col-md-6">
                    <label for="switch_board_with_base_5p">SWITCH BOARD WITH BASE 3P</label>
                    <input type="text" class="form-control" name="switch_board_with_base_5p"
                        id="switch_board_with_base_5p" value="6" placeholder="Enter SWITCH BOARD WITH BASE 3P" readonly>
                </div>
                <div class="form-group col-md-6">
                    <label for="switch_board_with_base_2p">SWITCH BOARD WITH BASE 2P</label>
                    <input type="text" class="form-control" name="switch_board_with_base_2p"
                        id="switch_board_with_base_2p" value="2" placeholder="Enter SWITCH BOARD WITH BASE 2P" readonly>
                </div>
                <div class="form-group col-md-6">
                    <label for="on_off_switch">ON/OF SWITCH</label>
                    <input type="text" class="form-control" name="on_off_switch" id="on_off_switch" value="17"
                        placeholder="Enter ON/OF SWITCH" readonly>
                </div>
                <div class="form-group col-md-6">
                    <label for="fan_dimmer">FAN DIMMER</label>
                    <input type="text" class="form-control" name="fan_dimmer" id="fan_dimmer" value="7"
                        placeholder="Enter FAN DIMMER" readonly>
                </div>
                <div class="form-group col-md-6">
                    <label for="steel_nail_1_inch">STEEL NAIL 1-INCH</label>
                    <input type="text" class="form-control" name="steel_nail_1_inch" id="steel_nail_1_inch" value="0"
                        placeholder="Enter STEEL NAIL 1-INCH" readonly>
                </div>
                <div class="form-group col-md-6">
                    <label for="black_screw_sodani_125_inch">BLACK SCREW (SODANI) 1.25-INCH</label>
                    <input type="text" class="form-control" name="black_screw_sodani_125_inch"
                        id="black_screw_sodani_125_inch" value="325" placeholder="Enter BLACK SCREW (SODANI) 1.25-INCH"
                        readonly>
                </div>
                <div class="form-group col-md-6">
                    <label for="rawal_plug">RAWAL PLUG</label>
                    <input type="text" class="form-control" name="rawal_plug" id="rawal_plug" value="350"
                        placeholder="Enter RAWAL PLUG" readonly>
                </div>

                <div class="form-group col-md-6">
                    <label for="rawal_plug">BLACK SCREW (SODANI) 2.5-INCH</label>
                    <input type="text" class="form-control" name="black_screw_sodani_25_inch" id="black_screw_sodani_25_inch" value="25"
                        placeholder="Enter RAWAL PLUG" readonly>
                </div>

                <div class="form-group col-md-6">
                    <label for="rawal_plug">THREE PIN PLUG</label>
                    <input type="text" class="form-control" name="three_pin_plug" id="three_pin_plug" value="1"
                        placeholder="Enter RAWAL PLUG" readonly>
                </div>
                <div class="form-group col-md-6">
                    <label for="rawal_plug">INAUGURATION BOARD</label>
                    <input type="text" class="form-control" name="inauguration_board" id="inauguration_board" value="1"
                        placeholder="Enter RAWAL PLUG" readonly>
                </div>
                <input type="hidden" class="form-control" name="site_id" id="site_id"
                    value="<?php echo $servey[0]['site_id'];?>">
            </div>
            <div>
                <?php if (isset($validation)): ?>
                <div class="col-12">
                    <div class="alert alert-danger" role="alert">
                        <?= $validation->listErrors() ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>
            <button type="submit" class="btn btn-primary mb-3">Submit Supply Order</button>
        </form>
    </div>
</div>
