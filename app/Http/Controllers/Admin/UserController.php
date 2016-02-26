<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\Auth\UserInterface;
use App\Models\Auth\User;
use App\Http\Requests\ActionRequest;

class UserController extends Controller
{

    public function __construct (UserInterface $userRepository)
    {
        $this->userRepository  = $userRepository;
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

    public function getDeleteMany(ActionRequest $request)
    {
        $ids = $request->input('ids');
        if (empty($ids)) {
            return response()->json(['error' => true, 'message' => 'Please select record to take action!']);
        }

        if ($request->input('action') == 'delete') {
            foreach ($ids as $id) {
                if (\Auth::user()->id == $id) {
                    return response()->json(['error' => true, 'message' => 'Can\'t delete this user. This user is logged on!']);
                }
                $response = $this->userRepository->delete($id);
            }
            return response()->json($response, $response['response_code']);
        }
    }

    public function getCreate()
    {
        return view('admin.users.create');
    }

}
