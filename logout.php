<?php
//start the session
session_start() ;

//session variable is registered, the user is ready to logout
session_unset() ;
session_destroy ();

// define here the next page address
header( "Location: sign.php" );
exit;
