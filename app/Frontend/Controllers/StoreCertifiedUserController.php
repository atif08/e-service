<?php

namespace App\Frontend\Controllers;

use App\Frontend\Actions\CreateCertifiedUserAction;
use App\Frontend\Requests\StoreCertifiedUserRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class StoreCertifiedUserController extends Controller
{
    public function __invoke(StoreCertifiedUserRequest $request,CreateCertifiedUserAction $createCertifiedUserAction): RedirectResponse
    {
        $createCertifiedUserAction->execute($request);

        return redirect('/')->with('success', 'Your application submitted successfully.');
    }

}
