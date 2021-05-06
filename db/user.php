<?php

function createUser($db, $email, $password, $firstName, $lastName, $address1, $address2, $county, $state, $zipcode, $role) {
    // Parse email and password
    $email = htmlspecialchars($email);
    $password = htmlspecialchars($password);
    $hashedpass = password_hash($password, PASSWORD_DEFAULT);

    // Check if user already exists with email
    $sql = "select * from users where Email = :bind_email;";
    $stmt = $db->prepare($sql);
    $stmt->bindparam(':bind_email', $email);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($results) > 0) {
        $_SESSION["SESSION_ERROR"] = "Failed to create new user: email already exists!";

        return;
    }

    // Insert user into database
    $sql = "insert into users (FirstName, LastName, Email, Password, Address1, Address2, County, State, ZipCode) values (:bind_fname, :bind_lname, :bind_email, :bind_pass, :bind_address1, :bind_address2, :bind_county, :bind_state, :bind_zipcode);";
    $stmt = $db->prepare($sql);
    $stmt->bindparam(':bind_fname', $firstName);
    $stmt->bindparam(':bind_lname', $lastName);
    $stmt->bindparam(':bind_email', $email);
    $stmt->bindparam(':bind_pass', $hashedpass);
    $stmt->bindparam(':bind_address1', $address1);
    $stmt->bindparam(':bind_address2', $address2);
    $stmt->bindparam(':bind_county', $county);
    $stmt->bindparam(':bind_state', $state);
    $stmt->bindparam(':bind_zipcode', $zipcode);

    $stmt->execute();

    // Get user ID
    $sql = "select UID from Users where Email = :bind_email;";
    $stmt = $db->prepare($sql);
    $stmt->bindparam(':bind_email', $email);

    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Insert user authentication into database
    if (count($results) > 0) {
        $uid = $results[0]['UID'];
        $token = password_hash($uid, PASSWORD_DEFAULT);

        $sql = "insert into UserAuthentication (UID, Roles, SessionStartDate, SessionToken) values (:bind_uid, :bind_roles, NOW(), :bind_token);";
        $stmt = $db->prepare($sql);
        $stmt->bindparam(':bind_uid', $uid);
        $stmt->bindparam(':bind_roles', $role);
        $stmt->bindparam(':bind_token', $token);

        $stmt->execute();

        $_SESSION['AUTH_TOKEN'] = $token;
        $_SESSION['AUTH_ROLE'] = $role;
    } else {
        $_SESSION["SESSION_ERROR"] = "Failed to create new user: failed to create authentication.";
    }
}

function getUser($db, $token) {
    // Get UID
    $sql = "select UID from UserAuthentication where SessionToken = :bind_token";
    $stmt = $db->prepare($sql);
    $stmt->bindparam(':bind_token', $token);

    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $uid = $result[0]['UID'];

    // Get user
    $sql = "select Email, FirstName, LastName, Address1, Address2, County, State, ZipCode from Users where UID = ".$uid.";";
    $stmt = $db->prepare($sql);
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}

function updateUser($db, $email, $password, $firstName, $lastName, $address1, $address2, $county, $state, $zipcode) {
    // Get UID
    $sql = "select UID from UserAuthentication where SessionToken = :bind_token";
    $stmt = $db->prepare($sql);
    $stmt->bindparam(':bind_token', $_SESSION['AUTH_TOKEN']);
    
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $uid = $results[0]['UID'];
    
    // Build update statement
    $sql = "update users set ";

    $total = 0;

    if (!empty($email)) {
        $sql .= "Email = '".htmlspecialchars($email)."'";

        $total += 1;
    }

    if (!empty($password)) {
        if ($total > 0) {
            $sql .= ", ";
        }
        
        $sql .= "Password = '".htmlspecialchars(password_hash($password, PASSWORD_DEFAULT))."'";

        $total += 1;
    }

    if (!empty($firstName)) {
        if ($total > 0) {
            $sql .= ", ";
        }
        
        $sql .= "FirstName = '".$firstName."'";

        $total += 1;
    }

    if (!empty($lastName)) {
        if ($total > 0) {
            $sql .= ", ";
        }
        
        $sql .= "LastName = '".$lastName."'";

        $total += 1;
    }

    if (!empty($address1)) {
        if ($total > 0) {
            $sql .= ", ";
        }
        
        $sql .= "Address1 = '".$address1."'";

        $total += 1;
    }

    if (!empty($address2)) {
        if ($total > 0) {
            $sql .= ", ";
        }
        
        $sql .= "Address2 = '".$address2."'";

        $total += 1;
    }

    if (!empty($county)) {
        if ($total > 0) {
            $sql .= ", ";
        }
        
        $sql .= "County = '".$county."'";

        $total += 1;
    }

    if (!empty($state)) {
        if ($total > 0) {
            $sql .= ", ";
        }
        
        $sql .= "State = '".$state."'";

        $total += 1;
    }

    if (!empty($zipcode)) {
        if ($total > 0) {
            $sql .= ", ";
        }
        
        $sql .= "ZipCode = '".$zipcode."'";

        $total += 1;
    }

    $sql .= " where UID = ".$uid.";";

    // Update table
    if ($total > 0) {
        $stmt = $db->prepare($sql);
        $stmt->execute();
    }
}

function verifyCredentials($db, $email, $password) {
    $email = htmlspecialchars($email);
    $password = htmlspecialchars($password);

    $sql = "select password from users where email = :bind_email;";
    $stmt = $db->prepare($sql);
    $stmt->bindparam(':bind_email', $email);
    
    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($results) > 0 && password_verify($password, $results[0]['password'])) {
        return True;
    } else {
        return False;
    }   
}

?>