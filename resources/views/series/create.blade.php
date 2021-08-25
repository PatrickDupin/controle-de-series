@extends('layout')

@section('cabecalho')
    Adicionar Séries
@endsection

@section('conteudo')
    @include('erros', ['errors' => $errors])

    <form method="post">
        @csrf
        <div class="row form-group">
            <div class="col col-8">
                <label for="nome">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" />
            </div>
            <div class="col col-2">
                <label for="qtd_temporadas">N° temporadas</label>
                <input type="number" class="form-control" id="qtd_temporadas" name="qtd_temporadas" />
            </div>
            <div class="col col-2">
                <label for="ep_por_temporada">Ep. por episódios</label>
                <input type="number" class="form-control" id="ep_por_temporada" name="ep_por_temporada"/>
            </div>
        </div>

        <button class="btn btn-primary">Adicionar</button>
    </form>
@endsection
