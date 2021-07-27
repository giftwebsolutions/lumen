<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthController extends Controller
{   
    function __construct() {
        // Enable authentication for controller methods (if errors remove middleware from routes in file web.php)        
        $this->middleware('auth', ['only' => ['create','update','delete']]);        
        // $this->middleware('auth', ['except' => ['select']]);
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
}
