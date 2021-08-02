@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{asset('css/home.css')}}">

    <div class="modal" tabindex="-1" id="modalConfronto">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confronto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger mb-2" role="alert" id="modalAlert">

                    </div>

                    <div class="row ms-auto me-auto">
                        <div class="col-7">
                            <label for="timeCasa">Time da Casa</label>
                        </div>
                        <div class="col-5">
                            <label for="timeCasa">Visitante</label>
                        </div>
                    </div>
                    <div class="row  ms-auto me-auto">
                        <div class="col-5">
                            <select name="time_casa" id="timeCasa" class="form-control d-inline">
                                <option disabled selected>Selecione...</option>
                                @foreach($times as $time)
                                    <option value="{{$time->id}}">{{$time->nome}}</option>
                                @endforeach
                            </select>
                            <input type="number" min="0" name="gols_casa" id="golsCasa" class="form-control d-inline">
                        </div>
                        <div class="col-2 text-center">x</div>
                        <div class="col-5">
                            <input type="number" min="0" name="gols_visitante" id="golsVisitante" class="form-control d-inline">
                            <select name="time_visitante" id="timeVisitante" class="form-control d-inline">
                                <option disabled selected>Selecione...</option>
                                @foreach($times as $time)
                                    <option value="{{$time->id}}">{{$time->nome}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="closeModal">Fechar</button>
                    <button type="button" class="btn btn-primary" id="saveConfronto">
                        <i class="fas fa-circle-notch fa-spin" id="loadingSave"></i> &emsp;Salvar Mudanças
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap pb-2 mb-3">
        <h1 class="h3">TABELA</h1>
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalConfronto">
            Inserir Confronto
        </button>
    </div>

    <div class="alert alert-danger mb-4" role="alert" id="tableAlert">
        Ocorreu um erro de comunicação com o servidor, tente novamente!
    </div>

    <div class="legenda">
        <span>
            <div class="time-campeao">&emsp;</div> Campeão
        </span>

        <span>
            <div class="time-libertadores">&emsp;</div> Classificado para Libertadores
        </span>

        <span>
            <div class="time-sulamericana">&emsp;</div> Classificado para Copa Sul-Americana
        </span>

        <span>
            <div class="time-rebaixado">&emsp;</div> Rebaixado
        </span>
    </div>

    <table class="table" id="tableData">
        <tr>
            <td>Posição</td>
            <td>PTS</td>
            <td>J</td>
            <td>V</td>
            <td>E</td>
            <td>D</td>
            <td>GP</td>
            <td>GC</td>
            <td>SG</td>
        </tr>

        <tr id="nodata">
            <td colspan="9" class="text-center h2">
                Nenhum dado encontrado!
            </td>
        </tr>

        <tr id="loading">
            <td colspan="9" class="text-center h2">
                <i class="fas fa-circle-notch fa-spin"></i>
            </td>
        </tr>

    <!--tr class="time-campeao">
            <td>
                <img src="{{asset('images/brasileirao.png')}}" alt="brasão" height="30px">
                Atletico-MG
            </td>
            <td class="fw-bold">10</td>
            <td>10</td>
            <td>10</td>
            <td>10</td>
            <td>10</td>
            <td>10</td>
            <td>10</td>
            <td>10</td>
        </tr!-->


    </table>

    <script src="{{asset('js/home.js')}}"></script>
@endsection
