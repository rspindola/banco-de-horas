@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form action="/create-schedule" method="post">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="inputEmail4">Data</label>
                        <input type="date" class="form-control" name="date">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputPassword4">Entrada</label>
                        <input type="time" class="form-control" name='startTime'>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputPassword4">Saida</label>
                        <input type="time" class="form-control" name='finishTime'>
                    </div>
                    <div class="form-group col-md-12">
                        <button type="submit">Enviar</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-6">
            @if(isset($schedules))
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>Dia</th>
                        <th>Entrada</th>
                        <th>Saida</th>
                        <th>Total</th>
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
    <div class="row">

    </div>
</div>
@endsection
