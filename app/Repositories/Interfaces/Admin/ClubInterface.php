<?php
namespace App\Repositories\Interfaces\Admin;

use App\Models\Contexts\Club;

interface ClubInterface
{
    public function getDatatableData();
    public function findById($id);
    public function delete($id);
    public function createOrUpdate(Club $club);
}
