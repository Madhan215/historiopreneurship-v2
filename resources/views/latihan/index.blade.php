@extends('layouts.main')

@section('container')



<?php
    $_SESSION['data_soal'] = json_decode($soal->data_soal, true);
    // dd($_SESSION['data_soal']);
    $_SESSION['soal_sekarang'] = 0;
    $_SESSION['jawaban'] = 0;
    $_SESSION['nilai'] = 0;

    

    header('Location: latihan.blade.php');
    exit();
?>

@endsection