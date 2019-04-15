<?php require('../inc/header.php') ?>
<?php
require('../database.php');
$field_id = $_GET['id'];

$sql = "SELECT * FROM fields WHERE id=$field_id";
$result = mysqli_query($conn, $sql);
$fields = [];

while($row = mysqli_fetch_array($result)) {
    $fields = [
        'id' => $row['id'],
        'model' => $row['model'],
        'name' => $row['name'],
        'title' => $row['title'],
        'type' => $row['type'],
        'sort_order' => $row['sort_order'],
        'required' => $row['required'] ? 'checked' : ''
    ];
}


?>

<h2>Edit Field</h2>

<form method="post" action="../fields/edit.php?id=<?= $field_id ?>">
    <div class="form-group">
        <label>Model:</label>
        <input type="text" placeholder="users" class="form-control" name="model" value="<?= $fields['model'] ?>" required>
    </div>
    <div class="form-group">
        <label>Field Name:</label>
        <input type="text" placeholder="age, company_name, ..." class="form-control" name="name" value="<?= $fields['name'] ?>" required>
    </div>
    <div class="form-group">
        <label>Field Title:</label>
        <input type="text" placeholder="Age, Company Name, ..." class="form-control" name="title" value="<?= $fields['title'] ?>" required>
    </div>
    <div class="form-group">
        <label>Field Type:</label>
        <input type="text" placeholder="integer, text, ..." class="form-control" name="type" value="<?= $fields['type'] ?>" required>
    </div>
    <div class="form-group">
        <label>Sort Order:</label>
        <input type="number" class="form-control" name="sort_order" value="<?= $fields['sort_order'] ?>" required>
    </div>
    <div class="form-group">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="required" id="defaultCheck1" <?= $fields['required'] ?> >
            <label class="form-check-label" for="defaultCheck1">
                Required
            </label>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>
<?php require('../inc/footer.php') ?>
