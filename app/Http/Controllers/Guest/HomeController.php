<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $good_projects = Project::where('published', 1)->orderBy('updated_at', 'DESC')->get();
        return view('guest.home', compact('good_projects'));
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('guest.projects.show', compact('project'));
    }
}
