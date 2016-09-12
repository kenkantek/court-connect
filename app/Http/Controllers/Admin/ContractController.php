<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateContractRequest;
use App\Models\Contract;
use App\Models\SetOpenDay;
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
        $contracts = Contract::where('club_id', $club_id)->orderBy('updated_at', 'desc')->paginate(50);
        foreach ($contracts as $contract){
            $contract->daysOfWeek = getTotalWeekFromPeriod(strtotime($contract->start_date), strtotime($contract->end_date) , $club_id);
        }
        return $contracts;
    }



    public function getList(Request $request)
    {
        $contracts = Contract::where(['club_id' => $request->input('club_id'), 'is_member' => $request->input('member')])
            ->orderBy('updated_at', 'desc')->get(['id','start_date','end_date','is_member','total_week']);
        foreach ($contracts as $contract){
            $contract->daysOfWeek = getTotalWeekFromPeriod(strtotime($contract->start_date), strtotime($contract->end_date) , $request->input('club_id'));
        }
        return response([
            'data' => $contracts,
        ]);
    }

    public function getView($contract_id)
    {
        $contract = Contract::where('id',$contract_id)->select(['id','start_date','end_date','is_member','total_week','extras'])->first();
        if(isset($contract['id'])){
            return response([
                'error' => false,
                'data' => $contract,
            ]);
        }else{
            return response([
                'error' => true,
                'messages' =>['Data invalid']
            ]);
        }
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
