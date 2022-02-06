@extends('layouts.admin')
@push('css')
    <style>
        /* .highcharts-figure, .highcharts-data-table table {
    min-width: 360px; 
    max-width: 800px;
    margin: 1em auto;
}

.highcharts-data-table table {
	font-family: Verdana, sans-serif;
	border-collapse: collapse;
	border: 1px solid #EBEBEB;
	margin: 10px auto;
	text-align: center;
	width: 100%;
	max-width: 500px;
}
.highcharts-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
}
.highcharts-data-table th {
	font-weight: 600;
    padding: 0.5em;
}
.highcharts-data-table td, .highcharts-data-table th, .highcharts-data-table caption {
    padding: 0.5em;
}
.highcharts-data-table thead tr, .highcharts-data-table tr:nth-child(even) {
    background: #f8f8f8;
}
.highcharts-data-table tr:hover {
    background: #f1f7ff;
} */

    </style>
@endpush
@section('content')
<div class="card shadow mb-4">
    <div class="card-body">
        {{-- <div class="table-responsive"> --}}
            {{-- <table class="table table-bordered" {{ $tableAttr}} width="100%" cellspacing="0">
            </table> --}}
            <figure class="highcharts-figure">
                <div id="income"></div>
                <p class="highcharts-description">
                    Registro histórico de los movimientos de ingresos al inventario.
                </p>
            </figure>
        {{-- </div> --}}
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        {{-- <div class="table-responsive"> --}}
            {{-- <table class="table table-bordered" {{ $tableAttr}} width="100%" cellspacing="0">
            </table> --}}
            <figure class="highcharts-figure">
                <div id="expenses"></div>
                <p class="highcharts-description">
                    Registro histórico de los movimientos de salidas del inventario.
                </p>
            </figure>
        {{-- </div> --}}
    </div>
</div>
@endsection
@push('scripts')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script>
    $.ajax({
        url: '{{route('dashboard.getIncome')}}',
        type: 'GET'
    }).done(function(response) {
        timeSerie(response,'income','Movimientos de Ingresos al Inventario');
    })
    .fail(function() {
        alert( "error" );
    })
    .always(function() {
    });
    $.ajax({
        url: '{{route('dashboard.getExpenses')}}',
        type: 'GET'
    }).done(function(response) {
        timeSerie(response,'expenses','Movimientos de Salidas del inventario');
    })
    .fail(function() {
        alert( "error" );
    })
    .always(function() {
    });
    function timeSerie(data,container,title){
        Highcharts.chart(container, {
            chart: {
                zoomType: 'x'
            },
            title: {
                text: title
            },
            subtitle: {
                text: document.ontouchstart === undefined ?
                    'Haga clic y arrastre en el área de trazado para acercar' : 'Pellizque el gráfico para acercar'
            },
            xAxis: {
                type: 'datetime'
            },
            yAxis: {
                title: {
                    text: 'Movimientos'
                }
            },
            legend: {
                enabled: false
            },
            plotOptions: {
                area: {
                    fillColor: {
                        linearGradient: {
                            x1: 0,
                            y1: 0,
                            x2: 0,
                            y2: 1
                        },
                        stops: [
                            [0, Highcharts.getOptions().colors[0]],
                            [1, Highcharts.color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
                        ]
                    },
                    marker: {
                        radius: 2
                    },
                    lineWidth: 1,
                    states: {
                        hover: {
                            lineWidth: 1
                        }
                    },
                    threshold: null
                }
            },

            series: [{
                type: 'area',
                name: 'Movimientos',
                data: data
            }]
        });
    }
        
</script>
@endpush