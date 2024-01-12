<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\SendInvoiceWithPdfAction;
use App\Admin\ViewModels\UserEditViewModel;
use App\Admin\ViewModels\UserIndexViewModel;
use App\Frontend\Requests\UpdateCertifiedUserRequest;
use App\Http\Controllers\Controller;
use App\Models\CertifiedUserApplication;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class CertifiedUserController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Admin/CertifiedUsers/Index',new UserIndexViewModel());
    }

    public function edit(CertifiedUserApplication $certifiedUser): Response
    {
        return Inertia::render('Admin/CertifiedUsers/Edit', new UserEditViewModel($certifiedUser));
    }

    public function update(UpdateCertifiedUserRequest $request, CertifiedUserApplication $certifiedUser, SendInvoiceWithPdfAction $sendInvoiceWithPdfAction): RedirectResponse
    {
        $certifiedUser->update($request->all());

        $sendInvoiceWithPdfAction->execute($certifiedUser);

        return Redirect::back()->with('success', 'user updated.');
    }

    public function destroy(CertifiedUserApplication $certifiedUser): RedirectResponse
    {
        $certifiedUser->delete();

        return Redirect::to('/certified-users')->with('success', 'User deleted.');
    }

    public function restore(CertifiedUserApplication $certifiedUser): RedirectResponse
    {
        $certifiedUser->restore();

        return Redirect::back()->with('success', 'User restored.');
    }
}
