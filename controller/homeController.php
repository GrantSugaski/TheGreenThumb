<?php

include '../db/model.php';
include '../db/locations.php';

session_start();

if (isset($_GET['request']) && $_GET['request'] == 'GetLocations') {
    try {
        $db = new DatabaseAdaptor();

        $locations = getLocations($db->db);

        echo json_encode($locations);
    } catch (Exception $ex) {
        $_SESSION['SESSION_ERROR'] = "Failed to get locations on internal exception.";
    }
}

?>