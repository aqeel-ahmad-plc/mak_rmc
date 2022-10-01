<div class="container">

    <h3 class="mt-3">Final Tested Sites Reports</h3>
    <?php if (session()->get('success')): ?>
    <div id="success_alert" class="alert alert-success fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                aria-hidden="true">&times;</span></button>
        <?= session()->get('success') ?>
    </div>
    <?php endif; ?>
    <div class="row">
        <form action="<?php echo base_url()."/reports/print_final_tested_report";?>" method="post">
            <div class="form-row">
                <div class="form-group ol-lg-3 col-md-3 col-sm-3">
                    <label for="report_filter">Report</label>
                    <select class="custom-select" name="report_filter" id="report_filter">
                        <option value="all">All</option>
                        <option value="package">Package Wise</option>
                        <option value="district">District Wise</option>
                        <!-- <option value="constituency">Constituency Wise</option> -->
                    </select>
                </div>
                <div class="form-group ol-lg-3 col-md-3 col-sm-3">
                    <label for="package_sub_filter" style="display: none;" id="package_sub_filter_label">Package</label>
                    <select class="custom-select" name="package_sub_filter" id="package_sub_filter_options"
                        style="display: none;">
                        <option value="05">Package 5</option>
                        <option value="06">Package 6</option>
                    </select>
                    <label for="district_sub_filter" style="display: none;"
                        id="district_sub_filter_label">District</label>
                    <select class="custom-select" name="district_sub_filter" id="district_sub_filter_options"
                        style="display: none;">
                        <option value="Swat">Swat</option>
                        <option value="Buner">Buner</option>
                        <option value="Shangla">Shangla</option>
                        <option value="Malakand">Malakand</option>
                        <option value="Dir Lower">Dir Lower</option>
                    </select>
                    <!-- <label for="report_sub_filter" style="display: none;"
                        id="constituency_filter_label">Constituency</label>
                    <select class="custom-select" name="report_sub_filter" id="constituency_filter_options"
                        style="display: none;">
                        <option value="swat">Swat</option>
                        <option value="buner">Buner</option>
                        <option value="shangla">Shangla</option>
                        <option value="dirlower">Dir Lower</option>
                    </select> -->
                </div>
                <div class="form-group ol-lg-3 col-md-3 col-sm-3">
                    <label for="print_as">Print As</label>
                    <select class="custom-select" name="print_as" id="print_as">
                        <option value="pdf">PDF</option>
                        <option value="csv">CSV</option>
                    </select>
                </div>
                <div class="form-group ol-lg-3 col-md-3 col-sm-3 py-4 mt-2">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-download"></i> Print</button>
                </div>
            </div>
        </form>
    </div>
    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Site#</th>
                <th>Site ID</th>
                <th>Masjid Name</th>
                <th>NA/PK</th>
                <th>District</th>
                <th>Download</th>
            </tr>
        </thead>
        <tbody>
            <?php if($serveys):
                    $index = 0 ;
                    foreach($serveys as $servey):
                        if($servey['fat_status']):
            ?>
            <tr>
                <td><?= $index+1 ?></td>
                <td><?= $servey['siteid']  ?></td>
                <td><?= $servey['masgid']  ?></td>
                <td><?= $servey['na_pk'] ?></td>
                <td><?= $servey['district'] ?></td>
                <td class="text-center"><a class="btn btn-primary"
                        href="<?php echo base_url()."/reports/print_final_testing_report/".$servey['site_id'];?>"><i
                            class="fas fa-download"></i> PDF</a></td>
            </tr>
            <?php
                        $index++;
                        endif;
                    endforeach;
                ?>
            <?php else:?>
            <tr>
                <td colspan="6" class="text-center">No sites found</td>
            </tr>
            <?php endif?>
        </tbody>
    </table>
</div>