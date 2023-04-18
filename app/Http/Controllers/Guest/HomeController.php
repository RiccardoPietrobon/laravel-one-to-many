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

    public function show()
    {
        $good_projects = Project::where('published', 1)->orderBy('updated_at', 'DESC')->get();

        foreach ($good_projects as $good_project) {
        }

        return view('guest.projects.show', compact('good_project'));
    }
}