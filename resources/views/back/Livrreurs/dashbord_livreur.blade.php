






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
@endpush

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
    
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
      
     
        <div class="row">
         
          <section class="col-lg-12 connectedSortable">

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
      </div><!-- /.container-fluid -->
    </section>
   



<style>

.dashboard-container {
    font-family: Arial, sans-serif;
    margin: 20px;
    text-align: center;
}

.dashboard-cards {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around;
    gap: 20px;
    margin-top: 20px;
}

.dashboard-card {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    width: 250px;
    height: 150px;
    border-radius: 10px;
    color: white;
    text-decoration: none;
    font-size: 16px;
}

.dashboard-card .icon {
    font-size: 24px;
}

.sales { background: linear-gradient(160deg, #FF6384, #FF9F40); }
.purchases { background: linear-gradient(160deg, #36A2EB, #4BC0C0); }
.stock { background: linear-gradient(160deg, #4BC0C0, #36A2EB); }
.production { background: linear-gradient(160deg, #FFCD56, #FF6384); }

</style>



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
