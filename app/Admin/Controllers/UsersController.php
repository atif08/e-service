<?php

namespace App\Admin\Controllers;

use App\Admin\Requests\StoreUserRequest;
use App\Admin\Requests\UpdateUserRequest;
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
    public function index()
    {
        return Inertia::render('Admin/Users/Index', [
            'filters' => Request::all('search', 'trashed'),
            'users' => User::orderByName()
                ->filter(Request::only('search','trashed'))
                ->get()
                ->transform(fn ($user) => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'deleted_at' => $user->deleted_at,
                ]),
        ]);
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
        return Inertia::render('Admin/Users/Edit', [
            'can' => Auth::user()->hasRole('manager'),
            'user' => [
                'id' => $user->id,
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'email' => $user->email,
                'owner' => $user->owner,
                'role_id'=> $user->roles[0]->id ?? null,
                'deleted_at' => $user->deleted_at,
            ],
            'roles' => Role::all()
        ]);
    }

    public function update(UpdateUserRequest $request,User $user): RedirectResponse
    {
        if ( $user->isSuperAdminUser()) {
            return Redirect::back()->with('error', 'Updating the demo user is not allowed.');
        }

        $user->update($request->safe()->except(['role_id','password']));

        /** assign role */
        ;
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
