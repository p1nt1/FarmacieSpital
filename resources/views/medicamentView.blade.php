@extends('layouts.app')

@section('content')
    <script>
        $( document ).ready(function() {
            $('#adauga').on('click', function(e){
                e.preventDefault();
                let data = {
                    medicament: $('#medicament').val(),
                    cantitate: $('#cantitate').val(),
                    sectie: $('#sectie').val()
                };

                $('#errorMedicament').text('');
                $('#errorCantitate').text('');
                $('#errorSectie').text('');

                fetch('/api/comanda/create', {
                    method: "POST", // *GET, POST, PUT, DELETE, etc.
                    mode: "cors", // no-cors, cors, *same-origin
                    cache: "no-cache", // *default, no-cache, reload, force-cache, only-if-cached
                    credentials: "same-origin", // include, *same-origin, omit
                    headers: {
                        "Content-Type": "application/json",
                    },
                    redirect: "follow", // manual, *follow, error
                    referrer: "no-referrer", // no-referrer, *client
                    body: JSON.stringify(data)
                })
                    .then(response => response.json())
                    .then((data)=>{
                        let ok = 1;

                        if(data['medicament'] !=  undefined){
                            $('#errorMedicament').text(data['medicament']);
                            ok=0;
                        }

                        if(data['cantitate'] != undefined){
                            $('#errorCantitate').text(data['cantitate']);
                            ok=0;
                        }

                        if(data['sectie'] !=    undefined){
                            $('#errorSectie').text(data['sectie']);
                            ok=0;
                        }

                        if( ok==1 ){
                            window.location.href = "/";
                        }
                    });
            })
        });

        let time = setTimeout(function(){
            window.location.reload(1);
        }, 3000);

        function modalReset(){
            clearTimeout(time);
        }
    </script>
    <div class="container" xmlns:margin="http://www.w3.org/1999/xhtml">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card">
                    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal" onclick="modalReset()">Adauga comanda</button>
                    <div id="myModal" class="modal fade" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header" >
                                    <h4 class="modal-title">Adauga comanda</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="/api/comanda/create">
                                        <div class="form-group row">
                                            <label for="medicament" class="col-md-4 col-form-label text-md-right">Medicament</label>

                                            <div class="col-md-6">
                                                <input id="medicament" type="text" class="form-control" name="medicament" required autofocus>
                                                <span class="invalid-feedback" style="display: block">
                                                    <strong id="errorMedicament"></strong>
                                                </span>

                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="cantitate" class="col-md-4 col-form-label text-md-right">Cantitate</label>

                                            <div class="col-md-6">
                                                <input id="cantitate" type="text" class="form-control" name="cantitate" required>
                                                    <span class="invalid-feedback" style="display: block;">
                                                        <strong id="errorCantitate" ></strong>
                                                    </span>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-4 col-form-label text-md-right">Sectie</label>

                                            <div class="col-md-6">
                                                <select class="form-control" id="sectie" name="sectie" required>
                                                    <option selected disabled>Select sectie</option>
                                                    @if ($sectii->count())
                                                        @foreach ($sectii as $sectie)
                                                            <option value="{{ $sectie->id }}">{{ $sectie->nume }}</option>
                                                        @endforeach
                                                    @endif

                                                </select>
                                                <span class="invalid-feedback" style="display: block;">
                                                        <strong id="errorSectie" ></strong>
                                                    </span>
                                            </div>
                                        </div>



                                        <div class="form-group row mb-0">
                                            <div class="col-md-8 offset-md-5">
                                                <button type="submit" class="btn btn-primary" id="adauga">
                                                    Adauga
                                                </button>

                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-header">Lista comenzi</div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Medicament</th>
                                <th scope="col">Cantitate</th>
                                <th scope="col">Sectie</th>
                                <th scope="col">Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($comenzi as $key => $comanda)
                                <tr>
                                    <th scope="col">{{$key+1}}</th>
                                    <td>{{$comanda->medicament}}</td>
                                    <td>{{$comanda->cantitate}}</td>
                                    <td>{{$comanda->sectie}}</td>
                                    <td>
                                        @if($comanda->status == 0)
                                            <i class="fa fa-circle" style="color: yellow"></i>
                                            @else
                                            @if($comanda->status == 1)
                                                <i class="fa fa-check" style="color: green"></i>
                                                @else
                                                <i class="fa fa-times" style="color: red"></i>
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
