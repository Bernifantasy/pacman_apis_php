<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return view('index');
    }
    public function create_user()
    {
        return view('create_user');
    }
    public function login()
    {
        return view('login');
    }
    public function logged()
    {
        return view('logged');
    }
    public function update_user()
    {
        return view('update_user');
    }
    public function logout()
    {
        return view('logout');
    }
    public function config_game()
    {
        return view('config_game');
    }
    public function update_config_game()
    {
        return view('update_config_game');
    }
    public function create_game()
    {
        return view('create_game');
    }
    public function get_user_last_games()
    {
        return view('get_user_last_games');
    }
    public function get_user_stats()
    {
        return view('get_user_stats');
    }
    public function get_top_users()
    {
        return view('get_top_users');
    }


}
