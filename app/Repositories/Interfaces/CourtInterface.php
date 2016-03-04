<?php
namespace App\Repositories\Interfaces\Auth;

use App\Models\Court;

interface CourtInterface
{
    public function getDatatableData();
    public function findById($id);
    public function delete($id);
    public function createOrUpdate(Court $court);
}
