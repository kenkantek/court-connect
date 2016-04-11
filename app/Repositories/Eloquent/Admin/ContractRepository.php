<?php
namespace App\Repositories\Eloquent\Admin;

use App\Models\Contract;
use App\Repositories\Interfaces\Admin\ContractInterface;

class ContractRepository implements ContractInterface
{
    public function getDatatableData()
    {
    }

    public function findById($id)
    {
        return Contract::where('id', $id)->first();
    }

    public function delete($id)
    {

    }

    public function createOrUpdate(Contract $court)
    {

    }
}
