<div class="pt-2 px-4">
    <h3 class="mt-3">Site Status and Feasibility</h3>
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="not-ok-sites-tab" data-toggle="tab" href="#not-ok-sites" role="tab"
                aria-controls="not-ok-sites" aria-selected="true">Not-Ok Sites</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="non-feasible-sites-tab" data-toggle="tab" href="#non-feasible-sites" role="tab"
                aria-controls="non-feasible-sites" aria-selected="false">Non-Feasible Sites</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="not-ok-sites" role="tabpanel" aria-labelledby="not-ok-sites-tab">
            <div class="px-2 py-2">
                <div class="row">
                    <div class="col-md-12 px-2 py-2">
                        <a class="btn btn-primary float-right" href="<?php echo base_url()."/serveys/print_status_and_feasibility/1";?>"><i class="fas fa-print"></i> Print Not-Ok Sites</a>
                    </div>
                </div>
                <table id="not-ok-sites-table" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Site#</th>
                            <th>Site ID</th>
                            <th>Masjid Name</th>
                            <th>District</th>
                            <th>Problem Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if($serveys):
                            $index = 0 ;
                            foreach($serveys as $servey):
                                if($servey['site_status'] == 0):
                        ?>
                        <tr>
                            <td><?= $index+1 ?></td>
                            <td><?= $servey['siteid']  ?></td>
                            <td><?= $servey['masgid']  ?></td>
                            <td><?= $servey['district']  ?></td>
                            <td><?= $servey['problem_description']  ?></td>
                        </tr>
                        <?php
                                    $index++;
                                endif;
                            endforeach;
                        ?>
                        <?php else:?>
                        <tr>
                            <td colspan="5" class="text-center">No sites found</td>
                        </tr>
                        <?php endif?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="tab-pane fade" id="non-feasible-sites" role="tabpanel" aria-labelledby="non-feasible-sites-tab">
            <div class="px-2 py-2">
                <div class="row">
                    <div class="col-md-12 px-2 py-2">
                        <a class="btn btn-primary float-right" href="<?php echo base_url()."/serveys/print_status_and_feasibility/2";?>"><i class="fas fa-print"></i> Print Non-Feasible Sites</a>
                    </div>
                </div>
                <table id="non-feasible-sites-table" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Site#</th>
                            <th>Site ID</th>
                            <th>Masjid Name</th>
                            <th>District</th>
                            <th>Remarks</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if($serveys):
                            $index = 0 ;
                            foreach($serveys as $servey):
                                
                                if($servey['site_feasibility'] == 0):
                        ?>
                        <tr>
                            <td><?= $index+1 ?></td>
                            <td><?= $servey['siteid']  ?></td>
                            <td><?= $servey['masgid']  ?></td>
                            <td><?= $servey['district']  ?></td>
                            <td><?= $servey['remarks']  ?></td>
                        </tr>
                        <?php
                                $index++;
                                endif;
                            endforeach;
                        ?>
                        <?php else:?>
                        <tr>
                            <td colspan="5" class="text-center">No sites found</td>
                        </tr>
                        <?php endif?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>