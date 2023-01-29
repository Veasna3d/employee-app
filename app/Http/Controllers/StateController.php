<?php

namespace App\Http\Controllers;

use App\Models\State;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request as Requests;
use Inertia\Inertia;

class StateController extends Controller
{
    public function index(){
       // $countries = Country::all();
        $perPage = Requests::input('perPage') ?: 5;
        return Inertia::render('State/Index',[
            'states' => State::query()
            ->when(Requests::input('search'), function($query, $search){
                $query->where('name', 'like', "%{$search}%");
            })
            ->paginate($perPage)
            ->withQueryString(),
            'filters' => Requests::only(['search', 'perPage']),
        ]);
    }

    public function create()
    {
        $countries = Country::all();
        return Inertia::render('State/Create', compact('countries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:states,name',
            'country_id' => 'required',
        ]);

            State::create([
                'name' => $request->name,
                'country_id' => $request->country_id
            ]);
            return Redirect::route('states.index')->with('message', 'State created successfully.');
    }

    // public function edit(Country $country)
    // {
    //     return Inertia::render('Country/Edit', compact('country'));
    // }

    // public function update(Request $request, Country $country)
    // {
    //     $request->validate([
    //         'name' => 'required|unique:countries,name',
    //         'country_code' => 'required|unique:countries,country_code',
    //     ]);
    //     $country->update([
    //         'name' => $request->name,
    //         'country_code' => $request->country_code
    //     ]);
    //     return Redirect::route('countries.index')->with('message', 'Country updated successfully.');
    // }

    // public function destroy(Country $country)
    // {
    //     $country->delete();
    //     return Redirect::back()->with('message', 'Action completed.');
    // }
}
