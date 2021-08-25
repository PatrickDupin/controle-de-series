<?php

namespace App\Http\Controllers;

use App\Models\Episodio;
use App\Models\Temporada;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EpisodiosController extends Controller
{
    /*
     * Estamos recebendo um número inteiro pela URL, mas podemos, no método do nosso Controller, indicar que queremos
     * um objeto - por exemplo, Temporada $temporada. Dessa forma, o Laravel vai, a partir do valor recebido, criar uma
     * temporada chamando o find(). Para que isso funcione, os parâmetros na URL e no método precisam ter o mesmo nome.
     * Portanto, no arquivo de rotas, mudaremos temporadaId para temporada.
     */
    public function index(Temporada $temporada, Request $request)
    {
        /*
         * Caso você prefira não usar o compact(), e possível fazer outra construção,
         * passando essas variáveis diretamente em um array:
         */
        return view('episodios.index', [
            'episodios' => $temporada->episodios,
            'temporadaId' => $temporada->id,
            'mensagem' => $request->session()->get('mensagem')
        ]);
    }

    public function assistir(Temporada $temporada, Request $request)
    {
        $episodiosAssistidos = $request->episodios;

        $temporada->episodios->each(
            function (Episodio $episodio) use ($episodiosAssistidos)
            {
                $episodio->assistido = in_array($episodio->id, $episodiosAssistidos);
            /*
             * $episodio->save();
             *
             * Ao final, poderíamos fazer $episodio->save(). Porém, dessa forma, iríamos salvar cada um dos episódios
             * individualmente, o que não parece prático. Uma solução seria colocarmos toda esse execução em uma transação,
             * ou, ao final, fazer $temporada->push() para enviar todas as modificações em $temporada e nas suas relações.
             *
             */
            }
        );

        $temporada->push();
        $request->session()->flash(
            'mensagem',
            'Alterações realizadas com sucesso!'
        );

        return redirect()->back();
    }

}
