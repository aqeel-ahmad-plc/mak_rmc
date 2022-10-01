<div class="container">

    <h3 class="mt-3">View Site FATS</h3>
    <?php if (session()->get('success')): ?>
        <div id="success_alert" class="alert alert-success fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?= session()->get('success') ?>
        </div>
    <?php endif; ?>
    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Site Fat#</th>
                <th>Site ID</th>
                <th>Masjid Name</th>
                <th>NA/PK</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if($fats):
                    $index = 0 ;
                    foreach($fats as $fat):
            ?>
                    <tr>
                        <td><?= $index+1 ?></td>
                        <td><?= $fat['siteid']  ?></td>
                        <td><?= $fat['masgid']  ?></td>
                        <td><?= $fat['na_pk']  ?></td>
                        <td class="text-center">
                            <a class="btn btn-primary" href="<?php echo base_url()."/fat/view_fat/".$fat['site_id'];?>"> <i class="fas fa-eye"></i> View Site FAT</a>
                        </td>
                    </tr>
                <?php
                        $index++;
                    endforeach;
                ?>
            <?php else:?>
                <tr>
                    <td colspan="5" class="text-center">No Site installations found</td>
                </tr>
            <?php endif?>
        </tbody>
    </table>
</div>
