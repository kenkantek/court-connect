<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\Auth\User;
use App\Repositories\Interfaces\Auth\UserInterface;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

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
        \Assets::addAppModule(['datatables']);

        return view('admin.users.list');
    }

    public function getDelete($id)
    {
        if (\Auth::user()->id == $id) {
            return response()->json(['error' => true, 'message' => 'Can\'t delete this user. This user is logged on!']);
        }
        $response = $this->userRepository->delete($id);
        return response()->json($response, $response['response_code']);
    }

    public function postDeleteMany(Request $request)
    {
        $ids = $request->input('ids');
        if (empty($ids)) {
            return response()->json(['error' => true, 'message' => 'Please select at least one record to delete!']);
        }

        foreach ($ids as $id) {
            if (\Auth::user()->id == $id) {
                return response()->json(['error' => true, 'message' => 'Can\'t delete this user. This user is logged on!']);
            }
            $response = $this->userRepository->delete($id);
        }
        return response()->json($response, $response['response_code']);
    }

    public function getCreate()
    {
        \Assets::addJavascript(['bootstrap-fileinput']);
        \Assets::addStylesheets(['bootstrap-fileinput']);
        \Assets::addAppModule(['avatar']);
        return view('admin.users.create');
    }
    public function postCreate(UserRequest $request)
    {
        $user = new User;
        $user->fill($request->all());
        $user = $this->userRepository->createOrUpdate($user);
        $destinationPath = 'uploads/images/users/';
        if ($request->hasFile('avatar')) {
            $img_avatar = $request->file('avatar');
            $avatarName_db = $destinationPath . $request->input('username') . '.' . $img_avatar->getClientOriginalExtension();
            Image::make($img_avatar)->resize(200, 200)->save($avatarName_db);
            $user->avatar = $avatarName_db;
            $user->save();
        }
        $user->assignRole($request->input('role'), 'clubs', 1);
        return redirect()->route('users.list')->with('success_msg', 'User created successfully!');
    }
    public function getEdit($id)
    {
        \Assets::addJavascript(['bootstrap-fileinput']);
        \Assets::addStylesheets(['bootstrap-fileinput']);
        \Assets::addAppModule(['avatar']);
        $user = $this->userRepository->findById($id);
        return view('admin.users.edit', compact('user'));
    }
    public function postEdit(Request $request, $id)
    {
        $user = $this->userRepository->findById($id);
        $user->fill($request->all());
        $user->id = $id;
        $user = $this->userRepository->createOrUpdate($user);
        $destinationPath = 'uploads/images/users/';
        if ($request->hasFile('avatar')) {
            $img_avatar = $request->file('avatar');
            $avatarName_db = $destinationPath . $request->input('username') . '.' . $img_avatar->getClientOriginalExtension();
            Image::make($img_avatar)->resize(200, 200)->save($avatarName_db);
            $user->avatar = $avatarName_db;
            $user->save();
        }
        if (!$user->hasRole($request->input('role'))) {
            $user->assignRole($request->input('role'), 'clubs', 1);
        }

        return redirect()->route('users.list')->with('success_msg', 'User updated successfully!');
    }

}
