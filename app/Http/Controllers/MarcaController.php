<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MarcaController extends Controller
{

    public function __construct(Marca $marca)
    {
        $this->marca = $marca;
    }
    protected $marca;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $marcas = $this->marca->all();
       // $marcas = Marca::all();
        return $marcas;
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
        //
        //$marca = Marca::create($request->all());
        //dd($request->all());
        //dd($marca);

        $marca = $this->marca->create($request->all());
        return $marca;
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $marca = $this->marca->find($id);
       return $marca;
   }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Marca $marca)
    {
        //

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        //
       //print_r($request->all()); //os dados atualizados
       //echo '<hr>';
      // print_r($marca->getAttributes()); //os dados antigos

       //$marca->update($request->all());
       $marca = $this->marca->find($id);
       $marca->update($request->all());

       return $marca;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $marca = $this->marca->find($id);
        $marca->delete();
        return ['msg'=>'A marca foi removida como sucesso!'];
    }
}
