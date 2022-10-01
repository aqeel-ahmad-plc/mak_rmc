<div class="container">
    <h3 class="mt-3">Site FAT Data</h3>
    <table class="table table-striped table-bordered" style="width:100%">
        <tbody>
            <tr>
                <td class="font-weight-bold">Final Testing Date</td>
                <td><?= $fat[0]['final_testing_date']; ?></td>
                <td class="font-weight-bold">Contractor Rep. Name</td>
                <td><?= $fat[0]['contractor_rep_name']; ?></td>
            </tr>
            <tr>
                <td class="font-weight-bold">Consultant Rep. Name</td>
                <td><?= $fat[0]['consultant_rep_name']; ?></td>
                <td class="font-weight-bold">Client Rep. Name</td>
                <td><?= $fat[0]['client_rep_name']; ?></td>
            </tr>
            <tr>
                <td class="font-weight-bold">FAT Result</td>
                <td>
                    <?php if($fat[0]['fat_result'] == 0):?>
                    <?= "FAIL" ?>
                    <?php elseif($fat[0]['fat_result'] == 1):?>
                    <?= "PASS" ?>
                    <?php endif?>
                </td>
                <td class="font-weight-bold">Reason of Rejection (Remarks)</td>
                <td><?= $fat[0]['reason_of_rejection']; ?></td>
            </tr>
            <tr>
                <td class="font-weight-bold">Reason of Rejection (Pic-1)</td>
                <td>
                    <?php if($fat[0]['reason_of_rejection_pic_1'] == ""):?>
                    <?= "--" ?>
                    <?php else:?>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#reason_of_rejection_pic_1">
                        <i class="fas fa-eye"></i> View Pic
                    </button>
                    <?php endif?>
                    <!-- Modal -->
                    <div class="modal fade" id="reason_of_rejection_pic_1" tabindex="-1" role="dialog"
                        aria-labelledby="reason_of_rejection_pic_1Label" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="reason_of_rejection_pic_1Label">Reason of Rejection (Pic-1)</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <img width="900" height="900"
                                        src="<?= base_url()."/assets/uploads/".$fat[0]['reason_of_rejection_pic_1']; ?>" alt=""
                                        srcset="">
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
                <td class="font-weight-bold">Reason of Rejection (Pic-2)</td>
                <td>
                    <?php if($fat[0]['reason_of_rejection_pic_2'] == ""):?>
                    <?= "--" ?>
                    <?php else:?>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal"
                        data-target="#reason_of_rejection_pic_2">
                        <i class="fas fa-eye"></i> View Pic
                    </button>
                    <?php endif?>
                    <!-- Modal -->
                    <div class="modal fade" id="reason_of_rejection_pic_2" tabindex="-1" role="dialog"
                        aria-labelledby="reason_of_rejection_pic_2Label" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="reason_of_rejection_pic_2Label">Reason of Rejection
                                        (Pic-2)</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <img width="900" height="900"
                                        src="<?= base_url()."/assets/uploads/".$fat[0]['reason_of_rejection_pic_2']; ?>"
                                        alt="" srcset="">
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="font-weight-bold">FAT Report (Pic)</td>
                <td>
                    <?php if($fat[0]['fat_report_pic'] == ""):?>
                    <?= "--" ?>
                    <?php else:?>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#fat_report_pic">
                        <i class="fas fa-eye"></i> View Pic
                    </button>
                    <?php endif?>
                    <!-- Modal -->
                    <div class="modal fade" id="fat_report_pic" tabindex="-1" role="dialog"
                        aria-labelledby="fat_report_picLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="fat_report_picLabel">FAT Report (Pic)</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <img width="900" height="900"
                                        src="<?= base_url()."/assets/uploads/".$fat[0]['fat_report_pic']; ?>"
                                        alt="" srcset="">
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
                <td class="font-weight-bold">PV Modules Pic</td>
                <td>
                    <?php if($fat[0]['pv_module_pic'] == ""):?>
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
                                        src="<?= base_url()."/assets/uploads/".$fat[0]['pv_module_pic']; ?>" alt=""
                                        srcset="">
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="font-weight-bold">Storage & Inverter Module Pic</td>
                <td>
                    <?php if($fat[0]['storage_inverter_module_pic'] == ""):?>
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
                                    <h5 class="modal-title" id="storage_inverter_module_picLabel">Storage & Inverter
                                        Module Pic</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <img width="900" height="900"
                                        src="<?= base_url()."/assets/uploads/".$fat[0]['storage_inverter_module_pic']; ?>"
                                        alt="" srcset="">
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
                <td class="font-weight-bold">Earthing Pic</td>
                <td>
                    <?php if($fat[0]['earthing_pic'] == ""):?>
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
                                        src="<?= base_url()."/assets/uploads/".$fat[0]['earthing_pic']; ?>" alt=""
                                        srcset="">
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="font-weight-bold">Lights Pic</td>
                <td>
                    <?php if($fat[0]['lights_pic'] == ""):?>
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
                                        src="<?= base_url()."/assets/uploads/".$fat[0]['lights_pic']; ?>" alt=""
                                        srcset="">
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
                <td class="font-weight-bold">Fans Pic</td>
                <td>
                    <?php if($fat[0]['fans_pic'] == ""):?>
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
                                        src="<?= base_url()."/assets/uploads/".$fat[0]['fans_pic']; ?>" alt=""
                                        srcset="">
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="font-weight-bold">Distribution Boards Pic</td>
                <td>
                    <?php if($fat[0]['distribution_board_pic'] == ""):?>
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
                                    <h5 class="modal-title" id="distribution_board_picLabel">Distribution Boards Pic
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <img width="900" height="900"
                                        src="<?= base_url()."/assets/uploads/".$fat[0]['distribution_board_pic']; ?>"
                                        alt="" srcset="">
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
                <td class="font-weight-bold">DC Wiring Pic</td>
                <td>
                    <?php if($fat[0]['dc_wiring_pic'] == ""):?>
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
                                        src="<?= base_url()."/assets/uploads/".$fat[0]['dc_wiring_pic']; ?>" alt=""
                                        srcset="">
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="font-weight-bold">AC Wiring Pic</td>
                <td>
                    <?php if($fat[0]['ac_wiring_pic'] == ""):?>
                    <?= "--" ?>
                    <?php else:?>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ac_wiring_pic">
                        <i class="fas fa-eye"></i> View Pic
                    </button>
                    <?php endif?>
                    <!-- Modal -->
                    <div class="modal fade" id="ac_wiring_pic" tabindex="-1" role="dialog"
                        aria-labelledby="ac_wiring_picLabel" aria-hidden="true">
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
                                        src="<?= base_url()."/assets/uploads/".$fat[0]['ac_wiring_pic']; ?>" alt=""
                                        srcset="">
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
                <td class="font-weight-bold">Testing Pic - 1</td>
                <td>
                    <?php if($fat[0]['testing_pic_1'] == ""):?>
                    <?= "--" ?>
                    <?php else:?>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#testing_pic_1">
                        <i class="fas fa-eye"></i> View Pic
                    </button>
                    <?php endif?>
                    <!-- Modal -->
                    <div class="modal fade" id="testing_pic_1" tabindex="-1" role="dialog"
                        aria-labelledby="testing_pic_1Label" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="testing_pic_1Label">Testing Pic - 1</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <img width="900" height="900"
                                        src="<?= base_url()."/assets/uploads/".$fat[0]['testing_pic_1']; ?>" alt=""
                                        srcset="">
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="font-weight-bold">Testing Pic - 2</td>
                <td>
                    <?php if($fat[0]['testing_pic_2'] == ""):?>
                    <?= "--" ?>
                    <?php else:?>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#testing_pic_2">
                        <i class="fas fa-eye"></i> View Pic
                    </button>
                    <?php endif?>
                    <!-- Modal -->
                    <div class="modal fade" id="testing_pic_2" tabindex="-1" role="dialog"
                        aria-labelledby="testing_pic_2Label" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="testing_pic_2Label">Testing Pic - 2</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <img width="900" height="900"
                                        src="<?= base_url()."/assets/uploads/".$fat[0]['testing_pic_2']; ?>" alt=""
                                        srcset="">
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
                <td class="font-weight-bold">Testing Pic - 3</td>
                <td>
                    <?php if($fat[0]['testing_pic_3'] == ""):?>
                    <?= "--" ?>
                    <?php else:?>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#testing_pic_3">
                        <i class="fas fa-eye"></i> View Pic
                    </button>
                    <?php endif?>
                    <!-- Modal -->
                    <div class="modal fade" id="testing_pic_3" tabindex="-1" role="dialog"
                        aria-labelledby="testing_pic_3Label" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="testing_pic_3Label">Testing Pic - 3</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <img width="900" height="900"
                                        src="<?= base_url()."/assets/uploads/".$fat[0]['testing_pic_3']; ?>" alt=""
                                        srcset="">
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="font-weight-bold">Rep. Group Pic</td>
                <td>
                    <?php if($fat[0]['rep_group_pic'] == ""):?>
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
                                        src="<?= base_url()."/assets/uploads/".$fat[0]['rep_group_pic']; ?>" alt=""
                                        srcset="">
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>