<?php
require_once "start_connection.php";
require_once "helper.php";

check_username($connection);

function check_username($connection)
{
    $username = $_POST['username'];
    $table_name = "users";
    $query = "SELECT * FROM $table_name WHERE username = :username";
    $stmt = $connection->prepare($query);
    $stmt->execute(array(
        ':username' => $username,
    ));
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    if ($result) {
        $user = $stmt->fetch();
        $is_success = reset_password($connection, $user);
        if ($is_success) {
            print_json(array(
                'status' => 'success',
                'message' => 'Password has been changed',
            ));
        }
    } else {
        print_json(array(
            'status' => 'error',
            'message' => 'User not found',
        ));
    }
}

function reset_password($connection, $user)
{
    if ($user) {
        $username = $user['username'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $update_query = "UPDATE users
        SET password='$password'
        WHERE username='$username'";
        $stmt = $connection->prepare($update_query);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    } else {
        print_json(array(
            'status' => 'error',
            'message' => 'User not found',
        ));
    }
}
