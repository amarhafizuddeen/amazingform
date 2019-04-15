<?php
    require('../database.php');

    $sql = "SELECT * FROM fields";
    $result = mysqli_query($conn, $sql);
    $fields = [];

    while($row = mysqli_fetch_array($result)) {
        $fields[] = [
            'id' => $row['id'],
            'model' => $row['model'],
            'name' => $row['name'],
            'title' => $row['title'],
            'type' => $row['type'],
            'sort_order' => $row['sort_order'],
            'required' => $row['required'] ? 'Yes' : 'No'
        ];
    }
    

?>

<?php require('list-fields.php'); ?>