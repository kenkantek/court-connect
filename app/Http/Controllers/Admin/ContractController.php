<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateContractRequest;
use App\Models\Contract;
use App\Repositories\Interfaces\Admin\ContractInterface;
use Illuminate\Http\Request;
class ContractController extends Controller
{
 	public function __construct(ContractInterface $contractRepository)
    {
        $this->contractRepository = $contractRepository;
    }
    public function postCreateContract(CreateContractRequest $request)
    {
        $contract = new Contract;
        // return $request->input();
        $contract->fill($request->input());
        $contract->save();

    }
    public function getListContract($club_id)
    {
        return Contract::where('club_id', $club_id)->orderBy('updated_at', 'desc')->paginate(50);
    }
    public function postUpdateContract(Request $request)
    {
        //return $request->input('id');
        $contract = Contract::findOrFail($request->input('id'));
        $contract->fill($request->input());
        $contract->save();
         return response([
            'success_msg' => 'Contact has been updated!',
        ]);
    }
    public function deleteContract(Request $request)
    {
        $nameContract = $request->input('name');
        $contract = Contract::find($request->input('id'))->delete();
        return response([
            'success_msg' => 'Contract ' . $nameContract . ' has been deleted',
        ]);
    }

}
