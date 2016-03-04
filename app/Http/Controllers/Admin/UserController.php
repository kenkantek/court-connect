<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\Auth\User;
use App\Repositories\Interfaces\Auth\UserInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function __construct(UserInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getDatatables()
    {
        return $this->userRepository->getDatatableData();
    }

    /**
     * Display all users
     *
     * @return Response
     */
    public function getList()
    {
        \Assets::addJavascript(['datatables', 'select2', 'uniform']);
        \Assets::addStylesheets(['datatables', 'select2', 'uniform']);
        \Assets::addAppModule(['datatables', 'user']);

        return view('admin.users.list');
    }

    public function getDelete($id)
    {
        if (\Auth::user()->id == $id) {
            return response()->json(['error' => true, 'message' => 'Can\'t delete this user. This user is logged on!']);
        }
        $response = $this->userRepository->delete($id);
        return response()->json([
            'error' => false, 'message' => 'Deleted user successfully!',
        ]);
    }
    public function postCreate(UserRequest $request)
    {
        $user = new User;
        $user->fill($request->all());
        $user = $this->userRepository->createOrUpdate($user);
        if ($request->input('is_admin') == '1') {
            $user->assignRole('admin', 'clubs', 1);
        } else {
            $user->assignRole('user', 'clubs', 1);
        }
        return response()->json([
            'error' => false, 'message' => 'User created successfully!',
        ]);
    }

    public function postEdit(Request $request)
    {
        $user = $this->userRepository->findById($request->input('id'));
        $user->fill($request->all());
        if ($request->input('password') != null && strlen($request->input('password')) > 8) {
            $user->password = bcrypt($request->input('password'));
        }
        $user = $this->userRepository->createOrUpdate($user);
        if ($request->input('is_admin') == '1' && !$user->hasRole('admin')) {
            $user->removeRole('user');
            $user->assignRole('admin', 'clubs', 1);
        }
        if ($request->input('is_admin') == null && !$user->hasRole('user')) {
            $user->removeRole('admin');
            $user->assignRole('user', 'clubs', 1);
        }
        return response()->json([
            'error' => false, 'message' => 'User updated successfully!',
        ]);
    }

}
