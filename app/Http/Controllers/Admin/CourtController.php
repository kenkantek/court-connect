<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\Admin\CourtInterface;

class CourtController extends Controller
{
    public function __construct(CourtInterface $courtRepository)
    {
        $this->courtRepository = $courtRepository;
    }
    public function getList($clubId)
    {
        # code...
    }
}
