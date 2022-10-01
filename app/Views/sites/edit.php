<div class="container">

    <h3 class="mt-3">Edit Site</h3>
    <form action="<?php echo base_url()."/sites/edit/".$site['site_id'];?>" method="post">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="site_id">Site ID</label>
                <input type="text" class="form-control" name="site_id" id="site_id" value="<?= set_value('site_id',$site['site_id']) ?>" placeholder="Enter Site ID">
            </div>
            <div class="form-group col-md-6">
                <label for="package">Package</label>
                <input type="text" class="form-control" name="package" id="package" value="<?= set_value('package',$site['package']) ?>" placeholder="Enter Package">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="client">Client</label>
                <input type="text" class="form-control" name="client" id="client" value="<?= set_value('client',$site['client']) ?>" placeholder="Enter Client">
            </div>
            <div class="form-group col-md-6">
                <label for="consultant">Consultants</label>
                <input type="text" class="form-control" name="consultant" id="consultant" value="<?= set_value('consultant',$site['consultant']) ?>" placeholder="Enter Consultants">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="contractor">Contractor</label>
                <input type="text" class="form-control" name="contractor" id="contractor" value="<?= set_value('contractor',$site['contractor']) ?>" placeholder="Enter Contractor">
            </div>
            <div class="form-group col-md-6">
                <label for="masgid">Masjid Name</label>
                <input type="text" class="form-control" name="masgid" id="masgid" value="<?= set_value('masgid',$site['masgid']) ?>" placeholder="Enter Masjid Name">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="district">District</label>
                <input type="text" class="form-control" name="district" id="district" value="<?= set_value('district',$site['district']) ?>" placeholder="Enter District">
            </div>
            <div class="form-group col-md-6">
                <label for="tehsil">Tehsil</label>
                <input type="text" class="form-control" name="tehsil" id="tehsil" value="<?= set_value('tehsil',$site['tehsil']) ?>" placeholder="Enter Tehsil">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="uc_vc_name_and_no">UC/VC Name & No</label>
                <input type="text" class="form-control" name="uc_vc_name_and_no" id="uc_vc_name_and_no" value="<?= set_value('uc_vc_name_and_no',$site['uc_vc_name_and_no']) ?>" placeholder="Enter UC/VC Name & No">
            </div>
            <div class="form-group col-md-6">
                <label for="na_pk">NA/PK</label>
                <input type="text" class="form-control" name="na_pk" id="na_pk" value="<?= set_value('na_pk',$site['na_pk']) ?>" placeholder="Enter NA/PK">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="focal_person">Focal Person Name</label>
                <input type="text" class="form-control" name="focal_person" id="focal_person" value="<?= set_value('focal_person',$site['focal_person']) ?>" placeholder="Enter Focal Person Name">
            </div>
            <div class="form-group col-md-6">
                <label for="contact">Contact Number</label>
                <input type="text" class="form-control" name="contact" id="contact" value="<?= set_value('contact',$site['contact']) ?>" placeholder="Enter Contact Number">
            </div>
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
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="<?php echo base_url()."/sites/manage";?>" class="btn btn-secondary">Cancel</a>
    </form>
</div>