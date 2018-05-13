<?php
require_once "start_connection.php";
require_once "helper.php";

delete_user($connection);

function delete_user($connection)
{
    $username = $_POST['username'];

    $query = "DELETE FROM users
    WHERE username = :username";
    try {
        $stmt = $connection->prepare($query);
        $stmt->execute(array(
            ':username' => $username,
        ));
        if ($stmt->rowCount() > 0) {
            print_json(array(
                'status' => 'success',
                'message' => 'User has been deleted',
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
