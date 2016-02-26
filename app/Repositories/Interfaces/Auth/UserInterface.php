<?php
namespace App\Repositories\Interfaces\Auth;

use App\Models\Auth\User;

interface UserInterface
{
    public function getDatatableData();
    public function findById($id);
    public function delete($id);
    public function createOrUpdate(User $user);
}
