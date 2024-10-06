<?php
    require_once('includes/db.php');

    $sql = "SELECT * FROM notes";
    $notes = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Notes App</title>
        <link rel="stylesheet" href="styles/style.css">
    </head>
    <body>
        <header>
            Notes App
        </header>
        
        <div class="titleDiv">
            <div class="backLink">
                <a class="nav-link" href="new.php">Add a new note</a>
            </div>
        </div>

        <div class="note-container">
            <?php
            while ($note = mysqli_fetch_assoc($notes)) {
                ?>
                <div class="note">
                    <div class="titleContainer">
                        <span class="nt-title"><?php echo htmlspecialchars($note['title']); ?></span>
                        <div class="nt-links">
                            <a class="nt-link" href="<?php echo 'edit.php?id='. $note['id']; ?>">Edit</a>
                            <a class="nt-link" href="<?php echo 'delete.php?id='. $note['id']; ?>">[X] Delete</a>
                        </div>                 
                    </div>

                    <div class="nt-content">
                        <?php if ($note['important']) { echo "<span class='imp'>IMPORTANT</span><br>"; } ?>
                        <?php echo htmlspecialchars($note['content']); ?>
                    </div>
                </div>
            <?php }
            mysqli_free_result($notes);
            ?>
        </div> 
    </body>
</html>

<?php require_once('includes/footer.php'); ?>
