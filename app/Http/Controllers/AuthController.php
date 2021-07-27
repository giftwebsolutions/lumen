<?php
namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthController extends Controller
{   
    function __construct() {
        // Enable authentication for controller methods
        $this->middleware('auth', ['only' => ['create','update','delete']]);

        // Check logged user role
        $this->middleware('role:worker|admin', ['only' => ['create','update','delete']]);
        // $this->middleware('role:admin|worker|user', ['only' => ['create','update','delete']]); 
        
        // Enable authentication for controller methods
        // $this->middleware('auth', ['except' => ['create','auth']]);
    }

    /**
     * Create user
     *
     * @return Response
     */
    public function create(Request $request)
    {     
        $user = $request->user();

        return response()->json([
            "authenticated" => $request->header('Authorization'), 
            "user.name" => $user->name,
            "user.email" => $user->email,
            "user.role" => $user->role
        ]);
    }
    
    /**
     * Update user
     *
     * @return Response
     */
    public function update(Request $request)
    {
        $user = $request->user();

        return response()->json([
            "authenticated" => $request->header('Authorization'), 
            "user.name" => $user->name,
            "user.email" => $user->email,
            "user.role" => $user->role
        ]);
    }
    
    /**
     * Delete user
     *
     * @return Response
     */
    public function delete(Request $request)
    {
        $user = $request->user();

        return response()->json([
            "authenticated" => $request->header('Authorization'), 
            "user.name" => $user->name,
            "user.email" => $user->email,
            "user.role" => $user->role
        ]);
    }
    
    /**
     * Login user
     *
     * @return Response
     */
    public function login(Request $request) {
        $credentials = $request->only(['email','password']);

        if (Auth::attempt($credentials, $request->has('remember'))) {
            return'logged in';
        } else {
            return 'not logged in';
        }
    }
}
