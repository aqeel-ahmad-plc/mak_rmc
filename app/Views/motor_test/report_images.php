<div class="container">

        <?php if (session()->get('success')): ?>
        <div id="success_alert" class="alert alert-success fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?= session()->get('success') ?>
        </div>
        <?php endif; ?>

    <h3 class="mt-3">Upload Logo</h3>
    <form action="<?php echo base_url()."/motor_test/report_images";?>" method="post" enctype="multipart/form-data">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="logo">Logo</label>
                <input type="file" class="form-control" name="logo" id="logo" required>
            </div>
        </div>

        <h3 class="mt-3">Upload Title Page Pictures</h3>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="first_title_image">First Title Picture</label>
                <input type="file" class="form-control" name="first_title_image" id="first_title_image" required>
            </div>
            <div class="form-group col-md-6">
                <label for="second_title_image">Second Title Picture</label>
                <input type="file" class="form-control" name="second_title_image" id="second_title_image" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="third_title_image">Third Title Picture</label>
                <input type="file" class="form-control" name="third_title_image" id="third_title_image" required>
            </div>
        </div>



        <div>
            <?php if (isset($validation)): ?>
            <div class="col-12">
                <div class="alert alert-danger" role="alert">
                    <?= $validation->listErrors() ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
        <button type="submit" class="btn btn-primary">Upload</button>
    </form>
</div>