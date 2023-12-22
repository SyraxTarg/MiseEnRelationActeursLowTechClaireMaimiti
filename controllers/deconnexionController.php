<?php

unset($_SESSION['idUser']);
unset($_SESSION['username']);
unset($_SESSION['privileges']);

header('Location: index.php?page=home');