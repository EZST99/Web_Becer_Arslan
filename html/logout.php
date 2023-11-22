<?php
session_start();
session_destroy();

echo "Sie wurden erfolgreich abgemeldet...";
header("Location: index.php");


?>