<?php require('../inc/header.php') ?>
<h2>Users</h2>

<table id="fieldsTable" class="display table">
    <thead>
        <tr>
            <th>#</th>
            <th>Model</th>
            <th>Name</th>
            <th>Title</th>
            <th>Type</th>
            <th>Sort Order</th>
            <th>Required</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $count = 1; 
            foreach ($fields as $field) { 
        ?>
        <tr>
            <td><?= $count++ ?></td>
            <td><?= $field['model'] ?></td>
            <td><?= $field['name'] ?></td>
            <td><?= $field['title'] ?></td>
            <td><?= $field['type'] ?></td>
            <td><?= $field['sort_order'] ?></td>
            <td><?= $field['required'] ?></td>
            <td>
                <a href="../forms/edit_field.php?id=<?= $field['id'] ?>">Edit</a> |
                <a href="../fields/delete.php?id=<?= $field['id'] ?>" onclick="return confirm('Are you sure you want to delete this field?')">Delete</a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>


<script>
    $(document).ready( function () {
        $('#fieldsTable').DataTable();
    } );
</script>
<?php require('../inc/footer.php') ?>
