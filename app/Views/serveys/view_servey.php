<div class="container">
    <h3 class="mt-3">Survey Data</h3>
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
                      <?php elseif($servey[0]['roof_top_type'] == 3):?>
                          <?= "Shutter roof / Corrugated sheet roof" ?>    
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
                <td class="font-weight-bold" colspan="2">Line Voltage</td>
                <td colspan="2"><?= $servey[0]['line_voltage']; ?></td>

            </tr>
            <tr>
                <td class="font-weight-bold">Khatib/ Caretaker Pic</td>
                <td>
                    <?php if($servey[0]['khatib_caretaker_pic_path'] == ""):?>
                    <?= "--" ?>
                    <?php else:?>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#khatib_caretaker_pic">
                        <i class="fas fa-eye"></i> View Pic
                    </button>
                    <?php endif?>
                    <!-- Modal -->
                    <div class="modal fade" id="khatib_caretaker_pic" tabindex="-1" role="dialog"
                        aria-labelledby="khatib_caretaker_picLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="khatib_caretaker_picLabel">Khatib/ Caretaker Pic</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <img width="900" height="900"
                                        src="<?= base_url()."/assets/uploads/".$servey[0]['khatib_caretaker_pic_path']; ?>"
                                        alt="" srcset="">
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
                <td class="font-weight-bold">Site Sketch Pic</td>
                <td>
                    <?php if($servey[0]['site_sketch_pic_path'] == ""):?>
                    <?= "--" ?>
                    <?php else:?>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#site_sketch_pic">
                        <i class="fas fa-eye"></i> View Pic
                    </button>
                    <?php endif?>
                    <!-- Modal -->
                    <div class="modal fade" id="site_sketch_pic" tabindex="-1" role="dialog"
                        aria-labelledby="site_sketch_picLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="site_sketch_picLabel">Site Sketch Pic</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <img width="900" height="900"
                                        src="<?= base_url()."/assets/uploads/".$servey[0]['site_sketch_pic_path']; ?>"
                                        alt="" srcset="">
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="font-weight-bold">Roof top Pic - 01</td>
                <td>
                    <?php if($servey[0]['roof_top_pic_01_path'] == ""):?>
                    <?= "--" ?>
                    <?php else:?>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#roof_top_pic_01">
                        <i class="fas fa-eye"></i> View Pic
                    </button>
                    <?php endif?>
                    <!-- Modal -->
                    <div class="modal fade" id="roof_top_pic_01" tabindex="-1" role="dialog"
                        aria-labelledby="roof_top_pic_01Label" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="roof_top_pic_01Label">Roof top Pic - 01</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <img width="900" height="900"
                                        src="<?= base_url()."/assets/uploads/".$servey[0]['roof_top_pic_01_path']; ?>"
                                        alt="" srcset="">
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
                <td class="font-weight-bold">Roof top Pic - 02</td>
                <td>
                    <?php if($servey[0]['roof_top_pic_02_path'] == ""):?>
                    <?= "--" ?>
                    <?php else:?>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#roof_top_pic_02">
                        <i class="fas fa-eye"></i> View Pic
                    </button>
                    <?php endif?>
                    <!-- Modal -->
                    <div class="modal fade" id="roof_top_pic_02" tabindex="-1" role="dialog"
                        aria-labelledby="roof_top_pic_02Label" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="roof_top_pic_02Label">Roof top Pic - 02</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <img width="900" height="900"
                                        src="<?= base_url()."/assets/uploads/".$servey[0]['roof_top_pic_02_path']; ?>"
                                        alt="" srcset="">
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="font-weight-bold">MDB Pic</td>
                <td>
                    <?php if($servey[0]['mdb_pic_path'] == ""):?>
                    <?= "--" ?>
                    <?php else:?>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#mdb_pic">
                        <i class="fas fa-eye"></i> View Pic
                    </button>
                    <?php endif?>
                    <!-- Modal -->
                    <div class="modal fade" id="mdb_pic" tabindex="-1" role="dialog" aria-labelledby="mdb_picLabel"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="mdb_picLabel">MDB Pic</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <img width="900" height="900"
                                        src="<?= base_url()."/assets/uploads/".$servey[0]['mdb_pic_path']; ?>" alt=""
                                        srcset="">
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
                <td class="font-weight-bold">Inverter Placement Pic</td>
                <td>
                    <?php if($servey[0]['inverter_placement_pic_path'] == ""):?>
                    <?= "--" ?>
                    <?php else:?>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#inverter_placement_pic">
                        <i class="fas fa-eye"></i> View Pic
                    </button>
                    <?php endif?>
                    <!-- Modal -->
                    <div class="modal fade" id="inverter_placement_pic" tabindex="-1" role="dialog"
                        aria-labelledby="inverter_placement_picLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="inverter_placement_picLabel">Inverter Placement Pic</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <img width="900" height="900"
                                        src="<?= base_url()."/assets/uploads/".$servey[0]['inverter_placement_pic_path']; ?>"
                                        alt="" srcset="">
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="font-weight-bold">Earth Point Pic</td>
                <td>
                    <?php if($servey[0]['earth_point_pic_path'] == ""):?>
                    <?= "--" ?>
                    <?php else:?>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#earth_point_pic">
                        <i class="fas fa-eye"></i> View Pic
                    </button>
                    <?php endif?>
                    <!-- Modal -->
                    <div class="modal fade" id="earth_point_pic" tabindex="-1" role="dialog"
                        aria-labelledby="earth_point_picLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="earth_point_picLabel">Earth Point Pic</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <img width="900" height="900"
                                        src="<?= base_url()."/assets/uploads/".$servey[0]['earth_point_pic_path']; ?>"
                                        alt="" srcset="">
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
                <td class="font-weight-bold">Motor Pic</td>
                <td>
                    <?php if($servey[0]['motor_pic_path'] == ""):?>
                    <?= "--" ?>
                    <?php else:?>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#motor_pic">
                        <i class="fas fa-eye"></i> View Pic
                    </button>
                    <?php endif?>
                    <!-- Modal -->
                    <div class="modal fade" id="motor_pic" tabindex="-1" role="dialog" aria-labelledby="motor_picLabel"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="motor_picLabel">Motor Pic</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <img width="900" height="900"
                                        src="<?= base_url()."/assets/uploads/".$servey[0]['motor_pic_path']; ?>" alt=""
                                        srcset="">
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="font-weight-bold">Internal Wiring Pic</td>
                <td>
                    <?php if($servey[0]['internal_wiring_pic_path'] == ""):?>
                    <?= "--" ?>
                    <?php else:?>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#internal_wiring_pic">
                        <i class="fas fa-eye"></i> View Pic
                    </button>
                    <?php endif?>
                    <!-- Modal -->
                    <div class="modal fade" id="internal_wiring_pic" tabindex="-1" role="dialog"
                        aria-labelledby="internal_wiring_picLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="internal_wiring_picLabel">Internal Wiring Pic</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <img width="900" height="900"
                                        src="<?= base_url()."/assets/uploads/".$servey[0]['internal_wiring_pic_path']; ?>"
                                        alt="" srcset="">
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
                <td class="font-weight-bold">Optional Pic-01</td>
                <td>
                    <?php if($servey[0]['optional_pic_01_path'] == ""):?>
                    <?= "--" ?>
                    <?php else:?>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#optional_pic_01">
                        <i class="fas fa-eye"></i> View Pic
                    </button>
                    <?php endif?>
                    <!-- Modal -->
                    <div class="modal fade" id="optional_pic_01" tabindex="-1" role="dialog"
                        aria-labelledby="optional_pic_01Label" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="optional_pic_01Label">Optional Pic-01</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <img width="900" height="900"
                                        src="<?= base_url()."/assets/uploads/".$servey[0]['optional_pic_01_path']; ?>"
                                        alt="" srcset="">
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="font-weight-bold">Optional Pic-02</td>
                <td>
                    <?php if($servey[0]['optional_pic_02_path'] == ""):?>
                    <?= "--" ?>
                    <?php else:?>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#optional_pic_02">
                        <i class="fas fa-eye"></i> View Pic
                    </button>
                    <?php endif?>
                    <!-- Modal -->
                    <div class="modal fade" id="optional_pic_02" tabindex="-1" role="dialog"
                        aria-labelledby="optional_pic_02Label" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="optional_pic_02Label">Optional Pic-02</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <img width="900" height="900"
                                        src="<?= base_url()."/assets/uploads/".$servey[0]['optional_pic_02_path']; ?>"
                                        alt="" srcset="">
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
                <td class="font-weight-bold">Optional Pic-03</td>
                <td>
                    <?php if($servey[0]['optional_pic_03_path'] == ""):?>
                    <?= "--" ?>
                    <?php else:?>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#optional_pic_03">
                        <i class="fas fa-eye"></i> View Pic
                    </button>
                    <?php endif?>
                    <!-- Modal -->
                    <div class="modal fade" id="optional_pic_03" tabindex="-1" role="dialog"
                        aria-labelledby="optional_pic_03Label" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="optional_pic_03Label">Optional Pic-03</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <img width="900" height="900"
                                        src="<?= base_url()."/assets/uploads/".$servey[0]['optional_pic_03_path']; ?>"
                                        alt="" srcset="">
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="font-weight-bold">Optional Pic-04</td>
                <td>
                    <?php if($servey[0]['optional_pic_04_path'] == ""):?>
                    <?= "--" ?>
                    <?php else:?>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#optional_pic_04">
                        <i class="fas fa-eye"></i> View Pic
                    </button>
                    <?php endif?>
                    <!-- Modal -->
                    <div class="modal fade" id="optional_pic_04" tabindex="-1" role="dialog"
                        aria-labelledby="optional_pic_04Label" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="optional_pic_04Label">Optional Pic-04</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <img width="900" height="900"
                                        src="<?= base_url()."/assets/uploads/".$servey[0]['optional_pic_04_path']; ?>"
                                        alt="" srcset="">
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
                <td class="font-weight-bold">Optional Pic-05</td>
                <td>
                    <?php if($servey[0]['optional_pic_05_path'] == ""):?>
                    <?= "--" ?>
                    <?php else:?>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#optional_pic_05">
                        <i class="fas fa-eye"></i> View Pic
                    </button>
                    <?php endif?>
                    <!-- Modal -->
                    <div class="modal fade" id="optional_pic_05" tabindex="-1" role="dialog"
                        aria-labelledby="optional_pic_05Label" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="optional_pic_05Label">Optional Pic-05</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <img width="900" height="900"
                                        src="<?= base_url()."/assets/uploads/".$servey[0]['optional_pic_05_path']; ?>"
                                        alt="" srcset="">
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="font-weight-bold">Rep. Group Pic</td>
                <td>
                    <?php if($servey[0]['rep_group_pic_path'] == ""):?>
                    <?= "--" ?>
                    <?php else:?>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#rep_group_pic">
                        <i class="fas fa-eye"></i> View Pic
                    </button>
                    <?php endif?>
                    <!-- Modal -->
                    <div class="modal fade" id="rep_group_pic" tabindex="-1" role="dialog"
                        aria-labelledby="rep_group_picLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="rep_group_picLabel">Rep. Group Pic</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <img width="900" height="900"
                                        src="<?= base_url()."/assets/uploads/".$servey[0]['rep_group_pic_path']; ?>" alt=""
                                        srcset="">
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
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
