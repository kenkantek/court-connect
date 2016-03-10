<?php
namespace App\Repositories\Interfaces\Admin;

use App\Models\Contexts\Court;

interface CourtInterface
{
    public function getDatatableData();
    public function findById($id);
    public function delete($id);
    public function createOrUpdate(Court $court);
}
