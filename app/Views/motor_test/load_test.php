<?php
    function get_percentage($total, $number)
    {
        if ( $total > 0 ) {
        return round($number / ($total / 100),2);
        } else {
        return 0;
        }
    }
?>
<div class="container-fluid">

  <?php if (session()->get('success')): ?>
      <div id="success_alert" class="alert alert-success fade show" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <?= session()->get('success') ?>
      </div>
  <?php endif; ?>

  <div class="d-sm-flex align-items-center justify-content-between mb-4 pt-2">
      <h1 class="h3 mb-0 text-gray-800"><b>Load Test</b></h1>
  </div>
  <form action="<?php echo base_url()."/motor_test/load_test";?>" method="post">
    <input type="hidden" name="test_id" value="<?php echo $test_id ?>" id="test_id">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><u>Output Power</u></h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Torque (N.m) -->
        <div class="col-xl-23 col-md-2">
            <div class="card shadow h-70 mb-1">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xl font-weight-bold text-primary text-uppercase">Torque (N.m)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"> <input type="text" name="load_test_torque" id="load_test_torque"> </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-23 col-md-2">
            <div class="card shadow h-70 mb-1">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xl font-weight-bold text-primary text-uppercase">Speed (RPM)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"> <input type="text" name="load_test_rpm" id="load_test_rpm"> </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-23 col-md-2">
            <div class="card shadow h-70 mb-1">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xl font-weight-bold text-primary text-uppercase">Shaft Power (kW)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><input type="text" name="load_test_shaft_power" id="load_test_shaft_power"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-23 col-md-2">
            <div class="card shadow h-70 mb-1">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xl font-weight-bold text-primary text-uppercase">Loading Factor (%)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><input type="text" name="loading_factor_load" id="loading_factor_load"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-23 col-md-2">
            <div class="card shadow h-70 mb-1">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xl font-weight-bold text-primary text-uppercase">Motor Size (HP)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><input type="text" name="motor_size_load" id="motor_size_load"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><u>Electrical Power</u></h1>
    </div>

    <div class="row">
      <table class="table">
        <thead class="thead-light">
          <tr>
            <th scope="col"></th>
            <th scope="col"><u>Average/Total</u></th>
            <th scope="col"><u>L1/L1-L2</u></th>
            <th scope="col"><u>L2/L2-L3</u></th>
            <th scope="col"><u>L3/L1-L3</u></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row"><u>Voltage (V)</u></th>
            <td> <input type="text" name="averge_voltage" id="averge_voltage"> </td>
            <td> <input type="text" name="voltage_a" id="voltage_a"> </td>
            <td> <input type="text" name="voltage_b" id="voltage_b"> </td>
            <td> <input type="text" name="voltage_c" id="voltage_c"> </td>
          </tr>
          <tr>
            <th scope="row"><u>Voltage (L-L)</u></th>
            <td> <input type="text" name="averge_voltage_phase_to_phase" id="averge_voltage_phase_to_phase"> </td>
            <td> <input type="text" name="voltage_ab" id="voltage_ab"> </td>
            <td> <input type="text" name="voltage_bc" id="voltage_bc"> </td>
            <td> <input type="text" name="voltage_ca" id="voltage_ca"> </td>
          </tr>
          <tr>
            <th scope="row"><u>Current (A)</u></th>
            <td> <input type="text" name="total_current" id="total_current"> </td>
            <td> <input type="text" name="current_a" id="current_a"> </td>
            <td> <input type="text" name="current_b" id="current_b"> </td>
            <td> <input type="text" name="current_c" id="current_c"> </td>
          </tr>
          <tr>
            <th scope="row"><u>P.F.</u></th>
            <td> <input type="text" name="average_pf" id="average_pf"> </td>
            <td> <input type="text" name="pf_a" id="pf_a"> </td>
            <td> <input type="text" name="pf_b" id="pf_b"> </td>
            <td> <input type="text" name="pf_c" id="pf_c"> </td>
          </tr>
          <tr>
            <th scope="row"><u>Active Power (kW)</u></th>
            <td> <input type="text" name="average_power" id="average_power"> </td>
            <td> <input type="text" name="power_a" id="power_a"> </td>
            <td> <input type="text" name="power_b" id="power_b"> </td>
            <td> <input type="text" name="power_c" id="power_c"> </td>
          </tr>
          <tr>
            <th scope="row"><u>Frequency (Hz)</u></th>
             <td> <input type="text" name="frequency" id="frequency"> </td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
        </tbody>
      </table>
    </div>

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><u>Other</u></h1>
    </div>
    <div class="row">

      <div class="col-xl-2 col-md-2">
          <div class="card shadow h-70 mb-1">
              <div class="card-body">
                  <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                          <div class="text-xl font-weight-bold text-primary text-uppercase">Ambient Temperature(°C)</div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800"> <input type="text" style="width:150px" name="amb_temperature" id="amb_temperature"></div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="col-xl-2 col-md-2">
          <div class="card shadow h-70 mb-1">
              <div class="card-body">
                  <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                          <div class="text-xl font-weight-bold text-primary text-uppercase">Motor Temperature(°C)</div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800"><input type="text" style="width:150px" name="motor_temperature" id="motor_temperature"></div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="col-xl-2 col-md-2">
          <div class="card shadow h-70 mb-1">
              <div class="card-body">
                  <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                          <div class="text-xl font-weight-bold text-primary text-uppercase">Estimated Efficiency(%)</div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800"><input type="text" style="width:150px" name="motor_efficiency_load_test" id="motor_efficiency_load_test"></div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="col-xl-2 col-md-2">

      </div>
      <div class="col-xl-2 col-md-2">
        <input type="submit" value="Record Load Point" class="btn btn-primary"/>
      </div>
      <div class="col-xl-2 col-md-2">

          <a class="btn btn-primary" href="<?php echo base_url()."/motor_test/complete_test/".$test_id;?>"><i class="fas fa-edit"></i> Complete Test </a>
      </div>

    </div>
  </form>

</div>
