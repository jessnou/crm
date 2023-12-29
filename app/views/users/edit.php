<?php

$title = 'Edit user';
ob_start();
?>

<h1>Edit user</h1>

<form method="POST" action="index.php?page=users&action=update&id=<?php echo $user['id']?>">
    <div class="mb-3">
        <label for="username">Username</label>
        <input type="text" class="form-control" id="username" name="username" value="<?php echo $user['username']?>" required>
    </div>
    <div class="mb-3">
        <label for="email">Username</label>
        <input type="text" class="form-control" id="email" name="email" value="<?php echo $user['email']?>" required>
    </div>
    <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="email_verification" name="email_verification"<?php echo $user['email_verification']?>>
        <label class="form-check-label" for="email_verification">Email verified</label>
    </div>

    <div class="mb-3">
        <label for="role" class="form-label">Role</label>

        <select class="form-control" name="role" id="role">
            <option value="0" <?php if(!$user['role'] == 0){echo 'selected';}?>>User</option>
            <option value="1"<?php if($user['role']== 1){echo 'selected';}?>>Content creator</option>
            <option value="2"<?php if($user['role']== 2){echo 'selected';}?>>Editor</option>
            <option value="3"<?php if($user['role']== 3){echo 'selected';}?>>Admin</option>
        </select>
    </div>
    <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="is_active" name="is_active"<?php echo $user['is_active'] == 1 ? 'Yes' : 'No' ?> >
        <label for="is_active" class="form-check-label" >Active</label>
    </div>
    <button type="submit" class="btn btn-primary">Изменить</button>

</form>

<?php

$content = ob_get_clean();
include 'app/views/layout.php';
?>
