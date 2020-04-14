<?php


namespace App;


use App\LoginToken;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatesUser
{

    use validatesRequests;
    protected  $request;

    public function __construct( Request $request)
    {
       $this->request   = $request;
    }

    public function invite()
    {
      $this->validateRequest()
            ->createToken()
            ->send();
    }

    protected function validateRequest()
    {
        $validatedData  =  $this->validate($this->request , [
            'email' => 'required|email|exists:users'
        ]);
        return $this;
    }

    protected function createToken()
    {
        $user =   User::ByEmail($this->request->email);
        return LoginToken::generateFor($user);
    }

    public function login($token)
    {
        auth::login($token->user);
        $token->delete();
    }
}
