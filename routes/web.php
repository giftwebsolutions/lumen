<?php
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Mysql\Db as Database;

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/hi', function () {
    return 'Hello World';
});

$router->get('user/{id}', 'ExampleController@show');

$router->get('user/{id}', function ($id) {
    return response()->json(['name' => 'Abigail', 'id' => $id]);
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

$router->get('db1/{id}', function ($id) {
    $rows = Database::Query("SELECT * FROM user WHERE id > :id", [':id' => 0])->FetchAllObj();
    return response()->json(['name' => 'Abigail', 'id' => $id, 'rows' => $rows]);
});

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
    return response()->json(['name' => 'Abigail', 'id' => $id, 'rows' => $rows, 'last_id' => $last_id]);
});

$router->get('alias/{name:[A-Za-z0-9\.]+}', function ($name) {
    //
});
