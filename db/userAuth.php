<?php

function getAuthorization($db, $email) {
    // Get user ID
    $sql = "select UID from Users where Email = :bind_email;";
    $stmt = $db->prepare($sql);
    $stmt->bindparam(':bind_email', $email);

    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Insert user authentication into database
    if (count($results) > 0) {
        $uid = $results[0]['UID'];

        $sql = "select Roles, SessionToken from UserAuthentication where UID = :bind_uid;";
        $stmt = $db->prepare($sql);
        $stmt->bindparam(':bind_uid', $uid);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>