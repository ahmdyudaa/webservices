<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	public function index()
	{
		$this->load->view('login_view');
	}

    public function register()
	{
		$this->load->view('register_view');
	}
}
