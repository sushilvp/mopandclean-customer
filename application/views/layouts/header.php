<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <title><?php echo isset($page_title) ? $page_title . ' - ' : ''; ?>MopAndClean</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/app.css'); ?>" rel="stylesheet">
</head>
<body class="app-body">

<!-- Top App Bar -->
<nav class="app-topbar">
    <div class="container-fluid d-flex align-items-center justify-content-between">
        <div class="topbar-brand">
            <img src="<?php echo base_url('assets/img/logo.png'); ?>" alt="MopAndClean" class="topbar-logo">
        </div>
        <div class="topbar-actions">
            <a href="<?php echo base_url('logout'); ?>" class="btn btn-sm btn-outline-light">
                <i class="bi bi-box-arrow-right"></i>
            </a>
        </div>
    </div>
</nav>

<!-- Main Content Area -->
<main class="app-content">
    <div class="container-fluid px-3">
