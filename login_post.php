<?php
require('model/database.php');
$email = filter_input(INPUT_POST, 'email', FILTER_DEFAULT);
$password = filter_input(INPUT_POST, 'password', FILTER_DEFAULT);

$emailError = "";
$passwordError = "";
$hasEmailError = false;
$hasPasswordError = false;

if(empty($email)){
    $emailError .= "Email is empty.<br>";
    $hasEmailError = true;
}
if(strpos($email, '@')===false){
    $emailError .= "Email must include @!<br>";
    $hasEmailError = true;
}

if(empty($password)){
    $passwordError .= "Password is empty.<br>";
    $hasPasswordError = true;
}
if(strlen($password)<8){
    $passwordError .= "Password must be at least 8 characters!<br>";
    $hasPasswordError = true;
}
?>
<!DOCTYPE html>
<html lang="eng">
<head>
    <title>Login Results</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    </head>
<body class="text-center mt-4">
    <h1 class="h1 mb-3 font-weight-bold">Email Results:</h1>
    <p class="mb-2">Email: <?php echo "$email";?></p>
    <h2 class="h1 mb-1 font-weight-normal" style="color: <?php echo($hasEmailError? "red":"green");?>;">
        <?php
            if($hasEmailError){
                echo "✕";
            }
            else{
                echo "✓";
            }
        ?>
    </h2>
    <p>
        <?php if ($hasEmailError): ?>
            <?php echo "Email was invalid!";?><br><br>
            <?php echo "$emailError";?>
        <?php else:?>
            <?php echo "Email was valid!";?>
        <?php endif?>
    </p>

    <h1 class="h1 mb-3 mt-5 font-weight-bold">Password Results:</h1>
    <p class="mb-2">Password: <?php echo "$password";?></p>
    <h2 class="h1 mb-1 font-weight-normal" style="color: <?php echo($hasPasswordError? "red":"green");?>;">
        <?php
        if($hasPasswordError){
            echo "✕";
        }
        else{
            echo "✓";
        }
        ?>
    </h2>
    <p>
        <?php if ($hasPasswordError): ?>
            <?php echo "Password was invalid!";?><br><br>
            <?php echo "$passwordError";?>
        <?php else:?>
            <?php echo "Password was valid!";?>
        <?php endif?>
    </p>
</body>
</html>