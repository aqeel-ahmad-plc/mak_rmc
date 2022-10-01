<div class="container">

    <h3 class="mt-3">View Problematic Sites</h3>
    <?php if (session()->get('success')): ?>
        <div id="success_alert" class="alert alert-success fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?= session()->get('success') ?>
        </div>
    <?php endif; ?>
    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Servey#</th>
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
                            <a class="btn btn-primary" href="<?php echo base_url()."/problematic/view_survey/".$servey['site_id'];?>"> <i class="fas fa-eye"></i> View Site</a>
                        </td>
                    </tr>
                <?php
                        $index++;
                    endforeach;
                ?>
            <?php else:?>
                <tr>
                    <td colspan="5" class="text-center">No Sites found</td>
                </tr>
            <?php endif?>
        </tbody>
    </table>
</div>
