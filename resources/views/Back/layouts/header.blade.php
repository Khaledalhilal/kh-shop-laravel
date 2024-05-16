<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>kh Admin- Dashboard</title>
    {{-- <link rel="stylesheet" href="{{URL::asset('Back/assets/css/fontAwsome2.css')}}"> --}}
    <link rel="stylesheet" href="{{URL::asset('Back/assets/vendor/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('Back/assets/vendor/datatables/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('Back/assets/css/sb-admin-2.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('Back/admin/css/bootstrap-select.css')}}">
<style>
    .custom-confirm-button-class {
    background-color: red !important;
    color: white !important;
    font-size: 24px !important;
    border-color:0px red !important;

}
</style>
</head>

