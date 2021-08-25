@extends('layout')

@section('cabecalho')
    Séries
@endSection

@section('conteudo')
    @includeWhen(!empty($mensagem), 'mensagem', ['mensagem' => $mensagem])

    @auth
        <a href="{{ route('form_criar_serie') }}" class="btn btn-dark mb-2">Adicionar</a>
    @endauth

    <ul class="list-group">
        @foreach ($series as $serie)
            <li class="list-group-item d-flex justify-content-between align-items-md-center">
                <span id="nome-serie-{{ $serie->id }}">{{ $serie->nome }}</span>

                <div class="input-group w-50" hidden id="input-nome-serie-{{ $serie->id }}">
                    <input type="text" class="form-control" value="{{ $serie->nome }}">
                    <div class="input-group-append">
                        <button class="btn btn-primary" onclick="editarSerie({{ $serie->id }})">
                            <i class="fas fa-check"></i>
                        </button>
                        @csrf
                    </div>
                </div>

                <div class="d-flex">
                    @auth
                        <button class="btn btn-info btn-sm mr-1" onclick="toggleInput({{ $serie->id }})">
                            <i class="fas fa-edit"></i>
                        </button>
                    @endauth
                    <a href="/series/{{ $serie->id }}/temporadas" class="btn btn-info btn-sm mr-1">
                        <i class="fas fa-external-link-alt"></i>
                    </a>
                    @auth
                        <form method="post"
                              action="/series/{{ $serie->id }}"
                              onSubmit="return confirm('Tem certeza que deseja remover {{ addslashes($serie->nome) }}?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm"><i class="fa fa-trash-alt">&nbsp;</i></button>
                        </form>
                    @endauth
                </div>
            </li>
        @endforeach
    </ul>

    <script>
        function toggleInput(serieId) {
            const nomeSerieEl = document.getElementById(`nome-serie-${serieId}`);
            const inputSerieEl = document.getElementById(`input-nome-serie-${serieId}`);

            if (nomeSerieEl.hasAttribute('hidden')) {
                nomeSerieEl.removeAttribute('hidden');
                inputSerieEl.hidden = true;
            } else {
                nomeSerieEl.hidden = true;
                inputSerieEl.removeAttribute('hidden');
            }
        }

        function editarSerie(serieId) {
            let formData = new FormData();
            const nome = document
                .querySelector(`#input-nome-serie-${serieId} > input`)
                .value;
            const token = document
                .querySelector(`input[name="_token"]`)
                .value;

            formData.append('nome', nome);
            formData.append('_token', token);

            const url = `/series/${serieId}/editaNome`;
            fetch(url, {
                method: 'POST',
                body: formData
            }).then(() => {
                toggleInput(serieId);
                document.getElementById(`nome-serie-${serieId}`)
                    .textContent = nome;
            })
        }
    </script>
@endsection
