<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return Employee::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'nomor' => 'required|unique:employees',
            'nama' => 'required',
            'jabatan' => 'nullable',
            'talahir' => 'nullable|date',
            'photo_upload_path' => 'nullable|file|mimes:jpeg,png,jpg|max:2048',
        ]);

        $url = null;
        if ($request->hasFile('photo_upload_path')) {
            $path = $request->file('photo_upload_path')->store('photos', 's3');
            $url = Storage::disk('s3')->url($path);
        }

        $employee = Employee::create([
            'nomor' => $validated['nomor'],
            'nama' => $validated['nama'],
            'jabatan' => $validated['jabatan'] ?? null,
            'talahir' => $validated['talahir'] ?? null,
            'photo_upload_path' => $url,
            'created_on' => Carbon::now(),
            'created_by' => 'system',
        ]);

        Redis::set('emp_' . $employee->nomor, json_encode($employee));

        return response()->json($employee);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        return Employee::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $employee = Employee::findOrFail($id);

        $employee->update($request->only([
            'nama',
            'jabatan',
            'talahir',
            'updated_by',
        ] + [
            'updated_on' => Carbon::now(),
        ]));

        Redis::set('emp_' . $employee->nomor, json_encode($employee));

        return response()->json($employee);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $employee = Employee::findOrFail($id);
        Redis::del('emp_' . $employee->nomor);
        $employee->delete();

        return response()->json(['message' => 'Employee deleted successfully']);
    }
}
