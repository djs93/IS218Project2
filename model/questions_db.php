<?php

function get_users_questions ($userId){
    global $db;

    $query = 'SELECT * FROM questions WHERE ownerid = :userId';
    $statement = $db->prepare($query);
    $statement->bindValue(':userId', $userId);
    $statement->execute();
    $questions = $statement->fetch();
    $statement->closeCursor();
    return $questions;
}

function create_question ($title, $body, $skills, $userId){
    global $db;

    $currDate = date('Y-m-d');

    $query = 'INSERT INTO questions
                (title, body, skills, ownerid, createddate)
              VALUES 
                (:title, :body, :skills, :ownerid, now())';
    $statement = $db->prepare($query);
    $statement->bindValue(':ownerid', $userId);
    $statement->bindValue(':skills', $skills);
    $statement->bindValue(':body', $body);
    $statement->bindValue(':title', $title);
    $statement->execute();
    $statement->closeCursor();
}