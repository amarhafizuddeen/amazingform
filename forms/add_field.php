<?php require('../inc/header.php') ?>

<h2>Add Fields</h2>

<form method="post" action="../fields/add.php">
    <div class="form-group">
        <label>Model:</label>
        <input type="text" placeholder="users" class="form-control" name="model" required>
    </div>
    <div class="form-group">
        <label>Field Name:</label>
        <input type="text" placeholder="age, company_name, ..." class="form-control" name="name" required>
    </div>
    <div class="form-group">
        <label>Field Title:</label>
        <input type="text" placeholder="Age, Company Name, ..." class="form-control" name="title" required>
    </div>
    <div class="form-group">
        <label>Field Type:</label>
        <input type="text" placeholder="integer, text, ..." class="form-control" name="type" required>
    </div>
    <div class="form-group">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="required" id="defaultCheck1" checked>
            <label class="form-check-label" for="defaultCheck1">
                Required
            </label>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
<?php require('../inc/footer.php') ?>
