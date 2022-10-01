<div class="container">

    <h3 class="mt-3">View Surveys</h3>
    <?php if (session()->get('success')): ?>
        <div id="success_alert" class="alert alert-success fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?= session()->get('success') ?>
        </div>
    <?php endif; ?>
    <div class="row">
        <div class="col-md-12 px-2 py-2">
            <a class="btn btn-primary float-right" href="<?php echo base_url()."/serveys/print_surveyed";?>"><i class="fas fa-print"></i> Print Surveyed Sites</a>
        </div>
    </div>
    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Site#</th>
                <th>Site ID</th>
                <th>Masjid Name</th>
                <th>NA/PK</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if($serveys):
                    $index = 0 ;
                    foreach($serveys as $servey):
            ?>
                    <tr>
                        <td><?= $index+1 ?></td>
                        <td><?= $servey['siteid']  ?></td>
                        <td><?= $servey['masgid']  ?></td>
                        <td><?= $servey['na_pk']  ?></td>
                        <td class="text-center">
                            <a class="btn btn-primary" href="<?php echo base_url()."/serveys/view_servey/".$servey['site_id'];?>"> <i class="fas fa-eye"></i> View Survey</a>
                        </td>
                    </tr>
                <?php
                        $index++;
                    endforeach;
                ?>
            <?php else:?>
                <tr>
                    <td colspan="5" class="text-center">No serveys found</td>
                </tr>
            <?php endif?>
        </tbody>
    </table>
</div>
