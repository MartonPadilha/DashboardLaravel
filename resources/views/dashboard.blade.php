@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
  <div class="content">
    <div class="container-fluid bi">
        <iframe width="933" height="700" src="https://app.powerbi.com/view?r=eyJrIjoiOWY3ZTg4NTQtY2U2NC00ZjZjLWJiNmEtZDVjYTg3NmQzNjU4IiwidCI6IjBiM2U3MTBhLTNhN2UtNGY4NC1iZGJlLWVmZmFmMTlkMTliMyJ9" frameborder="0" allowFullScreen="true"></iframe>
    </div>
  </div>

  <style>
    .bi {
    position: absolute;
    padding-bottom: 56.25%; /* 16:9 */
    padding-top: 25px;
    height: 0;
  }
  .bi iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
  }
  </style>

@endsection
