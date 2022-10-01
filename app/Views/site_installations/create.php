<div class="container">
    <h3 class="mt-3">Site Installation</h3>
    <h4 class="mt-3">Site Installation Data</h4>
    <form action="<?php echo base_url()."/site_installations/create/".$site['site_id'];?>" method="post"
        enctype="multipart/form-data">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="start_date">Installation Start Date</label>
                <input type="date" class="form-control" name="start_date" id="start_date"
                    value="<?= set_value('start_date') ?>" placeholder="Enter Installation Start Date">
            </div>
            <div class="form-group col-md-6">
                <label for="finish_date">Installation Finish Date</label>
                <input type="date" class="form-control" name="finish_date" id="finish_date"
                    value="<?= set_value('finish_date') ?>" placeholder="Enter Installation Finish Date">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="installer_id">Installer ID</label>
                <input type="text" class="form-control" name="installer_id" id="installer_id"
                    value="<?= set_value('installer_id') ?>" placeholder="Enter Installer ID">
            </div>
            <div class="form-group col-md-6">
                <label for="installer_name">Installer Name</label>
                <input type="text" class="form-control" name="installer_name" id="installer_name" value="<?= set_value('installer_name') ?>"
                    placeholder="Enter Installer Name">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="motor_connection">Motor Connection</label>
                <select class="custom-select" name="motor_connection" id="motor_connection">
                    <option value="0">No</option>
                    <option value="1">Yes</option>
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="pv_module_01_sno">PV Module – 01 Serial No.</label>
                <input type="text" class="form-control" name="pv_module_01_sno" id="pv_module_01_sno"
                    value="<?= set_value('pv_module_01_sno') ?>" placeholder="Enter PV Module – 01 Serial No.">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="pv_module_02_sno">PV Module – 02 Serial No.</label>
                <input type="text" class="form-control" name="pv_module_02_sno" id="pv_module_02_sno"
                    value="<?= set_value('pv_module_02_sno') ?>" placeholder="Enter PV Module – 02 Serial No.">
            </div>
            <div class="form-group col-md-6">
                <label for="pv_module_03_sno">PV Module – 03 Serial No.</label>
                <input type="text" class="form-control" name="pv_module_03_sno" id="pv_module_03_sno"
                    value="<?= set_value('pv_module_03_sno') ?>" placeholder="Enter PV Module – 03 Serial No.">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="pv_module_04_sno">PV Module – 04 Serial No.</label>
                <input type="text" class="form-control" name="pv_module_04_sno" id="pv_module_04_sno"
                    value="<?= set_value('pv_module_04_sno') ?>" placeholder="Enter PV Module – 04 Serial No.">
            </div>
            <div class="form-group col-md-6">
                <label for="inverter_sno">Inverter Serial No.</label>
                <input type="text" class="form-control" name="inverter_sno"
                    id="inverter_sno" value="<?= set_value('inverter_sno') ?>"
                    placeholder="Enter Inverter Serial No.">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="battery_sno">Battery Serial No.</label>
                <input type="text" class="form-control" name="battery_sno" id="battery_sno"
                    value="<?= set_value('battery_sno') ?>"
                    placeholder="Enter Battery Serial No.">
            </div>
            <input type="hidden" class="form-control" name="site_id" id="site_id" value="<?php echo $site['id'];?>">
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
        <button type="submit" class="btn btn-primary">Submit Site Installation Data</button>
        <a href="<?php echo base_url()."/sites/manage";?>" class="btn btn-secondary">Cancel</a>
    </form>
</div>