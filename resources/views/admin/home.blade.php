@extends('admin.main')
@section('content')
<div class="container-fluid mt-3">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
          <div class="inner">
            <h3>{{ $total_today }}</h3>

            <p>New Orders Today</p>
          </div>
          <div class="icon">
            <i class="ion ion-bag"></i>
          </div>
          <a href="{{ route('cart.list') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
          <div class="inner">
            <h3>53<sup style="font-size: 20px">%</sup></h3>

            <p>Bounce Rate</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <a href="{{ route('cart.list') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
          <div class="inner">
            <h3>{{ $total_customer }}</h3>

            <p>Total Order</p>
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
          <a href="{{ route('cart.list') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
          <div class="inner">
            <h3>{{ $total_visitor }}</h3>

            <p>Unique Visitors</p>
          </div>
          <div class="icon">
            <i class="ion ion-pie-graph"></i>
          </div>
          <a href="{{ route('cart.list') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
    </div>
    <!-- /.row -->
    <!-- Main row -->
    <div class="row"> 
        <form autocomplete="off">
          @csrf
          <div class="form-row">
            <div class="col-md-4 form-group">
              <p>Form: <input class="form-control" type="text" id="datepicker"></p>
            </div>
            <div class="col-md-4 form-group">
              <p>To: <input class="form-control" type="text" id="datepicker2"></p>
            </div>
            <div class="col-md-2 form-group">
              <p>Change<input type="button" name="btn-dashboard-filter" id="btn-dashboard-filter" class="btn btn-info form-control" value="Submit"></p>
            </div>
            <div class="col-md-2 form-group">
              <p>Filter by:
                <select class="form-select dashboard-filter">
                  <option value="">__Choose__</option>
                  <option value="7days">7 ngày qua</option>
                  <option value="lastmonth">Tháng trước</option>
                  <option value="currentmonth">Tháng này</option>
                  <option value="365days">365 ngày qua</option>
                </select>
              </p>
            </div>
          </div>
        </form>
     
    </div>
    <div class="row">
      <!-- Left col -->
      <p class="ml-3 text-center"><i><strong class="title-chart ">Biểu đồ doanh thu trong 30 ngày qua</strong></i></p>
      <section class=" connectedSortable ui-sortable" style="height:300px" id="SaleChart">  
      </section>
      
      <!-- /.Left col -->

    </div>
    <!-- /.row (main row) -->
  </div>

@endsection
@section('footer')

    {{-- SETTING FILTER DATE --}}
    <script>
      $( function() {
        $( "#datepicker" ).datepicker(
          {
            dateFormat: "yy-mm-dd",
            duration: "slow"
          }
        );
        $( "#datepicker2" ).datepicker(
          {
            dateFormat: "yy-mm-dd",
            duration: "slow"
          }
        );
      } );
    </script>
     {{-- END SETTING FILTER DATE --}}
     <script>
      $(document).ready(function(){
          chart30day_sorder();
          var chart = new Morris.Area({
          // ID of the element in which to draw the chart.
          element: 'SaleChart',
          // Chart data records -- each entry in this array corresponds to a point on
          // the chart.
          // The name of the data record attribute that contains x-values.
          xkey: 'period',
          // A list of names of data record attributes that contain y-values.
          ykeys: ['order','qty','sales'],
          // Labels for the ykeys -- will be displayed when you hover over the
          // chart.
          labels: ['Đơn hàng', 'Số lượng', 'Doanh số']
        });
        function chart30day_sorder(){
          var _token = $('input[name="_token"]').val();
          $.ajax({
            url: "{{ url('admin/days-order') }}",
            method: "POST",
            dataType: 'JSON',
            data: {_token:_token},
            success: function(data){
              chart.setData(data);
            }
          })
        }
        $('.dashboard-filter').change(function(){
          var filter = $(this).val();
          var text = $(".dashboard-filter option:selected").text();
          var _token = $('input[name="_token"]').val();
          if(filter != ''){
              $.ajax({
              url: "{{ url('admin/dashboard-filter') }}",
              method: "POST",
              dataType: 'JSON',
              data: {_token:_token,filter:filter},
              success: function(data){
                $('.title-chart').html('Biểu đồ danh thu trong '+text);
                chart.setData(data);
              }
            })
          }
          chart30day_sorder();
        });
        $('#btn-dashboard-filter').click(function(){
          var _token = $('input[name="_token"]').val();
          var from_date = $('#datepicker').val();
          var to_date= $('#datepicker2').val();
          $.ajax({
            url:"{{ url('admin/filter-by-date') }}",
            method: 'POST',
            dataType: 'JSON',
            data: {form_date:from_date,to_date:to_date,_token:_token},
            success: function(data){
            chart.setData(data);
            }
          })
        })
      });
      
     </script>
    
@endsection