@include("mailstester.spamclass")
<?php

// include the class
//include_once("spamclass.blade.php");

// get the data to be filtered. This is must be a string. 
//$email = file_get_contents  ( "email_src.txt" )
$email = $message['content'];

// create the instance.
$spam = new spamc;

// configure the instance.
$spam->command = 'PROCESS';


echo "<pre>";

// filter and check for errors, displaying the result.

if ($spam->filter($email)) {
     print_r($spam->result);
} else {
     print_r($spam->err);
}
echo "</pre>";
die;
