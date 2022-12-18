<div class="container">

    <h3 class="mt-3">Create Motor Test</h3>
    <?php if (session()->get('success')): ?>
        <div id="success_alert" class="alert alert-success fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?= session()->get('success') ?>
        </div>
    <?php endif; ?>
    <form action="<?php echo base_url()."/motor_test/create";?>" method="post"
        enctype="multipart/form-data">

      <h3 class="mt-3">Test Information</h3>
        <div class="form-row">


            <div class="form-group col-md-4">
                <label for="test_report_no">Test Report No</label>
                <input type="text" class="form-control" name="test_report_no" id="test_report_no" value="<?= set_value('test_report_no') ?>" placeholder="Enter Test Report No">
            </div>
            <div class="form-group col-md-4">
                <label for="test_date">Test Date</label>
                <input type="date" class="form-control" name="test_date" id="test_date"  value="<?= set_value('test_date') ?>" placeholder="Enter Package">
            </div>

            <div class="form-group col-md-4">
                <label for="hitachi_curve">Hitachi Curve</label>
                <input type="text" class="form-control" name="hitachi_curve" id="hitachi_curve" value="Hitachi Curve">
            </div>
        </div>
        <h3 class="mt-3">Motor Nameplate and Rated Data</h3>

        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="motor_manufacturer">Motor Manufacturer</label>
                <input type="text" class="form-control" name="motor_manufacturer" id="motor_manufacturer" value="<?= set_value('motor_manufacturer') ?>" placeholder="Enter Motor Manufacturer">
            </div>
            <div class="form-group col-md-4">
                <label for="motor_model">Motor Model</label>
                <input type="text" class="form-control" name="motor_model" id="motor_model"  value="<?= set_value('motor_model') ?>" placeholder="Enter Motor Model">
            </div>

            <div class="form-group col-md-4">
                <label for="motor_type">Motor Type</label>
                <input type="text" class="form-control" name="motor_type" id="motor_type" value="<?= set_value('motor_type') ?>" placeholder="Enter Motor Type">
            </div>
        </div>

        <div class="form-row">

            <div class="form-group col-md-4">
                <label for="stator_size">Frame/ Stator Size</label>
                <input type="text" class="form-control" name="stator_size" id="stator_size"  value="<?= set_value('stator_size') ?>" placeholder="Enter Frame/ Stator Size">
            </div>

            <div class="form-group col-md-4">
                <label for="number_of_phase">No. of Phase</label>
                <input type="number" class="form-control" name="number_of_phase" id="number_of_phase" value="<?= set_value('number_of_phase') ?>" placeholder="Enter No. of Phase">
            </div>
            <div class="form-group col-md-4">
                <label for="motor_rated_kw">Motor Rated kW</label>
                <input type="number" step="0.0001" class="form-control" name="motor_rated_kw" id="motor_rated_kw"  value="<?= set_value('motor_rated_kw') ?>" placeholder="Enter Motor Rated kW">
            </div>
        </div>




        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="motor_rated_hp">Motor Rated HP</label>
                <input type="number" class="form-control" name="motor_rated_hp" id="motor_rated_hp" value="<?= set_value('motor_rated_hp') ?>" placeholder="Enter Motor Rated HP">
            </div>
            <div class="form-group col-md-4">
                <label for="motor_rated_voltage">Motor Rated Voltage</label>
                <input type="number" class="form-control" name="motor_rated_voltage" id="motor_rated_voltage"  value="<?= set_value('motor_rated_voltage') ?>" placeholder="Enter Motor Rated Voltage">
            </div>

            <div class="form-group col-md-4">
                <label for="motor_rated_frequency">Motor Rated Frequency</label>
                <input type="number" class="form-control" name="motor_rated_frequency" id="motor_rated_frequency" value="<?= set_value('motor_rated_frequency') ?>" placeholder="Enter Motor Rated Frequency">
            </div>
        </div>


        <div class="form-row">

            <div class="form-group col-md-4">
                <label for="motor_rated_current">Motor Rated Current</label>
                <input type="number" step="0.0001" class="form-control" name="motor_rated_current" id="motor_rated_current"  value="<?= set_value('motor_rated_current') ?>" placeholder="Enter Motor Rated Current">
            </div>

            <div class="form-group col-md-4">
                <label for="motor_rated_pf">Motor Rated PF</label>
                <input type="number" step="0.00001" class="form-control" name="motor_rated_pf" id="motor_rated_pf" value="<?= set_value('motor_rated_pf') ?>" placeholder="Enter Motor Rated PF">
            </div>
            <div class="form-group col-md-4">
                <label for="motor_rated_rpm">Motor Rated RPM</label>
                <input type="number" class="form-control" name="motor_rated_rpm" id="motor_rated_rpm"  value="<?= set_value('motor_rated_rpm') ?>" placeholder="Enter Motor Rated RPM">
            </div>
        </div>




        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="no_of_poles">No. of Poles</label>
                <input type="number" class="form-control" name="no_of_poles" id="no_of_poles" value="<?= set_value('no_of_poles') ?>" placeholder="Enter No. of Poles">
            </div>
            <div class="form-group col-md-4">
                <label for="efficiency">Efficiency</label>
                <input type="number" step="0.0001" class="form-control" name="efficiency" id="efficiency"  value="<?= set_value('efficiency') ?>" placeholder="Enter Efficiency">
            </div>

            <div class="form-group col-md-4">
                <label for="service_factor">Service Factor</label>
                <input type="number" step="0.0001" class="form-control" name="service_factor" id="service_factor" value="<?= set_value('service_factor') ?>" placeholder="Enter Service Factor">
            </div>
        </div>


        <div class="form-row">

            <div class="form-group col-md-4">
                <label for="insulation_class">Insulation Class</label>
                <input type="text" class="form-control" name="insulation_class" id="insulation_class"  value="<?= set_value('insulation_class') ?>" placeholder="Enter Insulation Class">
            </div>
            <div class="form-group col-md-4">
                <label for="cooling_class">Cooling Class</label>
                <input type="text" class="form-control" name="cooling_class" id="cooling_class" value="<?= set_value('cooling_class') ?>" placeholder="Enter Cooling Class">
            </div>
            <div class="form-group col-md-4">
                <label for="ip_rating">IP Rating</label>
                <input type="text" class="form-control" name="ip_rating" id="ip_rating"  value="<?= set_value('ip_rating') ?>" placeholder="Enter IP Rating">
            </div>
        </div>




        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="connection_type">Connection Type</label>
                <input type="text" class="form-control" name="connection_type" id="connection_type" value="<?= set_value('connection_type') ?>" placeholder="Enter Connection Type">
            </div>
            <div class="form-group col-md-4">
                <label for="motor_sno">Motor Serial No</label>
                <input type="text" class="form-control" name="motor_sno" id="motor_sno"  value="<?= set_value('motor_sno') ?>" placeholder="Enter Motor Serial No">
            </div>

            <div class="form-group col-md-4">
                <label for="motor_pic">Motor Picture</label>
                <input type="file" class="form-control" name="motor_pic" id="motor_pic" required/>
            </div>
        </div>

        <h3 class="mt-3">Pre-Test Entries</h3>
          <div class="form-row">


              <div class="form-group col-md-4">
                  <label for="specified_temp">Specified Temperature</label>
                  <input type="number" step="0.00001" class="form-control" name="specified_temp" id="specified_temp" value="<?= set_value('specified_temp') ?>" placeholder="Enter Specified Temperature">
              </div>
              <div class="form-group col-md-4">
                  <label for="winding_resistance">Winding Resistance in Ohm</label>
                  <input type="number" step="0.00001" class="form-control" name="winding_resistance" id="winding_resistance"  value="<?= set_value('winding_resistance') ?>" placeholder="Enter Winding Resistance in Ohm">
              </div>
              <div class="form-group col-md-4">
                  <label for="temp_at_which_winding_resistance_measured">Temperature at winding resistance is measured</label>
                  <input type="number" step="0.00001" class="form-control" name="temp_at_which_winding_resistance_measured" id="temp_at_which_winding_resistance_measured"  value="<?= set_value('temp_at_which_winding_resistance_measured') ?>" placeholder="Enter Temperature at which winding resistance is measured">
              </div>
          </div>
          <h3 class="mt-3">Rated Curves  <input onclick="hideTable()" type="checkbox" style="width:22px; height:22px" name="rated_curves_checkbox" id="rated_curves_checkbox" checked> </h3>

          <div class="row" id="rated_curves_table">
            <table class="table">
              <thead class="thead-light">
                <tr>
                  <th scope="col">SNO</th>
                  <th scope="row">Shaft Power (P2), in kW</th>
                  <th scope="row">Efficiency, in %</th>
                  <th scope="row">Speed, in RPM</th>
                  <th scope="row">Current, in Amps</th>
                  <th scope="row">CosØ, in %</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row">1</th>
                  <td> <input type="text" name="shaft_power_p2_1" id="shaft_power_p2_1"> </td>
                  <td> <input type="text" name="efficiency_in_percent_1" id="efficiency_in_percent_1"> </td>
                  <td> <input type="text" name="speed_in_rpm_1" id="speed_in_rpm_1"> </td>
                  <td> <input type="text" name="current_in_amps_1" id="current_in_amps_1"> </td>
                  <td> <input type="text" name="cos_in_percent_1" id="cos_in_percent_1"> </td>
                </tr>
                <tr>
                  <th scope="row">2</th>

                  <td> <input type="text" name="shaft_power_p2_2" id="shaft_power_p2_2"> </td>
                  <td> <input type="text" name="efficiency_in_percent_2" id="efficiency_in_percent_2"> </td>
                  <td> <input type="text" name="speed_in_rpm_2" id="speed_in_rpm_2"> </td>
                  <td> <input type="text" name="current_in_amps_2" id="current_in_amps_2"> </td>
                  <td> <input type="text" name="cos_in_percent_2" id="cos_in_percent_2"> </td>
                </tr>
                <tr>
                  <th scope="row">3</th>

                  <td> <input type="text" name="shaft_power_p2_3" id="shaft_power_p2_3"> </td>
                  <td> <input type="text" name="efficiency_in_percent_3" id="efficiency_in_percent_3"> </td>
                  <td> <input type="text" name="speed_in_rpm_3" id="speed_in_rpm_3"> </td>
                  <td> <input type="text" name="current_in_amps_3" id="current_in_amps_3"> </td>
                  <td> <input type="text" name="cos_in_percent_3" id="cos_in_percent_3"> </td>
                </tr>
                <tr>
                  <th scope="row">4</th>

                  <td> <input type="text" name="shaft_power_p2_4" id="shaft_power_p2_4"> </td>
                  <td> <input type="text" name="efficiency_in_percent_4" id="efficiency_in_percent_4"> </td>
                  <td> <input type="text" name="speed_in_rpm_4" id="speed_in_rpm_4"> </td>
                  <td> <input type="text" name="current_in_amps_4" id="current_in_amps_4"> </td>
                  <td> <input type="text" name="cos_in_percent_4" id="cos_in_percent_4"> </td>
                </tr>
                <tr>
                  <th scope="row">5</th>

                  <td> <input type="text" name="shaft_power_p2_5" id="shaft_power_p2_5"> </td>
                  <td> <input type="text" name="efficiency_in_percent_5" id="efficiency_in_percent_5"> </td>
                  <td> <input type="text" name="speed_in_rpm_5" id="speed_in_rpm_5"> </td>
                  <td> <input type="text" name="current_in_amps_5" id="current_in_amps_5"> </td>
                  <td> <input type="text" name="cos_in_percent_5" id="cos_in_percent_5"> </td>
                </tr>
                <tr>
                  <th scope="row">6</th>

                  <td> <input type="text" name="shaft_power_p2_6" id="shaft_power_p2_6"> </td>
                  <td> <input type="text" name="efficiency_in_percent_6" id="efficiency_in_percent_6"> </td>
                  <td> <input type="text" name="speed_in_rpm_6" id="speed_in_rpm_6"> </td>
                  <td> <input type="text" name="current_in_amps_6" id="current_in_amps_6"> </td>
                  <td> <input type="text" name="cos_in_percent_6" id="cos_in_percent_6"> </td>
                </tr>
                <tr>
                  <th scope="row">7</th>

                  <td> <input type="text" name="shaft_power_p2_7" id="shaft_power_p2_7"> </td>
                  <td> <input type="text" name="efficiency_in_percent_7" id="efficiency_in_percent_7"> </td>
                  <td> <input type="text" name="speed_in_rpm_7" id="speed_in_rpm_7"> </td>
                  <td> <input type="text" name="current_in_amps_7" id="current_in_amps_7"> </td>
                  <td> <input type="text" name="cos_in_percent_7" id="cos_in_percent_7"> </td>
                </tr>
              </tbody>
            </table>
          </div>


          <h3 class="mt-3">Test Description</h3>


          <div class="form-row">


              <div class="form-group col-md-4">
                  <label for="test_description">Description</label>
                  <textarea  id="test_description" name="test_description" rows="15" cols="100"></textarea>
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
        <a href="<?php echo base_url()."/motor_test/manage";?>" class="btn btn-secondary">Cancel</a>

        <br><br><br>

    </form>



</div>

<script type="text/javascript">

function hideTable(){
  // Get the checkbox
  var checkBox = document.getElementById("rated_curves_checkbox");
  // Get the output text
  var rated_curves_table = document.getElementById("rated_curves_table");

  // If the checkbox is checked, display the output text
  if (checkBox.checked == true){
    rated_curves_table.style.display = "block";
  } else {
    rated_curves_table.style.display = "none";
  }
}

</script>
