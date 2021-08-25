<?php

namespace App\Models;

class Template extends \Illuminate\Database\Eloquent\Model
{
    // minha tabela tem outro nome
    protected $table = 'templates';

    // para tirar a opção de created_at updated_at das tabelas
    public $timestamps = false;

    // aqui a solução para inserir produtos com status default 'A' sem precisar ter ele no form
    protected $attributes = ['status' => 'A'];

    // campos que serão preenchidos pelo Request::all()
    protected $fillable = array('descricao', 'codigo_integracao', 'fornecedor_id');

    // campos que serão exclusivo e não serão aceitos via request get ou post
    protected $guarded = ['id'];

}
