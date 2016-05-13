<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\Auth\RoleUser;
use App\Models\Auth\User;
use App\Repositories\Interfaces\Auth\UserInterface;
use Illuminate\Http\Request;
use Validator;

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
        $title = 'User Manager';
        return view('admin.users.list', compact('title'));
    }

    public function getUsers(Request $request)
    {
        $take = $request->take ?: 10;
        $data = User::with('roles')->whereHas('roles', function($query) use ($request) {
            $query->where('context_id', $request->clubid);
        })->select("id", "first_name",'last_name' ,"email")->orderBy('created_at','desc')->paginate($take);
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
        $v = Validator::make($request->all(), [
            'first_name' => 'required|max:60',
            'last_name' => 'required|max:60',
            'email' => 'email|required|max:60|min:6|unique:users',
            'password' => 'required|min:8',

        ]);
        if($v->fails())
        {
            return response()->json(['error' => true,"messages"=>$v->errors()->all()]);
        }

        $user = new User;
        $request['password'] = bcrypt($request['password']);
        $user->fill($request->all());
        $user = $this->userRepository->createOrUpdate($user);
        if ($request->input('is_admin') == '1') {
            $user->assignRole('admin', 'clubs', $request->input('club_id'));
        } else {
            $user->assignRole('user', 'clubs', $request->input('club_id'));
        }
        return response()->json([
            'error' => false, 'success' => 'User created successfully!',
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

        if ($request->input('is_admin') == 1 && !$user->hasRole('admin')) {
            $user->removeRole('user');
            $user->assignRole('admin',$user->InfoClub['context'],$user->InfoClub['context_id']);
        }
        if ($request->input('is_admin') == 0 && !$user->hasRole('user')) {
            $user->removeRole('admin');
            $user->assignRole('user',$user->InfoClub['context'],$user->InfoClub['context_id']);
        }
        return response()->json([
            'error' => false,
            'success' => 'User updated successfully!',
            'user' => $user,
        ]);
    }
    public function postUpdateCourt(UpdateCourtRequest $request)
    {
        $court = Court::find($request->input('id'));
        $court->fill($request->all());
        $court->save();
        $rate = CourtRate::where('court_id', $request->input('id'))->delete();
        $inputRates = $request->input('dataRates');
        $this->updateTableRates($court, $inputRates);
        return response([
            'success_msg' => 'Court has been updated!',
            'court' => $court,
        ]);
    }

}