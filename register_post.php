<?php
$email = filter_input(INPUT_POST, 'email', FILTER_DEFAULT);
$password = filter_input(INPUT_POST, 'password', FILTER_DEFAULT);
$fname = filter_input(INPUT_POST, 'fname', FILTER_DEFAULT);
$lname = filter_input(INPUT_POST, 'lname', FILTER_DEFAULT);
$bday = filter_input(INPUT_POST, 'bday', FILTER_DEFAULT);

$emailError = "";
$passwordError = "";
$fnameError = "";
$lnameError = "";
$bdayError = "";

$hasEmailError = false;
$hasPasswordError = false;
$hasFnameError = false;
$hasLnameError = false;
$hasBdayError = false;

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

if(empty($fname)){
    $fnameError .= "First name is empty.<br>";
    $hasFnameError = true;
}

if(empty($lname)){
    $lnameError .= "Last name is empty.<br>";
    $hasLnameError = true;
}

if(empty($bday)){
    $bdayError .= "Birthday is empty.<br>";
    $hasBdayError = true;
}
?>
<!DOCTYPE html>
<html lang="eng">
<head>
    <title>Register Results</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body class="text-center mt-4">
<h1 class="h1 mb-3 font-weight-bold">First Name Results:</h1>
<p class="mb-2">First Name: <?php echo "$fname";?></p>
<h2 class="h1 mb-1 font-weight-normal" style="color: <?php echo($hasFnameError? "red":"green");?>;">
    <?php
    if($hasFnameError){
        echo "✕";
    }
    else{
        echo "✓";
    }
    ?>
</h2>
<p>
    <?php if ($hasFnameError): ?>
        <?php echo "First name was invalid!";?><br><br>
        <?php echo "$fnameError";?>
    <?php else:?>
        <?php echo "First name was valid!";?>
    <?php endif?>
</p>

<h1 class="h1 mb-3 mt-5 font-weight-bold">Last Name Results:</h1>
<p class="mb-2">Last Name: <?php echo "$lname";?></p>
<h2 class="h1 mb-1 font-weight-normal" style="color: <?php echo($hasLnameError? "red":"green");?>;">
    <?php
    if($hasLnameError){
        echo "✕";
    }
    else{
        echo "✓";
    }
    ?>
</h2>
<p>
    <?php if ($hasLnameError): ?>
        <?php echo "Last name was invalid!";?><br><br>
        <?php echo "$lnameError";?>
    <?php else:?>
        <?php echo "Last name was valid!";?>
    <?php endif?>
</p>

<h1 class="h1 mb-3 mt-5 font-weight-bold">Birthday Results:</h1>
<p class="mb-2">Birthday: <?php echo "$bday";?></p>
<h2 class="h1 mb-1 font-weight-normal" style="color: <?php echo($hasBdayError? "red":"green");?>;">
    <?php
    if($hasBdayError){
        echo "✕";
    }
    else{
        echo "✓";
    }
    ?>
</h2>
<p>
    <?php if ($hasBdayError): ?>
        <?php echo "Birthday was invalid!";?><br><br>
        <?php echo "$bdayError";?>
    <?php else:?>
        <?php echo "Birthday was valid!";?>
    <?php endif?>
</p>

<h1 class="h1 mb-3 mt-5 font-weight-bold">Email Results:</h1>
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