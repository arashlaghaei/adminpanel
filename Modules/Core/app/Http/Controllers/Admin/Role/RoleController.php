<?php

namespace Modules\Core\Http\Controllers\Admin\Role;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Core\Entities\Permission;
use Modules\Core\Entities\Role;
use Modules\Core\Entities\User;
use Modules\Core\Http\Requests\UserRequest;
use Modules\Core\Libraries\Class\StatisticsGenerator;

class RoleController extends Controller
{
    public function index()
    {
        if (request()->has('page')) {
            $per_page = request()->input('per_page', 10);

            $list = Role::search()->withCount('permissions')->paginate($per_page);

            return response()->json($list);
        }

        $userStats = new StatisticsGenerator(Role::class);
        $data['chartWeek'] = $userStats->getLastWeekRecords();
        $data['chartMonth'] = $userStats->getLastMonthRecords();
        $data['chartYear'] = $userStats->getLastYearRecords();

        return view('core::admin.Role.index', $data);
    }

    public function create()
    {
        $permissions = Permission::all();

        return view('core::admin.role.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $Role = Role::create([
            'name' => $request->input('name'),
            'label' => $request->input('name'),
        ]);
        $Role->permissions()->attach($request->input('permissions'));

        message();
        return redirect()->route('core.web.admin.role.role.index');
    }

    public function show(Role $role)
    {
        return view('core::admin.Role.show', compact('role'));
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all();
        $users = $role->user;

        return view('core::admin.Role.edit', compact('role','permissions','users'));
    }

    public function update(Request $request, Role $role)
    {
        $role->permissions()->sync($request->input('permissions'));

        message();
        return redirect()->route('core.web.admin.role.role.edit', $role->id);
    }

    public function destroy($id)
    {
        return response()->json(1);
    }
}
