<?php
    require('../database.php');
    session_start();
    
    $field_id = $_GET['id'];

    // Get the field's model
    $sql = "SELECT * FROM fields WHERE id=$field_id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $model = $row['model'];

    // Delete the field
    $sql = "DELETE FROM fields WHERE id=$field_id";
    
    if (mysqli_query($conn, $sql)) {
        // Normalize the sort order
        $sql = "SELECT * FROM fields WHERE model='$model' ORDER BY sort_order ASC";
        $result = mysqli_query($conn,$sql);
        $order = 1;

        while ($row = mysqli_fetch_assoc($result)) {
            $field_id = $row['id'];
            $sql = "UPDATE fields SET sort_order=$order WHERE id=$field_id";
            mysqli_query($conn, $sql);
            $order++;
        }
    
        $_SESSION['response'] = [
            'message' => 'You have successfully deleted the field.'
        ];
    } else {
        $_SESSION['response'] = [
            'error' => 'Failed to delete the field.'
        ];
    }

    header('Location: ../fields/list.php');
    die();