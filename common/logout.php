<?php session_unset();// remove all session variables
// destroy the session
session_destroy();
header("Location: index.html");
