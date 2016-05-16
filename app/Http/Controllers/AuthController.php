<?php

namespace App\Http\Controllers;

use Auth;
use URL;
use GuzzleHttp;
use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

use Socialite;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function login()
    {
        return Socialite::driver('github')->redirect();
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function loginCallback()
    {
        $user = Socialite::driver('github')->user();

        $isAdmin = $this->adminCheck($user);

        $authUser = $this->findOrCreateUser($user, $isAdmin);

        Auth::login($authUser, true);

        return redirect(URL::previous());
    }

    /**
     * Return true if user is a CodeLouisville admin
     *
     * @param $githubUser
     * @return User
     */
    private function adminCheck($githubUser)
    {
        $token = $githubUser->token;

        $client = new GuzzleHttp\Client();
        $orgs = json_decode($client->request('GET', 'https://api.github.com/user/memberships/orgs', [ 'headers' => [ 'Authorization' => "token $token" ] ])->getBody());

        $admin = false;

        foreach($orgs as $org)
        {
            if($org->organization->id == 6510199 && $org->role == 'admin') $admin  = true;
        }

        return $admin;
    }

    /**
     * Return user if exists; create and return if doesn't
     *
     * @param $githubUser
     * @return User
     */
    private function findOrCreateUser($githubUser, $isAdmin = false)
    {
        if ($authUser = User::where('github_id', $githubUser->id)->first()) {

            $authUser->admin = $isAdmin;
            $authUser->save();

            return $authUser;
        }

        return User::create([
            'name' => $githubUser->name,
            'email' => $githubUser->email,
            'github_id' => $githubUser->id,
            'avatar' => $githubUser->avatar,
            'admin' => $isAdmin
        ]);
    }
}
