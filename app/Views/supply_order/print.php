<div class="container">

    <h3 class="mt-3">Print Supply Orders</h3>
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
            <?php if($sites):
                    $index = 0 ;
                    foreach($sites as $site):
            ?>
                    <tr>
                        <td><?= $index+1 ?></td>
                        <td><?= $site['site_id']  ?></td>
                        <td><?= $site['masgid']  ?></td>
                        <td><?= $site['na_pk'] ?></td>
                        <td class="text-center">
                            <a class="btn btn-primary" href="<?php echo base_url()."/supply_order/print/".$site['id'];?>" ><i class="fas fa-print"></i> Print Supply Order</a>
                            <a class="btn btn-primary" href="<?php echo base_url()."/supply_order/print_packing_list/".$site['id'];?>" ><i class="fas fa-print"></i> Print Packing List</a>
                        </td>
                    </tr>
                <?php
                        $index++;
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
