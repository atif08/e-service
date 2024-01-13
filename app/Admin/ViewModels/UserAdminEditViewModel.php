<?php

namespace App\Admin\ViewModels;

use App\Enums\CertifiedUserStatusEnum;
use App\Helpers\Helpers;
use App\Models\CertifiedUserApplication;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\ViewModels\ViewModel;

class UserAdminEditViewModel extends ViewModel
{
    public function __construct(public readonly User $user)
    {
    }

    public function user(): array
    {
        return  [
            'id' => $this->user->id,
            'first_name' => $this->user->first_name,
            'last_name' => $this->user->last_name,
            'email' => $this->user->email,
            'owner' => $this->user->owner,
            'role_id'=> $this->user->roles[0]->id ?? null,
            'deleted_at' => $this->user->deleted_at,
        ];
    }

    public function can()
    {
        return  Auth::user()->hasRole('manager');
    }

    public function roles(): \Illuminate\Database\Eloquent\Collection|array
    {
        return Role::all();
    }

}
