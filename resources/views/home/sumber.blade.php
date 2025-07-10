@extends('layouts.main')

@section('container-content')

<h2 class="mb-3">Buku Ajar Historiopreneurship</h2>
<embed src="{{ asset('storage/BUKU_AJAR_HISTORIO.pdf') }}" 
    type="application/pdf" 
    width="100%" 
    height="800px" />

@endsection