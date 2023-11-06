<?php
namespace App\Repositories;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class MarcaRepository {
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }




    public function selectAtributosRegistrosRelacionados($atributos){
        $this->model = $this->model->with($atributos);
        //para atualizar o estado do atributo
        //a query está sendo montada
    }

    public function filtro($filtros){
        $filtros = explode(';',$filtros);

        foreach($filtros as $key => $condicao){
            $c = explode(':',$condicao);
            $this->model = $this->model->where($c[0],$c[1],$c[2]);
            //a query está sendo montada
            }

    }
    public function selectAtributos($atributos){
        $this->model = $this->model->selectRaw($atributos);

    }
    public function getResultado(){
        return $this->model->get();
    }


}