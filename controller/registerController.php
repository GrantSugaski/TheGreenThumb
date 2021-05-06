<?php

include '../db/model.php';
include '../db/user.php';

session_start();

if (isset($_POST['request']) && $_POST['request'] == "Register") {
    try {
        $db = new DatabaseAdaptor();

        createUser($db->db, $_POST['email'], $_POST['password'], $_POST['firstName'], $_POST['lastName'], $_POST['address1'], $_POST['address2'], $_POST['county'], $_POST['state'], $_POST['zipcode'], $_POST['role']);

        $_SESSION['SESSION_INFO'] = "Succesfully registered account";

        if (isset($_SESSION['SESSION_ERROR'])) {
            header("Location: ../register.php");
        } else {
            header("Location: ../index.php");
        }
    } catch (Exception $ex) {
        $_SESSION['SESSION_ERROR'] = "Failed to register on internal exception.";
    }
}

?>