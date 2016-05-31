<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\Auth\RoleUser;
use App\Models\Auth\User;
use App\Repositories\Interfaces\Auth\UserInterface;
use Illuminate\Http\Request;
use Mockery\CountValidator\Exception;
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
        \Assets::addJavascript(['multiple-select']);
        \Assets::addStylesheets(['multiple-select']);
        \Assets::addAppModule(['app']);
        $title = 'User Manager';
        return view('admin.users.list', compact('title'));
    }

    public function getUsers(Request $request)
    {
        $take = $request->take ?: 10;
        $data = User::with('roles')->whereHas('roles', function($query) use ($request) {
            $query->where('context_id', $request->input('clubid'))
                ->where('role_id','<>',4);
        })->select("id", "first_name",'last_name' ,"email")->orderBy('updated_at','desc')->paginate($take);

        foreach($data as $user){
            if($user->hasRole('admin')){
                $user['is_admin'] = true;
            }
            else{
                $user['is_admin'] = false;
            }
            $arr_club = [];
            foreach ($user->roles as $role){
                $arr_club[] = $role->pivot->context_id;
            }
            $user['arr_club'] = $arr_club;
        }
        return $data;
    }

    public function getDelete(Request $request)
    {
        if (\Auth::user()->id == $request->id) {
            return response()->json(['error' => true, 'message' => 'Can\'t delete this user. This user is logged on!']);
        }
        $response = $this->userRepository->delete($request->id);
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
            foreach ($request->input('clubs') as $club_id)
                $user->assignRole('admin', 'clubs', $club_id);
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

        if ($request->input('is_admin') == 1) {
            $user->removeRole('user');
            $user->removeRole('admin');
            $clubs_id = array_unique($request->input('clubs'));
            foreach ($clubs_id as $club_id) {
                $user->assignRole('admin', 'clubs', $club_id);
            }
            //$user->assignRole('admin',$user->InfoClub['context'],$user->InfoClub['context_id']);
        }
        if ($request->input('is_admin') == 0 && !$user->hasRole('user')) {
            $user_infoClub = $user->InfoClub;
            $user->removeRole('admin');
            $user->assignRole('user',$user_infoClub['context'],$user_infoClub['context_id']);
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