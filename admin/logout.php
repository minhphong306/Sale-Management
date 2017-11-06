<?php

session_start();
unset($_SESSION["is_logined"]);
header("Location: login.php");
