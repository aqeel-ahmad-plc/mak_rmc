<div class="container">

    <h3 class="mt-3">Edit User</h3>
    <form action="<?php echo base_url()."/users/edit/".$user['id'];?>" method="post">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="firstname">First Name</label>
                <input type="text" class="form-control" name="firstname" id="firstname" value="<?= set_value('firstname',$user['firstname']) ?>" placeholder="Enter First Name">
            </div>
            <div class="form-group col-md-6">
                <label for="lastname">Last Name</label>
                <input type="text" class="form-control" name="lastname" id="lastname" value="<?= set_value('lastname',$user['lastname']) ?>" placeholder="Enter Last Name">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="username">User Name</label>
                <input type="text" class="form-control" name="username" id="username" value="<?= set_value('username',$user['username']) ?>" placeholder="Enter User Name">
            </div>
            <div class="form-group col-md-6">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" id="email" value="<?= set_value('email',$user['email']) ?>" placeholder="Enter Email">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Enter Password">
            </div>
            <div class="form-group col-md-6">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" class="form-control" name="confirm_password" id="confirm_password"
                    placeholder="Enter Confirm Password">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="phone">Phone Number</label>
                <input type="text" class="form-control" name="phone" id="phone" value="<?= set_value('phone',$user['phone']) ?>" placeholder="Enter Phone Number">
            </div>
            <div class="form-group col-md-6">
                <label for="gender">Gender</label>
                <select class="custom-select" name="gender" id="gender">
                    <option value="1" <?= $user['gender'] == 1 ? 'selected': '' ?>>Male</option>
                    <option value="2" <?= $user['gender'] == 2 ? 'selected': '' ?>>Female</option>
                </select>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="role">Role</label>
                <select class="custom-select" name="role" id="role">
                    <option value="2" <?= $user['role'] == 2 ? 'selected': '' ?>>Manager</option>
                    <option value="3" <?= $user['role'] == 3 ? 'selected': '' ?>>Surveyor</option>
                    <option value="4" <?= $user['role'] == 4 ? 'selected': '' ?>>User</option>
                    <option value="5" <?= $user['role'] == 5 ? 'selected': '' ?>>Stock/Inventory User</option>
                </select>
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
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="<?php echo base_url()."/users/manage";?>" class="btn btn-secondary">Cancel</a>
    </form>
</div>