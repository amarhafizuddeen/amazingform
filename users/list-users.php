<?php require('../inc/header.php') ?>
<h2>Users</h2>

<table id="usersTable" class="display table">
    <thead>
        <tr>
            <th>ID</th>
            <?php
                foreach ($fields as $field) {        
                    echo "<th>" . $field['title'] . "</th>";
                }
            ?>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user) { ?>
        <tr>
            <td><?= $user['id'] ?></td>
            <?php
                $count = 0;
                foreach ($user['fields'] as $field) {   
                    $count++;                 
                    echo "<td>" . $field['value'] . "</td>";
                    if ($count > 2)
                        break;
                }
            ?>
            <td><a href="../forms/edit_user.php?id=<?= $user['id'] ?>">Edit</a></td>
        </tr>
        <?php } ?>
    </tbody>
</table>


<script>
    $(document).ready( function () {
        $('#usersTable').DataTable();
    } );
</script>
<?php require('../inc/footer.php') ?>
