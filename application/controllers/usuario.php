<?php

class Usuario extends CI_Controller {

		public function view($page = 'home')
	{
				
		if ( ! file_exists('application/views/usuario/'.$page.'.php'))
		{
			// Whoops, we don't have a page for that!
			echo "TESTE";
			
		}
		
		$data['title'] = ucfirst($page); // Capitalize the first letter
		
		$this->load->view('templates/header', $data);
		$this->load->view('usuario/'.$page, $data);
		$this->load->view('templates/footer', $data);

	}
	public function index()
	{
		$this->load->view('usuario/home.php');
	
	}
	
	
}