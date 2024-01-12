<?php

namespace App\Admin\ViewModels;

use App\Enums\CertifiedUserStatusEnum;
use App\Helpers\Helpers;
use App\Models\CertifiedUserApplication;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Spatie\ViewModels\ViewModel;

class UserEditViewModel extends ViewModel
{
    public CertifiedUserApplication $certifiedUser;
    public function __construct(CertifiedUserApplication $certifiedUser)
    {
        $this->certifiedUser = $certifiedUser;
    }

    public function user(): CertifiedUserApplication
    {
        return  $this->certifiedUser;
    }

    public function can()
    {
        return  Auth::user()->hasRole('manager');
    }

    public function invoice(): string|null
    {
        return  $this->certifiedUser->getMedia('invoice')->first()?->getUrl();
    }

    public function status_list(): array|Collection
    {
        $statusList = Helpers::mapEnum(CertifiedUserStatusEnum::cases());

        if (Auth::user()->hasRole('employee')) {
            $statusList = collect($statusList)->reject(function ($status) {
                return $status['value'] === 'approved';
            })->values()->all();
        }

        return $statusList;
    }
}
