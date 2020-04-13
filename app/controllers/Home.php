<?php

class Home extends Controller
{
   public function index ($name = '')
    {
        $this->view('home/index',['name'=>$name]);

    }
 /*
  * We used User class directly.
  * */
    public function create($username = '', $email = '') {
        User::create([
            'name' => $username,
            'email' => $email
        ]);
    }
}