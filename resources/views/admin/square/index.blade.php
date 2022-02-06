@extends('layouts.admin')
{{-- @push('css')
<link id="bsdp-css" href="https://unpkg.com/bootstrap-datepicker@1.9.0/dist/css/bootstrap-datepicker3.min.css" rel="stylesheet">
@endpush --}}
@section('content')

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <div class="py-3 d-flex justify-content-between align-items-end">
                <div class="form-inline">
                    {{-- <input id="report_date" placeholder="Fecha" type="text" class="date-report form-control"> --}}
                    <select class="form-control ml-1" id="report_type">
                        {{-- <option value="sale">Ventas</option>
                        <option value="buy">Compras</option> --}}
                        <option value="in">Entrada</option>
                        <option value="out">Salida</option>
                    </select>
                    <button onclick="openModalReport()" class="btn btn-primary ml-1">Reporte</button>
                </div>
                <div>
                    <button type="button" onclick="modal('{{route('squares.create').'?param=1'}}','Nuevo Movimiento',1000)" class="btn btn-primary"><i class="fas fa-plus"></i> Movimiento</button>
                    {{-- <button  onclick="modal('{{route('squares.create').'?param=2'}}','Nuevo Movimiento',1000)" class="btn btn-primary"><i class="fas fa-plus"></i> Compra</button>
                    <button onclick="modal('{{route('squares.create').'?param=3'}}','Nuevo Movimiento',1000)" class="btn btn-primary"><i class="fas fa-plus"></i> Venta</button> --}}
                </div>
            </div>
        </div>
    </div>
</div>

@component("components.tableOne")
    @slot("title","Control de Stock")
    @slot("btnAttr")
        style="display: none;"
    @endslot
    @slot("btnName","Nuevo Movimiento")
    @slot("tableAttr")
        id="squareTable"
    @endslot
    @slot("tableHeaders")
        <tr>
            <th scope="col"># <span class="oi oi-caret-bottom"></span><span class="oi oi-caret-top"></span></th>
            <th scope="col">Fecha<span class="oi oi-caret-bottom"></span><span class="oi oi-caret-top"></span></th>
            <th scope="col">Tipo<span class="oi oi-caret-bottom"></span><span class="oi oi-caret-top"></span></th>
            <th scope="col">Comentario<span class="oi oi-caret-bottom"></span><span class="oi oi-caret-top"></span></th>
            <th scope="col" class="text-center th-actions">Acciones</th>
        </tr>
    @endslot
@endcomponent
@endsection
@push('scripts')
    {{-- <script src="https://unpkg.com/bootstrap-datepicker@1.9.0/dist/js/bootstrap-datepicker.min.js"></script>
    <script>
        $('.date-report').datepicker({
            format: 'yyyy-mm-dd',
        });
    </script> --}}
    <script>
        let squareTable = tableOne(
            "squareTable",
            "{{route('squares.table')}}",
            [
                {data: 'id'},
                {data: 'created_at'},
                {data: 'type',render: function(type){
                        if(type=='in'){
                            return "{{ \App\Models\SquareType::getList()['in'] }}";
                        }if(type=='out'){
                            return "{{ \App\Models\SquareType::getList()['out'] }}";
                        }
                    }},
                {data: 'commentary',render: function(commentary){
                    if(commentary==null || commentary==""){
                        return "---";
                    }else{
                        return commentary;
                    }
                }},
                {data: 'actions',class:"text-center",orderable:false},
            ],
            [ 1, 'desc' ]
        );
    </script>
    <script>
        function openModalReport(){
            // let reportDate= $("#report_date").val();
            let reportType= $("#report_type").val();
            // if(reportDate==""){
            //     toastr.error('Ingrese una fecha', 'Error:');
            //     return;
            // }
            //modal('{{route('squares.report')}}?date='+reportDate+'&type='+reportType,'Reporte',1000);
        }
    </script>
@endpush
