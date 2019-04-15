<?php 
$requestUri = 'edit_user';
require('../inc/header.php') 
?>

<h2>Add User</h2>

<form method="post" action="../users/edit.php?id=<?= $_GET['id'] ?>">
    <?php require('../inc/fields/users.php') ?>
    <button type="submit" class="btn btn-primary">Update</button>
</form>
<?php require('../inc/footer.php') ?>
