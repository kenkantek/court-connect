<?php
namespace App\Repositories\Interfaces\Auth;

use App\Models\Club;

interface ClubInterface
{
    public function getDatatableData();
    public function findById($id);
    public function delete($id);
    public function createOrUpdate(Club $club);
}
