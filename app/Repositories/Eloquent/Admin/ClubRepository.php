<?php
namespace App\Repositories\Eloquent\Admin;

use App\Models\Contexts\Club;
use App\Repositories\Interfaces\Admin\ClubInterface;

class ClubRepository implements ClubInterface
{
    public function getDatatableData()
    {
    }

    public function findById($id)
    {
        return Club::where('id', $id)->first();
    }

    public function delete($id)
    {

    }

    public function createOrUpdate(Club $court)
    {

    }
}
