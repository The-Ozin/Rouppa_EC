<?php
session_start();
session_destroy();
header("Location: http://localhost/Rouppa_EC/user/user_login.php");
exit();

