<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Technology;
use Illuminate\Http\Request;

class TechnologyController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort = (!empty($sort_request = $request->get('sort'))) ? $sort_request : "updated_at"; //metodo ordinamento sempre uguale cambio i parametri
        $order = (!empty($order_request = $request->get('order'))) ? $order_request : "DESC";

        $technologies = Technology::orderBy($sort, $order)->paginate(10)->withQueryString();
        return view('admin.technologies.index', compact('sort', 'order', 'technologies')); //visualizzo il file index di technology passo i technologies
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $technology = new Technology(); //instanzio la nuova tech
        return view('admin.technologies.form', compact('technology')); //nel form
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'label' => 'required|string|max:20',
            'color' => 'required|string|size:7', //per forza 7 sennò non funziona
        ], [
            'label.required' => 'La tecnologia è richiesta',
            'label.string' => 'La tecnologia deve essere una stringa',
            'label.max' => 'Può avere un massimo di 20 caratteri',

            'color.required' => 'Il colore è richiesto',
            'color.string' => 'Il colore deve essere una stringa',
            'color.size' => 'Il colore deve avere la seguente sintassi #ffffff',
        ]);

        $technology = new Technology(); //instanzio la nuova tech
        $technology->fill($request->all()); //controlla il fillable nel model
        $technology->save(); //salvo

        return to_route('admin.technologies.show', $technology)
            ->with('message', 'Tecnologia creata correttamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Technology  $technology
     * @return \Illuminate\Http\Response
     */
    public function show(Technology $technology)
    {
        return view('admin.technologies.show', compact('technology'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Technology  $technology
     * @return \Illuminate\Http\Response
     */
    public function edit(Technology $technology)
    {
        return view('admin.technologies.form', compact('technology'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Technology  $technology
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Technology $technology)
    {
        $request->validate([
            'label' => 'required|string|max:20',
            'color' => 'required|string|size:7', //per forza 7 sennò non funziona
        ], [
            'label.required' => 'La tecnologia è richiesta',
            'label.string' => 'La tecnologia deve essere una stringa',
            'label.max' => 'Può avere un massimo di 20 caratteri',

            'color.required' => 'Il colore è richiesto',
            'color.string' => 'Il colore deve essere una stringa',
            'color.size' => 'Il colore deve avere la seguente sintassi #ffffff',
        ]);

        $technology->update($request->all()); //faccio l'update

        return to_route('admin.types.show', $technology)
            ->with('message', 'Tecnologia modificata correttamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Technology  $technology
     * @return \Illuminate\Http\Response
     */
    public function destroy(Technology $technology)
    {
        $technology_id = $technology->id;
        $technology->delete();
        return to_route('admin.types.index', $technology)
            ->with('message_type', 'danger')
            ->with('message', "Tecnologia $technology_id eliminata definitivamente");
    }
}
