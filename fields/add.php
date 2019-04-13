<?php
    require('../database.php');
    session_start();

    $model = $_POST['model'];
    $name = $_POST['name'];
    $title = $_POST['title'];
    $type = $_POST['type'];
    

    $sql = "INSERT INTO fields (model, name, title, type) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssss', $model, $name, $title, $type);
    
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