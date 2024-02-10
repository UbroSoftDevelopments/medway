<?php
session_start();
?>
<!DOCTYPE html>
<html>
<body>

<?php
// remove all session variables
session_unset();

// destroy the session
session_destroy();

header("Location: index.php");
exit();

//echo "All session variables are now removed, and the session is destroyed."
?>

</body>
</html>