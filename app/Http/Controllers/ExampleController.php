<?php
namespace App\Http\Controllers;

class ExampleController extends Controller
{
    /**
     * Retrieve the user for the given ID.
     * $router->get('user/{id}', 'ExampleController@show');
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        return "User id: " . $id;
    }
}
