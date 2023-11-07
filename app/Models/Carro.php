<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carro extends Model
{
    use HasFactory;

    protected $fillable= ['modelo_id','placa', 'disponivel','km'];
    //um rule que funcione para todos os métodos
    public function rules(){
        return [
            'modelo_id' => 'exists:modelos,id',
            'placa'=> 'required',
            'disponivel'=>'required',
            'km'=>'required',
            
        ];
    }

    public function modelo(){
        return $this->belongsTo('App\Models\Modelo');
    }

}
