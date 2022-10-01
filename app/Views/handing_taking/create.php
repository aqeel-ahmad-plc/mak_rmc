<div class="container">

    <h3 class="mt-3">Site Handing/Taking</h3>
    <form action="<?php echo base_url()."/handing_taking/create/".$site['site_id'];?>" method="post"
        enctype="multipart/form-data">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="handing_over_date">Handing/Taking Over Date</label>
                <input type="date" class="form-control" name="handing_over_date" id="handing_over_date"
                    value="<?= set_value('handing_over_date') ?>" placeholder="Enter Handing/Taking Over Date">
            </div>
            <div class="form-group col-md-6">
                <label for="handed_over_by">Handed Over By (Contractor)</label>
                <input type="text" class="form-control" name="handed_over_by" id="handed_over_by"
                    value="<?= set_value('handed_over_by') ?>" placeholder="Enter Handed Over By (Contractor)">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="take_over_by">Taken Over by (Beneficiary)</label>
                <input type="text" class="form-control" name="take_over_by" id="take_over_by"
                    value="<?= set_value('take_over_by') ?>" placeholder="Enter Taken Over by (Beneficiary)">
            </div>
            <div class="form-group col-md-6">
                <label for="beneficiary_cnic">Beneficiary CNIC</label>
                <input type="text" class="form-control" name="beneficiary_cnic" id="beneficiary_cnic" value="<?= set_value('beneficiary_cnic') ?>"
                    placeholder="Enter Beneficiary CNIC">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="beneficiary_pic_pv_module">Beneficiary Pic with PV Modules</label>
                <div>
                    <label for="beneficiary_pic_pv_module">Select a file:</label>
                    <input type="file" id="beneficiary_pic_pv_module" name="beneficiary_pic_pv_module">
                </div>
            </div>
            <div class="form-group col-md-6">
                <label for="beneficiary_pic_inverter">Beneficiary Pic with Inverter</label>
                <div>
                    <label for="beneficiary_pic_inverter">Select a file:</label>
                    <input type="file" id="beneficiary_pic_inverter" name="beneficiary_pic_inverter">
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="beneficiary_pic_fan_lights">Beneficiary Pic with Fan/Lights</label>
                <div>
                    <label for="beneficiary_pic_fan_lights">Select a file:</label>
                    <input type="file" id="beneficiary_pic_fan_lights" name="beneficiary_pic_fan_lights">
                </div>
            </div>
            <div class="form-group col-md-6">
                <label for="handing_over_certificate">Handing/Taking Over Certificate Pic</label>
                <div>
                    <label for="handing_over_certificate">Select a file:</label>
                    <input type="file" id="handing_over_certificate" name="handing_over_certificate">
                </div>
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
        <button type="submit" class="btn btn-primary">Submit Site Handing/Taking</button>
        <a href="<?php echo base_url()."/handing_taking/manage";?>" class="btn btn-secondary">Cancel</a>
    </form>
</div>