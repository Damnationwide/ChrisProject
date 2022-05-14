<?php
//Session variables store users infomation in order to start it use...//
include('library.php');
include_once('model/Login.php');
include_once('model/Cart.php');

if(isset($choice));
else  $choice=readValue('choice');

if(isset($message));
else  $message=readValue('message');

if($choice=='logon'){
	$user=readValue('username');
	$pass=readValue('password');
	$db=new Login();
	
	if(trim($user=="")){
		$message='Empty Username';
		$choice=null;
	}
	
	else if(trim($pass=="")){
		$message='Empty Password';
		$choice=null;
	}
	
	else if ($db->login($user,$pass)){     
		    if(isset($_SESSION['ON'])) include('checker.php');
		    else session_start();
			$_SESSION['username'] = $user;
			$_SESSION['password'] = $pass;

			$_SESSION['ON'] = true;

			$lifetime=600;
			setcookie(session_name(),session_id(),time()+$lifetime,"/");
			$_SESSION['LAST_ACTIVITY'] = time();
			$choice='home';
	}
	
	else{
		$message='Invalid-login';
		$pass=$user='';
		$choice=null;
	}
}

				if($choice==null ||$choice=='login'){    
						include('view/login.php');
				}
				
				else if($choice=="products"){
						if(!isset($_GET['choice2']))
							include( 'view/PCHardware.php' ) ;
						
						else{
							$item=$_GET['item'];
							$price=(float)$_GET['price'];
							session_start();
							$dbcart=new Cart();
							$dbcart->addItem($_SESSION['username'],$item,$price);
							include( 'view/PCHardware.php' ) ;
						}
				}
				

				else if($choice=='cart'){
					session_start();
					$userid=$_SESSION['username'];
					$dbcart=new Cart();
					$choice2=readValue("choice2");
					
					if($choice2=="set"){
						$item=readValue("item");
						$qty=readValue("qty");
						$userid=readValue("userid");
						$price=readValue("price");
						$dbcart->setItemNum($userid,$item,$price,$qty);
					}
					
					$output=$dbcart->getCart($userid);
					include('view/cart.php');
				}
				

				else if($choice=="home")
				{
					include( 'view/home.php' ) ;
				}

				else if($choice=="conversions"){
					include( 'view/Decimal-Binary-Hex.php');
				}

				else if($choice=="windows"){
					include( 'view/WindowsCMD.php');
				}

				else if($choice=="linux"){
					include( 'view/LinuxTerminal.php');
				}

				else if($choice=="contact"){
					include( 'view/Contact.php' ) ;
				}






				
				else if($choice=="thankyou"){
					session_start();
					$userid=$_SESSION['username'];
					$dbcart=new Cart();
					$dbcart->emptyCart($userid);
					include( 'view/thankyou.php' ) ;
				}

				else if($choice=="registration"){
						include("view/signup.php");
				}
				
				else if($choice=="register"){
					$user=$_GET['username'];
					$pass=$_GET['password'];
					$db=new Login();
					if($db->register($user,$pass)) header("Location: index.php");
					else
					{
						$message="ERROR: Userid Already In Use";
						include("view/signup.php");
					}
				}
				
				else if($choice=="logoff"){
					include('view/logoff.php' );
				}
				
				else if($choice=="logoff2"){
					session_start();
					session_unset();
					session_destroy();
					setcookie(session_name(),"",time()-1,"/");
					$message='Logoff-Succesfull';
					include('view/login.php' );
				}

				?>
