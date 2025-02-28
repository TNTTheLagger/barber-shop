<?php
namespace App\Http\Controllers;

use App\Models\Barber;
use Illuminate\Http\Request;

class BarberController extends Controller
{
    public function index()
    {
        return Barber::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'barber_name' => 'required|string|max:255',
        ]);

        return Barber::create($request->all());
    }

    public function show(Barber $barber)
    {
        return $barber;
    }

    public function update(Request $request, Barber $barber)
    {
        $request->validate([
            'barber_name' => 'required|string|max:255',
        ]);

        $barber->update($request->all());

        return $barber;
    }

    public function destroy(Barber $barber)
    {
        $barber->delete();

        return response()->noContent();
    }
}