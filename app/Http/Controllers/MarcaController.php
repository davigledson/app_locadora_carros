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
        return response()->json($marcas,200);
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

        $regras = [
            'nome'=> 'required|unique:marcas',
            'imagem'=>'required'
        ];
        $feedback=[
            'required'=> 'O campo :attribute é obrigatório',
            'nome.unique'=>'O nome da marca já existe'
        ];
        //lembrar do Accept para funcionar as validações
        $request->validate($regras,$feedback);
        //stateless

        $marca = $this->marca->create($request->all());
        return response()->json($marca,201) ;
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $marca = $this->marca->find($id);
        if($marca === null){
            return response()->json(['erro'=>'Recurso pesquisado não existe'],404) ;
            //json

        }
       return response()->json($marca,200) ;
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
       if($marca === null){
        return response()->json(['erro'=>'Impossivel realizar a atualização. O recurso solicitado não existe'],404) ;
       }
       $marca->update($request->all());

       return response()->json($marca,200) ;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $marca = $this->marca->find($id);
        if($marca === null){
            return response()->json(['erro'=>'Impossível realizar a exclusão. O recurso solicitado não existe'],404) ;
           }
        $marca->delete();
        return response()->json(['msg'=>'A marca foi removida como sucesso!'],200) ;
    }
}
