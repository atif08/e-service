<?php

namespace App\Admin\Actions;

use App\Enums\CertifiedUserStatusEnum;
use App\Mail\CertifiedUserApprovedMail;
use App\Models\CertifiedUserApplication;
use Illuminate\Support\Facades\Mail;

class SendInvoiceWithPdfAction
{
    public function __construct(public readonly CreateInvoicePdfAction $createInvoicePdfAction)
    {
    }

    public function execute(CertifiedUserApplication $certifiedUser):void
    {
        if (request()->status == CertifiedUserStatusEnum::APPROVED->value && !$certifiedUser->getMedia('invoice')->first()) {

            $path = $this->createInvoicePdfAction->execute($certifiedUser);

            Mail::to(request()->mail)->send(new CertifiedUserApprovedMail($certifiedUser, $path->getUrl()));
        }
    }
}
