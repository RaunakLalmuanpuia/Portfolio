<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
class ProjectController extends Controller
{
    public function index()
    {
        return Inertia::render('Projects/All',[
            'projects' => Project::all(),
            'avaliableIcons' => Project::getAvailableIcons(),
            'avaliableColors' => Project::getAvailableTextColors(),
        ]);
        
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => [
                'required',
                'max:255',
                Rule::unique(Project::class)
            ],
            'Description' => [
                'required',
                'max:255',
            ],
            'Color' => [
                'required',
                'in:' . implode(',', Project::getAvailableTextColors())
            ],
            'icon_name' => [
                'required',
                'in:' . implode(',', Project::getAvailableIcons())
            ],
        ]);

        Project::create($request->all());

        return redirect()->route('projects.index');
    }
    public function update(Request $request,  Project $project)
    {
        $request->validate([
            'title' => [
                'required',
                'max:255',
                Rule::unique(Project::class)->ignore($project->id)
            ],
            'Description' => [
                'required',
                'max:255',
            ],
            'Color' => [
                'required',
                'in:' . implode(',', Project::getAvailableTextColors())
            ],
            'icon_name' => [
                'required',
                'in:' . implode(',', Project::getAvailableIcons())
            ],
        ]);
        $project = Project::find($project->id);
        $project->update($request->all());

        return redirect()->route('projects.index');
    }
    public function destroy(Project $project)
    {
       $project->delete();
       return redirect()->route('projects.index');
    }
}
