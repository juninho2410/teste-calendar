<?php

class calendar_auth extends CI_Controller {
		
		public function index(){	
			session_start();
			$this->load->library('auth_calendar');
			if($this->auth_calendar->isAutenticated()){
				echo ('<script>location.href="/code-igniter"</script>');
			}
			else{
				$data['urltoautenticate']=$this->auth_calendar->auth_url();
				$this->load->view('calendar/autenticate',$data);
			}
			
		}
}
