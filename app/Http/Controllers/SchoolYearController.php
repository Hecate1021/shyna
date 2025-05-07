<?php

namespace App\Http\Controllers;

use App\Models\SchoolYear;
use Illuminate\Http\Request;

class SchoolYearController extends Controller
{
    public function index()
    {
        $schoolYears = SchoolYear::all();
        return view('school_year.index', compact('schoolYears'));
    }

    public function create()
    {
        return view('school_year.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'school_year' => 'required|string|max:255',
            'semester' => 'required|string|max:255',
        ]);

        SchoolYear::create($request->all());

        return redirect()->route('school_year.index')->with('success', 'School Year added successfully.');
    }

    public function edit(SchoolYear $schoolYear)
    {
        return view('school_year.edit', compact('schoolYear'));
    }

    public function update(Request $request, SchoolYear $schoolYear)
    {
        $request->validate([
            'school_year' => 'required|string|max:255',
            'semester' => 'required|string|max:255',
        ]);

        $schoolYear->update($request->all());

        return redirect()->route('school_year.index')->with('success', 'School Year updated successfully.');
    }

    public function destroy(SchoolYear $schoolYear)
    {
        $schoolYear->delete();

        return redirect()->route('school_year.index')->with('success', 'School Year deleted successfully.');
    }
}
