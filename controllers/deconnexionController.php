<?php

unset($_SESSION['idUser']);
unset($_SESSION['username']);

header('Location: index.php?page=home');