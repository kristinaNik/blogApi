<?php
/**
 * Created by PhpStorm.
 * User: kristina
 * Date: 9/23/19
 * Time: 1:17 PM
 */

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\User;

class UserRepository implements UserRepositoryInterface
{


    /**
     * @param $searchParam
     * @return mixed
     */
    public function searchUsers($searchParam)
    {
       return User::where('name', 'LIKE', '%' . $searchParam . '%')
            ->orWhere('email', 'LIKE', '%' . $searchParam . '%')
            ->get();

    }

    /**
     * @return mixed
     */
    public function getUsers()
    {
       return User::orderBy('id', 'desc')->get();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        return User::with('roles')->findOrFail($id);
    }

    /**
     * @param $userData
     * @return User
     */
    public function store($userData)
    {
        $user = new User();
        $user->name = $userData->name;
        $user->email = $userData->email;
        $password =  $userData->password;
        if (!empty($password)) {
            $user->password = bcrypt($userData);
        }
        $user->remember_token = null;
        $save = $user->save();
        if ($save) {
            $role = $userData->role;
            $permissions = $userData->permissions;

            $user->roles()->attach($role);
            $user->attachPermissions($permissions);
            $user->save();
        }

        return $user;

    }

    /**
     * @param $userData
     * @param $id
     * @return mixed
     */
    public function update($userData, $id)
    {
        $user = User::findOrFail($id);

        $user->name = $userData->name;
        $user->email = $userData->email;

        if (!empty($userData->password)) {
            $user->password = bcrypt($userData->password);
        }
        $save = $user->save();

        if ($save) {
            $role = $userData->role;
            $permissions = $userData->permissions;

            $user->roles()->sync($role);
            $user->permissions()->sync($permissions);
            $user->save();
        }

        return $user;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return $user;
    }
}
