<?php
session_start();
session_unset();
header('Location: ../login_register/index.php');
exit();