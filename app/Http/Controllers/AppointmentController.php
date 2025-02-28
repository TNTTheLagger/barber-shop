<?php
namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {
        return Appointment::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'barber_id' => 'required|exists:barbers,id',
            'appointment' => 'required|date',
        ]);

        return Appointment::create($request->all());
    }

    public function show(Appointment $appointment)
    {
        return $appointment;
    }

    public function update(Request $request, Appointment $appointment)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'barber_id' => 'required|exists:barbers,id',
            'appointment' => 'required|date',
        ]);

        $appointment->update($request->all());

        return $appointment;
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        return response()->noContent();
    }
}