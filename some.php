<?php

session_start();
echo $_SESSION['loginID'];
session_destroy();
