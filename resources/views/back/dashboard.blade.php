
           @php
              $admin = App\Models\Admin::where('id',session('user'))->first();
              @endphp
         
            
@extends('back.app')

@Push('css') 
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{asset('assets/back/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('assets/back/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{asset('assets/back/plugins/jqvmap/jqvmap.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('assets/back/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{asset('assets/back/plugins/daterangepicker/daterangepicker.css')}}">

  <link rel="stylesheet" href="{{asset('assets/back/plugins/fullcalendar-3.9.0/fullcalendar.min.css')}}" />
  <style>
    @media (min-width: 992px) {
    .modal-lg, .modal-xl {
        --bs-modal-width: 830px;
    }
}
  </style>
@endpush


@section('content')
@if(Auth::guard('admin')->check() &&  $admin->role=='admin')


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Tableau de bord</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">coffe-shop</a></li>
              <li class="breadcrumb-item active">Tableau de bord</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
         <div class='row'>
           <!------  machine Disponibles        -->
           <div class="col-lg-3 col-6">
            <div class="small-box  bg-success">
              <div class="inner">
                <p> Rapport café</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <button type="button" class="small-box-footer" data-toggle="modal" data-target="#rapport-cafe" style="border:0px; width:100%">
  Afficher le rapport <i class="fas fa-arrow-circle-right"></i>
</button>

             
            </div>
            <div class="modal fade" id="rapport-cafe" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Rapport café</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <iframe
    src="http://localhost:3000/public/dashboard/5bcabd6c-92de-4ce8-b33c-cf31cd61c25f"
    frameborder="0"
    width="800"
    height="600"
    allowtransparency
></iframe>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
      </div>
    </div>
  </div>
</div>
 </div>
        
          <!-------support ------->
             <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
              <div class="inner">
                <p> Rapport support</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <button type="button" class="small-box-footer" data-toggle="modal" data-target="#rapport-support" style="border:0px; width:100%">
  Afficher le rapport <i class="fas fa-arrow-circle-right"></i>
</button>
            </div>
            <div class="modal fade" id="rapport-support" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Rapport support</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
     
<iframe
    src="http://localhost:3000/public/dashboard/393877c3-ddd6-42dd-8511-17aa3e506ccc"
    frameborder="0"
    width="800"
    height="600"
    allowtransparency
></iframe>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
      </div>
    </div>
  </div>
</div>



          </div>

                 <div class="col-lg-3 col-6">
            <div class="small-box  bg-success">
              <div class="inner">
                <p> Rapport machine</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <button type="button" class="small-box-footer" data-toggle="modal" data-target="#rapport-machine" style="border:0px; width:100%">
  Afficher le rapport <i class="fas fa-arrow-circle-right"></i>
</button>

             
            </div>

            <div class="modal fade" id="rapport-machine" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Rapport machine</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <iframe
    src="http://localhost:3000/public/dashboard/c3867a4f-96e8-4a4f-8295-89117e531f45"
    frameborder="0"
    width="800"
    height="600"
    allowtransparency
></iframe>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
      </div>
    </div>
  </div>
</div>
    </div>
        </div>




        <div class="col-lg-3 col-6">
            <div class="small-box  bg-success">
              <div class="inner">
                <p> Rapport de ce mois</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <button type="button" class="small-box-footer" data-toggle="modal" data-target="#rapport-de-ce-mois" style="border:0px; width:100%">
  Afficher le rapport <i class="fas fa-arrow-circle-right"></i>
</button>

             
            </div>

            <div class="modal fade" id="rapport-de-ce-mois" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Rapport de ce mois</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <iframe
    src="http://localhost:3000/public/dashboard/c1fb59ef-c7d0-4681-a3f6-5fc61b0a75a6"
    frameborder="0"
    width="800"
    height="600"
    allowtransparency
></iframe>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
      </div>
    </div>
  </div>
</div>
    </div>
        </div>



        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
              <h3>    {{ $count_produit = \App\Models\Produit::where('status',1)->count(); }}</h3>
              <p>Liste articles café</p>
              </div>
              <div class="icon">
                <i class="nav-icon fas fa-coffee"></i>
              </div>
              <a href="{{ route('admin.list_produit')}}" class="small-box-footer">Voir plus <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          



          <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
              <div class="inner">
          <h3> {{ $count_machine = \App\Models\Gestion_machine::where('status',1)->count(); }} </h3>

                <p>Liste articles machines</p>
              </div>
              <div class="icon">
                <i class="nav-icon fas fa-hot-tub	"></i>
              </div>
              <a href="{{ route('admin.list_machine')}}" class="small-box-footer">Voir plus <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>





          


                    <!--Support-->

          <div class="col-lg-3 col-6">
            <div class="small-box  bg-info">
              <div class="inner">
                <h3>{{ $support= \App\Models\Support::count()}}</h3>
                <p>Tickets</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="{{ route('admin.list_support')}}" class="small-box-footer">Voir plus <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>


        </div>
     
        <div class="row">
         
          <section class="col-lg-9 connectedSortable">

            <div class="card">
              <div class="card-header border-0">
                <h3 class="card-title">
                  <i class="far fa-calendar-alt"></i>
                  Calendrier des commandes
                </h3>
                
              </div>
              <!-- /.card-header -->
              <div class="card-body pt-0">
                <!--The calendar -->
                <div id="calendar" style="width: 100%"></div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </section>
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div>
    </section>


    @elseif(Auth::guard('admin')->check() &&  $admin->role=='client')
    <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          
    <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>    {{ $count_produit = \App\Models\Produit::where('status',1)->count(); }}</h3>
                <p> articles des café</p>
              </div>
              <div class="icon">
                <i class="fa fa-coffee" style="font-size:48px"></i>

          </div>
          </div>
          </div>

          
          <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
              <div class="inner">
          <h3> {{ $count_machine = \App\Models\Gestion_machine::where('status',1)->count(); }} </h3>
                <p> articles des machines</p>
              </div>
              <div class="icon">
                <i class="nav-icon fas fa-hot-tub "style="font-size:48px"></i>
             
          </div>



          @endif

@stop

@Push('js')


<!-- Bootstrap 4 -->
<script src="{{asset('assets/back/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/back/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>

<!-- AdminLTE for demo purposes -->
<script src="{{asset('assets/back/js/demo.js')}}"></script>
<script src="{{asset('assets/back/plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('assets/back/plugins/fullcalendar-3.9.0/fullcalendar.min.js')}}"></script>
<script src="{{asset('assets/back/plugins/fullcalendar-3.9.0/locale/fr.js')}}"></script>
<script>
  $(document).ready(function () {
    var SITEURL = "{{ route('admin.calendar') }}";
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    var calendar = $('#calendar').fullCalendar({
                     lang: 'fr',
                    editable: true,
                    events: SITEURL,
                    displayEventTime: false,
                    editable: true,
                    eventRender: function (event, element, view) {
                     
                        if (event.allDay === 'true') {
                                event.allDay = true;
                        } else {
                                event.allDay = false;
                        }
                    },
                    selectable: false,
                    selectHelper: false
                  
 
                });
    });

</script>
<style>
  .fc-left h2{
    font-size:1rem;
    text-transform: capitalize;
  }
  .fc-day-number {
    font-size: 13px;
}
</style>
@endpush


