<div class="container">

    <h3 class="mt-3">Manage Users</h3>
    <?php if (session()->get('success')): ?>
        <div id="success_alert" class="alert alert-success fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?= session()->get('success') ?>
        </div>
    <?php endif; ?>
    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>User#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if($users):
                    $index = 0 ;
                    foreach($users as $user):
            ?>
                    <tr>
                        <td><?= $index+1 ?></td>
                        <td><?= $user['firstname'].' '.$user['lastname']  ?></td>
                        <td><?= $user['email']  ?></td>
                        <td><?= $user['phone'] ?></td>
                        <td class="text-center">
                            <a class="btn btn-primary" href="<?php echo base_url()."/users/edit/".$user['id'];?>"><i class="fas fa-edit"></i> Edit</a>
                            <a class="btn btn-danger" href="<?php echo base_url()."/users/delete/".$user['id'];?>"><i class="fas fa-trash-alt"></i> Delete</a>
                        </td>
                    </tr>
                <?php
                        $index++; 
                    endforeach;
                ?>
            <?php else:?>
                <tr>
                    <td colspan="5" class="text-center">No users found</td>
                </tr>
            <?php endif?>
        </tbody>
    </table>
</div>