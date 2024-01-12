<?php

namespace App\Frontend\Actions;

use App\Enums\CertifiedUserStatusEnum;
use App\Frontend\Requests\StoreCertifiedUserRequest;
use App\Mail\CertifiedUserAppicationMail;
use App\Models\CertifiedUserApplication;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Request;

class CreateCertifiedUserAction
{
    public function __construct()
    {
    }
    public function execute(StoreCertifiedUserRequest $request): void
    {
        /** Save certified user */
        $user = CertifiedUserApplication::create($request->validated()+['status'=>CertifiedUserStatusEnum::NEW]);

        /** save media */
        if (Request::file('photo')) {
            $user
                ->addMedia(Request::file('photo'))
                ->toMediaCollection();
        }
        if (Request::file('certificate_file')) {
            $user
                ->addMedia(Request::file('certificate_file'))
                ->toMediaCollection();
        }

        /** send mail to user */
        Mail::to($request->mail)->send(new CertifiedUserAppicationMail($user));

    }

}
