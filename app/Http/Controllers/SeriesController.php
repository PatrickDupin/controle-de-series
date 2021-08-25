<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequest;
use App\Models\Serie;
use App\Services\CriadorDeSerie;
use App\Services\RemovedorDeSerie;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    /*
        public function __construct()
        {
            $this->middleware('auth');
        }
     * A autenticação foi direcionadas para as rotas especificas
     */
    public function index(Request $request)
    {
        $series = Serie::query()
            ->orderBy('nome')
            ->get();

        $mensagem = $request->session()->get('mensagem');

        return view('series.index', compact('series', 'mensagem'));
    }

    public function create()
    {
        return view('series.create');
    }

    public function store(SeriesFormRequest $request, CriadorDeSerie $criadorDeSerie)
    {
        /* Esse método receberá, por parâmetro, um array associativo com os valores que queremos passar para a tabela
         *
           $serie = Serie::create([
               'nome' => $nome,
               'genero' => $genero -> possível parâmetro que poderia ser enviado através do formulário
           ]);

         * No exemplo abaixo, o método all() pega todos os dados do formulário no request
           $serie = Serie::create( $request->all() );

         */

        $serie = $criadorDeSerie->criarSerie(
            $request->nome,
            $request->qtd_temporadas,
            $request->ep_por_temporada);

        $request->session()
            ->flash(
                "mensagem",
                "Série {$serie->nome} e suas temporadas e episódios criados com sucesso!"
            );

        return redirect()->route('listar_series');
    }

    public function destroy(Request $request, RemovedorDeSerie $removedorDeSerie)
    {
        $nomeSerie = $removedorDeSerie->removerSerie($request->id);

        Serie::destroy($request->id);
        $request->session()
            ->flash(
                "mensagem",
                "Série $nomeSerie removida com sucesso"
            );
        return redirect()->route('listar_series');
    }

    public function editaNome(int $id, Request $request)
    {
        $novoNome = $request->nome;
        $serie = Serie::find($id);
        $serie->nome = $novoNome;
        $serie->save();
    }
}
