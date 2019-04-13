<?php
    require('../database.php');
    $user_id = $_GET['user_id'];

    $sql = 'SELECT * FROM users WHERE id = ' . $user_id;
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $fields = json_decode($row['fields']);

    $arr = [];

    foreach ($fields as $field) {
        $sql = "SELECT * FROM fields WHERE id = " . $field->id;
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);

        $arr[] = [
            'id' => $row['id'],
            'name' => $row['name'],
            'title' => $row['title'],
            'sort_order' => $row['sort_order'],
            'value' => $field->value
        ];
    }

    usort($arr, function ($item1, $item2) {
        return $item1['sort_order'] <=> $item2['sort_order'];
    });

    foreach ($arr as $field) {
        echo '<p>' . $field['title'] . ' : ' .$field['value'];
    }
?>