<div class="container">

    <h3 class="mt-3">Items in Stock</h3>
    <?php if (session()->get('success')): ?>
        <div id="success_alert" class="alert alert-success fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?= session()->get('success') ?>
        </div>
    <?php endif; ?>
    <div class="row">
        <div class="col-md-12 px-2 py-2">
            <a class="btn btn-primary float-right" href="<?php echo base_url()."/stocks/print";?>"><i class="fas fa-print"></i> Print Stock Report</a>
        </div>
    </div>
    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Item#</th>
                <th>Name</th>
                <th>Quantity</th>
            </tr>
        </thead>
        <tbody>
            <?php if($stocks):
                    $index = 0 ;
                    foreach($stocks as $stock):
            ?>
                    <tr>
                        <td><?= $index+1 ?></td>
                        <td><?= $stock['label']  ?></td>
                        <td><?= $stock['quantity']  ?></td>
                    </tr>
                <?php
                        $index++; 
                    endforeach;
                ?>
            <?php else:?>
                <tr>
                    <td colspan="3" class="text-center">No Stocks found</td>
                </tr>
            <?php endif?>
        </tbody>
    </table>
</div>