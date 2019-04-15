<?php require('../inc/header.php') ?>
<?php
    require('../database.php');

    $sql = "SELECT * FROM users";
    $result = mysqli_query($conn, $sql);
    $users = [];

    while($row = mysqli_fetch_array($result)) {
        $fields = json_decode($row['fields']);
        $arr = [];

        foreach ($fields as $field) {
            $sql = "SELECT * FROM fields WHERE id = " . $field->id;
            $result2 = mysqli_query($conn, $sql);
            $row2 = mysqli_fetch_assoc($result2);

            $arr[] = [
                'id' => $row2['id'],
                'name' => $row2['name'],
                'title' => $row2['title'],
                'sort_order' => $row2['sort_order'],
                'value' => $field->value
            ];

            usort($arr, function ($item1, $item2) {
                return $item1['sort_order'] <=> $item2['sort_order'];
            });
        }

        $users[] = [
            'id' => $row['id'],
            'fields' => $arr
        ];
    }

    $sql = "SELECT id, title FROM fields WHERE model = 'users' ORDER BY sort_order ASC LIMIT 3";
    $result = mysqli_query($conn, $sql);

    $fields = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $fields[] = [
            'id' => $row['id'],
            'title' => $row['title']
        ];
    } 
?>
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
