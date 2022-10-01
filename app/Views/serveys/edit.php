<div class="container">

    <h3 class="mt-3">Site Survey</h3>
    <form action="<?php echo base_url()."/serveys/edit/".$servey[0]['site_id'];?>" method="post"
        enctype="multipart/form-data">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="contractor_rep_name">Contractor Rep. Name</label>
                <input type="text" class="form-control" name="contractor_rep_name" id="contractor_rep_name"
                    value="<?= set_value('contractor_rep_name', $servey[0]['contractor_rep_name'], $servey[0]['contractor_rep_name']) ?>"
                    placeholder="Enter Contractor Rep. Name">
            </div>
            <div class="form-group col-md-6">
                <label for="consultant_rep_name">Consultant Rep. Name</label>
                <input type="text" class="form-control" name="consultant_rep_name" id="consultant_rep_name"
                    value="<?= set_value('consultant_rep_name', $servey[0]['consultant_rep_name']) ?>"
                    placeholder="Enter Consultant Rep. Name">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="client_rep_name">Client Rep. Name</label>
                <input type="text" class="form-control" name="client_rep_name" id="client_rep_name"
                    value="<?= set_value('client_rep_name', $servey[0]['client_rep_name']) ?>"
                    placeholder="Enter Client Rep. Name">
            </div>
            <div class="form-group col-md-6">
                <label for="address">Address</label>
                <input type="text" class="form-control" name="address" id="address"
                    value="<?= set_value('address', $servey[0]['address']) ?>" placeholder="Enter Address">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <?php
                    $coordinates = explode(' ',$servey[0]['gps_coordinates_n']);
                    $degree = $coordinates[0];
                    $minute = $coordinates[1];
                    $second = $coordinates[2];
                ?>
                <label for="gps_coordinates_n">GPS Coordinates (N)</label>
                <div class="form-row">
                    <div class="col">
                        <input type="number" step="0.00001" class="form-control" name="gps_coordinates_n_degree" id="gps_coordinates_n_degree"
                            value="<?= set_value('gps_coordinates_n_degree', $degree) ?>"
                            placeholder="Degree">
                    </div>
                    <div class="col">
                        <input type="number" step="0.00001" class="form-control" name="gps_coordinates_n_minute" id="gps_coordinates_n_minute"
                            value="<?= set_value('gps_coordinates_n_minute', $minute) ?>"
                            placeholder="Minutes">
                    </div>
                    <div class="col">
                        <input type="number" step="0.00001" class="form-control" name="gps_coordinates_n_second" id="gps_coordinates_n_second"
                            value="<?= set_value('gps_coordinates_n_second', $second) ?>"
                            placeholder="Seconds">
                    </div>
                </div>
            </div>
            <div class="form-group col-md-6">
                <?php
                    $coordinates = explode(' ',$servey[0]['gps_coordinates_e']);
                    $degree = $coordinates[0];
                    $minute = $coordinates[1];
                    $second = $coordinates[2];
                ?>
                <label for="gps_coordinates_e">GPS Coordinates (E)</label>
                <div class="form-row">
                    <div class="col">
                        <input type="number" step="0.00001" class="form-control" name="gps_coordinates_e_degree" id="gps_coordinates_e_degree"
                            value="<?= set_value('gps_coordinates_e_degree', $degree) ?>"
                            placeholder="Degree">
                    </div>
                    <div class="col">
                        <input type="number" step="0.00001" class="form-control" name="gps_coordinates_e_minute" id="gps_coordinates_e_minute"
                            value="<?= set_value('gps_coordinates_e_minute', $minute) ?>"
                            placeholder="Minutes">
                    </div>
                    <div class="col">
                        <input type="number" step="0.00001" class="form-control" name="gps_coordinates_e_second" id="gps_coordinates_e_second"
                            value="<?= set_value('gps_coordinates_e_second', $second) ?>"
                            placeholder="Seconds">
                    </div>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="khatib_caretaker_name">Khatib/ Caretaker Name</label>
                <input type="text" class="form-control" name="khatib_caretaker_name" id="khatib_caretaker_name"
                    value="<?= set_value('khatib_caretaker_name', $servey[0]['khatib_caretaker_name']) ?>"
                    placeholder="Enter Khatib/ Caretaker Name">
            </div>
            <div class="form-group col-md-6">
                <label for="khatib_caretaker_cnic">Khatib/ Caretaker CNIC</label>
                <input type="text" class="form-control" name="khatib_caretaker_cnic" id="khatib_caretaker_cnic"
                    value="<?= set_value('khatib_caretaker_cnic', $servey[0]['khatib_caretaker_cnic']) ?>"
                    placeholder="Enter Khatib/ Caretaker CNIC">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="khatib_caretaker_cell_no">Khatib/ Caretaker Cell No</label>
                <input type="text" class="form-control" name="khatib_caretaker_cell_no" id="khatib_caretaker_cell_no"
                    value="<?= set_value('khatib_caretaker_cell_no', $servey[0]['khatib_caretaker_cell_no']) ?>"
                    placeholder="Enter Khatib/ Caretaker Cell No">
            </div>
            <div class="form-group col-md-6">
                <label for="inverter_pv_modules_distance">Distance Between Inverter & PV Modules (ft.)</label>
                <input type="text" class="form-control" name="inverter_pv_modules_distance"
                    id="inverter_pv_modules_distance"
                    value="<?= set_value('inverter_pv_modules_distance', $servey[0]['inverter_pv_modules_distance']) ?>"
                    placeholder="Enter Distance Between Inverter & PV Modules (ft.)">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inverter_earth_distance">Distance Between Inverter & Earth (ft.)</label>
                <input type="text" class="form-control" name="inverter_earth_distance" id="inverter_earth_distance"
                    value="<?= set_value('inverter_earth_distance', $servey[0]['inverter_earth_distance']) ?>"
                    placeholder="Enter Distance Between Inverter & Earth (ft.)">
            </div>
            <div class="form-group col-md-6">
                <label for="inverter_mdb_distance">Distance Between Inverter & MDB (ft.)</label>
                <input type="text" class="form-control" name="inverter_mdb_distance" id="inverter_mdb_distance"
                    value="<?= set_value('inverter_mdb_distance', $servey[0]['inverter_mdb_distance']) ?>"
                    placeholder="Enter Distance Between Inverter & MDB (ft.)">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="roof_top_type">Roof Top Type</label>
                <select class="custom-select" name="roof_top_type" id="roof_top_type">
                    <option value="0" <?= $servey[0]['roof_top_type'] == 0 ? 'selected': '' ?>>Bare RCC</option>
                    <option value="1" <?= $servey[0]['roof_top_type'] == 1 ? 'selected': '' ?>>RCC with Brick Lining
                    </option>
                    <option value="2" <?= $servey[0]['roof_top_type'] == 2 ? 'selected': '' ?>>Mud/ Choka</option>
                    <option value="3" <?= $servey[0]['roof_top_type'] == 3 ? 'selected': '' ?>>Shutter roof / Corrugated sheet roof</option>
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="no_of_stories">No. of Stories</label>
                <input type="text" class="form-control" name="no_of_stories" id="no_of_stories"
                    value="<?= set_value('no_of_stories', $servey[0]['no_of_stories']) ?>"
                    placeholder="Enter No. of Stories">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="mounting_type">Mounting Type</label>
                <select class="custom-select" name="mounting_type" id="mounting_type">
                    <option value="0" <?= $servey[0]['mounting_type'] == 0 ? 'selected': '' ?>>Rooftop Anchored</option>
                    <option value="1" <?= $servey[0]['mounting_type'] == 1 ? 'selected': '' ?>>Rooftop Foundation
                    </option>
                    <option value="2" <?= $servey[0]['mounting_type'] == 2 ? 'selected': '' ?>>Ground Fixed</option>
                    <option value="3" <?= $servey[0]['mounting_type'] == 3 ? 'selected': '' ?>>Ground Pole Mounted
                    </option>
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="motor_hp">Motor HP</label>
                <input type="text" class="form-control" name="motor_hp" id="motor_hp"
                    value="<?= set_value('motor_hp', $servey[0]['motor_hp']) ?>" placeholder="Enter Motor HP">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="motor_ampere">Motor Ampere (A)</label>
                <input type="text" class="form-control" name="motor_ampere" id="motor_ampere"
                    value="<?= set_value('motor_ampere', $servey[0]['motor_ampere']) ?>"
                    placeholder="Enter Motor Ampere (A)">
            </div>
            <div class="form-group col-md-6">
                <label for="motor_input_power">Motor Input Power (W)</label>
                <input type="text" class="form-control" name="motor_input_power" id="motor_input_power"
                    value="<?= set_value('motor_input_power', $servey[0]['motor_input_power']) ?>"
                    placeholder="Enter Motor Input Power (W)">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="motor_to_connect">Motor to Connect</label>
                <select class="custom-select" name="motor_to_connect" id="motor_to_connect">
                    <option value="0" <?= $servey[0]['motor_to_connect'] == 0 ? 'selected': '' ?>>No</option>
                    <option value="1" <?= $servey[0]['motor_to_connect'] == 1 ? 'selected': '' ?>>Yes</option>
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="existing_no_of_fans">Existing Nos. of Fans</label>
                <input type="text" class="form-control" name="existing_no_of_fans" id="existing_no_of_fans"
                    value="<?= set_value('existing_no_of_fans', $servey[0]['existing_no_of_fans']) ?>"
                    placeholder="Enter Existing Nos. of Fans">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="existing_no_of_lights">Existing Nos. of Lights</label>
                <input type="text" class="form-control" name="existing_no_of_lights" id="existing_no_of_lights"
                    value="<?= set_value('existing_no_of_lights', $servey[0]['existing_no_of_lights']) ?>"
                    placeholder="Enter Existing Nos. of Lights">
            </div>
            <div class="form-group col-md-6">
                <label for="existing_wiring_type">Existing Wiring Type</label>
                <select class="custom-select" name="existing_wiring_type" id="existing_wiring_type">
                    <option value="0" <?= $servey[0]['existing_wiring_type'] == 0 ? 'selected': '' ?>>Concealed</option>
                    <option value="1" <?= $servey[0]['existing_wiring_type'] == 1 ? 'selected': '' ?>>Open</option>
                </select>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="khatib_caretaker_pic_path">Khatib/ Caretaker Pic</label>
                <div>
                    <label for="khatib_caretaker_pic_path">Select a file:</label>
                    <input type="file" id="khatib_caretaker_pic_path" name="khatib_caretaker_pic_path">
                </div>
            </div>
            <div class="form-group col-md-6">
                <label for="site_sketch_pic_path">Site Sketch Pic</label>
                <div>
                    <label for="site_sketch_pic_path">Select a file:</label>
                    <input type="file" id="site_sketch_pic_path" name="site_sketch_pic_path">
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="roof_top_pic_01_path">Roof top Pic - 01</label>
                <div>
                    <label for="roof_top_pic_01_path">Select a file:</label>
                    <input type="file" id="roof_top_pic_01_path" name="roof_top_pic_01_path">
                </div>
            </div>
            <div class="form-group col-md-6">
                <label for="roof_top_pic_02_path">Roof top Pic - 02</label>
                <div>
                    <label for="roof_top_pic_02_path">Select a file:</label>
                    <input type="file" id="roof_top_pic_02_path" name="roof_top_pic_02_path">
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="mdb_pic_path">MDB Pic</label>
                <div>
                    <label for="mdb_pic_path">Select a file:</label>
                    <input type="file" id="mdb_pic_path" name="mdb_pic_path">
                </div>
            </div>
            <div class="form-group col-md-6">
                <label for="inverter_placement_pic_path">Inverter Placement Pic</label>
                <div>
                    <label for="inverter_placement_pic_path">Select a file:</label>
                    <input type="file" id="inverter_placement_pic_path" name="inverter_placement_pic_path">
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="earth_point_pic_path">Earth Point Pic</label>
                <div>
                    <label for="earth_point_pic_path">Select a file:</label>
                    <input type="file" id="earth_point_pic_path" name="earth_point_pic_path">
                </div>
            </div>
            <div class="form-group col-md-6">
                <label for="motor_pic_path">Motor Pic</label>
                <div>
                    <label for="motor_pic_path">Select a file:</label>
                    <input type="file" id="motor_pic_path" name="motor_pic_path">
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="internal_wiring_pic_path">Internal Wiring Pic</label>
                <div>
                    <label for="internal_wiring_pic_path">Select a file:</label>
                    <input type="file" id="internal_wiring_pic_path" name="internal_wiring_pic_path">
                </div>
            </div>
            <div class="form-group col-md-6">
                <label for="optional_pic_01_path">Optional Pic-01</label>
                <div>
                    <label for="optional_pic_01_path">Select a file:</label>
                    <input type="file" id="optional_pic_01_path" name="optional_pic_01_path">
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="optional_pic_02_path">Optional Pic-02</label>
                <div>
                    <label for="optional_pic_02_path">Select a file:</label>
                    <input type="file" id="optional_pic_02_path" name="optional_pic_02_path">
                </div>
            </div>
            <div class="form-group col-md-6">
                <label for="optional_pic_03_path">Optional Pic-03</label>
                <div>
                    <label for="optional_pic_03_path">Select a file:</label>
                    <input type="file" id="optional_pic_03_path" name="optional_pic_03_path">
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="optional_pic_04_path">Optional Pic-04</label>
                <div>
                    <label for="optional_pic_04_path">Select a file:</label>
                    <input type="file" id="optional_pic_04_path" name="optional_pic_04_path">
                </div>
            </div>
            <div class="form-group col-md-6">
                <label for="optional_pic_05_path">Optional Pic-05</label>
                <div>
                    <label for="optional_pic_05_path">Select a file:</label>
                    <input type="file" id="optional_pic_05_path" name="optional_pic_05_path">
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="rep_group_pic_path">Rep. Group Pic</label>
                <div>
                    <label for="rep_group_pic_path">Select a file:</label>
                    <input type="file" id="rep_group_pic_path" name="rep_group_pic_path">
                </div>
            </div>
            <div class="form-group col-md-6">
                <label for="line_voltage">Line Voltage</label>
                <input type="text" class="form-control" name="line_voltage" id="line_voltage"
                    value="<?= set_value('line_voltage', $servey[0]['line_voltage']) ?>"
                    placeholder="Enter Line Voltage">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="site_feasibility">Site Feasibility</label>
                <select class="custom-select" name="site_feasibility" id="site_feasibility">
                    <option value="0" <?= $servey[0]['site_feasibility'] == 0 ? 'selected': '' ?>>No</option>
                    <option value="1" <?= $servey[0]['site_feasibility'] == 1 ? 'selected': '' ?>>Yes</option>
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="site_status">Status of Site</label>
                <select class="custom-select" name="site_status" id="site_status">
                    <option value="0" <?= $servey[0]['site_status'] == 0 ? 'selected': '' ?>>Problematic</option>
                    <option value="1" <?= $servey[0]['site_status'] == 1 ? 'selected': '' ?>>Ready</option>
                </select>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="problem_description">Problem Description</label>
                <small class="text-muted">(If Status of Site is Problematic then enter description)</small>
                <textarea type="text" class="form-control" name="problem_description" id="problem_description"
                    rows="3"><?= $servey[0]['problem_description']; ?></textarea>
            </div>
            <div class="form-group col-md-6">
                <label for="remarks">Remarks</label>
                <textarea type="text" class="form-control" name="remarks" id="remarks"
                    rows="3"><?= $servey[0]['remarks']; ?></textarea>
            </div>
            <input type="hidden" class="form-control" name="site_id" id="site_id"
                value="<?php echo $servey[0]['site_id'];?>">
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
        <button type="submit" class="btn btn-primary">Update Survey</button>
        <a href="<?php echo base_url()."/serveys/manage";?>" class="btn btn-secondary">Cancel</a>
    </form>
</div>
