@extends('layouts.app')

@section('content')
<h2>Tiket Saya</h2>
<ul>
    @foreach($tiket as $t)
    <li>
        {{ $t->konser->nama }} - {{ $t->kode_tiket }} - Status: {{ $t->status }}
    </li>
    @endforeach
</ul>
@endsection
