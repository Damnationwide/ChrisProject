<?php
session_start();
if ($_SESSION['ON'] ==false || $_SESSION['ON']==null) {
  session_unset();
  session_destroy();
  setcookie(session_name(),"",time()-1,"/");
  setcookie(session_name(),"",time()-1);
  header( 'Location: index.php?message=Invalid-Login' );;
  //$message="invalid-login";
  //include('index.php');
}
else
if (isset($_SESSION['LAST_ACTIVITY'])) 
	if ( time() - $_SESSION['LAST_ACTIVITY'] > 600) 
	{
		session_unset();     // unset $_SESSION variable for the run-time 
		session_destroy();   // destroy session data in storage
		setcookie(session_name(),"",time()-1,"/");
		setcookie(session_name(),"",time()-1);

		header( 'Location: index.php?message=Session-Time-Out' );
	}

?>
