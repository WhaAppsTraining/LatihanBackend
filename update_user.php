<?php
function update_access_key($connection, $user_id, $access_key)
{
    $update_query = "UPDATE users
    SET access_key='$access_key'
    WHERE id=$user_id";
    $stmt = $connection->prepare($update_query);
    $stmt->execute();
    return $stmt->rowCount() > 0;
}