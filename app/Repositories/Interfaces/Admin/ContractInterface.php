<?php
namespace App\Repositories\Interfaces\Admin;

use App\Models\Contract;

interface ContractInterface
{
    public function getDatatableData();
    public function findById($id);
    public function delete($id);
    public function createOrUpdate(Contract $club);
}
