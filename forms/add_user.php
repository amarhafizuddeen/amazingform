<?php require('../inc/header.php') ?>

<h2>Add User</h2>

<form method="post" action="../users/add.php">
    <?php require('../inc/fields/users.php') ?>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
<?php require('../inc/footer.php') ?>
