<?php

namespace Modules\Core\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use Modules\Core\Entities\User;
use Modules\Core\Http\Requests\Admin\changePasswordRequest;

class ChangePasswordController extends Controller
{
    public function edit(User $user)
    {
        auth()->loginUsingId(1);
        $user = auth()->user();

        return view('core::admin.User.changePassword.edit',compact('user'));
    }

    public function store(changePasswordRequest $request)
    {
        $user = auth()->user();
        $user->update([
            'password' => bcrypt($request->input('new_password')),
        ]);

        message();
        return redirect()->route('core.web.admin.user.changePassword.edit');
    }
}
