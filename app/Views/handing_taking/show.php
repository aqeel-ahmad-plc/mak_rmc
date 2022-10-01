<div class="container">

    <h3 class="mt-3">View Site Handing/Takings</h3>
    <?php if (session()->get('success')): ?>
        <div id="success_alert" class="alert alert-success fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?= session()->get('success') ?>
        </div>
    <?php endif; ?>
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
            <?php if($handing_takings):
                    $index = 0 ;
                    foreach($handing_takings as $handing_taking):
            ?>
                    <tr>
                        <td><?= $index+1 ?></td>
                        <td><?= $handing_taking['siteid']  ?></td>
                        <td><?= $handing_taking['masgid']  ?></td>
                        <td><?= $handing_taking['na_pk']  ?></td>
                        <td class="text-center">
                            <a class="btn btn-primary" href="<?php echo base_url()."/handing_taking/view_handing_taking/".$handing_taking['site_id'];?>"> <i class="fas fa-eye"></i> View Site Handing/Taking</a>
                        </td>
                    </tr>
                <?php
                        $index++;
                    endforeach;
                ?>
            <?php else:?>
                <tr>
                    <td colspan="5" class="text-center">No Site Handing/Taking found</td>
                </tr>
            <?php endif?>
        </tbody>
    </table>
</div>
