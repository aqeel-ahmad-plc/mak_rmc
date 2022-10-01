<div class="container">

    <h3 class="mt-3">Surveys Approval</h3>
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
                <th>Approval Status</th>
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
                        <td>
                            <?php if($servey['status'] == 1): ?>
                                <spane style='color:green;'>Approved</span>
                            <?php elseif($servey['status'] == 2): ?>
                                <spane style='color:red;'>Rejected</span>
                            <?php else: ?>
                                <spane style='color:orange;'>Pending</span>
                            <?php endif ?>
                        </td>
                        <td class="text-center">
                            <?php
                                if($servey['status'] == 1 || $servey['status'] == 2)
                                {
                                    $style = "  cursor: not-allowed;opacity: 0.5;text-decoration: none;pointer-events: none; ";
                                }
                                else
                                {
                                    $style = "";
                                }
                            ?>
                            <a class="btn btn-success" href="<?php echo base_url()."/serveys/approve/".$servey['id'];?>" style = "<?= $style  ?>"> <i class="fas fa-check-circle"></i></i> Approve Survey</a>
                            <a class="btn btn-danger" href="<?php echo base_url()."/serveys/reject/".$servey['id'];?>" style = "<?= $style  ?>"> <i class="fas fa-times-circle"></i></i> Reject Survey</a>
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
