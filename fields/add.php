<?php
    require('../database.php');
    session_start();

    $model = $_POST['model'];
    $name = $_POST['name'];
    $title = $_POST['title'];
    $type = $_POST['type'];
    $required = isset($_POST['required']) ? 1 : 0;

    $sql = "SELECT count(id) AS num FROM fields WHERE model = 'users'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $sort_order = $row['num'] + 1;

    $sql = "INSERT INTO fields (model, name, title, type, sort_order, required) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssssii', $model, $name, $title, $type, $sort_order, $required);
    
    if ($stmt->execute()) {
        $_SESSION['response'] = [
            'message' => 'You have successfully added new field.',
            'field_details' => $_POST
        ];
    } else {
        $_SESSION['response'] = [
            'error' => 'Failed to add new field.'
        ];
    }

    header('Location: ../forms/add_field.php');
    die();