@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-3">
            @include('layouts.menu')
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    Administracija korisnika

                    <button type="button" class="btn btn-sm btn-outline-secondary float-right" data-toggle="modal" data-target="#addUsersModal">
                        <i class="far fa-plus-square"></i>
                        Dodaj korisnika
                    </button>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <table class="table table-sm table-striped table-condensed table-hover">
                        <thead>
                            <tr>
                                <th>#ID</th>
                                <th>Ime korisnika</th>
                                <th>Prezime korisnika</th>
                                <th>UID korisnika</th>
                                <th>Email korisnika</th>
                                <th>Uloga korisnika</th>
                                <th>Akcije</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td class="align-middle">{{ $user->id }}</td>
                                <td class="align-middle">{{ $user->name }}</td>
                                <td class="align-middle">{{ $user->surname }}</td>
                                <td class="align-middle">{{ $user->oid }}</td>
                                <td class="align-middle">{{ $user->email }}</td>
                                <td class="align-middle">{{ $user->role }}</td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                    <a id="editUserBtn" href="{{ route("users.get", $user->id)}}" class="btn btn-sm btn-outline-secondary"><i class="far fa-edit"></i> Uredi</a>
                                    <a href="{{ route("users.delete", $user->id)}}" class="btn btn-sm btn-outline-danger"><i class="far fa-trash-alt"></i> Pobriši</a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="modal  fade" id="addUsersModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel" aria-hidden="true">
                        <form id="addUsersForm" method="POST" action="{{ route('users.store') }}" >
                            @csrf
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addUserModalLabel">Korisnici</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Zatvori">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="name">Ime korisnika</label>
                                        <input type="hidden" id="id" name="id" />
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name') }}" placeholder="Unesite ime korisnika">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="surname">Prezime korisnika</label>
                                        <input type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" id="surname" placeholder="Unesite prezime korisnika">
                                        @error('surname')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="name">JMBG korisnika</label>
                                        <input type="text" class="form-control @error('oid') is-invalid @enderror" name="oid" id="oid" placeholder="Unesite prezime korisnika">
                                        @error('oid')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Email korisnika</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Unesite email korisnika">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="role">Uloga korisnika</label>
                                        <select class="form-control @error('role') is-invalid @enderror" name="role" id="role" placeholder="Odaberite ulogu">
                                            <option value="nastavnik">Nastavnik</option>
                                            <option value="administrator">Administrator</option>
                                            <option value="učenik">Učenik</option>
                                        </select>
                                        @error('role')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Lozinka korisnika</label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="Unesite lozinku">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="password_confirmation">Ponovite lozinku korisnika</label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password_confirmation" id="password_confirmation" placeholder="Ponovite lozinku">
                                    </div>
                                    @error('password_confirmation')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Zatvori</button>
                                    <button id="addUserBtn" type="submit" class="btn btn-primary">Spasi podatke</button>
                                </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
