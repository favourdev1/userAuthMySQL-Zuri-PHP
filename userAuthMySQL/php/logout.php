<?php
wait(4);
session_unset();
session_destroy();
header("Location: ../index.php");

