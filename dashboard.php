<?php
session_start();

if (!empty($_SESSION['user_id'])) {
    echo $_SESSION['user_id'];
}

else {
    header("Location: index.php");
}
?>