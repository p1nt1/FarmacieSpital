@extends('layouts.app')

@section('content')
    <script>
        function setStatus(event, id, status){
            event.preventDefault();

            let data = {
                id: id,
                status: status
            };

            fetch('/api/comanda/status', {
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
                .then((data)=> {
                    window.location.href = "/";
                })
        }

        setTimeout(function(){
            window.location.reload(1);
        }, 6000);
    </script>
    <div class="container" xmlns:margin="http://www.w3.org/1999/xhtml">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card">
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
                                <th scope="col">Quantity</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($comenzi as $key => $comanda)
                                @if($comanda->status == 0)
                                    <tr>
                                        <th scope="col">{{$key+1}}</th>
                                        <td>{{$comanda->medicament}}</td>
                                        <td>{{$comanda->cantitate}}</td>
                                        <td>{{$comanda->sectie}}</td>
                                        <td>
                                            <i class="fa fa-check" style="color: green; cursor: pointer" onclick="setStatus(event, {{$comanda->id}}, 1)"></i>
                                            <i class="fa fa-times" style="color: red; cursor: pointer" onclick="setStatus(event, {{$comanda->id}}, -1)"></i>
                                        </td>
                                        <td>
                                            {{$comanda->quantity}}
                                        </td>
                                    </tr>
                                @endif

                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
