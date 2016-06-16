<?php

session_start();

$_SESSION['Hello'] = 'World';

echo $_SESSION['Hello'];