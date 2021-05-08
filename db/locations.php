<?php

function getLocations($db) {
    $sql = "select FirstName, LastName, Address, Products from Locations l join Users u where l.UID = u.UID;";
    $stmt = $db->prepare($sql);
    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $results;
}

?>