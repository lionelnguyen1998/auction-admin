<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>{{ $title }}</title>

<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome -->
<link rel="stylesheet" href="/template/admin/plugins/fontawesome-free/css/all.min.css">
<!-- flag-icon-css -->
<link rel="stylesheet" href="/template/admin/plugins/flag-icon-css/css/flag-icon.min.css">
<!-- icheck bootstrap -->
<link rel="stylesheet" href="/template/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="/template/admin/dist/css/adminlte.min.css">
<!-- summernote -->
<link rel="stylesheet" href="/template/admin/plugins/summernote/summernote-bs4.min.css">
<!-- overlayScrollbars -->
<link rel="stylesheet" href="/template/admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
<!-- BS Stepper -->
<link rel="stylesheet" href="/template/admin/plugins/bs-stepper/css/bs-stepper.min.css">
<!-- DataTables -->
<link rel="stylesheet" href="/template/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="/template/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="/template/admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

<!-- Toastr -->
<link rel="stylesheet" href="/template/admin/plugins/toastr/toastr.min.css">

<meta name="csrf-token" content="{{ csrf_token() }}">

@yield('header')

<style>
    .hidden {
        display: none;
    }
</style>
</head>
