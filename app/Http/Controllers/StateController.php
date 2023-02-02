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
       // $country = Country::with(['country'])->find();
       // $states = StateResource::collection(State::with('country')->get());
       // return Inertia::render('Product/Index', compact('states'));
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

    public function edit(State $state)
    {
        $countries = Country::all();
        return Inertia::render('State/Edit', compact('state', 'countries'));
    }

    public function update(Request $request, State $state)
    {
        $request->validate([
            'name' => 'required|unique:states,name',
            'country_id' => 'required',
        ]);
        $state->update([
            'name' => $request->name,
            'country_id' => $request->country_id
        ]);
        return Redirect::route('states.index')->with('message', 'State updated successfully.');
    }

    public function destroy(State $state)
    {
        $state->delete();
        return Redirect::back()->with('message', 'Action completed.');
    }
}
