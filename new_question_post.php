<?php
$name = filter_input(INPUT_POST, 'name', FILTER_DEFAULT);
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
    $nameError .= "Question name is empty.<br>";
    $hasNameError = true;
}
if(strlen($name)<3){
    $nameError .= "Question name must be at least 3 characters!<br>";
    $hasNameError = true;
}

if(strlen($body)===0){
    $bodyError .= "Question Body is empty.<br>";
    $hasBodyError = true;
}
if(strlen($body)>=500){
    $bodyError .= "Question body must be less than 500 characters!<br>";
    $hasBodyError = true;
}

if(count($skillsArray)<2){
    $skillsError .= "Must enter at least 2 skills!<br>";
    $hasSkillsError = true;
}
?>
<!DOCTYPE html>
<html lang="eng">
<head>
    <title>Question Results</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body class="text-center mt-4">
<h1 class="h1 mb-3 font-weight-bold">Question Name Results:</h1>
<p class="mb-2">Question Name: <?php echo "$name";?></p>
<h2 class="h1 mb-1 font-weight-normal" style="color: <?php echo($hasNameError? "red":"green");?>;">
    <?php
    if($hasNameError){
        echo "✕";
    }
    else{
        echo "✓";
    }
    ?>
</h2>
<p>
    <?php if ($hasNameError): ?>
        <?php echo "Question name was invalid!";?><br><br>
        <?php echo "$nameError";?>
    <?php else:?>
        <?php echo "Question name was valid!";?>
    <?php endif?>
</p>

<h1 class="h1 mb-3 mt-5 font-weight-bold">Question Body Results:</h1>
<p class="mb-2">Question Body: <?php echo "$body";?></p>
<h2 class="h1 mb-1 font-weight-normal" style="color: <?php echo($hasBodyError? "red":"green");?>;">
    <?php
    if($hasBodyError){
        echo "✕";
    }
    else{
        echo "✓";
    }
    ?>
</h2>
<p>
    <?php if ($hasBodyError): ?>
        <?php echo "Question body was invalid!";?><br><br>
        <?php echo "$bodyError";?>
    <?php else:?>
        <?php echo "Question body was valid!";?>
    <?php endif?>
</p>

<h1 class="h1 mb-3 mt-5 font-weight-bold">Skills Results:</h1>
<p class="mb-2">Skills Array: <?php print_r($skillsArray);?></p>
<h2 class="h1 mb-1 font-weight-normal" style="color: <?php echo($hasSkillsError? "red":"green");?>;">
    <?php
    if($hasSkillsError){
        echo "✕";
    }
    else{
        echo "✓";
    }
    ?>
</h2>
<p>
    <?php if ($hasSkillsError): ?>
        <?php echo "Skills was invalid!";?><br><br>
        <?php echo "$skillsError";?>
    <?php else:?>
        <?php echo "Skills was valid!";?>
    <?php endif?>
</p>
</body>
</html>