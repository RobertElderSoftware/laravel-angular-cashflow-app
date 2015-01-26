<?php

class HomeController extends BaseController {
	public function index(){
		if(Auth::check()){
			return View::make('index');
		}else{
        		return Redirect::to('users/login');
        	}
	}
}
