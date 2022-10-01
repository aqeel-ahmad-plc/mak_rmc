<div class="container">

    <h3 class="mt-3">Manage Supply Orders</h3>
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
                <th>Supply Order Status</th>
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
                        <td><?= ($site['supply_order_status'] == 1) ? "<spane style='color:green;'>Supply Order Created</span>" : "<spane style='color:red;'>Pending</span>" ?></td>
                        <td class="text-center">
                        <?php if($site["supply_order_status"]):?>
                            <?php
                                if(session()->get("role") == 1)
                                {
                                    $style = "";
                                }
                                else
                                {
                                    $style = "  cursor: not-allowed;opacity: 0.5;text-decoration: none;pointer-events: none; ";
                                }
                            ?>
                            <a class="btn btn-danger" href="<?php echo base_url()."/supply_order/delete/".$site['id'];?>"  style = "<?= $style  ?>"><i class="fas fa-trash"></i> Delete</a>
                        <?php else:?>
                            <a class="btn btn-primary" href="<?php echo base_url()."/supply_order/create/".$site['id'];?>" ><i class="fas fa-edit"></i> Supply Order</a>
                        <?php endif;?>
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
