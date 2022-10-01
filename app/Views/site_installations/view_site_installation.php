<div class="container">
    <h3 class="mt-3">Site Installation Data</h3>
    <table class="table table-striped table-bordered" style="width:100%">
        <tbody>
            <tr>
                <td class="font-weight-bold">Installation Start Date</td>
                <td><?= $site_installation[0]['start_date']; ?></td>
                <td class="font-weight-bold">Installation Finish Date</td>
                <td><?= $site_installation[0]['finish_date']; ?></td>
            </tr>
            <tr>
                <td class="font-weight-bold">Installer ID</td>
                <td><?= $site_installation[0]['installer_id']; ?></td>
                <td class="font-weight-bold">Installer Name</td>
                <td><?= $site_installation[0]['installer_name']; ?></td>
            </tr>
            <tr>
                <td class="font-weight-bold">Motor Connection</td>
                <td>
                    <?php if($site_installation[0]['motor_connection'] == 0):?>
                        <?= "No" ?>
                    <?php elseif($site_installation[0]['motor_connection'] == 1):?>
                        <?= "Yes" ?>
                    <?php endif?>    
                </td>
                <td class="font-weight-bold">PV Module – 01 Serial No</td>
                <td><?= $site_installation[0]['pv_module_01_sno']; ?></td>
            </tr>
            <tr>
                <td class="font-weight-bold">PV Module – 02 Serial No</td>
                <td><?= $site_installation[0]['pv_module_02_sno']; ?></td>
                <td class="font-weight-bold">PV Module – 03 Serial No</td>
                <td><?= $site_installation[0]['pv_module_03_sno']; ?></td>
            </tr>
            <tr>
                <td class="font-weight-bold">PV Module – 04 Serial No</td>
                <td><?= $site_installation[0]['pv_module_04_sno']; ?></td>
                <td class="font-weight-bold">Inverter Serial No</td>
                <td><?= $site_installation[0]['inverter_sno']; ?></td>
            </tr>
            <tr>
                <td class="font-weight-bold" colspan="2">Battery Serial No</td>
                <td colspan="2"><?= $site_installation[0]['battery_sno']; ?></td>
            </tr>
            <tr>
                <td class="font-weight-bold">PV Modules Pic</td>
                <td>
                    <?php if($site_installation[0]['pv_module_pic'] == ""):?>
                    <?= "--" ?>
                    <?php else:?>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#pv_module_pic">
                        <i class="fas fa-eye"></i> View Pic
                    </button>
                    <?php endif?>
                    <!-- Modal -->
                    <div class="modal fade" id="pv_module_pic" tabindex="-1" role="dialog"
                        aria-labelledby="pv_module_picLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="pv_module_picLabel">PV Modules Pic</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <img width="900" height="900"
                                        src="<?= base_url()."/assets/uploads/".$site_installation[0]['pv_module_pic']; ?>"
                                        alt="" srcset="">
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
                <td class="font-weight-bold">Storage & Inverter Module Pic</td>
                <td>
                    <?php if($site_installation[0]['storage_inverter_module_pic'] == ""):?>
                    <?= "--" ?>
                    <?php else:?>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#storage_inverter_module_pic">
                        <i class="fas fa-eye"></i> View Pic
                    </button>
                    <?php endif?>
                    <!-- Modal -->
                    <div class="modal fade" id="storage_inverter_module_pic" tabindex="-1" role="dialog"
                        aria-labelledby="storage_inverter_module_picLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="storage_inverter_module_picLabel">Storage & Inverter Module Pic</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <img width="900" height="900"
                                        src="<?= base_url()."/assets/uploads/".$site_installation[0]['storage_inverter_module_pic']; ?>"
                                        alt="" srcset="">
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="font-weight-bold">Earthing Pic</td>
                <td>
                    <?php if($site_installation[0]['earthing_pic'] == ""):?>
                    <?= "--" ?>
                    <?php else:?>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#earthing_pic">
                        <i class="fas fa-eye"></i> View Pic
                    </button>
                    <?php endif?>
                    <!-- Modal -->
                    <div class="modal fade" id="earthing_pic" tabindex="-1" role="dialog"
                        aria-labelledby="earthing_picLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="earthing_picLabel">Earthing Pic</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <img width="900" height="900"
                                        src="<?= base_url()."/assets/uploads/".$site_installation[0]['earthing_pic']; ?>"
                                        alt="" srcset="">
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
                <td class="font-weight-bold">Lights Pic</td>
                <td>
                    <?php if($site_installation[0]['lights_pic'] == ""):?>
                    <?= "--" ?>
                    <?php else:?>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#lights_pic">
                        <i class="fas fa-eye"></i> View Pic
                    </button>
                    <?php endif?>
                    <!-- Modal -->
                    <div class="modal fade" id="lights_pic" tabindex="-1" role="dialog"
                        aria-labelledby="lights_picLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="lights_picLabel">Lights Pic</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <img width="900" height="900"
                                        src="<?= base_url()."/assets/uploads/".$site_installation[0]['lights_pic']; ?>"
                                        alt="" srcset="">
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="font-weight-bold">Fans Pic</td>
                <td>
                    <?php if($site_installation[0]['fans_pic'] == ""):?>
                    <?= "--" ?>
                    <?php else:?>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#fans_pic">
                        <i class="fas fa-eye"></i> View Pic
                    </button>
                    <?php endif?>
                    <!-- Modal -->
                    <div class="modal fade" id="fans_pic" tabindex="-1" role="dialog" aria-labelledby="fans_picLabel"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="fans_picLabel">Fans Pic</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <img width="900" height="900"
                                        src="<?= base_url()."/assets/uploads/".$site_installation[0]['fans_pic']; ?>" alt=""
                                        srcset="">
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
                <td class="font-weight-bold">Distribution Boards Pic</td>
                <td>
                    <?php if($site_installation[0]['distribution_board_pic'] == ""):?>
                    <?= "--" ?>
                    <?php else:?>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#distribution_board_pic">
                        <i class="fas fa-eye"></i> View Pic
                    </button>
                    <?php endif?>
                    <!-- Modal -->
                    <div class="modal fade" id="distribution_board_pic" tabindex="-1" role="dialog"
                        aria-labelledby="distribution_board_picLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="distribution_board_picLabel">Distribution Boards Pic</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <img width="900" height="900"
                                        src="<?= base_url()."/assets/uploads/".$site_installation[0]['distribution_board_pic']; ?>"
                                        alt="" srcset="">
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="font-weight-bold">DC Wiring Pic</td>
                <td>
                    <?php if($site_installation[0]['dc_wiring_pic'] == ""):?>
                    <?= "--" ?>
                    <?php else:?>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#dc_wiring_pic">
                        <i class="fas fa-eye"></i> View Pic
                    </button>
                    <?php endif?>
                    <!-- Modal -->
                    <div class="modal fade" id="dc_wiring_pic" tabindex="-1" role="dialog"
                        aria-labelledby="dc_wiring_picLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="dc_wiring_picLabel">DC Wiring Pic</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <img width="900" height="900"
                                        src="<?= base_url()."/assets/uploads/".$site_installation[0]['dc_wiring_pic']; ?>"
                                        alt="" srcset="">
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
                <td class="font-weight-bold">AC Wiring Pic</td>
                <td>
                    <?php if($site_installation[0]['ac_wiring_pic'] == ""):?>
                    <?= "--" ?>
                    <?php else:?>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ac_wiring_pic">
                        <i class="fas fa-eye"></i> View Pic
                    </button>
                    <?php endif?>
                    <!-- Modal -->
                    <div class="modal fade" id="ac_wiring_pic" tabindex="-1" role="dialog" aria-labelledby="ac_wiring_picLabel"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="ac_wiring_picLabel">AC Wiring Pic</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <img width="900" height="900"
                                        src="<?= base_url()."/assets/uploads/".$site_installation[0]['ac_wiring_pic']; ?>" alt=""
                                        srcset="">
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="font-weight-bold">Optional Pic - 1</td>
                <td>
                    <?php if($site_installation[0]['optional_pic_1'] == ""):?>
                    <?= "--" ?>
                    <?php else:?>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#optional_pic_1">
                        <i class="fas fa-eye"></i> View Pic
                    </button>
                    <?php endif?>
                    <!-- Modal -->
                    <div class="modal fade" id="optional_pic_1" tabindex="-1" role="dialog"
                        aria-labelledby="optional_pic_1Label" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="optional_pic_1Label">Optional Pic - 1</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <img width="900" height="900"
                                        src="<?= base_url()."/assets/uploads/".$site_installation[0]['optional_pic_1']; ?>"
                                        alt="" srcset="">
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
                <td class="font-weight-bold">Optional Pic - 2</td>
                <td>
                    <?php if($site_installation[0]['optional_pic_2'] == ""):?>
                    <?= "--" ?>
                    <?php else:?>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#optional_pic_2">
                        <i class="fas fa-eye"></i> View Pic
                    </button>
                    <?php endif?>
                    <!-- Modal -->
                    <div class="modal fade" id="optional_pic_2" tabindex="-1" role="dialog"
                        aria-labelledby="optional_pic_2Label" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="optional_pic_2Label">Optional Pic - 2</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <img width="900" height="900"
                                        src="<?= base_url()."/assets/uploads/".$site_installation[0]['optional_pic_2']; ?>"
                                        alt="" srcset="">
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="font-weight-bold">Optional Pic - 3</td>
                <td>
                    <?php if($site_installation[0]['optional_pic_3'] == ""):?>
                    <?= "--" ?>
                    <?php else:?>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#optional_pic_3">
                        <i class="fas fa-eye"></i> View Pic
                    </button>
                    <?php endif?>
                    <!-- Modal -->
                    <div class="modal fade" id="optional_pic_3" tabindex="-1" role="dialog"
                        aria-labelledby="optional_pic_3Label" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="optional_pic_3Label">Optional Pic - 3</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <img width="900" height="900"
                                        src="<?= base_url()."/assets/uploads/".$site_installation[0]['optional_pic_3']; ?>"
                                        alt="" srcset="">
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
                <td class="font-weight-bold">Optional Pic - 4</td>
                <td>
                    <?php if($site_installation[0]['optional_pic_4'] == ""):?>
                    <?= "--" ?>
                    <?php else:?>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#optional_pic_4">
                        <i class="fas fa-eye"></i> View Pic
                    </button>
                    <?php endif?>
                    <!-- Modal -->
                    <div class="modal fade" id="optional_pic_4" tabindex="-1" role="dialog"
                        aria-labelledby="optional_pic_4Label" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="optional_pic_4Label">Optional Pic - 4</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <img width="900" height="900"
                                        src="<?= base_url()."/assets/uploads/".$site_installation[0]['optional_pic_4']; ?>"
                                        alt="" srcset="">
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="font-weight-bold">Optional Pic - 5</td>
                <td>
                    <?php if($site_installation[0]['optional_pic_5'] == ""):?>
                    <?= "--" ?>
                    <?php else:?>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#optional_pic_5">
                        <i class="fas fa-eye"></i> View Pic
                    </button>
                    <?php endif?>
                    <!-- Modal -->
                    <div class="modal fade" id="optional_pic_5" tabindex="-1" role="dialog"
                        aria-labelledby="optional_pic_5Label" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="optional_pic_5Label">Optional Pic - 5</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <img width="900" height="900"
                                        src="<?= base_url()."/assets/uploads/".$site_installation[0]['optional_pic_5']; ?>"
                                        alt="" srcset="">
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>
