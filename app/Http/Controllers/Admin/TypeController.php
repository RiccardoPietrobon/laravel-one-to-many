<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = Type::all(); //passo tutti i valori
        return view('admin.types.index', compact('types')); //visualizzo il file index di type passo i types
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $type = new Type(); //instanzio il nuovo tipo
        return view('admin.types.form', compact('type')); //nel form
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
            'label.required' => 'La tipologia è richiesta',
            'label.string' => 'La tipologia deve essere una stringa',
            'label.max' => 'Può avere un massimo di 20 caratteri',

            'color.required' => 'Il colore è richiesto',
            'color.string' => 'Il colore deve essere una stringa',
            'color.size' => 'Il colore deve avere la seguente sintassi #ffffff',
        ]);

        $type = new Type(); //instanzio il nuovo tipo
        $type->fill($request->all()); //controlla il fillable nel model
        $type->save(); //salvo

        return to_route('admin.types.show')
            ->with('message', 'Progetto creato correttamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function show(Type $type)
    {
        return view('admin.types.show', compact('type'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function edit(Type $type)
    {
        return view('admin.types.form', compact('types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Type $type)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function destroy(Type $type)
    {
        //
    }
}