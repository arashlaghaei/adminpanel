<?php

namespace Modules\Core\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use Modules\Core\Entities\User;
use Modules\Core\Http\Requests\Admin\ProfileRequest;

class ProfileController extends Controller
{
    public function edit(User $user)
    {
        auth()->loginUsingId(1);
        $user = auth()->user();

        return view('core::admin.User.Profile.edit',compact('user'));
    }

    public function update(ProfileRequest $request, User $user)
    {
        $data = $request->validated();
        $data['picture'] = pictureUpdate('picture', 'users/picture', $user->picture);

        if ($data['picture_remove']) {
            pictureDelete($user->picture);
            $data['picture'] = null;
        }
        $user->update($data);
        message();
        return redirect()->route('core.web.admin.user.profile.edit');
    }
}
