<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// home
Route::get('/', 'Customer\HomeController@home');

// login
Route::post('/login', 'Customer\AccountController@login');

// logout
Route::get('/logout', 'Customer\AccountController@logout');

// register
Route::post('/register', 'Customer\AccountController@register');

// check booking
Route::post('/booking/check/{room_id}', 'Customer\BookController@bookingRoomCheck');

// booking
Route::post('/booking', 'Customer\BookController@bookingRoom');

// admin
// Route::group(['prefix' => 'admin', 'middleware' => 'CheckAdminLogin'], function () {
// 	// users member
// 	Route::get('/user/member', 'UserController@member');
// 	Route::put('/user/member/{id}', 'UserController@updateMember');
// 	Route::delete('/user/member/{id}', 'UserController@destroyMember');
// });

// room 
Route::get('/room/{id}/information', 'RoomController@show');

// admin
Route::group(['prefix' => 'admin', 'middleware' => 'CheckAdmin'], function () {
	// get home page admin
	Route::get('/', 'AdminController@homePage');
	Route::get('/home', 'AdminController@homePage');

	// get change pass
	Route::get('/change/password', 'Auth_Admin\LoginController@getChangePassword');
	Route::post('/change/password', 'Auth_Admin\LoginController@changePassword');

    // category
	Route::resource('category', 'CategoryController');
	Route::post('/update_category', 'CategoryController@edit');
	Route::get('/new/category', function(){
		return view('category.new_category'); 
	});

	// rooms 
	Route::resource('room', 'RoomController');
	Route::get('room/detail/{id}', 'RoomController@showRoom');
	Route::post('room/update', 'RoomController@updateRoom');
	Route::get('/new/room', function(){
		return view('room.new_room');
	});

	// reservations 
	Route::resource('reservation', 'ReservationController');

    // posts
	// Route::resource('post', 'PostController');
	// Route::get('post/detail/{id}', 'PostController@showPost');
	// Route::post('post/update', 'PostController@updatePost');
	// Route::get('/new/post', function(){
	// 	return view('post.new_post');
	// });

    // tags
	// Route::resource('tag', 'TagController');
	// Route::get('/new/tag', function(){
	// 	return view('tag.new_tag');
	// });

	// users
	// Route::get('/user/member/{id}', 'UserController@show');

	// // contacts
	// Route::get('/contact', 'ContactController@index');
	// Route::delete('/contact/{id}', 'ContactController@destroy');

	// // slides
	// Route::get('/slide', 'SlideController@index');
	// Route::get('/slide/{id}', 'SlideController@show');
	// Route::post('/slide', 'SlideController@store');
	// Route::post('/update_slide', 'SlideController@edit');
	// Route::put('/update_status/{id}', 'SlideController@updateStatus');
	// Route::get('/new/slide', function(){
	// 	return view('slide.new_slide');
	// });
	// Route::delete('/slide/{id}', 'SlideController@destroy');

	// // introductions
	// Route::get('/edit/intro', 'IntroController@intro');
	// Route::post('/intro/update', 'IntroController@updateIntro');
});

// admin
Route::group(['prefix' => 'admin'], function () {
	// authentication routes...
	Route::get('/login', 'Auth_Admin\LoginController@showLoginForm')->name('login');
	Route::post('/login', 'Auth_Admin\LoginController@postLoginAdmin');
	Route::get('/logout', 'Auth_Admin\LoginController@logoutAdmin')->name('logout');
});
