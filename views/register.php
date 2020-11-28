<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body class="text-center mt-4">
    <h1 class="h1 mb-3 font-weight-bold">Register</h1>
    <form action="../register_post.php" method="post">
        <div class="h3 mt-5 font-weight-normal">
            <label for="fname">First Name</label>
            <br>
            <input id="fname" name="fname" type="text" <?php
            if(!empty($fname)){
                echo("value=$fname");
            }?>>
            <br>
        </div>

        <div class="h3 mt-2 font-weight-normal">
            <label for="lname">Last Name</label>
            <br>
            <input id="lname" name="lname" type="text" <?php
            if(!empty($lname)){
                echo("value=$lname");
            }?>>
            <br>
        </div>

        <div class="h3 mt-5 font-weight-normal">
            <label for="bday">Birthday</label>
            <br>
            <input id="bday" name="bday" type="date" <?php
            if(!empty($bday)){
                echo("value=$bday");
            }?>>
            <br>
        </div>

        <div class="h3 mt-5 font-weight-normal">
            <label for="email">Email Address</label>
            <br>
            <input id="email" name="email" type="text" <?php
                if(!empty($email)){
                    echo("value=$email");
                }?>>
            <br>
        </div>

        <div class="h3 mt-2 font-weight-normal">
            <label for="password">Password</label>
            <br>
            <input id="password" name="password" type="password">
            <br>
        </div>

        <div>
            <input class="btn btn-lg btn-primary mt-3" type="submit" value="Register">
        </div>
    </form>
</body>
</html>