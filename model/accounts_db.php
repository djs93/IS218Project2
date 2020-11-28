<?php

function validate_login($email, $password){
    global $db;
    $query = 'SELECT * FROM accounts WHERE email = :email AND password = :password';
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':password', $password);
    $statement->execute();
    $user = $statement->fetch();
    $statement->closeCursor();

    if (count($user)>0){
        return $user['id'];
    } else {
        return false;
    }
}

function add_user($email, $fname, $lname, $birthday, $password){
    global $db;
    $query = 'INSERT INTO `accounts` (`email`, `fname`, `lname`, `birthday`, `password`) 
                        VALUES(:email, :fname, :lname, :bday, :password)';
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':fname', $fname);
    $statement->bindValue(':lname', $lname);
    $statement->bindValue(':bday', $birthday);
    $statement->bindValue(':password', $password);
    $statement->execute();
    $user = $statement->fetch();
    $statement->closeCursor();

    if (count($user)>0){
        return $user['id'];
    } else {
        return false;
    }
}