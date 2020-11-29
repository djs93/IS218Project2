<?php

function get_users_questions ($userId){
    global $db;

    $query = 'SELECT * FROM questions WHERE ownerid = :userId';
    $statement = $db->prepare($query);
    $statement->bindValue(':userId', $userId);
    $statement->execute();
    $questions = $statement->fetchAll();
    $statement->closeCursor();
    return $questions;
}

function create_question ($title, $body, $skills, $userId){
    global $db;

    $query = 'SELECT email FROM accounts WHERE id = :userId';
    $statement = $db->prepare($query);
    $statement->bindValue(':userId', $userId);
    $statement->execute();
    $returned = $statement->fetch();
    $email = $returned['email'];
    $statement->closeCursor();

    $query = 'INSERT INTO questions
                (owneremail,title, body, skills, ownerid, createddate)
              VALUES 
                (:email, :title, :body, :skills, :ownerid, now())';
    $statement = $db->prepare($query);
    $statement->bindValue(':ownerid', $userId);
    $statement->bindValue(':skills', $skills);
    $statement->bindValue(':body', $body);
    $statement->bindValue(':title', $title);
    $statement->bindValue(':email', $email);
    $statement->execute();
    $statement->closeCursor();
}