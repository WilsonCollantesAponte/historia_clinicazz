<?php
session_start();
session_unset();
session_destroy();
header("Location: ../section/index.php");
exit;
?>

