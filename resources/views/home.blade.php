@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
            <div class="col-md-12">
                @include('layouts.message')
            </div>
        <div class="col-md-6">
            <form action="/create-schedule" method="post">
                @csrf
                <div class="form-group row">
                    <label for="inputData" class="col-sm-2 col-form-label">Data</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control @error('date') is-invalid @enderror" name="date"
                            data-toggle="datepicker">

                        @error('date')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEntrada" class="col-sm-2 col-form-label">Entrada</label>
                    <div class="col-sm-10">
                        <input type="time" class="form-control timepicker @error('startTime') is-invalid @enderror"
                            name='startTime'>

                        @error('startTime')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Saida</label>
                    <div class="col-sm-10">
                        <input type="time" class="form-control timepicker @error('finishTime') is-invalid @enderror"
                            name='finishTime'>

                        @error('finishTime')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-success float-right">Enviar</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-6">
            @if(isset($schedules))
            <table id="table_id" class="table table-striped table-bordered nowrap">
                <thead>
                    <tr>
                        <th>Dia</th>
                        <th class="text-right">Entrada</th>
                        <th class="text-right">Saida</th>
                        <th class="text-right">Total</th>
                        <th class="text-right">Acao</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $soma = 0;
                    @endphp
                    @foreach ($schedules as $schedule)
                    @php
                    $startTime = Carbon\Carbon::createFromFormat('H:i', $schedule->startTime);
                    $finishTime = Carbon\Carbon::createFromFormat('H:i', $schedule->finishTime);

                    $tempoTotal = $startTime->diffInMinutes($finishTime) - 540;

                    $tempoTotalHora = ($tempoTotal > 0 ? floor($tempoTotal / 60) : ceil($tempoTotal / 60));
                    $tempoTotalMinutos = substr('0' . $tempoTotal % 60, -2);

                    $soma += $tempoTotal;
                    @endphp
                    <tr>
                        <td>{{Carbon\Carbon::parse($schedule->date)->format('d/m/Y') }}</td>
                        <td class="text-right">{{$schedule->startTime}}</td>
                        <td class="text-right">{{Carbon\Carbon::parse($schedule->finishTime)->format('H:i')}}</td>
                        {{-- <td class="text-right">{{ Carbon\Carbon::parse(
                            (new Carbon\Carbon($schedule->startTime))
                                ->diff(new Carbon\Carbon($schedule->finishTime))
                                ->format('%h:%I'))->format('H:i') }}</td> --}}
                        <td class="text-right">
                            {{$tempoTotalHora}}:{{$tempoTotalMinutos}}
                        </td>
                        <td class="text-right">
                            <a href="javascript:;" 
                                class="edit-modal"
                                data-id="{{$schedule->id}}"
                                data-date="{{$schedule->date}}" 
                                data-starttime="{{$schedule->startTime}}" 
                                data-finishtime="{{$schedule->finishTime}}">
                                    Editar
                            </a>
                            <a href="javascript:;" 
                                data-toggle="modal" 
                                onclick="deleteData({{$schedule->id}})"
                                data-target="#DeleteModal" 
                                class="btn btn-default"
                                data-original-title="Excluir" 
                                data-container="body">Excluir</a>
                        </td>
                    </tr>
                    @endforeach
                <tfoot>
                    @php
                    $somaHora = ($soma > 0 ? floor($soma / 60) : ceil($soma / 60));
                    $somaMinutos = substr('0' . $soma % 60, -2);
                    @endphp
                    <td colspan="4" class="text-right">
                        <p class="font-weight-bold {{($soma > 0 ? 'text-success' : 'text-danger')}}">
                            <b>{{$somaHora}}:{{$somaMinutos}}</b>
                        </p>
                    </td>
                </tfoot>
                </tbody>
            </table>
            @endif
        </div>
    </div>
</div>
@include('layouts.delete')
@include('layouts.edit')
@stop
