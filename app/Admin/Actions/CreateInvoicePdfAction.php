<?php

namespace App\Admin\Actions;

use App\Models\CertifiedUserApplication;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\File;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class CreateInvoicePdfAction
{
    public function __construct()
    {
    }

    public function execute(CertifiedUserApplication $certifiedUser):Media
    {
//        $html = view('pdf.invoice',['order' =>$order])->render();
        $html = view('pdf.invoice',['user'=>$certifiedUser])->render();

        $path = storage_path("app/public/invoice-".rand(0,10).".pdf");

        Pdf::loadHTML( $html )
           ->setPaper( 'a4', 'potrait' )
           ->setWarnings( false )
           ->save( $path );

        /** Attach pdf to spaite media */

        $pdfFile = new File($path);

        return $certifiedUser->addMedia($pdfFile)
            ->toMediaCollection('invoice');
    }
}
