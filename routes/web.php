<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/user', [UserController::class, 'index']);

Route::post('/submit', [UserController::class, 'submitForm']);

Route::get('/test', function () {
    return 'Laravel Minggu-5 berhasil!';
});

use App\Http\Controllers\QueryBuilderController;

Route::get('/query-builder/insert', [QueryBuilderController::class, 'insert']);

Route::get('/query-builder/insert-get-id', [QueryBuilderController::class, 'insertGetId']);

Route::get('/query-builder/get', [QueryBuilderController::class, 'get']);

Route::get('/query-builder/find-user', [QueryBuilderController::class, 'findUser']);

Route::get('/query-builder/select', [QueryBuilderController::class, 'select']);

Route::get('/query-builder/multiple-where', [QueryBuilderController::class, 'multipleWhere']);

Route::get('/query-builder/adult-users', [QueryBuilderController::class, 'adultUsers']);

Route::get('/query-builder/update', [QueryBuilderController::class, 'update']);

Route::get('/query-builder/increment', [QueryBuilderController::class, 'increment']);

Route::get('/query-builder/decrement', [QueryBuilderController::class, 'decrement']);

Route::get('/query-builder/delete', [QueryBuilderController::class, 'delete']);

Route::get('/query-builder/pluck-name', [QueryBuilderController::class, 'pluckName']);

Route::get('/query-builder/pluck-name-email', [QueryBuilderController::class, 'pluckNameEmail']);

Route::get('/query-builder/count-users', [QueryBuilderController::class, 'countUsers']);

Route::get('/query-builder/sum-points', [QueryBuilderController::class, 'sumPoints']);

Route::get('/query-builder/avg-age', [QueryBuilderController::class, 'avgAge']);

Route::get('/query-builder/max-age', [QueryBuilderController::class, 'maxAge']);

Route::get('/query-builder/min-age', [QueryBuilderController::class, 'minAge']);

Route::get('/query-builder/join', [QueryBuilderController::class, 'join']);

Route::get('/query-builder/left-join', [QueryBuilderController::class, 'leftJoin']);

Route::get('/query-builder/order-by', [QueryBuilderController::class, 'orderBy']);

Route::get('/query-builder/limit', [QueryBuilderController::class, 'limit']);

Route::get('/query-builder/offset', [QueryBuilderController::class, 'offset']);

Route::get('/query-builder/subquery', [QueryBuilderController::class, 'subquery']);

Route::get('/query-builder/select-raw', [QueryBuilderController::class, 'selectRaw']);

Route::get('/query-builder/where-raw', [QueryBuilderController::class, 'whereRaw']);


use App\Http\Controllers\EloquentController;

Route::get('/eloquent/create', [EloquentController::class, 'create']);

Route::get('/eloquent/save', [EloquentController::class, 'save']);

Route::get('/eloquent/all', [EloquentController::class, 'all']);

Route::get('/eloquent/find', [EloquentController::class, 'find']);

Route::get('/eloquent/where', [EloquentController::class, 'where']);

Route::get('/eloquent/first-or-fail', [EloquentController::class, 'firstOrFail']);

Route::get('/eloquent/update', [EloquentController::class, 'update']);

Route::get('/eloquent/save-update', [EloquentController::class, 'saveUpdate']);

Route::get('/eloquent/delete', [EloquentController::class, 'delete']);

Route::get('/eloquent/destroy', [EloquentController::class, 'destroy']);

Route::get('/eloquent/where-status', [EloquentController::class, 'whereStatus']);

Route::get('/eloquent/or-where', [EloquentController::class, 'orWhere']);

Route::get('/eloquent/where-between', [EloquentController::class, 'whereBetween']);

Route::get('/eloquent/where-in', [EloquentController::class, 'whereIn']);

Route::get('/eloquent/where-null', [EloquentController::class, 'whereNull']);

Route::get('/eloquent/where-not-null', [EloquentController::class, 'whereNotNull']);

Route::get('/eloquent/when-condition', [EloquentController::class, 'whenCondition']);

use App\Models\User;

Route::get('/eloquent/one-to-one', function () {
    $user = User::first();

    return $user->profile;
});

Route::get('/eloquent/one-to-many', function () {
    $user = User::first();

    return $user->posts;
});

Route::get('/eloquent/many-to-many', function () {
    $user = User::first();

    return $user->roles;
});

Route::get('/eloquent/mutator', function () {
    $user = new \App\Models\User();

    $user->name = 'Zalifa Naila Salsabila';
    $user->email = 'naila.salsabila@example.com';
    $user->password = 'password123';

    $user->save();

    return $user;
});

Route::get('/eloquent/accessor', function () {
    $user = User::where('email', 'naila.salsabila@example.com')->first();

    return [
        'name_dari_database' => $user->name,
        'display_name' => $user->display_name,
    ];
});

Route::get('/eloquent/soft-delete', function () {
    $user = User::first();

    return [
        'nama' => $user->name,
        'soft_delete_aktif' => in_array(
            \Illuminate\Database\Eloquent\SoftDeletes::class,
            class_uses_recursive(User::class)
        )
    ];
});

Route::get('/eloquent/soft-delete-action', function () {
    $user = User::first();

    $user->delete();

    return [
        'message' => 'User berhasil di-soft delete.',
        'deleted_at' => $user->deleted_at,
    ];
});

Route::get('/eloquent/with-trashed', function () {
    return User::withTrashed()->get();
});

Route::get('/eloquent/only-trashed', function () {
    return User::onlyTrashed()->get();
});

Route::get('/eloquent/restore', function () {
    $user = User::onlyTrashed()->first();

    if ($user) {
        $user->restore();

        return [
            'message' => 'User berhasil direstore.',
            'deleted_at' => $user->deleted_at,
        ];
    }

    return 'Tidak ada user yang di-soft delete.';
});

Route::get('/eloquent/fillable', function () {
    $user = User::create([
        'name' => 'Naila Fillable',
        'email' => 'naila.fillable@example.com',
        'password' => 'password123',
    ]);

    return $user;
});

Route::get('/eloquent/guarded', function () {
    $user = User::create([
        'name' => 'Naila Guarded',
        'email' => 'naila.guarded@example.com',
        'password' => 'password123',
    ]);

    return $user;
});

Route::get('/eloquent/active', function () {
    $activeUsers = User::active()->get();

    return $activeUsers;
});