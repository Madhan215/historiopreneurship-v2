@extends('layouts.main')

@section('container')

<div class="mt-3">
    <div class="row mt-3">
        <div class="col">
            <label for="kuis">Tugas</label><br>
            <textarea name="kuis" id="kuis" rows="5"></textarea>
            <button class="btn btn-primary mt-3">Kirim</button>
        </div>
    </div>
</div>

@endsection