<?php
namespace App\Repositories\Eloquent\Auth;

use App\Models\Auth\User;
use App\Repositories\Interfaces\Auth\UserInterface;

class UserRepository implements UserInterface
{
    public function getDatatableData()
    {
        $users = User::select(['updated_at', 'id', 'username', 'first_name', 'last_name', 'email', 'created_at']);

        $datatables = \Datatables::of($users)
            ->edit_column('username', function ($user) {
                return '<a class="ellipsis" href="#">' . $user->username . '</a>';
            })
            ->addColumn('operations', function ($user) {
                return '<a href="" class="btn btn-icon btn-primary tip" data-original-title="Edit"><i class="fa fa-edit"></i></a>&nbsp;'
                . '<a class="btn btn-icon btn-danger deleteDialog tip" data-toggle="modal" data-section="' . route('users.delete', $user->id) . '" role="button" data-original-title="Delete Entry" ><i class="fa fa-trash-o"></i></a>';
            })
            ->edit_column('first_name', function ($user) {
                return $user->getFullName();
            })
            ->remove_column('last_name')
            ->edit_column('updated_at', function ($user) {
                return '<input type="checkbox" class="checkboxes" name="id[]" value="' . $user->id .'"/>';
            })
            ->edit_column('created_at', function ($user) {
                return date_from_database($user->created_at, 'd-m-Y');
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
