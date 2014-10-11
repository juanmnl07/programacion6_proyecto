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
		$this->view('home/index', ['name' => $user->name]);
	}

	public function about_us()
	{
		$this->view('home/about_us', []);
	}

	public function contact_us()
	{
		$this->view('home/contact_us', []);
	}

	public function blog($blog_id = '')
	{
		$this->view('home/blog', ['blog_id' => $blog_id]);
	}

	public function login()
	{
		$this->view('home/login', []);
	}

	public function register()
	{
		$this->view('home/register', []);
	}

}