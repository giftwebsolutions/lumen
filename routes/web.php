<?php
use Illuminate\Http\Response;

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/hi', function () {
    return 'Hello World';
});

$router->get('user/{id}', function ($id) {
    return response()->json(['name' => 'Abigail', 'id' => $id]);
    // return response()->json(['name' => 'Abigail', 'state' => 'CA']);
    // return response()->json(['error' => 'Unauthorized'], 401, ['X-Header-One' => 'Header Value']);

    // return redirect('home/dashboard');
    // return redirect()->route('login');
    // return redirect()->route('profile', ['id' => 1]);
    // return redirect()->route('profile', [$user]);

    // return response($content, $status)->header('Content-Type', $value);
    // return response()->download($pathToFile);
    // return response()->download($pathToFile, $name, $headers);

    // return 'User '.$id;
});
