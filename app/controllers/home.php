<?php
/**
* 
*/

//incluimos el recurso del modelo respectivo al controlador para manejar la bd

class Home extends Controller
{
	
	public function index($name = '')
	{
		$this->view('home/index', ['resultado' => array('estatus'=>2)]);
	}

	public function about_us()
	{
		$this->view('home/about_us', ['resultado' => array('estatus'=>2)]);
	}

	public function contact_us()
	{
		$this->view('home/contact_us', ['resultado' => array('estatus'=>2)]);
	}

	public function blog($blog_id = '')
	{
		$this->view('home/blog', ['blog_id' => $blog_id, 'resultado' => array('estatus'=>2)]);
	}

	public function login()
	{
		$this->view('home/login', ['resultado' => array('estatus'=>2)]);
	}

	public function register()
	{
		
		$this->view('home/register', ['resultado' => array('estatus'=>2)]);
		
	}

}