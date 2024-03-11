<!DOCTYPE html>
<html>
    <!-- the head section -->
    <?php include 'header.php'; ?>
    <head>
        <title>SportsPro</title>
        <link rel="stylesheet" href="main.css">
    </head>

    <!-- the body section -->
    <body>
    <main>
        <h1>Database Error</h1>
        <p>An error occurred while attempting to work with the database.</p>
        <p>Message: <?php echo $error_message; ?></p>
    </main>
    </body>
</html>
