<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function getRoles(Request $request)
    {
        return Role::select('id', 'name')
            ->search($request->search)
            ->orderBy('id', 'ASC')
            ->simplePaginate(50);
    }
}
