@extends('layouts.app')
@section('title','Imprint')

@section('customStyles')
    <style>
        .container {
            background-color: white;
            margin-top: 5rem;
            padding: 2.5rem;
            border-radius: 10px;
            width: 35rem;
            text-align: center;
        }
    </style>
@endsection

@section('content')

    <div class="bs-docs-section container">
        <h1 id="kontakt">Contact Information</h1>
        <address>
            <strong>Martin Dallinger</strong><br>
            Loitzendorf 31<br>
            3643 Maria Laach<br>
            <abbr title="Telefonnummer">Tel.:</abbr> +00000000000<br>
            <abbr title="Email-Adresse">E-Mail:</abbr> <a href="mailto:martin.dallinger@sz-ybbs.ac.at">martin.dallinger@sz-ybbs.ac.at</a>
        </address>
    </div>
@endsection
