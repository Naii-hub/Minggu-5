<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class QueryBuilderController extends Controller
{
    public function insert()
    {
        DB::table('users')->insert([
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'password' => bcrypt('password123')
        ]);

        return 'Data John Doe berhasil ditambahkan.';
    }

    public function insertGetId()
    {
        $id = DB::table('users')->insertGetId([
            'name' => 'Jane Doe',
            'email' => 'janedoe@example.com',
            'password' => bcrypt('password123')
        ]);

        return 'Data Jane Doe berhasil ditambahkan dengan ID: ' . $id;
    }

    public function get()
    {
        $users = DB::table('users')->get();

        return $users;
    }

    public function findUser()
    {
        $user = DB::table('users')
        ->where('email', 'johndoe@example.com')
        ->first();

        return $user;
    }

    public function select()
    {
        $users = DB::table('users')
        ->select('id', 'name')
        ->get();

        return $users;
    }

    public function multipleWhere()
    {
        $users = DB::table('users')
        ->where('status', 'active')
        ->where('role', 'admin')
        ->get();

         return $users;
    }

    public function adultUsers()
    {
        $users = DB::table('users')
        ->where('age', '>=', 18)
        ->get();

        return $users;
    }

    public function update()
    {
        DB::table('users')
        ->where('email', 'johndoe@example.com')
        ->update([
            'status' => 'inactive'
        ]);

        return 'Data berhasil diperbarui.';
    }

    public function increment()
    {
        DB::table('users')
        ->where('id', 1)
        ->increment('points', 10);

        return 'Points berhasil ditambahkan.';
    }

    public function decrement()
    {
         DB::table('users')
        ->where('id', 1)
        ->decrement('points', 5);

        return 'Points berhasil dikurangi.';
    }

    public function delete()
    {
        DB::table('users')
            ->where('email', 'johndoe@example.com')
            ->delete();

        return 'Data berhasil dihapus.';
    }

    public function pluckName()
    {
        $names = DB::table('users')->pluck('name');

        return $names;
    }

    public function pluckNameEmail()
    {
        $users = DB::table('users')->pluck('name', 'email');

        return $users;
    }

    public function countUsers()
    {
        $totalUsers = DB::table('users')->count();

        return 'Jumlah users: ' . $totalUsers;
    }

    public function sumPoints()
    {
        $totalPoints = DB::table('users')->sum('points');

        return 'Total points: ' . $totalPoints;
    }

    public function avgAge()
    {
        $averageAge = DB::table('users')->avg('age');

        return 'Rata-rata usia: ' . $averageAge;
    }

    public function maxAge()
    {
        $maxAge = DB::table('users')->max('age');

        return 'Usia tertinggi: ' . $maxAge;
    }

    public function minAge()
    {
        $minAge = DB::table('users')->min('age');

        return 'Usia terendah: ' . $minAge;
    }

    public function join()
    {
        $users = DB::table('users')
            ->join('orders', 'users.id', '=', 'orders.user_id')
            ->select('users.name', 'orders.total_price')
            ->get();

        return $users;
    }

    public function leftJoin()
    {
        $users = DB::table('users')
            ->leftJoin('orders', 'users.id', '=', 'orders.user_id')
            ->get();

        return $users;
    }

    public function orderBy()
    {
        $users = DB::table('users')
            ->orderBy('name', 'asc')
            ->get();

        return $users;
    }

    public function limit()
    {
        $users = DB::table('users')
            ->limit(10)
            ->get();

        return $users;
    }

    public function offset()
    {
    $users = DB::table('users')
        ->offset(10)
        ->limit(10)
        ->get();

    return $users;
    }

    public function subquery()
    {
        $users = DB::table('users')
            ->select('name')
            ->selectSub(function ($query) {
                $query->from('orders')
                    ->selectRaw('count(*)')
                    ->whereColumn('orders.user_id', 'users.id');
            }, 'order_count')
            ->get();

        return $users;
    }

    public function selectRaw()
    {
    $users = DB::table('users')
        ->selectRaw('COUNT(*) as total_users, status')
        ->groupBy('status')
        ->get();

    return $users;
    }

    public function whereRaw()
    {
        $users = DB::table('users')
            ->whereRaw('age > ? AND status = ?', [18, 'active'])
            ->get();

    return $users;
    }
}