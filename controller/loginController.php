<?php

include '../db/model.php';
include '../db/user.php';
include '../db/userAuth.php';

session_start();

if (isset($_POST['request']) && $_POST['request'] == "Login") {
    try {
        $db = new DatabaseAdaptor();

        $result = verifyCredentials($db->db, $_POST['email'], $_POST['password']);
        
        if ($result) {
            $result = getAuthorization($db->db, $_POST['email']);

            $_SESSION['AUTH_TOKEN'] = $result[0]['SessionToken'];
            $_SESSION['AUTH_ROLE'] = $result[0]['Roles'];
        } else {
            $_SESSION['SESSION_ERROR'] = "Failed to authenticate user.";
        }

        header("Location: ../index.php");
    } catch (Exception $ex) {
        $_SESSION['SESSION_ERROR'] = "Failed to login on internal exception.";
    }
}

?>
