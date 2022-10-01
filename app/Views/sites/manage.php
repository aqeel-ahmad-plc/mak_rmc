<div class="container">

    <h3 class="mt-3">Manage Sites</h3>
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
                <th>District</th>
                <th>Tehsil</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if($sites):
                    $index = 0 ;
                    foreach($sites as $site):
            ?>
                    <tr>
                        <td><?= $index+1 ?></td>
                        <td><?= $site['site_id']  ?></td>
                        <td><?= $site['district']  ?></td>
                        <td><?= $site['tehsil'] ?></td>
                        <td class="text-center">
                            <a class="btn btn-primary" href="<?php echo base_url()."/sites/edit/".$site['site_id'];?>"><i class="fas fa-edit"></i> Edit</a>
                            <?php if((session()->get("role") == 1)):?>
                                <a class="btn btn-danger" href="<?php echo base_url()."/sites/delete/".$site['site_id'];?>"><i class="fas fa-trash-alt"></i> Delete</a>
                            <?php endif?>
                        </td>
                    </tr>
                <?php
                        $index++; 
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