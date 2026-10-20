$router->get('/', 'UserController@index');
$router->get('/users/create', 'UserController@create');
$router->post('/users/store', 'UserController@store');
$router->get('/users/delete/{id}', 'UserController@delete');
