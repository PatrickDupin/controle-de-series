<?php

namespace App\Services;

use App\Models\Serie;
use Illuminate\Support\Facades\DB;

class CriadorDeSerie
{
    public function criarSerie(string $nomeSerie, int $qtdTemporadas, int $epPorTemporada): Serie
    {
        DB::beginTransaction(); // laravel, inicie uma transação
        $serie = Serie::create(['nome' => $nomeSerie]);
        $this->criaTemporadas($serie, $qtdTemporadas, $epPorTemporada);
        DB::commit(); // terminei

        return $serie;
    }

    /**
     * @param $serie
     * @param int $qtdTemporadas
     * @param int $epPorTemporada
     */
    private function criaTemporadas(Serie $serie, int $qtdTemporadas, int $epPorTemporada): void
    {
        for ($i = 1; $i <= $qtdTemporadas; $i++) {
            $temporada = $serie->temporadas()->create(['numero' => $i]);

            $this->criaEpisodios($epPorTemporada, $temporada);
        }
    }

    /**
     * @param int $epPorTemporada
     * @param $temporada
     */
    private function criaEpisodios(int $epPorTemporada, $temporada): void
    {
        for ($j = 1; $j <= $epPorTemporada; $j++) {
            $temporada->episodios()->create(['numero' => $j]);
        }
    }
}
