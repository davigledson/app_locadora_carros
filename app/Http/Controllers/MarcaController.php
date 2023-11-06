<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $marcas = $this->marca->with('modelos')->get();
       // $marcas = Marca::all();

       //all() -> criando um obj de consulta + get() = collection
       //get() -> possibilidade de modificar a consulta ->collection
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


        //lembrar do Accept para funcionar as validações
        $request->validate($this->marca->rules(),$this->marca->feedback());
        //stateless

        $image = $request->file('imagem');
        $imagem_urn = $image->store('imagens','public');



        //aponta para o diretório storage
        //pode omitir o segundo parâmetro se for o 'local'
       $marca = $this->marca->create([
        'nome'=> $request->nome,
        'imagem'=> $imagem_urn,
       ]);
        //$marca = $this->marca->create($request->all());
        return response()->json($marca,201) ;
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $marca = $this->marca->with('modelos')->find($id);
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
       //dd($request->method());
        //dd($request->nome);
        //dd($request->file('imagem'));
       if($marca === null){
        return response()->json(['erro'=>'Impossível realizar a atualização. O recurso solicitado não existe'],404) ;
       }

       if($request->method() ==='PATCH'){
        //return ['teste'=> 'Verbo PATCH'];

        $regrasDinamicas = array();

        //percorrendo todas as regras definidas no Model
            foreach($marca->rules() as $input => $regra){

                //coletar apenas as regras aplicáveis aos parâmetros parciais da requisição patch

                if(array_key_exists($input,$request->all())){
                    $regrasDinamicas[$input] = $regra;
                }


            }
//dd($regrasDinamicas);

        //dd($marca->rules());

        $request->validate($regrasDinamicas,$marca->feedback());

       } else {
        $request->validate($marca->rules(),$marca->feedback());
       }
       //remove o arquivo antigo caso um novo seja enviado no request
 if($request->file('imagem')){
        Storage::disk('public')->delete($marca->imagem);$image = $request->file('imagem');
       $imagem_urn = $image->store('imagens','public');
       //aponta para o diretório storage
       //pode omitir o segundo parâmetro se for o 'local'
       //refatoração - preencher o objeto marca com os dados do request
       $marca->fill($request->all());
       $marca->imagem = $imagem_urn;
       //dd($marca->getAttributes());
       }


       $marca->save();
       /*

        $marca->update([
        'nome'=> $request->nome,
        'imagem'=> $imagem_urn,
       ]) ;
        */


       return response()->json($marca,200) ;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        $marca = $this->marca->find($id);
        if($marca === null){
            return response()->json(['erro'=>'Impossível realizar a exclusão. O recurso solicitado não existe'],404) ;
           }

         //remove o arquivo antigo
        Storage::disk('public')->delete($marca->imagem);

        $marca->delete();
        return response()->json(['msg'=>'A marca foi removida como sucesso!'],200) ;
    }
}
