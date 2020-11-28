<?php
require('model/database.php');
require('model/accounts_db.php');
require('model/questions_db.php');

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'display_login';
    }
}

switch ($action) {
    case 'display_login': {
        include('views/login.php');
        break;
    }

    case 'display_login_errored': {
        $hasLogonError = true;
        include('views/login.php');
        break;
    }

    case 'validate_login':{
        $email = filter_input(INPUT_POST, 'email', FILTER_DEFAULT);
        $password = filter_input(INPUT_POST, 'password', FILTER_DEFAULT);

        $error = "";
        $hasEmailError = false;
        $hasPasswordError = false;

        if(empty($email)){
            $error .= "Email is empty.<br>";
            $hasEmailError = true;
        }
        if(strpos($email, '@')===false){
            $error .= "Email must include @!<br>";
            $hasEmailError = true;
        }

        if(empty($password)){
            $error .= "Password is empty.<br>";
            $hasPasswordError = true;
        }
        if(strlen($password)<8){
            $error .= "Password must be at least 8 characters!<br>";
            $hasPasswordError = true;
        }
        if($hasEmailError == true || $hasPasswordError == true){
            header('Location: .?action=display_login_errored');
        } else {
            $userId = validate_login($email, $password);
            if($userId==false){
                header("Location: .?action=display_registration_filled&email=$email");
            }
            else {
                header("Location: .?action=display_questions&userId=$userId");
            }
        }
        break;
    }

    case 'login': {
        break;
    }

    case 'display_registration':{
        include('views/register.php');
        break;
    }

    case 'display_registration_filled':{
        $email = filter_input(INPUT_GET, 'email', FILTER_DEFAULT);
        include('views/register.php');
        break;
    }

    case 'display_registration_errored':{
        $email = filter_input(INPUT_GET, 'email', FILTER_DEFAULT);
        $fname = filter_input(INPUT_GET, 'fname', FILTER_DEFAULT);
        $lname = filter_input(INPUT_GET, 'lname', FILTER_DEFAULT);
        $bday = filter_input(INPUT_GET, 'bday', FILTER_DEFAULT);
        $invalidRegFields = true;
        include('views/register.php');
        break;
    }

    case 'display_registration_already_exists':{
        $email = filter_input(INPUT_GET, 'email', FILTER_DEFAULT);
        $fname = filter_input(INPUT_GET, 'fname', FILTER_DEFAULT);
        $lname = filter_input(INPUT_GET, 'lname', FILTER_DEFAULT);
        $bday = filter_input(INPUT_GET, 'bday', FILTER_DEFAULT);
        $emailExistsAlready = true;
        include('views/register.php');
        break;
    }

    case 'verify_registration':{
        $email = filter_input(INPUT_POST, 'email', FILTER_DEFAULT);
        $password = filter_input(INPUT_POST, 'password', FILTER_DEFAULT);
        $fname = filter_input(INPUT_POST, 'fname', FILTER_DEFAULT);
        $lname = filter_input(INPUT_POST, 'lname', FILTER_DEFAULT);
        $bday = filter_input(INPUT_POST, 'bday', FILTER_DEFAULT);

        $error = "";
        $hasEmailError = false;
        $hasPasswordError = false;
        $hasFnameError = false;
        $hasLnameError = false;
        $hasBdayError = false;

        if(empty($email)){
            $error .= "Email is empty.<br>";
            $hasEmailError = true;
        }
        else if(strpos($email, '@')===false){
            $error .= "Email must include @!<br>";
            $hasEmailError = true;
        }

        if(empty($password)){
            $error .= "Password is empty.<br>";
            $hasPasswordError = true;
        }
        if(strlen($password)<8){
            $error .= "Password must be at least 8 characters!<br>";
            $hasPasswordError = true;
        }

        if(empty($fname)){
            $error .= "First name is empty.<br>";
            $hasFnameError = true;
        }

        if(empty($lname)){
            $error .= "Last name is empty.<br>";
            $hasLnameError = true;
        }

        if(empty($bday)){
            $error .= "Birthday is empty.<br>";
            $hasBdayError = true;
        }

        if($hasEmailError == true || $hasPasswordError == true || $hasFnameError == true || $hasLnameError == true || $hasBdayError == true){
            header("Location: .?action=display_registration_errored&email=$email&fname=$fname&lname=$lname&bday=$bday");
        } else {
            $userValid = validate_register($email, $password);
            if($userValid==false){
                header("Location: .?action=display_registration_already_exists&email=$email&fname=$fname&lname=$lname&bday=$bday");
            }
            else {
                $userId = add_user($email, $fname, $lname, $bday, $password);
                if($userId == false){
                    $error = "Unknown error while adding user";
                    include('errors/error.php');
                }
                header("Location: .?action=display_questions&userId=$userId");
            }
        }

        break;
    }

    case 'display_questions':{
        $userId = filter_input(INPUT_GET, 'userId');
        if($userId == NULL || $userId < 0){
            header('Location: .?action=display_login');
        } else{
            $questions = get_user_questions($userId);
            include('views/display_questions.php');
        }
        break;
    }

    case 'display_question_form':{
        $userId = filter_input(INPUT_GET, 'userId');
        if($userId == NULL || $userId <0){
            header('Location: .?action=display_login');
        } else{
            include('views/new_question.php');
        }
        break;
    }

    case 'display_question_form_errored':{
        $userId = filter_input(INPUT_GET, 'userId');
        if($userId == NULL || $userId <0){
            header('Location: .?action=display_login');
        } else{
            include('views/new_question.php');
        }
        break;
    }

    case 'submit_question':{
        $userId = filter_input(INPUT_POST, 'userId');
        $title = filter_input(INPUT_POST, 'name', FILTER_DEFAULT);
        $body = filter_input(INPUT_POST, 'body', FILTER_DEFAULT);
        $skills = filter_input(INPUT_POST, 'skills', FILTER_DEFAULT);
        $skillsArray = explode(",", $skills);

        $nameError = "";
        $bodyError = "";
        $skillsError = "";

        $hasNameError = "";
        $hasBodyError = "";
        $hasSkillsError = "";

        if(empty($name)){
            $nameError .= "Question cannot be empty.";
            $hasNameError = true;
        }
        else if(strlen($name)<3){
            $nameError .= "Question name must be at least 3 characters!";
            $hasNameError = true;
        }

        if(strlen($body)===0){
            $bodyError .= "Question Body cannot be empty.";
            $hasBodyError = true;
        }
        if(strlen($body)>=500){
            $bodyError .= "Question body must be less than 500 characters!";
            $hasBodyError = true;
        }

        if(count($skillsArray)<2){
            $skillsError .= "Must enter at least 2 skills!";
            $hasSkillsError = true;
        }
        if($hasNameError || $hasBodyError || $hasSkillsError){
            $loc = "Location: .?action=display_question_form_errored&userId=$userId";
            if($hasNameError){
                $loc .= "&nameError=$nameError";
            }
            if($hasBodyError){
                $loc .= "&nameError=$bodyError";
            }
            if($hasSkillsError){
                $loc .= "&nameError=$skillsError";
            }
            header($loc);
        } else{
            create_question($title, $body, $skills, $userId);
            header("Location: .?action=display_questions&userId=$userId");
        }
        break;
    }

    default: {
        $error = 'Unknown Action';
        include('errors/error.php');
    }
}