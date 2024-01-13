<?php

namespace App\Admin\ViewModels;

use App\Enums\CertifiedUserStatusEnum;
use App\Helpers\Helpers;
use App\Models\CertifiedUserApplication;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Spatie\ViewModels\ViewModel;

class UserIndexViewModel extends ViewModel
{

    public function users()
    {
        $query = CertifiedUserApplication::orderBy('id')
            ->filter(Request::only('search', 'trashed'));

        $query->when(Auth::user()->hasRole('employee'), function ($q) {
            return $q->whereIn('status', [CertifiedUserStatusEnum::NEW,CertifiedUserStatusEnum::REJECTED]);
        });

        return $query->paginate(10)->withQueryString();

    }

    public function filters(): array
    {

        return Request::all('search', 'trashed');
    }
}
