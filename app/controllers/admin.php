<?php
/**
* 
*/
class Admin extends Controller
{
	public function login()
	{
		$this->view('admin/login', []);
	}

	public function register()
	{
		$this->view('admin/register', []);
	}

}