<?php
setcookie("user", "", time() - 3600*24*30*12, "/");
setcookie("hash", "", time() - 3600*24*30*12, "/");
header('Location: /');
?>