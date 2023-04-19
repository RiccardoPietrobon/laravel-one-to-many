<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Type; //importo il type
use Illuminate\Http\Request;
use Illuminate\Support\Arr; //classe per gli array
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort = (!empty($sort_request = $request->get('sort'))) ? $sort_request : "updated_at";
        $order = (!empty($order_request = $request->get('order'))) ? $order_request : "DESC";

        $projects = Project::orderBy($sort, $order)->paginate(10)->withQueryString(); //me li ordina per update e mi mostra i primi 10 elementi


        return view('admin.projects.index', compact('projects', 'sort', 'order')); //passo anche sort e orderper sapere l'ordine
    }

    /**
     * Show the form for creating a new resource.
     *
     * 
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $project = new Project;
        $types = Type::orderBy('label')->get(); //aggiungo types per vederlo nel form

        return view('admin.projects.form', compact('project', 'types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'title' => 'required|string|max:100',
                'text' => 'required|string',
                'image' => 'nullable|image|mimes:jpg,png,jpeg',
                'type_id' => 'nullable|exists:types,id',

            ],
            [
                'title.required' => 'Il titolo è obbligatorio',
                'title.string' => 'Il titolo deve essere una stringa',
                'title.max' => 'Il titolo può avere un massimo di 100 caratteri',

                'text.required' => 'Il titolo è obbligatorio',
                'text.string' => 'Il testo deve essere una stringa',

                'image.image' => 'Il file caricato deve essere un\'immagine',
                'image.mimes' => 'L\'immagine deve essere un file jpg, png o jpeg',

                'type_id.exists' => 'L\ID non è valido, seleziona tra quelli elencati',

            ]
        );

        $data = $request->all();

        if (Arr::exists($data, 'image')) { //se esiste l'immagine
            $path = Storage::put('uploads/progetti', $data['image']); //viene caricata nello storage
            $data['image'] = $path; //successivamente passa nel fill
        }

        $project = new Project;
        $project->fill($data);
        $project->slug = Project::generateUniqueSlug($project->title);
        $project->save();

        return to_route('admin.projects.show', $project)
            ->with('message', 'Progetto creato correttamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $types = Type::orderBy('label')->get(); //aggiungo types per vederlo nel form
        return view('admin.projects.form', compact('project', 'types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $request->validate(
            [
                'title' => 'required|string|max:100',
                'text' => 'required|string',
                'image' => 'nullable|image|mimes:jpg,png,jpeg',
                'published' => 'boolean',
            ],
            [
                'title.required' => 'Il titolo è obbligatorio',
                'title.string' => 'Il titolo deve essere una stringa',
                'title.max' => 'Il titolo può avere un massimo di 100 caratteri',

                'text.required' => 'Il titolo è obbligatorio',
                'text.string' => 'Il testo deve essere una stringa',

                'image.image' => 'Il file caricato deve essere un\'immagine',
                'image.mimes' => 'L\'immagine deve essere un file jpg, png o jpeg',
            ]
        );

        $data = $request->all();
        $data["slug"] = Project::generateUniqueSlug($data["title"]);
        $data["published"] = $request->has("published") ? 1 : 0;



        if (Arr::exists($data, 'image')) { //se esiste l'immagine
            if ($project->image) Storage::delete($project->image); //cancellala
            $path = Storage::put('uploads/progetti', $data['image']); //viene caricata nello storage
            $data['image'] = $path; //successivamente passa nel fill
        }

        $project->update($data);


        return to_route('admin.projects.show', $project)
            ->with('message', 'Progetto modificato correttamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {

        if ($project->image) Storage::delete($project->image); //cancellala

        $project->delete();
        return to_route('admin.projects.index', $project)
            ->with('message_type', 'danger')
            ->with('message', 'Progetto eliminato definitivamente');
    }
}