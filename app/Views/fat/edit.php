<div class="container">

    <h3 class="mt-3">Edit Site FAT</h3>
    <form action="<?php echo base_url()."/fat/edit/".$fat[0]['site_id'];?>" method="post"
        enctype="multipart/form-data">
                <div class="form-row">
            <div class="form-group col-md-6">
                <label for="final_testing_date">Final Testing Date</label>
                <input type="date" class="form-control" name="final_testing_date" id="final_testing_date"
                    value="<?= set_value('final_testing_date', $fat[0]['final_testing_date']) ?>" placeholder="Enter Final Testing Date">
            </div>
            <div class="form-group col-md-6">
                <label for="contractor_rep_name">Contractor Rep. Name</label>
                <input type="text" class="form-control" name="contractor_rep_name" id="contractor_rep_name"
                    value="<?= set_value('contractor_rep_name', $fat[0]['contractor_rep_name']) ?>" placeholder="Enter Contractor Rep. Name">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="consultant_rep_name">Consultant Rep. Name</label>
                <input type="text" class="form-control" name="consultant_rep_name" id="consultant_rep_name"
                    value="<?= set_value('consultant_rep_name', $fat[0]['consultant_rep_name']) ?>" placeholder="Enter Consultant Rep. Name">
            </div>
            <div class="form-group col-md-6">
                <label for="client_rep_name">Client Rep. Name</label>
                <input type="text" class="form-control" name="client_rep_name" id="client_rep_name" value="<?= set_value('client_rep_name', $fat[0]['client_rep_name']) ?>"
                    placeholder="Enter Client Rep. Name">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="fat_result">FAT Result</label>
                <select class="custom-select" name="fat_result" id="fat_result">
                    <option value="0" <?= $fat[0]['fat_result'] == 0 ? 'selected': '' ?>>FAIL</option>
                    <option value="1" <?= $fat[0]['fat_result'] == 1 ? 'selected': '' ?>>PASS</option>
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="reason_of_rejection">Reason of Rejection (Remarks)</label>
                <input type="text" class="form-control" name="reason_of_rejection" id="reason_of_rejection"
                    value="<?= set_value('reason_of_rejection', $fat[0]['reason_of_rejection']) ?>" placeholder="Enter Reason of Rejection (Remarks)">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="reason_of_rejection_pic_1">Reason of Rejection (Pic-1)</label>
                <div>
                    <label for="reason_of_rejection_pic_1">Select a file:</label>
                    <input type="file" id="reason_of_rejection_pic_1" name="reason_of_rejection_pic_1">
                </div>
            </div>
            <div class="form-group col-md-6">
                <label for="reason_of_rejection_pic_2">Reason of Rejection (Pic-2)</label>
                <div>
                    <label for="reason_of_rejection_pic_2">Select a file:</label>
                    <input type="file" id="reason_of_rejection_pic_2" name="reason_of_rejection_pic_2">
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="fat_report_pic">FAT Report (Pic)</label>
                <div>
                    <label for="fat_report_pic">Select a file:</label>
                    <input type="file" id="fat_report_pic" name="fat_report_pic">
                </div>
            </div>
            <div class="form-group col-md-6">
                <label for="pv_module_pic">PV Modules Pic</label>
                <div>
                    <label for="pv_module_pic">Select a file:</label>
                    <input type="file" id="pv_module_pic" name="pv_module_pic">
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="storage_inverter_module_pic">Storage & Inverter Module Pic</label>
                <div>
                    <label for="storage_inverter_module_pic">Select a file:</label>
                    <input type="file" id="storage_inverter_module_pic" name="storage_inverter_module_pic">
                </div>
            </div>
            <div class="form-group col-md-6">
                <label for="earthing_pic">Earthing Pic</label>
                <div>
                    <label for="earthing_pic">Select a file:</label>
                    <input type="file" id="earthing_pic" name="earthing_pic">
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="lights_pic">Lights Pic</label>
                <div>
                    <label for="lights_pic">Select a file:</label>
                    <input type="file" id="lights_pic" name="lights_pic">
                </div>
            </div>
            <div class="form-group col-md-6">
                <label for="fans_pic">Fans Pic</label>
                <div>
                    <label for="fans_pic">Select a file:</label>
                    <input type="file" id="fans_pic" name="fans_pic">
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="distribution_board_pic">Distribution Boards Pic</label>
                <div>
                    <label for="distribution_board_pic">Select a file:</label>
                    <input type="file" id="distribution_board_pic" name="distribution_board_pic">
                </div>
            </div>
            <div class="form-group col-md-6">
                <label for="dc_wiring_pic">DC Wiring Pic</label>
                <div>
                    <label for="dc_wiring_pic">Select a file:</label>
                    <input type="file" id="dc_wiring_pic" name="dc_wiring_pic">
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="ac_wiring_pic">AC Wiring Pic</label>
                <div>
                    <label for="ac_wiring_pic">Select a file:</label>
                    <input type="file" id="ac_wiring_pic" name="ac_wiring_pic">
                </div>
            </div>
            <div class="form-group col-md-6">
                <label for="testing_pic_1">Testing Pic  - 1</label>
                <div>
                    <label for="testing_pic_1">Select a file:</label>
                    <input type="file" id="testing_pic_1" name="testing_pic_1">
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="testing_pic_2">Testing Pic  - 2</label>
                <div>
                    <label for="testing_pic_2">Select a file:</label>
                    <input type="file" id="testing_pic_2" name="testing_pic_2">
                </div>
            </div>
            <div class="form-group col-md-6">
                <label for="testing_pic_3">Testing Pic  - 3</label>
                <div>
                    <label for="testing_pic_3">Select a file:</label>
                    <input type="file" id="testing_pic_3" name="testing_pic_3">
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="rep_group_pic">Rep. Group Pic</label>
                <div>
                    <label for="rep_group_pic">Select a file:</label>
                    <input type="file" id="rep_group_pic" name="rep_group_pic">
                </div>
            </div>
            <input type="hidden" class="form-control" name="site_id" id="site_id" value="<?php echo $fat[0]['site_id'];?>">
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
        <button type="submit" class="btn btn-primary">Update Site FAT</button>
        <a href="<?php echo base_url()."/fat/manage";?>" class="btn btn-secondary">Cancel</a>
    </form>
</div>