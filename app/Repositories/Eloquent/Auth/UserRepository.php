<?php
namespace App\Repositories\Eloquent\Auth;

use App\Models\Auth\User;
use App\Repositories\Interfaces\Auth\UserInterface;

class UserRepository implements UserInterface
{
    public function getDatatableData()
    {
        $users = User::select(['id', 'fullname', 'email'])->orderBy('users.id', 'DESC');

        $datatables = \Datatables::of($users)
            ->editColumn('email', function ($user) {
                return '<span class="hidden-id" data-id="' . $user->id . '">' . $user->email . '</span>';
            })
            ->addColumn('Is Admin?', function ($user) {
                $temp = 'No';
                if ($user->hasRole('admin')) {
                    $temp = 'Yes';
                }
                return $temp;
            })
            ->removeColumn('id');

        return $datatables->make();
    }

    public function findById($id)
    {
        return User::where('id', $id)->first();
    }

    public function delete($id)
    {
        try {
            $user = $this->findById($id);

            $user->delete();
        } catch (\Exception $e) {
            return ['error' => true, 'message' => 'User could not be deleted', 'response_code' => 500];
        }
        return ['error' => false, 'message' => 'User deleted', 'response_code' => 200];
    }

    public function createOrUpdate(User $user)
    {
        if ($user === null) {
            return null;
        }

        $user->save();

        return $user;
    }
}
