<?php

class Home extends Controller {
    
    public function index() 
    {
        $user = $this->model('User');
        //$user->name = $name;
        
        $this->view('home/index');
    }
    
    public function register()
    {
        $this->view('home/register');
    }
    
    public function terms()
    {
        $this->view('home/terms');
    }
}