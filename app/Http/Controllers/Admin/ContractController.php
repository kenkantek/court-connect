<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateContractRequest;
use App\Models\Contract;
use App\Repositories\Interfaces\Admin\ContractInterface;

class ContractController extends Controller
{
 	public function __construct(ContractInterface $contractRepository)
    {
        $this->contractRepository = $contractRepository;
    }
  public function postCreateContract(CreateContractRequest $request)
    {
        $contract = new Contract;
        $contract->fill($request->input());
        $contract->save();

    }
    public function getListContract($club_id)
    {
        return Contract::where('club_id', $club_id)->orderBy('updated_at', 'desc')->paginate(50);
    }

}
