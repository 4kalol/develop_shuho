<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\UnitUser;
use App\Models\GroupUser;
use App\Models\Group;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admins'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $this->RegisterRelatedData($user);

        event(new Registered($user));

        Auth::guard('admins')->login($user);

        // return redirect(RouteServiceProvider::ADMIN_HOME);
        return redirect()->to('/admin/shuhos/index');
    }

    public function RegisterRelatedData($adminData)
    {
        // unit_usersテーブルへの反映.
        $unitUser = UnitUser::create([
            'users_id' => null,
            'admins_id' => $adminData->id,
        ]);

        // groupsテーブルへの反映.
        $group = Group::create([
            'name' => '',
        ]);

        // group_userテーブルへの反映.
        $groupUser = GroupUser::create([
            'user_id' => $unitUser->id,
            'group_id' => $group->id,
        ]);
    }
}
