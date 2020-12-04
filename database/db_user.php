<?php
    include_once('database/connection.php');

    /**
     * Verifies if a certain username, password combination
     * exists in the database. Use the sha1 hashing function.
     */
    function checkUserPassword($email, $password) {
        global $db;
        $stmt = $db->prepare('SELECT * FROM account WHERE email = ? AND password = ?');
        $stmt->execute(array($email, $password)); //sha1($password))
        return $stmt->fetch()?true:false; // return true if a line exists
    }

    function getUser($email){
        global $db;
        $stmt = $db->prepare('SELECT account.id AS id, name, account.bio AS bio, location.city AS city 
            FROM account 
            INNER JOIN person 
            ON account.id = person.account_id
            INNER JOIN location
            ON location.id = person.location_id
            WHERE account.email = ?');
        $stmt->execute(array($email)); 
        return $stmt->fetch(); // return true if a line exists
    }
?>