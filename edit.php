<?php
    require_once('includes/db.php');
    require_once('includes/functions.php');
    
    // Handle form submission
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $title = prep_input($_POST['title']);
        $content = prep_input($_POST['content']);
        $important = prep_input($_POST['important']);  // Correct handling of the checkbox
        $id = prep_input($_POST['id']);

        $sql = "UPDATE notes SET title = '$title', content = '$content', important = '$important' WHERE id = '$id' LIMIT 1";

        if (mysqli_query($conn, $sql)) {
            header('Location: index.php');  // Redirect after successful update
            exit();  // Ensure no further execution after header redirect
        } else {
            echo 'Error: ' . mysqli_error($conn);
        }
    }

    // Fetch note data for the given id
    if (!isset($_GET['id'])) {
        header('Location: index.php');  // Redirect if no id is set
        exit();
    }

    $id = $_GET['id'];
    $sql = "SELECT * FROM notes WHERE id = '$id' LIMIT 1";
    $result = mysqli_query($conn, $sql);
    $note = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Edit Note - Notes App</title>
        <link rel="stylesheet" href="styles/style.css">
    </head>
    <body>
        <header>Notes App</header>

        <div class="titleDiv">
            <div class="backLink">
                <a class="nav-link" href="index.php">Home</a>
            </div>
            <div class="head">Edit Note</div>
        </div>

        <form action="edit.php" method="post">
            <input type="hidden" name="id" value="<?php echo $note['id']; ?>" />

            <span class="label">Title</span>
            <input type="text" name="title" value="<?php echo htmlspecialchars($note['title']); ?>" required />

            <span class="label">Content</span>
            <textarea name="content" required><?php echo htmlspecialchars($note['content']); ?></textarea>

            <div class="chkgroup">
                <span class="label-in">Important</span>
                <input type="hidden" name="important" value="0" />
                <input type="checkbox" name="important" value="1" <?php if ($note['important']) { echo "checked"; } ?> />
            </div>

            <input type="submit" value="Update Note" />
        </form>
    </body>
</html>

<?php require_once('includes/footer.php'); ?>
