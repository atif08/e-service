<?php

namespace App\Frontend\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Price;
use App\Models\University;
use Inertia\Inertia;
use Inertia\Response;

class CreateCertifiedUserController extends Controller
{
    public function __invoke(): Response
    {
        return Inertia::render('CertifiedUser/Create',
            [
                'countries' => Country::all(),
                'universities' => University::all(),
                'prices' => Price::all()
            ]);
    }
}
