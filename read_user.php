<?php
require_once "start_connection.php";
require_once "helper.php";

read_user($connection);

function read_user($connection)
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
        validate_user($connection, $user);
    }
}

function validate_user($connection, $user)
{
    if ($user) {
        if (password_verify($_POST['password'], $user['password'])) {
            $user['access_key'] = generate_key();
            require_once "update_user.php";
            update_access_key($connection, $user['id'], $user['access_key']);
            print_json(array(
                'status' => 'success',
                'user' => $user,
            ));
        } else {
            print_json(array(
                'status' => 'failed',
                'message' => 'Wrong password',
            ));
        }
    } else {
        print_json(array(
            'status' => 'failed',
            'message' => 'User not found',
        ));
    }
}
