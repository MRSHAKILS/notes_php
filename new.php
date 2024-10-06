<?php
    require_once('includes/db.php');
    require_once('includes/functions.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $title = prep_input($_POST['title']);
        $content = prep_input($_POST['content']);
        $important = isset($_POST['important']) ? 1 : 0;  // Checkbox for important should be checked or unchecked
        
        $sql = "INSERT INTO notes (title, content, important) VALUES ('$title', '$content', '$important')";
        if (mysqli_query($conn, $sql)) {
            header('Location: index.php');  // Redirect to index.php after successful note creation
        } else {
            echo 'Error: ' . mysqli_error($conn);  // Display error if any
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Notes App - New Note</title>
        <link rel="stylesheet" href="styles/style.css">
    </head>
    <body>
        <header>
            Notes App
        </header>

        <div class="titleDiv">
            <div class="backLink"><a class="nav-link" href="index.php">Home</a></div>
            <div class="head">New Note</div>
        </div>

        <form action="new.php" method="post">
            <span class="label">Title</span>
            <input type="text" name="title" required />

            <span class="label">Content</span>
            <textarea name="content" required></textarea>

            <div class="chkgroup">
                <span class="label-in">Important</span>
                <input type="hidden" name="important" value="0" />
                <input type="checkbox" name="important" value="1" />
            </div>

            <input type="submit" value="Add Note" />
        </form>
    </body>
</html>

<?php require_once('includes/footer.php'); ?>
