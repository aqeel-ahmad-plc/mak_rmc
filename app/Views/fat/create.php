<div class="container">

    <h3 class="mt-3">Site FAT</h3>
    <h3 class="mt-3">Site FAT Data</h3>
    <form action="<?php echo base_url()."/fat/create/".$site['site_id'];?>" method="post"
        enctype="multipart/form-data">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="final_testing_date">Final Testing Date</label>
                <input type="date" class="form-control" name="final_testing_date" id="final_testing_date"
                    value="<?= set_value('final_testing_date') ?>" placeholder="Enter Final Testing Date">
            </div>
            <div class="form-group col-md-6">
                <label for="contractor_rep_name">Contractor Rep. Name</label>
                <input type="text" class="form-control" name="contractor_rep_name" id="contractor_rep_name"
                    value="<?= set_value('contractor_rep_name') ?>" placeholder="Enter Contractor Rep. Name">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="consultant_rep_name">Consultant Rep. Name</label>
                <input type="text" class="form-control" name="consultant_rep_name" id="consultant_rep_name"
                    value="<?= set_value('consultant_rep_name') ?>" placeholder="Enter Consultant Rep. Name">
            </div>
            <div class="form-group col-md-6">
                <label for="client_rep_name">Client Rep. Name</label>
                <input type="text" class="form-control" name="client_rep_name" id="client_rep_name" value="<?= set_value('client_rep_name') ?>"
                    placeholder="Enter Client Rep. Name">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="fat_result">FAT Result</label>
                <select class="custom-select" name="fat_result" id="fat_result">
                    <option value="0">FAIL</option>
                    <option value="1">PASS</option>
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="reason_of_rejection">Reason of Rejection (Remarks)</label>
                <input type="text" class="form-control" name="reason_of_rejection" id="reason_of_rejection"
                    value="<?= set_value('reason_of_rejection') ?>" placeholder="Enter Reason of Rejection (Remarks)">
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
        <button type="submit" class="btn btn-primary">Submit Site FAT Data</button>
        <a href="<?php echo base_url()."/fat/manage";?>" class="btn btn-secondary">Cancel</a>
    </form>
</div>