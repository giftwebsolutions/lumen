<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
	function __construct() {
		// Enable authentication for controller methods
		$this->middleware('auth', ['only' => ['create','update','delete']]);

		// Check logged user role
		$this->middleware('role:worker|admin|user', ['only' => ['create','update','delete']]);
		// $this->middleware('role:admin|worker|user', ['only' => ['create','update','delete']]);

		// Enable authentication for controller methods
		// $this->middleware('auth', ['except' => ['login']]);
	}

	/**
	 * Login user, create token
	 *
	 * @return Response
	 */
	public function login(Request $request)
	{
		$this->validate($request, [
		    'email' => 'required|email|max:255',
		    'pass' => 'required|min:8'
		], [
			'required' => strtoupper('ERR_:attribute'),
			'*' => strtoupper('ERR_:attribute')
		]);

		$size = env('AUTH_TOKEN_LENGTH', 32);
		$token = bin2hex(random_bytes($size));

		try {
			$user = collect(User::where('email', $request->input('email'))->where('pass', md5($request->input('pass')))->get())->first();
			if($user->id > 0) {
				User::where('id', $user->id)->update(['api_token' => $token]);
				return response()->json(['token' => $token]);
			}
		} catch (\Exception $e) {
			return response()->json(['error' => 'ERR_CREDENTIALS', 'error_message' => $e->getMessage()], 402);
		}

		return response()->json(['error' => 'ERR_AUTHENTICATION'], 401);
	}

	/**
	 * Update user auth only
	 *
	 * @return Response
	 */
	public function update(Request $request)
	{
		$user = $request->user();
		$user = Auth::user();
		$id = Auth::id();

		// The user is logged in
		if (Auth::check()) {
			// Update user here ...
			// Facades
			// $cnt = DB::update('update users set name = :name where id = :id', ['id' => $user->id, 'name' => $request->input('name')]);
			// Eloquent
			// $cnt = User::where('id', $user->id)->update('name', $request->input('name'));

			return response()->json([
				"user.id" => $user->id,
				"user.name" => $user->name,
				"user.email" => $user->email,
				"user.role" => $user->role,
			]);
		}

		return response()->json(['error' => 'ERR_AUTHENTICATION'], 401);
	}
}

/*
// Validateor example
$validator = Validator::make($request->all(), [
	'email' => 'required|email|max:255',
	'pass' => 'required|min:8'
], [
	'required' => strtoupper('ERR_:attribute'),
	'*' => strtoupper('ERR_:attribute')
]);
// MessageBag https://laravel.com/api/5.5/Illuminate/Support/MessageBag.html
if ($validator->fails()) {
	return $validator->errors();
}
*/