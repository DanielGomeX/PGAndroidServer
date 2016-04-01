<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/




// Authentication routes...
#Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'SessionController@authenticate');
Route::get('auth/logout', 'SessionController@logout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

Route::get('/login', function () {
    return view('account.login');
});

Route::get('/', function () {
    return view('layout.home');
});

Route::post('coordenadas/new/', [ 'as' => 'coordenadas_new', 'uses' => 'CoordenadaController@store']);
Route::post('pedido/store', [ 'as' => 'pedido_store', 'uses' => 'PedidoController@store']);
Route::get('json/users/', [ 'as' => 'user_json', 'uses' => 'UserController@getJson']);
Route::get('json/pedidos/', [ 'as' => 'pedidos_json', 'uses' => 'PedidoController@getJson']);

//ainda precisa serem criadas as acl... mas os processos já estao feitos...
// como segue um exemplo de root...

Route::group(['middleware' => 'acl:root'], function(){
	


	Route::get('users', [ 'as' => 'user', 'uses' => 'UserController@index']);
	Route::get('user/deleted', [ 'as' => 'user_deleted', 'uses' => 'UserController@deleted']);
	Route::get('user/new', [ 'as' => 'user_new', 'uses' => 'UserController@create']);
	Route::get('user/edit/{id}', [ 'as' => 'user_edit', 'uses' => 'UserController@edit']);
	Route::post('user/restore/{id}', [ 'as' => 'user_restore', 'uses' => 'UserController@restore']);
	Route::post('user/destroy/{id}', [ 'as' => 'user_delete', 'uses' => 'UserController@destroy']);
	Route::post('user/store', [ 'as' => 'user_store', 'uses' => 'UserController@store']);
});




Route::group(['middleware' => 'auth'], function(){
	Route::get('mapa', [ 'as' => 'mapa', 'uses' => 'MapaController@index']);




	


	Route::get('pedidos', [ 'as' => 'pedido', 'uses' => 'PedidoController@index']);
	Route::get('pedido/deleted', [ 'as' => 'pedido_deleted', 'uses' => 'PedidoController@deleted']);
	Route::get('pedido/new', [ 'as' => 'pedido_new', 'uses' => 'PedidoController@create']);
	Route::get('pedido/edit/{id}', [ 'as' => 'pedido_edit', 'uses' => 'PedidoController@edit']);
	Route::post('pedido/restore/{id}', [ 'as' => 'pedido_restore', 'uses' => 'PedidoController@restore']);
	Route::post('pedido/destroy/{id}', [ 'as' => 'pedido_delete', 'uses' => 'PedidoController@destroy']);
	
	

	

	Route::get('tipos', [ 'as' => 'tipo', 'uses' => 'TipoController@index']);
	Route::get('tipo/deleted', [ 'as' => 'tipo_deleted', 'uses' => 'TipoController@deleted']);
	Route::get('tipo/new', [ 'as' => 'tipo_new', 'uses' => 'TipoController@create']);
	Route::get('tipo/edit/{id}', [ 'as' => 'tipo_edit', 'uses' => 'TipoController@edit']);
	Route::post('tipo/restore/{id}', [ 'as' => 'tipo_restore', 'uses' => 'TipoController@restore']);
	Route::post('tipo/destroy/{id}', [ 'as' => 'tipo_delete', 'uses' => 'TipoController@destroy']);
	Route::post('tipo/store', [ 'as' => 'tipo_store', 'uses' => 'TipoController@store']);
	Route::get('json/tipos/', [ 'as' => 'tipos_json', 'uses' => 'TipoController@getJson']);



	Route::get('products', [ 'as' => 'product', 'uses' => 'ProductController@index']);
	Route::get('product/deleted', [ 'as' => 'product_deleted', 'uses' => 'ProductController@deleted']);
	Route::get('product/new', [ 'as' => 'product_new', 'uses' => 'ProductController@create']);
	Route::get('product/edit/{id}', [ 'as' => 'product_edit', 'uses' => 'ProductController@edit']);
	Route::post('product/restore/{id}', [ 'as' => 'product_restore', 'uses' => 'ProductController@restore']);
	Route::post('product/destroy/{id}', [ 'as' => 'product_delete', 'uses' => 'ProductController@destroy']);
	Route::post('product/store', [ 'as' => 'product_store', 'uses' => 'ProductController@store']);
	Route::get('json/products/', [ 'as' => 'products_json', 'uses' => 'ProductController@getJson']);

	Route::get('groups', [ 'as' => 'group', 'uses' => 'GroupController@index']);
	Route::get('group/deleted', [ 'as' => 'group_deleted', 'uses' => 'GroupController@deleted']);
	Route::get('group/new', [ 'as' => 'group_new', 'uses' => 'GroupController@create']);
	Route::get('group/edit/{id}', [ 'as' => 'group_edit', 'uses' => 'GroupController@edit']);
	Route::post('group/restore/{id}', [ 'as' => 'group_restore', 'uses' => 'GroupController@restore']);
	Route::post('group/destroy/{id}', [ 'as' => 'group_delete', 'uses' => 'GroupController@destroy']);
	Route::post('group/store', [ 'as' => 'group_store', 'uses' => 'GroupController@store']);


	Route::get('permissions', [ 'as' => 'permission', 'uses' => 'PermissionController@index']);
	Route::get('permission/deleted', [ 'as' => 'permission_deleted', 'uses' => 'PermissionController@deleted']);
	Route::get('permission/new', [ 'as' => 'permission_new', 'uses' => 'PermissionController@create']);
	Route::get('permission/edit/{id}', [ 'as' => 'permission_edit', 'uses' => 'PermissionController@edit']);
	Route::post('permission/restore/{id}', [ 'as' => 'permission_restore', 'uses' => 'PermissionController@restore']);
	Route::post('permission/destroy/{id}', [ 'as' => 'permission_delete', 'uses' => 'PermissionController@destroy']);
	Route::post('permission/store', [ 'as' => 'permission_store', 'uses' => 'PermissionController@store']);

	Route::get('clients', [ 'as' => 'client', 'uses' => 'ClientController@index']);
	Route::get('client/deleted', [ 'as' => 'client_deleted', 'uses' => 'ClientController@deleted']);
	Route::get('client/new', [ 'as' => 'client_new', 'uses' => 'ClientController@create']);
	Route::get('client/edit/{id}', [ 'as' => 'client_edit', 'uses' => 'ClientController@edit']);
	Route::post('client/restore/{id}', [ 'as' => 'client_restore', 'uses' => 'ClientController@restore']);
	Route::post('client/destroy/{id}', [ 'as' => 'client_delete', 'uses' => 'ClientController@destroy']);
	Route::post('client/store', [ 'as' => 'client_store', 'uses' => 'ClientController@store']);

	Route::get('regions', [ 'as' => 'region', 'uses' => 'RegionController@index']);
	Route::get('region/deleted', [ 'as' => 'region_deleted', 'uses' => 'RegionController@deleted']);
	Route::get('region/new', [ 'as' => 'region_new', 'uses' => 'RegionController@create']);
	Route::get('region/edit/{id}', [ 'as' => 'region_edit', 'uses' => 'RegionController@edit']);
	Route::post('region/restore/{id}', [ 'as' => 'region_restore', 'uses' => 'RegionController@restore']);
	Route::post('region/destroy/{id}', [ 'as' => 'region_delete', 'uses' => 'RegionController@destroy']);
	Route::post('region/store', [ 'as' => 'region_store', 'uses' => 'RegionController@store']);

	Route::get('viaturas', [ 'as' => 'viatura', 'uses' => 'ViaturaController@index']);
	Route::get('viatura/deleted', [ 'as' => 'viatura_deleted', 'uses' => 'ViaturaController@deleted']);
	Route::get('viatura/new', [ 'as' => 'viatura_new', 'uses' => 'ViaturaController@create']);
	Route::get('viatura/edit/{id}', [ 'as' => 'viatura_edit', 'uses' => 'ViaturaController@edit']);
	Route::post('viatura/restore/{id}', [ 'as' => 'viatura_restore', 'uses' => 'ViaturaController@restore']);
	Route::post('viatura/destroy/{id}', [ 'as' => 'viatura_delete', 'uses' => 'ViaturaController@destroy']);
	Route::post('viatura/store', [ 'as' => 'viatura_store', 'uses' => 'ViaturaController@store']);
	

	Route::get('unidades', [ 'as' => 'unidade', 'uses' => 'UnidadeController@index']);
	Route::get('unidade/deleted', [ 'as' => 'unidade_deleted', 'uses' => 'UnidadeController@deleted']);
	Route::get('unidade/new', [ 'as' => 'unidade_new', 'uses' => 'UnidadeController@create']);
	Route::get('unidade/edit/{id}', [ 'as' => 'unidade_edit', 'uses' => 'UnidadeController@edit']);
	Route::post('unidade/restore/{id}', [ 'as' => 'unidade_restore', 'uses' => 'UnidadeController@restore']);
	Route::post('unidade/destroy/{id}', [ 'as' => 'unidade_delete', 'uses' => 'UnidadeController@destroy']);
	Route::post('unidade/store', [ 'as' => 'unidade_store', 'uses' => 'UnidadeController@store']);
	
	Route::get('itinerarios/get', [ 'as' => 'itinerario_get', 'uses' => 'ItinerarioController@get']);
	Route::get('itinerarios', [ 'as' => 'itinerario', 'uses' => 'ItinerarioController@index']);
	Route::get('itinerario/deleted', [ 'as' => 'itinerario_deleted', 'uses' => 'ItinerarioController@deleted']);
	Route::get('itinerario/new', [ 'as' => 'itinerario_new', 'uses' => 'ItinerarioController@create']);
	Route::get('itinerario/edit/{id}', [ 'as' => 'itinerario_edit', 'uses' => 'ItinerarioController@edit']);
	Route::post('itinerario/restore/{id}', [ 'as' => 'itinerario_restore', 'uses' => 'ItinerarioController@restore']);
	Route::post('itinerario/destroy/{id}', [ 'as' => 'itinerario_delete', 'uses' => 'ItinerarioController@destroy']);
	Route::post('itinerario/store', [ 'as' => 'itinerario_store', 'uses' => 'ItinerarioController@store']);

	Route::get('rondas', [ 'as' => 'ronda', 'uses' => 'RondaController@index']);
	Route::get('ronda/deleted', [ 'as' => 'ronda_deleted', 'uses' => 'RondaController@deleted']);
	Route::get('ronda/new', [ 'as' => 'ronda_new', 'uses' => 'RondaController@create']);
	Route::get('ronda/edit/{id}', [ 'as' => 'ronda_edit', 'uses' => 'RondaController@edit']);
	Route::post('ronda/restore/{id}', [ 'as' => 'ronda_restore', 'uses' => 'RondaController@restore']);
	Route::post('ronda/destroy/{id}', [ 'as' => 'ronda_delete', 'uses' => 'RondaController@destroy']);
	Route::post('ronda/store', [ 'as' => 'ronda_store', 'uses' => 'RondaController@store']);
});




Event::listen('illuminate.query', function($query)
{	
    #var_dump($query);
});