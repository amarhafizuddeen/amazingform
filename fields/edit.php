<?php
    require('../database.php');
    session_start();

    $model = $_POST['model'];
    $name = $_POST['name'];
    $title = $_POST['title'];
    $type = $_POST['type'];
    $sort_order = $_POST['sort_order'];
    $required = isset($_POST['required']) ? 1 : 0;

    $sql = "UPDATE fields SET model = ?, name = ?, title = ?, type = ?, sort_order = ?, required = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssssiii', $model, $name, $title, $type, $sort_order, $required, $_GET['id']);
    
    if ($stmt->execute()) {
        $sql = "SELECT * FROM fields";



        $_SESSION['response'] = [
            'message' => 'You have successfully updated the field details.',
            'field_details' => $_POST
        ];
    } else {
        $_SESSION['response'] = [
            'error' => 'Failed to update field details.'
        ];
    }

    header('Location: ../forms/edit_field.php?id='.$_GET['id']);
    die();