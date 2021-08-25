<?php

namespace App\Models;

class Serie extends \Illuminate\Database\Eloquent\Model
{
    /* Informa a tabela que o model tem acesso
     * Caso a tabela tenha o mesmo nome da Model, porém no plural,
     * não há a necessidade de informar este atributo
     */
    protected $table = 'series';

    // campos que serão preenchidos pelo Request::all()
    protected $fillable = ['nome'];

    // negar ao Laravel a permissão para salvar o campos created_at e updated_at na tabela
    public $timestamps = false;


    public function temporadas()
    {
        return $this->hasMany(Temporada::class);
    }
}
