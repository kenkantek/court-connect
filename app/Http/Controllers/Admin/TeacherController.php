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

class TeacherController extends Controller
{

    public function __construct(UserInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getList()
    {
        $title = 'Teacher Manager';
        return view('admin.users.list-teacher', compact('title'));
    }

    public function getTeachers(Request $request)
    {
        $take = $request->take ?: 10;
        $data = User::with('teacher','roles')->whereHas('roles', function($query) use ($request) {
            $query->where('context_id', $request->clubid)->where('role_id',4);
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

    public function getListForBooking($club_id = 1)
    {
        $teachers = User::with('teacher')->whereHas('roles', function($query) use ($club_id) {
            $query->where('context_id', $club_id)->where('role_id', 4);
        })->get();
        return response()->json([
            'error' => false,
            'data' => $teachers
        ]);
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
    public function postCreate(Request $request)
    {
        // $user = User::with('teacher')->where('id',1)->first();
        // return $user;
        $v = Validator::make($request->all(), [
            'first_name' => 'required|max:60',
            'last_name' => 'required|max:60',
            'email' => 'email|required|max:60|min:6|unique:users',
            'password' => 'required|min:8',
            'rate' => 'required|numeric',
            'club_id' => 'required|integer',
        ]);

        if($v->fails())
        {
            return response()->json(['error' => true,"messages"=>$v->errors()->all()]);
        }
        $user = new User;
        $user->fill($request->all());
        $user = $this->userRepository->createOrUpdate($user);
        $user->assignRole('teacher', 'clubs', $request->input('club_id'));
       
        $teacher = new Teacher;
        $teacher->club_id = $request->input('club_id');
        $teacher->rate = $request->input('rate');
        $teacher->user()->associate($user);
        $teacher->save();
        return response()->json([
            'error' => false, 'success' => 'Teacher created successfully!',
        ]);

    }

    public function postEdit(Request $request)
    {
        $v = Validator::make($request->all(), [
            'fullname' => 'required|max:60',
            'email' => 'email|required|max:60|min:6',
            'password' => 'required|min:8',
        ]);

        if($v->fails())
        {
            return response()->json(['error' => true,"messages"=>$v->errors()->all()]);
        }
        $user = $this->userRepository->findById($request->input('id'));
        if(!isset($user))
            return response()->json(['error' => true,"messages"=>['Data invalid']]);
        $tmp_err = null;
        if($user['email'] != $request->input('email')){
            $tmp = User::whereEmail($request->input('email'))->first();
            if(isset($tmp)){
                $tmp_err = "The email has already been taken.";
            }

        }
        if(!is_null($tmp_err)){
            return response()->json(['error' => true,"messages"=>[$tmp_err]]);
        }

        $user->fill($request->all());
        $user->password = bcrypt($request->input('password'));
        $user = $this->userRepository->createOrUpdate($user);

        $teacher = Teacher::where('user_id',$user['id'])->first();
        $teacher->rate = $request->input('rate');
        $teacher->update();

        return response()->json([
            'error' => false,
            'success' => 'User updated successfully!',
            'user' => $user,
        ]);
    }



}
