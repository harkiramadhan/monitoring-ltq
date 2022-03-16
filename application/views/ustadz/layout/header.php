<!--
=========================================================
* Argon Dashboard 2 - v2.0.0
=========================================================

* Product Page: https://www.creative-tim.com/product/argon-dashboard
* Copyright 2022 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url('/assets/img/apple-icon.png') ?>">
  <link rel="icon" type="image/png" href="<?= base_url('/assets/img/favicon.png') ?>">
  <title><?= $title ?></title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <link href="<?= base_url('/assets/css/style.css') ?>" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="<?= base_url('/assets/css/nucleo-icons.css') ?>" rel="stylesheet" />
  <link href="<?= base_url('/assets/css/nucleo-svg.css') ?>" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="<?= base_url('/assets/css/nucleo-svg.css') ?>" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="<?= base_url('/assets/css/argon-dashboard.min.css?v=2.0.0') ?>" rel="stylesheet" />
  <!-- Anti-flicker snippet (recommended)  -->
  <!-- <style>
    .async-hide {
      opacity: 0 !important
    }
  </style>
  <script>
    (function(a, s, y, n, c, h, i, d, e) {
      s.className += ' ' + y;
      h.start = 1 * new Date;
      h.end = i = function() {
        s.className = s.className.replace(RegExp(' ?' + y), '')
      };
      (a[n] = a[n] || []).hide = h;
      setTimeout(function() {
        i();
        h.end = null
      }, c);
      h.timeout = c;
    })(window, document.documentElement, 'async-hide', 'dataLayer', 4000, {
      'GTM-K9BGS8K': true
    });
  </script> -->
</head>

<body class="g-sidenav-show  bg-gray-100">
  <div class="min-height-300 bg-primary position-absolute w-100"></div>
  <aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
    </div>
    <div class="collapse navbar-collapse w-auto mt-n6" id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link <?= ($this->uri->segment(1) == 'dashboard') ? 'active' : '' ?>" href="<?= site_url('dashboard') ?>">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1"><strong>Dashboard</strong></span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= ($this->uri->segment(1) == 'tahunajar') ? 'active' : '' ?>" href="<?= site_url('tahunajar') ?>">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-calendar-grid-58 text-warning text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1"><strong>Semester</strong></span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= ($this->uri->segment(1) == 'guru') ? 'active' : '' ?>" href="<?= site_url('guru') ?>">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-world-2 text-danger text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1"><strong>Guru</strong></span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= ($this->uri->segment(1) == 'siswa') ? 'active' : '' ?>" href="<?= site_url('siswa') ?>">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-world-2 text-danger text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1"><strong>Siswa</strong></span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= ($this->uri->segment(1) == 'kelas') ? 'active' : '' ?>" href="<?= site_url('kelas') ?>">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-credit-card text-success text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1"><strong>Kelas</strong></span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= ($this->uri->segment(1) == 'kegiatan') ? 'active' : '' ?>" href="<?= site_url('kegiatan') ?>">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-app text-info text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1"><strong>Kegiatan</strong></span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= ($this->uri->segment(1) == 'materi') ? 'active' : '' ?>" href="<?= site_url('materi') ?>">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-app text-info text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1"><strong>Materi</strong></span>
          </a>
        </li>
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Lainnya</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= ($this->uri->segment(1) == 'user') ? 'active' : '' ?>" href="<?= site_url('user') ?>">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1"><strong>Pengguna</strong></span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="<?= site_url('logout') ?>">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-spaceship text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1"><strong>Logout</strong></span>
          </a>
        </li>
      </ul>
    </div>
  </aside>
  <main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
      <div class="container-fluid py-1 px-3">
        <?php if($tahunajar): ?>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-2 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm text-white active" aria-current="page"><h6 class="font-weight-bolder text-white mb-0">Semester Aktif</h6></li>
          </ol>
          <h6 class="font-weight-bolder text-white mb-0"><?= $tahunajar->tahun_awal."/".$tahunajar->tahun_akhir." - Semester ". $tahunajar->semester ?></h6>
        </nav>
        <?php endif; ?>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <!-- <div class="input-group">
              <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
              <input type="text" class="form-control" placeholder="Type here...">
            </div> -->
          </div>
          <ul class="navbar-nav  justify-content-end">
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center me-3">
              <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line bg-white"></i>
                  <i class="sidenav-toggler-line bg-white"></i>
                  <i class="sidenav-toggler-line bg-white"></i>
                </div>
              </a>
            </li>
            <li class="nav-item dropdown pe-2 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-white p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-user me-sm-1"></i>
                &nbsp;&nbsp;<span class="d-sm-inline d-none"><strong><?= $this->session->userdata('nama') ?></strong></span>
              </a>
              <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
                <div class=" dropdown-header noti-title">
                  <h6 class="text-overflow m-0"><?= $lembaga->nama ?></h6>
                </div>
                <li>
                  <a class="dropdown-item border-radius-md" href="#">
                    <div class="d-flex py-1">
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="text-sm font-weight-normal mb-1">
                          <i class="fas fa-credit-card"></i> &nbsp;&nbsp; Profile
                        </h6>
                      </div>
                    </div>
                  </a>
                </li>
                <hr class="my-2">
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <?php if($this->session->userdata('sukses')): ?>
        <div class="alert bg-success text-white" role="alert">
          <strong><?= $this->session->flashdata("sukses") ?></strong>
        </div>
      <?php endif; ?>

      <?php if($this->session->userdata('error')): ?>
        <div class="alert bg-danger text-white" role="alert">
          <strong><?= $this->session->flashdata("error") ?></strong>
        </div>
      <?php endif; ?>