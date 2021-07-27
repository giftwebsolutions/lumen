<?php
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Mysql\Db as Database;

$router->get('/', function () use ($router) {
    return response()->json([
        'lumen.version' => $router->app->version(),
        'lumen.routes' => 'routes/web.php'
    ]);
    
    return $router->app->version();
});

$router->get('/hi', 'home', function () {
    return 'Hello World';
});

$router->get('user/{id}', 'ExampleController@show');

$router->get('user/{id}', function ($id, Request $request) {
    return response()->json([
        'url.id' => $id
    ]);
    // return 'User '.$id;
    // return response()->json(['name' => 'Abigail', 'state' => 'CA']);
    // return response()->json(['error' => 'Unauthorized'], 401, ['X-Header-One' => 'Header Value']);
    // return response($content, $status)->header('Content-Type', $value);
    // return response()->download($pathToFile);
    // return response()->download($pathToFile, $name, $headers);
    // return redirect('home/dashboard');
    // return redirect()->route('login');
    // return redirect()->route('profile', ['id' => 1]);
    // return redirect()->route('profile', [$user]);
    // return 'User '.$id;
});

// Authenticate middleware in controller constructor
// $router->post('/panel', 'AuthController@create');

// Authenticate middelware
$router->post('/panel/{id}', ['middleware' => 'auth', function (Request $request, $id) {
    $user = $request->user();
        
    return response()->json([
        "authenticated" => $request->header('Authorization'), 
        "user.name" => $user->name,
        "user.email" => $user->email,
        "user.role" => $user->role
    ]);
}]);

// Authentication
$router->post('/panel', ['middleware' => 'auth', 'uses' => 'AuthController@create']);

// Set session
$router->get('set-session', function (Request $request) {
    // Set session data
    $request->session()->put('name', uniqid());
    
    // Get session data
    $sid = $request->session()->get('_token');
    $name = $request->session()->get('name');
    
    return response()->json([
        'session.id' => $sid,
        'session.name' => $name
    ]);
});

// Get session data
$router->get('session', function (Request $request) {
    if($request->session()->has('name')) {
    
        // Get session data
        $sid = $request->session()->get('_token');
        $name = $request->session()->get('name');
    
        return response()->json([
            'session.id' => $sid,
            'session.name' => $name
        ]);        
    } else {
        return response()->json([
            'error' => [
                'description' => 'ERR_SESSION'
            ]
        ], 403);
    }    
});

// Db
$router->get('db/{id}', function ($id) {
    /*
        Lumen mysql
    */
    $email = uniqid().'@woo.xx';
    $pass = md5($email);
    $new_id = app('db')->select('insert into user (email,pass) values (?, ?)', [$email, $pass]);
    $rows = app('db')->select('select * from user where id != :id', ['id' => $id]);

    /*
        Lumen facades
        Uncomment: $app->withFacades(); in bootstrap/app.php
    */
    $email = uniqid().'@woo.xx';
    $pass = md5($email);

    $new_id = DB::insert('insert into user (email,pass) values (?, ?)', [$email, $pass]);
    $last_id = DB::getPdo()->lastInsertId();
    $rows = DB::select('select * from user where id != :id', ['id' => $id]);

    // DB::delete('delete from user where id != 0');
    // $last_id = DB::table('user')->insertGetId(['pass => $pass, 'email => $email]);

    // Response
    return response()->json(['name' => 'Bambo', 'id' => $id, 'rows' => $rows, 'last_id' => $last_id]);
});

// Custom database class
$router->get('database/{id}', function ($id) {
    $rows = Database::Query("SELECT * FROM user WHERE id > :id", [':id' => 0])->FetchAllObj();
    return response()->json(['name' => 'Bambo', 'id' => $id, 'rows' => $rows]);
});

// Get url parts
$router->get('alias/{name:[A-Za-z0-9\.]+}/{code}', function ($name, $code) {
    //
});

// Middelware auth
$router->group(['middleware' => 'middleware.auth'], function ($app) {
    $app->get('/user/dashboard', ['uses' => 'Controller@method']);
});
