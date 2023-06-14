<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::all();

        return response()->json($projects);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $project = new Project;
        $project->name = $request->input('name');
        $project->description = $request->input('description');
        // Set other project attributes as needed

        $project->save();

        return response()->json(['message' => 'Project saved successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return response()->json($project);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Project $project, Request $request)
    {


        if ($request->has('IsComplete')) {
            $project->IsComplete = $request->input('IsComplete');
        } else {
            $validatedData = $request->validate([
                'name' => 'required',
                'description' => 'required',
                // Add validation rules for other project attributes
            ]);

            $project->fill($validatedData);
        }
        // Set other project attributes as needed

        $project->save();

        return response()->json(['message' => 'Project edited successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Project $project)
    {
        $project->delete();
        return response()->json(['message' => 'Project deleted successfully']);
    }
}
