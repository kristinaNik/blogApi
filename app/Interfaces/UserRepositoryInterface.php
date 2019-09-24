<?php
/**
 * Created by PhpStorm.
 * User: kristina
 * Date: 9/24/19
 * Time: 11:33 AM
 */

namespace App\Interfaces;


interface UserRepositoryInterface
{
    public function searchUsers($searchParam);

    public function getUsers();

    public function show($id);

    public function store($userData);

    public function update($userData, $id);

    public function destroy($id);
}