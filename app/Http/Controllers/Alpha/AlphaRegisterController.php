<?php

namespace App\Http\Controllers\Alpha;

use App\Alpha;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AlphaRegisterController extends Controller
{
    
	public function create()
	{

		return view('alpha.register');

	}

	public function store(Request $request)
	{
		$this->validator($request->all())->validate();

		return $this->makeAlpha($request->all()) ? back() : redirect('/ty');
		
	}

	public function thankyou() {

		return view('alpha.thankyou')

	}

	protected function validator(array $data)
    {
        return Validator::make($data, [
            'handler' => 'required|max:255|alpha_dash|unique:alphas',
            'email' => 'required|email|max:255|unique:alphas',
        ]);
    }

    protected function makeAlpha(array $data)
    {
    	return Alpha::create([
    		'handler' => $data['handler'],
    		'email' => $data['email'],
    	]);
    }

}
