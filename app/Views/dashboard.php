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
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><span id="torque"></span></div>
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
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><span id="rpm"></span></div>
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
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><span id="shaft_power"></span></div>
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
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><span id="loading_factor"></span></div>
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
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><span id="motor_size"></span></div>
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
            <td id="averge_voltage"></td>
            <td id="voltage_a"></td>
            <td id="voltage_b"></td>
            <td id="voltage_c"></td>
          </tr>
          <tr>
            <th scope="row"><u>Voltage (L-L)</u></th>
            <td id="averge_voltage_phase_to_phase"></td>
            <td id="voltage_ab"></td>
            <td id="voltage_bc"></td>
            <td id="voltage_ca"></td>
          </tr>
          <tr>
            <th scope="row"><u>Current (A)</u></th>
            <td id="total_current"></td>
            <td id="current_a"></td>
            <td id="current_b"></td>
            <td id="current_c"></td>
          </tr>
          <tr>
            <th scope="row"><u>P.F.</u></th>
            <td id="average_pf"></td>
            <td id="pf_a"></td>
            <td id="pf_b"></td>
            <td id="pf_c"></td>
          </tr>
          <tr>
            <th scope="row"><u>Active Power (kW)</u></th>
            <td id="average_power"></td>
            <td id="power_a"></td>
            <td id="power_b"></td>
            <td id="power_c"></td>
          </tr>
          <tr>
            <th scope="row"><u>Frequency (Hz)</u></th>
            <td id="frequency"></td>
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
                          <div class="h5 mb-0 font-weight-bold text-gray-800"><span id="amb_temperature"><span></div>
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
                          <div class="h5 mb-0 font-weight-bold text-gray-800"><span id="motor_temperature"><span></div>
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
                          <div class="h5 mb-0 font-weight-bold text-gray-800"><span id="motor_efficiency"><span></div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="col-xl-2 col-md-2">

      </div>
      <div class="col-xl-2 col-md-2">
        <input type="button" value="Screen Shot" class="btn btn-primary" onclick="capture()"/>
      </div>

    </div>


</div>
