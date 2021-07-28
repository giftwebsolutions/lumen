<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\User;

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
		// $user = $request->user();
		$user = Auth::user();
		$id = Auth::id();
		$ok = 'err';

		if (Auth::check()) {
			// The user is logged in...
			$ok = 'ok';
		}

		return response()->json([
			"authenticated" => $request->header('Authorization'),
			"user.id" => $id,
			"user.name" => $user->name,
			"user.email" => $user->email,
			"user.role" => $user->role,
			'auth_ok' => $ok
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
	public function login(Request $request)
	{
		// $this->validate($request, [
		//     'email' => 'required|email|max:255',
		//     'password' => 'required|min:8'
		// ]);

		// Request array
		$all = $request->all();

		// Array
		$data = [
			implode(',', $all),
			// 'ip' => '127.0.0.1',
			// 'airports' => ['NYC', 'LIT'],
		];

		$validator = Validator::make($data, [
			'email' => 'required|email|max:255',
			'password' => 'required|min:8',
			// 'ip' => 'required|ip',
			// 'airports' => ['required', 'array', Rule::in(['NYC', 'LIT'])]
		], [
			'required' => strtoupper('ERR_:attribute'),
			'email' => strtoupper('ERR_:attribute'),
			'password' => strtoupper('ERR_:attribute'),
		]);

		// MessageBag https://laravel.com/api/5.5/Illuminate/Support/MessageBag.html
		$errors = $validator->errors();
		// Keys list
		$err_keys = $validator->errors()->keys();
		// Messages
		$err_msgs = $validator->errors()->all();
		// First message
		$first_msg = $validator->errors()->first();

		if ($validator->fails()) {
			return $validator->errors();
		}

		try
		{
			$token = User::attempt($request->input('email'), $request->input('password'));

			if ($token != null) {
				return response()->json(['auth' => 'ok', 'token' => $token]);
			} else {
				throw new \Exception('ERR_TOKEN_ATTEMPT', 401);
			}
		}
		catch (\Exception $e)
		{
			return response()->json(['auth' => 'not ok', 'error' => $e->getMessage(), 'error_code' => $e->getCode()]);
		}

		return response()->json(['auth' => 'not ok', 'token' => $token]);
	}
}
