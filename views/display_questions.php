<?php //include('abstract-views/header.php');?>
<!-- put in header.php for project 3-->
<?php
    $user = get_user_info($userId);
    $name = ucfirst($user['fname']).' '.ucfirst($user['lname']);
    $email = $user['email'];
?>
    <!DOCTYPE html>
    <html lang="en" style="height: 100%;">
<head>
    <meta charset="UTF-8">
    <title>Post New Question</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body class="text-center h-100">
<div class="row h-100">
    <div class="col-2" style="border-right: 1px solid rgba(0,0,0,.1); background-color: rgba(0,0,0,0.05);">
        <nav id="sidebar" class="mt-4">
            <div class="sidebar-header">
                <h3><?php echo $name;?></h3>
            </div>

            <ul class="list-unstyled components">
                <p><?php echo $email;?></>
                <li>
                    <a class="btn btn-lg btn-primary mt-3" href=".?action=display_question_form&userId=<?php echo $userId;?>">Add Question</a>
                </li>
            </ul>
        </nav>
    </div>
    <div class="col">
        <div class="row justify-content-md-center mt-5">
            <table class="col-10 table table-striped table-bordered">
                <tr>
                    <th>Question Title</th>
                    <th>Quesiton Body</th>
                </tr>
                <?php foreach ($questions as $question) : ?>
                    <tr>
                        <td><?php echo $question['title']; ?></td>
                        <td><?php echo $question['body']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>

        </body>
    </div>
</div>
</html>

<?php //include('abstract-views/footer.php');?>