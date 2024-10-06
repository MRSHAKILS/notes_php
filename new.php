<?php
    require_once('includes/db.php');
    require_once('includes/functions.php');



        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            $title = prep_data($_POST['title']);
            $content = prep_data($_POST['content']);
            $important = prep_data($_POST['important']);

            
            $sql = "INSERT INTO notes (title, content, important) VALUES ('";
            $sql .= $title . "', '" . $content . "', '" . $important . "')";
            if(mysqli_query($conn, $sql)){
                echo 'Success';
            }
            
        }

        

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Notes App</title>
        <link rel="stylesheet" href="styles/style.css">
    </head>
    <header>
                Notes App
    </header>

    <div class="titleDiv">
            <div class="backLink"><a class="nav-link" href="index.php"> Home</a></div>
            <div class="head">New Note</div>
    </div>
    <form action="new.php" method="post">     

            <span class="label">Title</span>
            <input type="text" name="title" />
            
            <span class="label">Content</span>
            <textarea name="content"> </textarea>

            <div class="chkgroup">
                <span class="label-in">Important</span>
                <input type="hidden" name="important" value="0" />
                <input type="checkbox" name="important" value="1" />
            </div>
            
        <input type="submit" />
</html>
<?php require_once('includes/footer.php'); ?>