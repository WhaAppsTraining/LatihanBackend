<?php
require_once "start_connection.php";
require_once "helper.php";

get_all_users($connection);

function get_all_users($connection)
{
    $table_name = "users";
    $query = "SELECT * FROM $table_name";
    $stmt = $connection->prepare($query);
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    if ($result) {
        $users = $stmt->fetchAll();
        print_json(array(
            status => 'success',
            users => $users,
        ));
    }
}