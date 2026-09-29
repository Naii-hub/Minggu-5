<?php

namespace App\Http\Controllers;

use App\Models\User;

class EloquentController extends Controller
{
    public function create()
    {
        User::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => bcrypt('password')
        ]);

        return 'Data John Doe berhasil ditambahkan.';
    }

    public function save()
    {
        $user = new User;

        $user->name = 'Naila';
        $user->email = 'naila@example.com';
        $user->password = bcrypt('password');

        $user->save();

        return 'Data Naila berhasil ditambahkan.';
    }

    public function all()
    {
        $users = User::all();

        return $users;
    }

    public function find()
    {
        $user = User::find(5);

        return $user;
    }

    public function where()
    {
        $users = User::where('email', 'john@example.com')->get();

        return $users;
    }

    public function firstOrFail()
    {
        $user = User::where('email', 'john@example.com')->firstOrFail();

        return $user;
    }

    public function update()
    {
        User::where('email', 'john@example.com')
            ->update([
                'name' => 'John Updated'
            ]);

        return 'Data berhasil diperbarui.';
    }

    public function saveUpdate()
    {
        $user = User::find(5);

        $user->name = 'Naila Updated';
        $user->save();

        return 'Data berhasil diperbarui dengan save().';
    }

    public function delete()
    {
        $user = User::find(3);
        $user->delete();

        return 'Data berhasil dihapus.';
    }

    public function destroy()
    {
        User::destroy(3);

        return 'Data berhasil dihapus dengan destroy().';
    }

    public function whereStatus()
    {
        $users = User::where('status', 'active')->get();

        return $users;
    }

    public function orWhere()
    {
        $users = User::where('status', 'active')
            ->orWhere('role', 'admin')
            ->get();

        return $users;
    }

    public function whereBetween()
    {
        $users = User::whereBetween('age', [18, 30])->get();

        return $users;
    }

    public function whereIn()
    {
        $users = User::whereIn('role', ['admin', 'editor'])->get();

        return $users;
    }

    public function whereNull()
    {
        $users = User::whereNull('deleted_at')->get();

        return $users;
    }

    public function whereNotNull()
    {
        $users = User::whereNotNull('email_verified_at')->get();

        return $users;
    }

    public function whenCondition()
    {
        $role = 'admin';

        $users = User::when($role, function ($query, $role) {
            return $query->where('role', $role);
        })->get();

        return $users;
    }
}