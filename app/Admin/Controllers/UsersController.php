<?php

namespace App\Admin\Controllers;

use App\Admin\Requests\StoreUserRequest;
use App\Admin\Requests\UpdateUserRequest;
use App\Admin\ViewModels\UserAdminEditViewModel;
use App\Admin\ViewModels\UserAdminIndexViewModel;
use App\Admin\ViewModels\UserEditViewModel;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Admin/Users/Index', new UserAdminIndexViewModel());
    }

    public function create(): Response
    {
        return Inertia::render('Admin/Users/Create');
    }

    public function store(StoreUserRequest $request): RedirectResponse
    {
        User::create($request->validated());

        return Redirect::to('/users')->with('success', 'User created.');
    }

    public function edit(User $user): Response
    {
        return Inertia::render('Admin/Users/Edit', new UserAdminEditViewModel($user));
    }

    public function update(UpdateUserRequest $request,User $user): RedirectResponse
    {
        if ( $user->isSuperAdminUser()) {
            return Redirect::back()->with('error', 'Updating the demo user is not allowed.');
        }

        $user->update($request->safe()->except(['role_id','password']));

        /** assign role */

        $user->syncRoles([request()->input('role_id')]);

        if (Request::get('password')) {
            $user->update(['password' => Request::get('password')]);
        }

        return Redirect::back()->with('success', 'User updated.');
    }

    public function destroy(User $user): RedirectResponse
    {
        if ($user->isSuperAdminUser()) {
            return Redirect::back()->with('error', 'Deleting the super admin is not allowed.');
        }

        $user->delete();

        return Redirect::back()->with('success', 'User deleted.');
    }

    public function restore(User $user): RedirectResponse
    {
        $user->restore();

        return Redirect::back()->with('success', 'User restored.');
    }
}
