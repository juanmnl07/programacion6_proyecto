<?php
/**
* 
*/
class Home extends Controller
{
	
	public function index($name = '')
	{
		$user = $this->model('user');
		$user->name = $name;
		$this->view('home/index', []);
	}

	public function about_us()
	{
		$this->view('home/about_us', []);
	}

	public function contact_us()
	{
		$this->view('home/contact_us', []);
	}

}