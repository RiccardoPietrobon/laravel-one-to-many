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
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort = (!empty($sort_request = $request->get('sort'))) ? $sort_request : "updated_at"; //metodo ordinamento sempre uguale cambio i parametri
        $order = (!empty($order_request = $request->get('order'))) ? $order_request : "DESC";

        $types = Type::orderBy($sort, $order)->paginate(10)->withQueryString();
        return view('admin.types.index', compact('sort', 'order', 'types')); //visualizzo il file index di type passo i types
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

        return to_route('admin.types.show', $type)
            ->with('message', 'Tipologia creata correttamente');
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
        return view('admin.types.form', compact('type'));
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

        $type->update($request->all()); //faccio l'update

        return to_route('admin.types.show', $type)
            ->with('message', 'Tipologia modificata correttamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function destroy(Type $type)
    {
        $type_id = $type->id;
        $type->delete();
        return to_route('admin.types.index', $type)
            ->with('message_type', 'danger')
            ->with('message', "Tipologia $type_id eliminata definitivamente");
    }
}