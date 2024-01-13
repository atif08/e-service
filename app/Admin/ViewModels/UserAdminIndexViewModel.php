<?php

namespace App\Admin\ViewModels;

use App\Enums\CertifiedUserStatusEnum;
use App\Helpers\Helpers;
use App\Models\CertifiedUserApplication;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Spatie\ViewModels\ViewModel;

class UserAdminIndexViewModel extends ViewModel
{

    public function users()
    {
        return User::orderByName()
            ->filter(Request::only('search','trashed'))
            ->get()
            ->transform(fn ($user) => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'deleted_at' => $user->deleted_at,
            ]);
    }

    public function filters(): array
    {

        return Request::all('search', 'trashed');
    }
}
