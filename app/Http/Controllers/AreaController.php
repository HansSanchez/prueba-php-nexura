<?php

namespace App\Http\Controllers;

use App\Models\Area;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    public function getAreas(Request $request)
    {
        return Area::select('id', 'name')
            ->search($request->search)
            ->orderBy('id', 'ASC')
            ->simplePaginate(50);
    }
}
