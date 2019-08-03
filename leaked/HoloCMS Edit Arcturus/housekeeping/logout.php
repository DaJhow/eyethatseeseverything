<?php require_once("../inc/core.god.php");
require_once("../inc/hk_session.php");

unset($_SESSION['HUsername']);
unset($_SESSION['HPassword']);

header("Location: index.php"); ?>