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
?>

<?php require('list-users.php'); ?>