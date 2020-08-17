<?php
//Adios  
session_start();  
session_destroy();  
header("location:../login.php");