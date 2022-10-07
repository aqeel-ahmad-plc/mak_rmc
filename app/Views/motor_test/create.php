<div class="container">

    <h3 class="mt-3">Create Motor Test</h3>
    <form action="<?php echo base_url()."/motor_test/create";?>" method="post">

      <h3 class="mt-3">Test Information</h3>
        <div class="form-row">


            <div class="form-group col-md-6">
                <label for="test_report_no">Test Report No</label>
                <input type="text" class="form-control" name="test_report_no" id="test_report_no" value="<?= set_value('test_report_no') ?>" placeholder="Enter Test Report No">
            </div>
            <div class="form-group col-md-6">
                <label for="test_date">Test Date</label>
                <input type="date" class="form-control" name="test_date" id="test_date"  value="<?= set_value('test_date') ?>" placeholder="Enter Package">
            </div>
        </div>
        <h3 class="mt-3">Motor Nameplate and Rated Data</h3>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="motor_manufacturer">Motor Manufacturer</label>
                <input type="text" class="form-control" name="motor_manufacturer" id="motor_manufacturer" value="<?= set_value('motor_manufacturer') ?>" placeholder="Enter Motor Manufacturer">
            </div>
            <div class="form-group col-md-6">
                <label for="motor_model">Motor Model</label>
                <input type="text" class="form-control" name="motor_model" id="motor_model"  value="<?= set_value('motor_model') ?>" placeholder="Enter Motor Model">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="motor_type">Motor Type</label>
                <input type="text" class="form-control" name="motor_type" id="motor_type" value="<?= set_value('motor_type') ?>" placeholder="Enter Motor Type">
            </div>
            <div class="form-group col-md-6">
                <label for="stator_size">Frame/ Stator Size</label>
                <input type="text" class="form-control" name="stator_size" id="stator_size"  value="<?= set_value('stator_size') ?>" placeholder="Enter Frame/ Stator Size">
            </div>
        </div>


        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="number_of_phase">No. of Phase</label>
                <input type="number" class="form-control" name="number_of_phase" id="number_of_phase" value="<?= set_value('number_of_phase') ?>" placeholder="Enter No. of Phase">
            </div>
            <div class="form-group col-md-6">
                <label for="motor_rated_kw">Motor Rated kW</label>
                <input type="number" class="form-control" name="motor_rated_kw" id="motor_rated_kw"  value="<?= set_value('motor_rated_kw') ?>" placeholder="Enter Motor Rated kW">
            </div>
        </div>


        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="motor_rated_hp">Motor Rated HP</label>
                <input type="number" class="form-control" name="motor_rated_hp" id="motor_rated_hp" value="<?= set_value('motor_rated_hp') ?>" placeholder="Enter Motor Rated HP">
            </div>
            <div class="form-group col-md-6">
                <label for="motor_rated_voltage">Motor Rated Voltage</label>
                <input type="number" class="form-control" name="motor_rated_voltage" id="motor_rated_voltage"  value="<?= set_value('motor_rated_voltage') ?>" placeholder="Enter Motor Rated Voltage">
            </div>
        </div>


        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="motor_rated_frequency">Motor Rated Frequency</label>
                <input type="number" class="form-control" name="motor_rated_frequency" id="motor_rated_frequency" value="<?= set_value('motor_rated_frequency') ?>" placeholder="Enter Motor Rated Frequency">
            </div>
            <div class="form-group col-md-6">
                <label for="motor_rated_current">Motor Rated Current</label>
                <input type="number" class="form-control" name="motor_rated_current" id="motor_rated_current"  value="<?= set_value('motor_rated_current') ?>" placeholder="Enter Motor Rated Current">
            </div>
        </div>


        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="motor_rated_pf">Motor Rated PF</label>
                <input type="number" class="form-control" name="motor_rated_pf" id="motor_rated_pf" value="<?= set_value('motor_rated_pf') ?>" placeholder="Enter Motor Rated PF">
            </div>
            <div class="form-group col-md-6">
                <label for="motor_rated_rpm">Motor Rated RPM</label>
                <input type="number" class="form-control" name="motor_rated_rpm" id="motor_rated_rpm"  value="<?= set_value('motor_rated_rpm') ?>" placeholder="Enter Motor Rated RPM">
            </div>
        </div>


        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="no_of_poles">No. of Poles</label>
                <input type="number" class="form-control" name="no_of_poles" id="no_of_poles" value="<?= set_value('no_of_poles') ?>" placeholder="Enter No. of Poles">
            </div>
            <div class="form-group col-md-6">
                <label for="efficiency">Efficiency</label>
                <input type="number" class="form-control" name="efficiency" id="efficiency"  value="<?= set_value('efficiency') ?>" placeholder="Enter Efficiency">
            </div>
        </div>


        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="service_factor">Service Factor</label>
                <input type="number" class="form-control" name="service_factor" id="service_factor" value="<?= set_value('service_factor') ?>" placeholder="Enter Service Factor">
            </div>
            <div class="form-group col-md-6">
                <label for="insulation_class">Insulation Class</label>
                <input type="text" class="form-control" name="insulation_class" id="insulation_class"  value="<?= set_value('insulation_class') ?>" placeholder="Enter Insulation Class">
            </div>
        </div>


        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="cooling_class">Cooling Class</label>
                <input type="text" class="form-control" name="cooling_class" id="cooling_class" value="<?= set_value('cooling_class') ?>" placeholder="Enter Cooling Class">
            </div>
            <div class="form-group col-md-6">
                <label for="ip_rating">IP Rating</label>
                <input type="text" class="form-control" name="ip_rating" id="ip_rating"  value="<?= set_value('ip_rating') ?>" placeholder="Enter IP Rating">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="connection_type">Connection Type</label>
                <input type="text" class="form-control" name="connection_type" id="connection_type" value="<?= set_value('connection_type') ?>" placeholder="Enter Connection Type">
            </div>
            <div class="form-group col-md-6">
                <label for="motor_sno">Motor Serial No</label>
                <input type="text" class="form-control" name="motor_sno" id="motor_sno"  value="<?= set_value('motor_sno') ?>" placeholder="Enter Motor Serial No">
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
        <button type="submit" class="btn btn-primary">Create</button>
        <a href="<?php echo base_url()."/sites/manage";?>" class="btn btn-secondary">Cancel</a>
    </form>
</div>
