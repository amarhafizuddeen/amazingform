<?php
    require('../database.php');
    session_start();

    $sql = "SELECT id, name FROM fields WHERE model = 'users'";
    $result = mysqli_query($conn, $sql);
    $inputs = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $input = [
            'id' => $row['id'],
            'value' => $_POST[$row['name']]
        ];

        $inputs[] = $input;
    }
    
    $sql = "INSERT INTO users (fields) VALUES (?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', json_encode($inputs));
    
    if ($stmt->execute()) {
        $_SESSION['response'] = [
            'message' => 'Successfully added a new user.'
        ];
    } else {
        $_SESSION['response'] = [
            'error' => 'Failed to add new user.'
        ];
    }
    

    header('Location: ../forms/add_user.php');
    die();