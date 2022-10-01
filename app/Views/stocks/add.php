<div class="container">

    <!-- <h3 class="mt-3">Add New Stock Items</h3> -->
    <?php if (session()->get('success')): ?>
    <div id="success_alert" class="alert alert-success fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                aria-hidden="true">&times;</span></button>
        <?= session()->get('success') ?>
    </div>
    <?php endif; ?>
    <!-- <div class="col-md-8 mt-3">
        <form action="<?php echo base_url()."/stocks/add";?>" method="post">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="label">Item Label</label>
                    <input type="text" class="form-control" name="label" id="label" value="<?= set_value('label') ?>"
                        placeholder="Enter Item Label">
                </div>
                <div class="form-group col-md-6">
                    <label for="quantity">Item Quantity</label>
                    <input type="text" class="form-control" name="quantity" id="quantity"
                        value="<?= set_value('quantity') ?>" placeholder="Enter Item Quantity">
                </div>
            </div>
            <button type="submit" class="btn btn-success">Add Item</button>
        </form>
    </div>
    <hr> -->
    <h3 class="mt-3">Update Existing Stock Items</h3>
    <div class="col-md-8 mt-3">
        <form action="<?php echo base_url()."/stocks/update";?>" method="post">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="item">Select Item</label>
                    <select class="custom-select" name="item" id="item">
                        <option value = "default" selected>Select Item</option>
                        <?php if($stocks):
                                foreach($stocks as $stock):
                        ?>
                                <option value="<?= $stock['sno']?>"><?= $stock['label']?></option>
                        <?php
                                endforeach;
                            endif;
                        ?>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="quantity">Item Quantity</label>
                    <input type="text" class="form-control" name="quantity" id="quantity"
                        value="<?= set_value('quantity') ?>" placeholder="Enter Item Quantity">

                </div>
                <div class="form-group col-md-3" id = "current_quantity_div" style="display: none;">
                    <label style="margin-top: 40px;"> + Current Quantity = <span id="current_quantity"> 0 </span></label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Update Item</button>
        </form>
    </div>

    <div class="mt-2">
        <?php if (isset($validation)): ?>
        <div class="col-12">
            <div class="alert alert-danger" role="alert">
                <?= $validation->listErrors() ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>
