<?php
class auth_calendar {
public $client;
public $cal;


function __construct(){		
	require_once $_SERVER['DOCUMENT_ROOT']. '/code-igniter/application/libraries/calendar/src/Google_Client.php';
	require_once $_SERVER['DOCUMENT_ROOT']. '/code-igniter/application/libraries/calendar/src/contrib/Google_CalendarService.php';
	$this->loadLibrary();
}			
function loadLibrary(){
		//session_start();
		$this->client = new Google_Client();
		$this->client->setApplicationName("Google Calendar PHP Starter Application");
		// Visit https://code.google.com/apis/console?api=calendar to generate your
		// client id, client secret, and to register your redirect uri.
		 $this->client->setClientId('269366000610.apps.googleusercontent.com');
		 $this->client->setClientSecret('bit1D2zktc9z_vI6HRJMQmOl');
		 $this->client->setRedirectUri('http://localhost/code-igniter/calendar_auth');
		 $this->client->setDeveloperKey('AIzaSyDb7YdTUvj1v_YzaV_dyxjrkC1T3DsW8yI');
		
		
		$this->cal = new Google_CalendarService($this->client);
		
		if (isset($_GET['logout'])) {
		  unset($_SESSION['token']);
		}
		if (isset($_GET['code'])) {
		  $this->client->authenticate($_GET['code']);
		  $_SESSION['token'] = $this->client->getAccessToken();
		  //header('Location: http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']);
		  
		}

		if (isset($_SESSION['token'])){
		  $this->client->setAccessToken($_SESSION['token']);
		}
		
				
	}	
	public function isAutenticated(){
		if ($this->client->getAccessToken()) {		  		  
				$_SESSION['token'] = $this->client->getAccessToken();
				return true;
			}
		else {
				return false;
			}
	}
	public function auth_url(){
		return $this->client->createAuthUrl();
	
	}
}
		
?>
		