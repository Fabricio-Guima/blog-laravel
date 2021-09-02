<?php

use App\Models\Client;

Route::get('teste', function(){
    $client = Client::first();

    $token = $client->createToken('token-teste');

    dd($token->plainTextToken);
    
});

//ROTAS ADMIN DE PLANOS
Route::prefix('admin')
        ->namespace('Admin')
        ->middleware('auth')
        ->group(function(){

          

/**
     * Role x User
     */
Route::get('users/{id}/role/{idRole}/detach', 'ACL\RoleUserController@detachRoleUser')->name('users.role.detach');
Route::post('users/{id}/roles', 'ACL\RoleUserController@attachRolesUser')->name('users.roles.attach');
Route::any('users/{id}/roles/create', 'ACL\RoleUserController@rolesAvailable')->name('users.roles.available');
Route::get('users/{id}/roles', 'ACL\RoleUserController@roles')->name('users.roles');
Route::get('roles/{id}/users', 'ACL\RoleUserController@users')->name('roles.users');          


/**
* Permission x Role
*/
Route::get('roles/{id}/permission/{idPermission}/detach', 'ACL\PermissionRoleController@detachPermissionRole')->name('roles.permission.detach');
Route::post('roles/{id}/permissions', 'ACL\PermissionRoleController@attachPermissionsRole')->name('roles.permissions.attach');
Route::any('roles/{id}/permissions/create', 'ACL\PermissionRoleController@permissionsAvailable')->name('roles.permissions.available');
Route::get('roles/{id}/permissions', 'ACL\PermissionRoleController@permissions')->name('roles.permissions');
Route::get('permissions/{id}/role', 'ACL\PermissionRoleController@roles')->name('permissions.roles');
/**
     * Routes Roles
     */
Route::any('roles/search', 'ACL\RoleController@search')->name('roles.search');
Route::resource('roles', 'ACL\RoleController');
/**
     * Routes Tables
     */

Route::any('tenants/search', 'TenantController@search')->name('tenants.search');
Route::resource('tenants', 'TenantController');

/**
     * Routes Tables
     */
Route::get('tables/qrcode/{identify}', 'TableController@qrcode')->name('tables.qrcode');

Route::any('tables/search', 'TableController@search')->name('tables.search');
Route::resource('tables', 'TableController');                


/**
     * Product x Category
     */
    Route::get('products/{id}/category/{idCategory}/detach', 'CategoryProductController@detachCategoryProduct')->name('products.category.detach');
    Route::post('products/{id}/categories', 'CategoryProductController@attachCategoriesProduct')->name('products.categories.attach');
    Route::any('products/{id}/categories/create', 'CategoryProductController@categoriesAvailable')->name('products.categories.available');
    Route::get('products/{id}/categories', 'CategoryProductController@categories')->name('products.categories');
    Route::get('categories/{id}/products', 'CategoryProductController@products')->name('categories.products');





//rota de products 
Route::any('products/search', 'ProductController@search')->name('products.search');
Route::resource('products', 'ProductController');

//rota de categorias 
Route::any('categories/search', 'CategoryController@search')->name('categories.search');
Route::resource('categories', 'CategoryController');                  

                
//rota de users para o adm criar um user
Route::any('users/search', 'UserController@search')->name('users.search');
Route::resource('users', 'UserController');                 



//Plan x Profile

//vincular permissão a um perfil
Route::get('plans/{id}/profile/{idProfile}/detach', 'ACL\PlanProfileController@detachProfilePlan')->name('plans.profile.detach');

Route::post('plans/{id}/profiles', 'ACL\PlanProfileController@attachProfilesPlan')->name('plans.profiles.attach');


Route::any('plans/{id}/profiles/create', 'ACL\PlanProfileController@profilesAvailable')->name('plans.profiles.available');

Route::get('plans/{id}/profiles', 'ACL\PlanProfileController@profiles')->name('plans.profiles');

//listar todos os plans que tem x permissão
Route::get('profiles/{id}/plans', 'ACL\PlanProfileController@plans')->name('profiles.plans');





//Permission x Profile

//vincular permissão a um perfil
Route::get('profiles/{id}/permission/{idPermission}/detach', 'ACL\PermissionProfileController@detachPermissionsProfile')->name('profiles.permissions.detach');

Route::post('profiles/{id}/permissions', 'ACL\PermissionProfileController@attachPermissionsProfile')->name('profiles.permissions.attach');


Route::any('profiles/{id}/permissions/create', 'ACL\PermissionProfileController@permissionsAvailable')->name('profiles.permissions.available');

Route::get('profiles/{id}/permissions', 'ACL\PermissionProfileController@permissions')->name('profiles.permissions');

//listar todos os profiles que tem x permissão
Route::get('permissions/{id}/profile', 'ACL\PermissionProfileController@profiles')->name('permissions.profile');








//rota de Permissions (permissões)
Route::any('permissions/search', 'ACL\PermissionController@search')->name('permissions.search');
Route::resource('permissions', 'ACL\PermissionController');    



//rota de Profiles (perfis)
Route::any('profiles/search', 'ACL\ProfileController@search')->name('profiles.search');
Route::resource('profiles', 'ACL\ProfileController');


//rota de detalhes do plano
// create view
Route::get('plans/{url}/details/create', 'DetailPlanController@create')->name('details.plan.create');
//delete
Route::delete('plans/{urlPlan}/details/{idDetail}', 'DetailPlanController@destroy')->name('details.plan.destroy');
//show
Route::get('plans/{urlPlan}/details/{idDetail}', 'DetailPlanController@show')->name('details.plan.show');
//update
Route::put('plans/{urlPlan}/details/{idDetail}/update', 'DetailPlanController@update')->name('details.plan.update'); 
//edit view
Route::get('plans/{url}/details/{idDetail}/edit', 'DetailPlanController@edit')->name('details.plan.edit');    
//store 
Route::post('plans/{url}/details', 'DetailPlanController@store')->name('details.plan.store');

//index todos os detalhes de um plano x
Route::get('plans/{url}/details', 'DetailPlanController@index')->name('details.plan.index');


            //Rotas de plano 
Route::get('plans/create', 'PlanController@create')->name('plans.create');
Route::put('plans/{url}', 'PlanController@update')->name('plans.update');
Route::get('plans/edit/{url}', 'PlanController@edit')->name('plans.edit');
Route::any('plans/search', 'PlanController@search')->name('plans.search');
Route::delete('plans/{url}', 'PlanController@destroy')->name('plans.destroy');
Route::get('plans/{url}', 'PlanController@show')->name('plans.show');
Route::post('plans', 'PlanController@store')->name('plans.store');
Route::get('plans', 'PlanController@index')->name('plans.index');



Route::get('/', 'PlanController@index')->name('admin.index');
});

// Site
// rota de planos para a empresa escolher
Route::get('/plan/{url}', 'Site\SiteController@plan')->name('plan.subscription');


Route::get('/', 'Site\SiteController@index')->name('site.home');

//autenticação
// posso desabilitar o registro, por exemplo. Auth::routes(['register' => false]);
Auth::routes();


