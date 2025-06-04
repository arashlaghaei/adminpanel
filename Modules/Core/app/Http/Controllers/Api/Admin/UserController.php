<?php

namespace Modules\Core\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product\Product;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $list = User::search()->latest('id')->paginate();

        return response()->json($list);
    }

    public function show($id)
    {
        $show = User::findOrFail($id);

        return response()->json($show);
    }
}
