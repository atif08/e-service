<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Price;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;
use Inertia\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;

class PriceController extends Controller
{

    public function index(): Response
    {
        return Inertia::render('Admin/Prices/Index', [
            'filters' => Request::all('search', 'trashed'),
            'prices' => Price::orderBy('id','desc')
                ->filter(Request::only('search', 'trashed'))
                ->get(),
        ]);
    }


    public function create(): Response
    {
        return Inertia::render('Admin/Prices/Create');

    }


    public function store(): RedirectResponse
    {

        Price::create($this->validateRule());

        return Redirect::to('/prices')->with('success', 'Price created.');
    }

    public function edit(Price $price): Response
    {
        return Inertia::render('Admin/Prices/Edit',['price'=>$price]);
    }


    public function update(Price $price): RedirectResponse
    {

        $price->update($this->validateRule());

        return Redirect::to('/prices')->with('success', 'Price updated.');
    }

    public function destroy(Price $price): RedirectResponse
    {

        $price->delete();

        return Redirect::to('/prices')->with('success', 'Price deleted.');
    }

    public function restore(Price $price): RedirectResponse
    {
        $price->restore();

        return Redirect::back()->with('success', 'User restored.');
    }

    protected function validateRule(): array
    {
        return request()->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);
    }


}
