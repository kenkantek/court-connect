<?php
namespace App\Repositories\Eloquent\Auth;

use App\Models\Auth\User;
use App\Repositories\Interfaces\Auth\UserInterface;

class UserRepository implements UserInterface
{
    public function getDatatableData()
    {
        $users = User::select(['users.updated_at', 'users.id', 'username', 'first_name', 'last_name', 'email', 'phone'])->orderBy('users.id', 'DESC');

        $datatables = \Datatables::of($users)
            ->edit_column('username', function ($user) {
                return '<a class="ellipsis" href="#">' . $user->username . '</a>';
            })
            ->edit_column('phone', function ($user) {
                $temp = null;
                foreach ($user->roles()->get() as $role) {
                    $temp .= $role->label . ', ';
                }
                $temp = trim($temp, ', ');
                return $temp;
            })
            ->addColumn('operations', function ($user) {
                return '<a href="' . route('users.edit', $user->id) . '" class="btn btn-icon btn-primary tip" data-original-title="Edit"><i class="fa fa-edit"></i></a>&nbsp;'
                . '<a class="btn btn-icon btn-danger deleteDialog tip" data-toggle="modal" data-section="' . route('users.delete', $user->id) . '" role="button" data-original-title="Delete Entry" ><i class="fa fa-trash-o"></i></a>';
            })
            ->edit_column('first_name', function ($user) {
                return $user->getFullName();
            })
            ->remove_column('last_name')
            ->edit_column('updated_at', function ($user) {
                return '<input type="checkbox" class="checkboxes" name="id[]" value="' . $user->id . '"/>';
            });
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
