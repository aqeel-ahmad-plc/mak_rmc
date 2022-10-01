<div class="container">

    <h3 class="mt-3">Edit Site Installation</h3>
    <form action="<?php echo base_url()."/site_installations/edit/".$site_installation[0]['site_id'];?>" method="post"
        enctype="multipart/form-data">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="start_date">Installation Start Date</label>
                <input type="date" class="form-control" name="start_date" id="start_date"
                    value="<?= set_value('start_date', $site_installation[0]['start_date']) ?>" placeholder="Enter Installation Start Date">
            </div>
            <div class="form-group col-md-6">
                <label for="finish_date">Installation Finish Date</label>
                <input type="date" class="form-control" name="finish_date" id="finish_date"
                    value="<?= set_value('finish_date', $site_installation[0]['finish_date']) ?>" placeholder="Enter Installation Finish Date">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="installer_id">Installer ID</label>
                <input type="text" class="form-control" name="installer_id" id="installer_id"
                    value="<?= set_value('installer_id', $site_installation[0]['installer_id']) ?>" placeholder="Enter Installer ID">
            </div>
            <div class="form-group col-md-6">
                <label for="installer_name">Installer Name</label>
                <input type="text" class="form-control" name="installer_name" id="installer_name" value="<?= set_value('installer_name', $site_installation[0]['installer_name']) ?>"
                    placeholder="Enter Installer Name">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="motor_connection">Motor Connection</label>
                <select class="custom-select" name="motor_connection" id="motor_connection">
                    <option value="0" <?= $site_installation[0]['motor_connection'] == 0 ? 'selected': '' ?>>No</option>
                    <option value="1" <?= $site_installation[0]['motor_connection'] == 1 ? 'selected': '' ?>>Yes</option>
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="pv_module_01_sno">PV Module – 01 Serial No.</label>
                <input type="text" class="form-control" name="pv_module_01_sno" id="pv_module_01_sno"
                    value="<?= set_value('pv_module_01_sno', $site_installation[0]['pv_module_01_sno']) ?>" placeholder="Enter PV Module – 01 Serial No.">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="pv_module_02_sno">PV Module – 02 Serial No.</label>
                <input type="text" class="form-control" name="pv_module_02_sno" id="pv_module_02_sno"
                    value="<?= set_value('pv_module_02_sno', $site_installation[0]['pv_module_02_sno']) ?>" placeholder="Enter PV Module – 02 Serial No.">
            </div>
            <div class="form-group col-md-6">
                <label for="pv_module_03_sno">PV Module – 03 Serial No.</label>
                <input type="text" class="form-control" name="pv_module_03_sno" id="pv_module_03_sno"
                    value="<?= set_value('pv_module_03_sno', $site_installation[0]['pv_module_03_sno']) ?>" placeholder="Enter PV Module – 03 Serial No.">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="pv_module_04_sno">PV Module – 04 Serial No.</label>
                <input type="text" class="form-control" name="pv_module_04_sno" id="pv_module_04_sno"
                    value="<?= set_value('pv_module_04_sno', $site_installation[0]['pv_module_04_sno']) ?>" placeholder="Enter PV Module – 04 Serial No.">
            </div>
            <div class="form-group col-md-6">
                <label for="inverter_sno">Inverter Serial No.</label>
                <input type="text" class="form-control" name="inverter_sno"
                    id="inverter_sno" value="<?= set_value('inverter_sno', $site_installation[0]['inverter_sno']) ?>"
                    placeholder="Enter Inverter Serial No.">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="battery_sno">Battery Serial No.</label>
                <input type="text" class="form-control" name="battery_sno" id="battery_sno"
                    value="<?= set_value('battery_sno', $site_installation[0]['battery_sno']) ?>"
                    placeholder="Enter Battery Serial No.">
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
                <label for="optional_pic_1">Optional Pic - 1</label>
                <div>
                    <label for="optional_pic_1">Select a file:</label>
                    <input type="file" id="optional_pic_1" name="optional_pic_1">
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="optional_pic_2">Optional Pic - 2</label>
                <div>
                    <label for="optional_pic_2">Select a file:</label>
                    <input type="file" id="optional_pic_2" name="optional_pic_2">
                </div>
            </div>
            <div class="form-group col-md-6">
                <label for="optional_pic_3">Optional Pic - 3</label>
                <div>
                    <label for="optional_pic_3">Select a file:</label>
                    <input type="file" id="optional_pic_3" name="optional_pic_3">
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="optional_pic_4">Optional Pic - 4</label>
                <div>
                    <label for="optional_pic_4">Select a file:</label>
                    <input type="file" id="optional_pic_4" name="optional_pic_4">
                </div>
            </div>
            <div class="form-group col-md-6">
                <label for="optional_pic_5">Optional Pic - 5</label>
                <div>
                    <label for="optional_pic_5">Select a file:</label>
                    <input type="file" id="optional_pic_5" name="optional_pic_5">
                </div>
            </div>
            <input type="hidden" class="form-control" name="site_id" id="site_id" value="<?php echo $site_installation[0]['site_id'];?>">
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
        <button type="submit" class="btn btn-primary">Update Site Installation</button>
        <a href="<?php echo base_url()."/site_installations/manage";?>" class="btn btn-secondary">Cancel</a>
    </form>
</div>