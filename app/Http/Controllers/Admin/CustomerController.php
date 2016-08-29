<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\Auth\RoleUser;
use App\Models\Auth\User;
use App\Models\Teacher;
use App\Repositories\Interfaces\Auth\UserInterface;
use Illuminate\Http\Request;
use Validator;

class CustomerController extends Controller
{

    public function __construct(UserInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getList()
    {
        $title = 'Manage Customer';
        return view('admin.users.list-customer', compact('title'));
    }

    public function getCustomers(Request $request)
    {
        $take = $request->take ?: 10;
        $data = User::with('teacher','roles')->whereHas('roles', function($query) use ($request) {
            $query->where('role_id',3);
        })->orderBy('created_at','desc')->paginate($take);
        foreach($data as $user){
            if($user->hasRole('admin')){
                $user['is_admin'] = true;
            }
            else{
                $user['is_admin'] = false;
            }
        }
        return $data;
    }
}
