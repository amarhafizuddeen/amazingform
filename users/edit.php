<?php
    require('../database.php');
    session_start();

    $user_id = $_GET['id'];

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
    
    $sql = "UPDATE users SET fields = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('si', json_encode($inputs), $user_id);
    
    if ($stmt->execute()) {
        $_SESSION['response'] = [
            'message' => 'Successfully updated user details.'
        ];
    } else {
        $_SESSION['response'] = [
            'error' => 'Failed to update user details.'
        ];
    }
    

    header('Location: ../forms/edit_user.php?id='.$user_id);
    die();