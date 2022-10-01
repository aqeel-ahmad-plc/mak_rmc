<div class="pt-2 px-4">
    <h3 class="mt-3">FAT Passed & Failed Sites</h3>
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="passed-sites-tab" data-toggle="tab" href="#passed" role="tab"
                aria-controls="passed-sites" aria-selected="true">Passed Sites</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="failed-sites-tab" data-toggle="tab" href="#failed-sites" role="tab"
                aria-controls="failed-sites" aria-selected="false">Failed Sites</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="passed-sites" role="tabpanel" aria-labelledby="passed-sites-tab">
            <div class="px-2 py-2">
                <div class="row">
                    <div class="col-md-12 px-2 py-2">
                        <a class="btn btn-primary float-right" href="<?php echo base_url()."/fat/print_fat_passed_failed/2";?>"><i class="fas fa-print"></i> Print Passed Sites</a>
                    </div>
                </div>
                <table id="passed-sites-table" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Site#</th>
                            <th>Site ID</th>
                            <th>Masjid Name</th>
                            <th>District</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if($fats):
                            $index = 0 ;
                            foreach($fats as $fat):
                                if($fat['fat_result'] == 1):
                        ?>
                        <tr>
                            <td><?= $index+1 ?></td>
                            <td><?= $fat['siteid']  ?></td>
                            <td><?= $fat['masgid']  ?></td>
                            <td><?= $fat['district']  ?></td>
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
        <div class="tab-pane fade" id="failed-sites" role="tabpanel" aria-labelledby="failed-sites-tab">
            <div class="px-2 py-2">
                <div class="row">
                    <div class="col-md-12 px-2 py-2">
                        <a class="btn btn-primary float-right" href="<?php echo base_url()."/fat/print_fat_passed_failed/1";?>"><i class="fas fa-print"></i> Print Failed Sites</a>
                    </div>
                </div>
                <table id="failed-sites-table" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Site#</th>
                            <th>Site ID</th>
                            <th>Masjid Name</th>
                            <th>District</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if($fats):
                            $index = 0 ;
                            foreach($fats as $fat):
                                
                                if($fat['fat_result'] == 0):
                        ?>
                        <tr>
                            <td><?= $index+1 ?></td>
                            <td><?= $fat['siteid']  ?></td>
                            <td><?= $fat['masgid']  ?></td>
                            <td><?= $fat['district']  ?></td>
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