<?php


Route::get('/','HomeController@index')->name('home');
Route::get('/product/{slug}','HomeController@single')->name('product.single');

Route::prefix('cart')->name('cart.')->group(function(){
    Route::post('add','CartController@add')->name('add');
    Route::get('/','CartController@index')->name('index');
    Route::get('remove/{slug}','CartController@remove')->name('remove');
    Route::get('cancel','CartController@cancel')->name('cancel');
});

Route::get('/model', function(){
    //Criar uma Store para um User
    /*
    $user = \App\User::find(10);
    $store = $user->store()->create([
        'name' => 'loja teste1',
        'description' => 'desc teste1',
        'phone' => '454545454',
        'slug' => 'loja-teste1'
    ]);
    */
    
    
    //Criar um produto para uma loja
    /*
    $store = \App\Store::find(41);
    $product = $store->products()->create([
        'name' => 'notebook intel',
        'description' => 'core muto bao',
        'body' => 'aksdfnaskfnansfasdfasfa',
        'price' => 3000.50,
        'slug' => 'notebook-intel'
    ]);

    */



    //Criar uma  categoria

    /*
    \App\Category::create([
        'name' => 'Games',
        'description' => null,
        'slug' => 'games'
    ]);

    \App\Category::create([
        'name' => 'notebooks',
        'description' => null,
        'slug' => 'notebooks'
    ]);

    return \App\Category::all();
        */


    //Adicionar um produto para uma categoria
    //$produto = \App\Product::find(41);
   // $produto->categories()->sync([1]); // adicionar para o produto, para remover = detach
});

Route::prefix('checkout')->name('checkout.')->group(function(){
    Route::get('/','CheckoutController@index')->name('index');
    Route::post('proccess','CheckoutController@proccess')->name('proccess');
});


Route::group(['middleware' => ['auth']],function(){

    Route::prefix('admin')->name('admin.')->namespace('Admin')->group(function(){

        /*
        Route::prefix('stores')->name('stores.')->group(function(){
    
            Route::get('/','StoreController@index')->name('index'); // exibir todas as lojas
            Route::get('create','StoreController@create')->name('create'); // form de criar
            Route::post('store','StoreController@store')->name('store'); // salvar = create chama store
            Route::get('/{store}/edit','StoreController@edit')->name('edit'); // form de editar
            Route::post('update/{store}','StoreController@update')->name('update'); // atualizar ] editar chama update
            Route::get('/destroy/{store}','StoreController@destroy')->name('destroy'); // deletar
        });
        */
        Route::resource('stores','StoreController');
        Route::resource('products','ProductController');
        Route::resource('categories','CategoryController');

        Route::post('photos/remove/','ProductPhotoController@removePhoto')->name('photo.remove');
    });
    
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
