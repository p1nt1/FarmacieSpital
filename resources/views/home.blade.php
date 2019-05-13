@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    <form method="POST" action="/api/comanda/create">
                        @csrf

                        <div class="form-group row">
                            <label for="medicament" class="col-md-4 col-form-label text-md-right">Medicament</label>

                            <div class="col-md-6">
                                <input id="medicament" type="text" class="form-control{{ $errors->has('medicament') ? ' is-invalid' : '' }}" name="medicament" required autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="cantitate" class="col-md-4 col-form-label text-md-right">Cantitate</label>

                            <div class="col-md-6">
                                <input id="cantitate" type="text" class="form-control{{ $errors->has('cantitate') ? ' is-invalid' : '' }}" name="cantitate" required>
                            </div>
                        </div>

                        <div class="form-group row">

                            <label class="col-md-4 col-form-label text-md-right">Sectie</label>

                            <div class="col-md-6">
                                <select class="form-control" id="sectie" name="sectie">
                                    <option selected disabled>Select sectie</option>
                                    @if ($list->count())
                                        @foreach ($list as $sectie)
                                            <option value="{{ $sectie->id }}">{{ $sectie->nume }}</option>
                                        @endforeach
                                    @endif

                                </select>
                            </div>
                        </div>



                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-5">
                                <button type="submit" class="btn btn-primary">
                                    Adauga
                                </button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
