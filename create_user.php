<?php
require_once "start_connection.php";
require_once "helper.php";

create_user($connection);

function create_user($connection)
{
    $username = $_POST['username'];
    $name = $_POST['name'];
    $password = $_POST['password'];
    $table_name = "users";

    $query = "INSERT INTO user (username, name, password)
VALUES (:username, :name, :password)";
    try {
        $stmt = $connection->prepare($query);
        $stmt->execute(array(
            ':username' => $username,
            ':name' => $name,
            ':password' => password_hash($password, PASSWORD_DEFAULT),
        ));
        if ($stmt->rowCount() > 0) {
            print_json(array(
                'status' => 'success',
                'message' => 'User has been created',
            ));
        } else {
            print_json(array(
                'status' => 'failed',
                'message' => 'Something wrong',
            ));
            // contoh error: username tidak ditemukan
        }
    } catch (PDOException $e) {
        print_json(array(
            'status' => 'failed',
            'message' => $e->getMessage(),
        ));
    }
}
