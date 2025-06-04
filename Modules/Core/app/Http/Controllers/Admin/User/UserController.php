<?php

namespace Modules\Core\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use Modules\Core\Entities\User;
use Modules\Core\Http\Requests\UserRequest;
use Modules\Core\Libraries\Class\StatisticsGenerator;

class UserController extends Controller
{
    public function index()
    {
        if (request()->has('page')) {
            $per_page = request()->input('per_page', 10);

            $list = User::search()->paginate($per_page);

            return response()->json($list);
        }

        $userStats = new StatisticsGenerator(User::class);
        $data['userChartWeek'] = $userStats->getLastWeekRecords();
        $data['userChartMonth'] = $userStats->getLastMonthRecords();
        $data['userChartYear'] = $userStats->getLastYearRecords();

        return view('core::admin.user.user.index',$data);
    }

    public function create( )
    {
        return view('core::admin.user.user.create');
    }

    public function store(UserRequest $request)
    {
        $data = $request->validated();
        $data['password'] = bcrypt($data['password']);
        $data['is_admin'] = $data['type'] == 'admin'? 1 : 0;

        User::create($data);
        message();
        return redirect()->route('core.web.admin.user.user.index');
    }

    public function show(User $user)
    {
        return view('core::admin.User.user.show',compact('user'));
    }

    public function edit(User $user)
    {
        return view('core::admin.user.user.edit',compact('user'));
    }

    public function update(UserRequest $request, User $user)
    {
        $data = $request->validated();
        if ($request->input('password')) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }

        $data['is_admin'] = $data['type'] == 'admin'? 1 : 0;
        $data['picture'] = pictureUpdate('picture', 'users/picture', $user->picture);

        if ($data['picture_remove']) {
            pictureDelete($user->picture);
            $data['picture'] = null;
        }
        $user->update($data);
        message();
        return redirect()->route('core.web.admin.user.user.edit', $user->id);
    }

    public function destroy($id)
    {
        return response()->json(1);
    }
}
