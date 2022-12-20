<div class="container">

    <h3 class="mt-3">Manage Test</h3>
    <?php if (session()->get('success')): ?>
        <div id="success_alert" class="alert alert-success fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?= session()->get('success') ?>
        </div>
    <?php endif; ?>
    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>SNO</th>
                <th>Test Report No</th>
                <th>Test Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if($motor_tests):
                    $index = 0 ;
                    foreach($motor_tests as $motor_test):
            ?>
                    <tr>
                        <td><?= $index+1 ?></td>
                        <td><?= $motor_test['test_report_no']  ?></td>
                        <td><?= $motor_test['test_date']  ?></td>
                        <td class="text-center">
                          <a class="btn btn-primary" href="<?php echo base_url()."/motor_test/edit_rated_data/".$motor_test['id'];?>"><i class="fas fa-edit"></i> Edit Rated Data</a>
                              <?php if($motor_test['test_status'] == 0){?>
                              <a class="btn btn-primary" href="<?php echo base_url()."/motor_test/no_load_test/".$motor_test['id'];?>"><i class="fas fa-play"></i> Start Tests </a>
                            <?php } else if($motor_test['test_status'] == 1) { ?>
                              <a class="btn btn-primary" href="<?php echo base_url()."/motor_test/load_test/".$motor_test['id'];?>"><i class="fas fa-play"></i> Start Load Test </a>
                            <?php } else if($motor_test['test_status'] == 2){ ?>
                              <a class="btn btn-primary" href="<?php echo base_url()."/motor_test/generate_report/".$motor_test['id'];?>"><i class="fas fa-download"></i> Generate Report </a>
                              <a class="btn btn-primary" href="<?php echo base_url()."/motor_test/export_csv/".$motor_test['id'];?>"><i class="fas fa-download"></i> Generate CSV </a>
                            <?php } ?>
                        </td>
                    </tr>
                <?php
                        $index++;
                    endforeach;
                ?>
            <?php else:?>
                <tr>
                    <td colspan="6" class="text-center">No Test found</td>
                </tr>
            <?php endif?>
        </tbody>
    </table>
</div>
