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

        return redirect()->route('project.index');
    }
}
