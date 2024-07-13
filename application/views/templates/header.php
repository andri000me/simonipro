<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $title; ?></title>
  <link rel="shortcut icon" type="image/png" href="<?= base_url('assets'); ?>/images/logos/favicon-simonipro.svg" />
  <link rel="stylesheet" href="<?= base_url('assets'); ?>/css/styles.min.css" />
  <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fullcalendar/core@4.2.0/main.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@4.3.0/main.min.css">

  <!-- tinymce -->
  <script src="https://cdn.tiny.cloud/1/sbwlx6m5ktmt8l626anfszcsc028bdt59l7vlab651y2mnt1/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
  <script>
    // tinymce
    tinymce.init({
      selector: 'textarea#tiny',
      height: 300,
      plugins:[
        'autolink', 'lists'
      ],
      toolbar: 'undo redo | bold italic underline | alignleft aligncenter alignright alignjustify |' + 
      'bullist numlist',
      menubar: 'favs',
    });
  </script>
</head>

<body>

<?php 
  function getShortProdi($nama_prodi) {
      $words = explode(' ', $nama_prodi);
      $shortProdi = '';
      foreach ($words as $word) {
          $shortProdi .= strtoupper($word[0]);
      }
      return $shortProdi;
  }
?>