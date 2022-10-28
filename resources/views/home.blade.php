@extends('layouts.master')

@section("title")
    <meta content="" name="description">
    <meta content="" name="keywords">

    <title>Dashboard | {{ env('MY_SITE_NAME') }}</title>


<!-- tags style and css and js, start here-->
  <style type="text/css">
        .bootstrap-tagsinput{
            width: 100%;
        }
        .label-info{
            background-color: #17a2b8;

        }
        .label {
            display: inline-block;
            padding: .25em .4em;
            font-size: 75%;
            font-weight: 700;
            line-height: 1;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: .25rem;
            transition: color .15s ease-in-out,background-color .15s ease-in-out,
            border-color .15s ease-in-out,box-shadow .15s ease-in-out;
        }


        /*error sweetalert, start here*/
        .swal-text {
            font-size: 16px;
            position: relative;
            float: none;
            line-height: normal;
            vertical-align: top;
            text-align: center;
            display: inline-block;
            margin: 0;
            padding: 0 10px;
            font-weight: 400;
            color: rgba(0,0,0,.64);
            max-width: calc(100% - 20px);
            overflow-wrap: break-word;
            box-sizing: border-box;
        }
        /*error sweetalert, end here*/

    </style>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" integrity="sha512-xmGTNt20S0t62wHLmQec2DauG9T+owP9e6VU8GigI0anN7OXLip9i7IwEhelasml2osdxX71XcYm6BQunTQeQg==" crossorigin="anonymous" />
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js" integrity="sha512-VvWznBcyBJK71YKEKDMpZ0pCVxjNuKwApp4zLF3ul+CiflQi6aIJR+aZCP/qWsoFBA28avL5T5HA+RE+zrGQYg==" crossorigin="anonymous"></script>
  <!-- tags style and css and js, end here-->

@endsection


@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
          <h1>Dashboard</h1>
          <nav>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.html">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </nav>
        </div><!-- End Page Title -->


        @if((Auth::user()->role_id=='8') || (Auth::user()->role_id=='7') || (Auth::user()->role_id=='6'))
        

        <!-- filter section, start here -->
        <label>Filter</label>
              <form method="get" action="{{ route('home.filter')}}" class="row">
                
                <div class="col-md-4 position-relative ">
                  <select class="form-select fontSize12" name="company_id_filter" id="company_id_filter">
                    <option value="">-- Select Company --</option>
                    @foreach($company_names as $company_name_filter)
                    <option value="{{$company_name_filter['id']}}" @if(request()->get('company_id_filter')==$company_name_filter['id']) selected @endif>{{$company_name_filter['name']}}</option>
                    @endforeach
                  </select>
                </div>
               

                  <input type="submit" name="submit" value="Filter" class="btn btn-primary filter_submit_btn">

                  <a href="{{ url('/home') }}" class="filter_clear_btn">
                    <input type="button" name="button" value="Clear" class="btn btn-info filter_clear_btn2">
                  </a>

              </form>
              <!-- filter section, end here -->
              
              <div style="clear: both; height: 10px;"></div>

        <section class="section">
          <div class="row">

            <!-- gender graph, start here -->
            <div class="col-lg-6">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Classification As Per Gender</h5>

                  <!-- Vertical Bar Chart -->
                  <div id="verticalBarChart" style="min-height: 400px;" class="echart"></div>

                  <script>
                    document.addEventListener("DOMContentLoaded", () => {
                      echarts.init(document.querySelector("#verticalBarChart")).setOption({
                        title: {
                          text: ''
                        },
                        tooltip: {
                          trigger: 'axis',
                          axisPointer: {
                            type: 'shadow'
                          }
                        },
                        legend: {},
                        grid: {
                          left: '3%',
                          right: '4%',
                          bottom: '3%',
                          containLabel: true
                        },
                        xAxis: {
                          type: 'value',
                          boundaryGap: [0, 0.01]
                        },
                        yAxis: {
                          type: 'category',
                          data: ['Female', 'Male']
                        },
                        series: [
                        <?php 

                        
                        foreach ($company_locations as $company_location_name) { 

                          $no_male=0;
                          $no_female=0;

                          foreach ($user_genders as $key => $value_genders) {

                            if($company_location_name["id"]==$value_genders["company_location_id"]){

                              if($value_genders["gender"]=='Male') {
                                $no_male=$no_male+1;
                              } else if($value_genders["gender"]=='Female') {
                                $no_female=$no_female+1;
                              }
                            }
                          }
                          ?>
                          {
                            name: '<?php echo $company_location_name["name"]?>',
                            type: 'bar',
                            indexLabel: "{x}, {y}",
                            data: ['<?php echo $no_female?>', '<?php echo $no_male?>'],
                            label: {
                                show: true,
                                position: 'right',
                                color: "black",
                                fontSize:12,
                            }
                          },
                        <?php } ?>
                        ]
                      });
                    });
                  </script>
                  <!-- End Vertical Bar Chart -->

                </div>
              </div>
            </div>
            <!-- gender graph, end here -->



            <!-- Appraisal Cycle graph, start here -->
            <div class="col-lg-6">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Appraisal Cycle</h5>

                  <!-- Vertical Bar Chart -->
                  <div id="verticalBarChartAppraisal" style="min-height: 400px;" class="echart"></div>

                  <script>
                    document.addEventListener("DOMContentLoaded", () => {
                      echarts.init(document.querySelector("#verticalBarChartAppraisal")).setOption({
                        title: {
                          text: ''
                        },
                        tooltip: {
                          trigger: 'axis',
                          axisPointer: {
                            type: 'shadow'
                          }
                        },
                        legend: {},
                        grid: {
                          left: '3%',
                          right: '4%',
                          bottom: '3%',
                          containLabel: true
                        },
                        xAxis: {
                          type: 'value',
                          boundaryGap: [0, 0.01]
                        },
                        yAxis: {
                          type: 'category',
                          data: [<?php foreach ($company_locations as $company_location_name) { ?>'<?php echo $company_location_name["name"]?>',<?php } ?>]
                        },

                        <?php 
                          $no_guru_apr=0;
                          $no_guru_oct=0;

                          $no_moh_apr=0;
                          $no_moh_oct=0;

                          foreach ($user_appraisal_cycle as $key => $user_appraisal_cycles) {

                            $cycle = date('m-d', strtotime($user_appraisal_cycles["appraisal_cycle"]));

                              if($user_appraisal_cycles["company_location_id"]==1){

                                if($cycle==date('Y-04-01')){
                                  $no_guru_apr=$no_guru_apr+1;
                                } else if($cycle==date('Y-10-01')){
                                  $no_guru_oct=$no_guru_oct+1;
                                }
                                  
                              } else if($user_appraisal_cycles["company_location_id"]==2){

                                if($cycle==date('Y-04-01')){
                                  $no_moh_apr=$no_moh_apr+1;
                                } else if($cycle==date('Y-10-01')){
                                  $no_moh_oct=$no_moh_oct+1;
                                }

                              }
                          }

                         ?>


                        series: [
                          {
                            name: 'Apr-<?php echo date("y");?>',
                            type: 'bar',
                            data: [<?php echo $no_guru_apr?>, <?php echo $no_moh_apr?>],
                            label: {
                                show: true,
                                position: 'right',
                                color: "black",
                                fontSize:12,
                            }
                          },
                          {
                            name: 'Oct-<?php echo date("y");?>',
                            type: 'bar',
                            data: [<?php echo $no_guru_oct?>, <?php echo $no_moh_oct?>],
                            label: {
                                show: true,
                                position: 'right',
                                color: "black",
                                fontSize:12,
                            }
                          }
                        ]
                      });
                    });
                  </script>
                  <!-- End Vertical Bar Chart -->

                </div>
              </div>
            </div>
            <!-- Appraisal Cycle graph, end here -->

            <!-- Employee Status graph, start here -->
            <div class="col-lg-6">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Member Status</h5>

                  <!-- Vertical Bar Chart -->
                  <div id="verticalBarChartEmployeeStatus" style="min-height: 400px;" class="echart"></div>

                  <script>
                    document.addEventListener("DOMContentLoaded", () => {
                      echarts.init(document.querySelector("#verticalBarChartEmployeeStatus")).setOption({
                        title: {
                          text: ''
                        },
                        tooltip: {
                          trigger: 'axis',
                          axisPointer: {
                            type: 'shadow'
                          }
                        },
                        legend: {},
                        grid: {
                          left: '3%',
                          right: '4%',
                          bottom: '3%',
                          containLabel: true
                        },
                        yAxis: {
                          type: 'value',
                          boundaryGap: [0, 0.01]
                        },
                        xAxis: {
                          type: 'category',
                          data: [<?php foreach ($company_locations as $company_location_name) { ?>'<?php echo $company_location_name["name"]?>',<?php } ?>]
                        },

                        <?php 
                          $no_guru_conf=0;
                          $no_guru_prob=0;

                          $no_moh_conf=0;
                          $no_moh_prob=0;

                          foreach ($all_users as $key => $all_user_name) {

                            //$cycle = date('m-d', strtotime($user_appraisal_cycles["appraisal_cycle"]));

                              if($all_user_name["company_location_id"]==1){

                                if($all_user_name["employee_type"]=='Confirmed') {
                                  $no_guru_conf=$no_guru_conf+1;
                                } else if($all_user_name["employee_type"]=='Probation') {
                                  $no_guru_prob=$no_guru_prob+1;
                                }
                                  
                              } else if($all_user_name["company_location_id"]==2){

                                if($all_user_name["employee_type"]=='Confirmed') {
                                  $no_moh_conf=$no_moh_conf+1;
                                } else if($all_user_name["employee_type"]=='Probation') {
                                  $no_moh_prob=$no_moh_prob+1;
                                }

                              }
                          }

                         ?>

                        series: [{
                            name: 'Confirmed',
                            type: 'bar',
                            data: ['<?php echo $no_guru_conf?>', '<?php echo $no_moh_conf?>'],
                            label: {
                                show: true,
                                position: 'top',
                                color: "black",
                                fontSize:12,
                            }
                          },
                          {
                            name: 'Probation',
                            type: 'bar',
                            data: ['<?php echo $no_guru_prob?>', '<?php echo $no_moh_prob?>'],
                            label: {
                                show: true,
                                position: 'top',
                                color: "black",
                                fontSize:12,
                            }
                          }
                        ]
                      });
                    });
                  </script>
                  <!-- End Vertical Bar Chart -->

                </div>
              </div>
            </div>
            <!-- Employee Status graph, end here -->


            <!-- Key Player graph, start here -->
            <div class="col-lg-6">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Key Player</h5>

                  <!-- Pie Chart -->
                  <div id="pieChart"></div>

                  <script>
                    document.addEventListener("DOMContentLoaded", () => {
                      new ApexCharts(document.querySelector("#pieChart"), {
                        series: [44, 55, 13, 43, 22],
                        chart: {
                          height: 350,
                          type: 'pie',
                          toolbar: {
                            show: true
                          }
                        },
                        labels: ['Team A', 'Team B', 'Team C', 'Team D', 'Team E']
                      }).render();
                    });
                  </script>
                  <!-- End Pie Chart -->

                </div>
              </div>
            </div>
            <!-- Key Player graph, end here -->


            <!-- Companywise graph, start here -->
            <div class="col-lg-12">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Company-wise Member</h5>
                        <?php 

                          $no_guru_bvc=0;
                          $no_guru_vc=0;
                          $no_guru_adwys=0;
                          $no_guru_nutra=0;
                          $no_guru_letx=0;
                          $no_guru_vfull=0;


                          $no_moh_bvc=0;
                          $no_moh_vc=0;
                          $no_moh_adwys=0;
                          $no_moh_nutra=0;
                          $no_moh_letx=0;
                          $no_moh_vfull=0;

                        foreach ($user_genders as $user_gender) {
           
                          foreach ($company_names as $company_name) {
                            //echo " ".$company_name['name'];
                            if(($company_name['id']==$user_gender['company_id']) && ($user_gender['company_location_id']=='1')){

                              if($company_name['id']=='1') {
                                $no_guru_bvc=$no_guru_bvc+1;

                              } else if($company_name['id']=='2') {
                                $no_guru_vc=$no_guru_vc+1;

                              } else if($company_name['id']=='3') {
                                $no_guru_adwys=$no_guru_adwys+1;

                              } else if($company_name['id']=='4') {
                                $no_guru_nutra=$no_guru_nutra+1;

                              } else if($company_name['id']=='5') {
                                $no_guru_letx=$no_guru_letx+1;

                              } else if($company_name['id']=='6') {
                                $no_guru_vfull=$no_guru_vfull+1;

                              } 
                              
                            } else if(($company_name['id']==$user_gender['department']) && ($user_gender['company_location_id']=='2')){

                              if($company_name['id']=='1') {
                                $no_moh_bvc=$no_moh_bvc+1;

                              } else if($company_name['id']=='2') {
                                $no_moh_vc=$no_moh_vc+1;

                              } else if($company_name['id']=='3') {
                                $no_moh_adwys=$no_moh_adwys+1;

                              } else if($company_name['id']=='4') {
                                $no_moh_nutra=$no_moh_nutra+1;

                              } else if($company_name['id']=='5') {
                                $no_moh_letx=$no_moh_letx+1;

                              } else if($company_name['id']=='6') {
                                $no_moh_vfull=$no_moh_vfull+1;

                              }

                            }

                          }
                        }
                        ?>
                  <!-- Column Chart -->
                  <div id="columnChart"></div>

                  <script>
                    document.addEventListener("DOMContentLoaded", () => {
                      new ApexCharts(document.querySelector("#columnChart"), {
                        series: [
                        {
                          name: 'Gurugram - AIHP',
                          data: [<?php echo $no_guru_adwys;?>,<?php echo $no_guru_bvc;?>,<?php echo $no_guru_letx;?>,<?php echo $no_guru_nutra;?>,<?php echo $no_guru_vc;?>,<?php echo $no_guru_vfull;?>]
                        },
                        {
                          name: 'Mohali',
                          data: [<?php echo $no_moh_adwys;?>,<?php echo $no_moh_bvc;?>,<?php echo $no_moh_letx;?>,<?php echo $no_moh_nutra;?>,<?php echo $no_moh_vc;?>,<?php echo $no_moh_vfull;?>]
                        }
                        ],
                        chart: {
                          type: 'bar',
                          height: 350
                        },
                        plotOptions: {
                          bar: {
                            horizontal: false,
                            columnWidth: '55%',
                            endingShape: 'rounded',
                            dataLabels: {
                              position: 'top'
                            }
                          },
                        },
                        dataLabels: {
                          enabled: true
                        },
                        stroke: {
                          show: true,
                          width: 2,
                          colors: ['transparent']
                        },
                        xaxis: {
                          categories: [<?php foreach ($company_names as $company_name) { ?>'<?php echo $company_name["name"]?>',<?php } ?>],
                        },
                        yaxis: {
                          title: {
                            text: ''
                          }
                        },
                        fill: {
                          opacity: 1
                        },
                        tooltip: {
                          y: {
                            formatter: function(val) {
                              return "" + val + " Members"
                            }
                          }
                        }
                      }).render();
                    });
                  </script>
                  <!-- End Column Chart -->

                </div>
              </div>
            </div>
            <!-- Company graph, end here -->


            <!-- Department graph, start here -->
            <div class="col-lg-12">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Department-wise Member</h5>

                  
                        <?php 

                          $no_guru_adope=0;
                          $no_guru_edu=0;
                          $no_guru_finAcc=0;
                          $no_guru_hr=0;
                          $no_guru_igam=0;
                          $no_guru_mng=0;
                          $no_guru_media=0;
                          $no_guru_mobile=0;
                          $no_guru_pm=0;
                          $no_guru_pub=0;
                          $no_guru_techOpe=0;


                          $no_moh_adope=0;
                          $no_moh_edu=0;
                          $no_moh_finAcc=0;
                          $no_moh_hr=0;
                          $no_moh_igam=0;
                          $no_moh_mng=0;
                          $no_moh_media=0;
                          $no_moh_mobile=0;
                          $no_moh_pm=0;
                          $no_moh_pub=0;
                          $no_moh_techOpe=0;


                        foreach ($user_genders as $user_gender) {
                          $cnt=0;
                          foreach ($department_names as $department_name) {
                            $cnt++;                            
                            //echo "<br>".$department_name['name'];
                            if(($department_name['id']==$user_gender['department']) && ($user_gender['company_location_id']=='1')){

                              if($department_name['id']=='1') {
                                $no_guru_igam=$no_guru_igam+1;

                              } else if($department_name['id']=='2') {
                                $no_guru_pub=$no_guru_pub+1;

                              } else if($department_name['id']=='3') {
                                $no_guru_techOpe=$no_guru_techOpe+1;

                              } else if($department_name['id']=='4') {
                                $no_guru_finAcc=$no_guru_finAcc+1;

                              } else if($department_name['id']=='5') {
                                $no_guru_hr=$no_guru_hr+1;

                              } else if($department_name['id']=='6') {
                                $no_guru_mobile=$no_guru_mobile+1;

                              } else if($department_name['id']=='7') {
                                $no_guru_pm=$no_guru_pm+1;

                              } else if($department_name['id']=='8') {
                                $no_guru_media=$no_guru_media+1;

                              } else if($department_name['id']=='9') {
                                $no_guru_adope=$no_guru_adope+1;

                              } else if($department_name['id']=='10') {
                                $no_guru_edu=$no_guru_edu+1;

                              } else if($department_name['id']=='11') {
                                $no_guru_mng=$no_guru_mng+1;
                              }
                              
                            } else if(($department_name['id']==$user_gender['department']) && ($user_gender['company_location_id']=='2')) {

                              if($department_name['id']=='1') {
                                $no_moh_igam=$no_moh_igam+1;

                              } else if($department_name['id']=='2') {
                                $no_moh_pub=$no_moh_pub+1;

                              } else if($department_name['id']=='3') {
                                $no_moh_techOpe=$no_moh_techOpe+1;

                              } else if($department_name['id']=='4') {
                                $no_moh_finAcc=$no_moh_finAcc+1;

                              } else if($department_name['id']=='5') {
                                $no_moh_hr=$no_moh_hr+1;

                              } else if($department_name['id']=='6') {
                                $no_moh_mobile=$no_moh_mobile+1;

                              } else if($department_name['id']=='7') {
                                $no_moh_pm=$no_moh_pm+1;

                              } else if($department_name['id']=='8') {
                                $no_moh_media=$no_moh_media+1;

                              } else if($department_name['id']=='9') {
                                $no_moh_adope=$no_moh_adope+1;

                              } else if($department_name['id']=='10') {
                                $no_moh_edu=$no_moh_edu+1;

                              } else if($department_name['id']=='11') {
                                $no_moh_mng=$no_moh_mng+1;
                              }

                            }

                          }
                        }
                        ?>
                  <!-- Column Chart -->
                  <div id="columnChartDepartment"></div>

                  <script>
                    document.addEventListener("DOMContentLoaded", () => {
                      new ApexCharts(document.querySelector("#columnChartDepartment"), {
                        series: [
                        {
                          name: 'Gurugram - AIHP',
                          data: ['<?php echo $no_guru_adope;?>','<?php echo $no_guru_edu;?>','<?php echo $no_guru_finAcc;?>','<?php echo $no_guru_hr;?>','<?php echo $no_guru_igam;?>','<?php echo $no_guru_mng;?>','<?php echo $no_guru_media;?>','<?php echo $no_guru_mobile;?>','<?php echo $no_guru_pm;?>','<?php echo $no_guru_pub;?>','<?php echo $no_guru_techOpe;?>',]
                        },
                        {
                          name: 'Mohali',
                          data: ['<?php echo $no_moh_adope;?>','<?php echo $no_moh_edu;?>','<?php echo $no_moh_finAcc;?>','<?php echo $no_moh_hr;?>','<?php echo $no_moh_igam;?>','<?php echo $no_moh_mng;?>','<?php echo $no_moh_media;?>','<?php echo $no_moh_mobile;?>','<?php echo $no_moh_pm;?>','<?php echo $no_moh_pub;?>','<?php echo $no_moh_techOpe;?>',]
                        }
                        ],
                        chart: {
                          type: 'bar',
                          height: 350
                        },
                        plotOptions: {
                          bar: {
                            horizontal: false,
                            columnWidth: '55%',
                            endingShape: 'rounded',
                            dataLabels: {
                              position: 'top'
                            }
                          },
                        },
                        dataLabels: {
                          enabled: true
                        },
                        stroke: {
                          show: true,
                          width: 2,
                          colors: ['transparent']
                        },
                        xaxis: {
                          categories: [<?php foreach($department_names as $department_name){?>'<?php echo $department_name["name"]?>',<?php } ?>]
                        },
                        yaxis: {
                          title: {
                            text: ''
                          }
                        },
                        fill: {
                          opacity: 1
                        },
                        tooltip: {
                          y: {
                            formatter: function(val) {
                              return "" + val + " Members"
                            }
                          }
                        }
                      }).render();
                    });
                  </script>
                  <!-- End Column Chart -->

                </div>
              </div>
            </div>
            <!-- Department graph, end here -->



            <?php 

            $no_guru_tenure1=0;
            $no_guru_tenure2=0;
            $no_guru_tenure3=0;
            $no_guru_tenure4=0;
            $no_guru_tenure5=0;
            $no_guru_tenure6=0;
            $no_guru_tenure7=0;
            $no_guru_tenure8=0;
            $no_guru_tenure9=0;
            $no_guru_tenure10=0;


            $no_moh_tenure1=0;
            $no_moh_tenure2=0;
            $no_moh_tenure3=0;
            $no_moh_tenure4=0;
            $no_moh_tenure5=0;
            $no_moh_tenure6=0;
            $no_moh_tenure7=0;
            $no_moh_tenure8=0;
            $no_moh_tenure9=0;
            $no_moh_tenure10=0;

            $years=0;

          foreach ($all_users as $all_user) {
              //echo $all_user['joining_date']." / ";

              $sdate = date("y-m-d");
              $edate = $all_user['joining_date'];
              $date_diff = abs(strtotime($edate) - strtotime($sdate));

              $years = floor($date_diff / (365*60*60*24));

              if($all_user['company_location_id']=='1') {

                if($years=='1') {
                  $no_guru_tenure1=$no_guru_tenure1+1;

                } else if($years=='2') {
                  $no_guru_tenure2=$no_guru_tenure2+1;

                } else if($years=='3') {
                  $no_guru_tenure3=$no_guru_tenure3+1;

                } else if($years=='4') {
                  $no_guru_tenure4=$no_guru_tenure4+1;

                } else if($years=='5') {
                  $no_guru_tenure5=$no_guru_tenure5+1;

                } else if($years=='6') {
                  $no_guru_tenure6=$no_guru_tenure6+1;

                } else if($years=='7') {
                  $no_guru_tenure7=$no_guru_tenure7+1;

                } else if($years=='8') {
                  $no_guru_tenure8=$no_guru_tenure8+1;

                } else if($years=='9') {
                  $no_guru_tenure9=$no_guru_tenure9+1;

                } else if($years=='10') {
                  $no_guru_tenure10=$no_guru_tenure10+1;

                }
                
              } else if($all_user['company_location_id']=='2') {

                if($years=='1') {
                  $no_moh_tenure1=$no_moh_tenure1+1;

                } else if($years=='2') {
                  $no_moh_tenure2=$no_moh_tenure2+1;

                } else if($years=='3') {
                  $no_moh_tenure3=$no_moh_tenure3+1;

                } else if($years=='4') {
                  $no_moh_tenure4=$no_moh_tenure4+1;

                } else if($years=='5') {
                  $no_moh_tenure5=$no_moh_tenure5+1;

                } else if($years=='6') {
                  $no_moh_tenure6=$no_moh_tenure6+1;

                } else if($years=='7') {
                  $no_moh_tenure7=$no_moh_tenure7+1;

                } else if($years=='8') {
                  $no_moh_tenure8=$no_moh_tenure8+1;

                } else if($years=='9') {
                  $no_moh_tenure9=$no_moh_tenure9+1;

                } else if($years=='10') {
                  $no_moh_tenure10=$no_moh_tenure10+1;

                }              

            }
          }
          ?>

            <!-- Tenure graph, end here -->
            <div class="col-lg-12">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Tenure</h5>

                  <!-- Column Chart -->
                  <div id="columnChartTenure"></div>

                  <script>
                    document.addEventListener("DOMContentLoaded", () => {
                      new ApexCharts(document.querySelector("#columnChartTenure"), {
                        series: [
                        
                        {
                          name: 'Gurugram - AIHP',
                          data: [<?php echo $no_guru_tenure1;?>,<?php echo $no_guru_tenure2;?>,<?php echo $no_guru_tenure3;?>,<?php echo $no_guru_tenure4;?>,<?php echo $no_guru_tenure5;?>,<?php echo $no_guru_tenure6;?>,<?php echo $no_guru_tenure7;?>,<?php echo $no_guru_tenure8;?>,<?php echo $no_guru_tenure9;?>,<?php echo $no_guru_tenure10;?>]
                        },
                        {
                          name: 'Mohali',
                          data: [<?php echo $no_moh_tenure1;?>,<?php echo $no_moh_tenure2;?>,<?php echo $no_moh_tenure3;?>,<?php echo $no_moh_tenure4;?>,<?php echo $no_moh_tenure5;?>,<?php echo $no_moh_tenure6;?>,<?php echo $no_moh_tenure7;?>,<?php echo $no_moh_tenure8;?>,<?php echo $no_moh_tenure9;?>,<?php echo $no_moh_tenure10;?>]
                        }],
                        chart: {
                          type: 'bar',
                          height: 350
                        },
                        plotOptions: {
                          bar: {
                            horizontal: false,
                            columnWidth: '55%',
                            endingShape: 'rounded',
                            dataLabels: {
                              position: 'top'
                            }
                          },
                        },
                        dataLabels: {
                          enabled: true
                        },
                        stroke: {
                          show: true,
                          width: 2,
                          colors: ['transparent']
                        },
                        xaxis: {
                          categories: ['1 Year', '2 Years', '3 Years', '4 Years', '5 Years', '6 Years', '7 Years', '8 Years', '9 Years', '10 Years'],
                        },
                        yaxis: {
                          title: {
                            text: ''
                          }
                        },
                        fill: {
                          opacity: 1
                        },
                        tooltip: {
                          y: {
                            formatter: function(val) {
                              return " " + val + ""
                            }
                          }
                        }
                      }).render();
                    });
                  </script>
                  <!-- End Column Chart -->

                </div>
              </div>
            </div>
            <!-- Tenure graph, end here -->


          </div>
        </section>


        @else
        <section class="section dashboard">
          <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-8">
              <div class="row">

				  
				  
				  
					  <div class="col-xl-12 col-lg-12 col-sm-12">
						  <div class="bg-primary custom-card card-box card">
							  <div class="p-4 card-body">
								  <div class="align-items-center row">
									  <div class="col-xl-8 col-sm-6 col-12 img-bg ">
										  <h4 class="d-flex "><span class="font-weight-bold text-white ">General Report</span></h4> 
										  <p class="tx-white-7 mb-1">You have two projects to finish, you had completed<b class="text-warning"> 57%</b> from your montly level, Keep going to your level</p>
									  </div>
									  <img src="assests/assets/img/intro-img.png" alt="work1">
								  </div>
							  </div>
						  </div>
					  </div>
				  

            <!-- save member Promotions, start here  -->
              <a href="#" data-bs-toggle="modal" data-bs-target="#verticalycenteredPromotions">Add Promotions</a>

              <div class="modal fade" id="verticalycenteredPromotions" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                  
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Promotions</h5>
                      <button type="button" class="btn-close" id="promotions_close_id" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                      <div class="modal-body">
                
                        <div class="col-md-12 position-relative">
                          <label for="name" class="form-label">Old Designation</label>
                          <select class="form-select" name="old_designation_id" id="old_designation_id">
                            <option value="">Choose...</option>
                            @foreach($designation_details as $designation_detail)
                            <option value="{{$designation_detail['id']}}" @if((Auth::user()->designation)==$designation_detail['id']) selected @endif>{{$designation_detail['name']}}</option>
                            @endforeach
                          </select>
                          <span class="text-danger" id="old_designation_idError"></span>
                        </div>

                        
                        <div class="col-md-12 position-relative">
                          <br>
                          <label for="name" class="form-label">New Designation</label>
                          <select class="form-select" name="new_designation_id" id="new_designation_id">
                            <option value="">Choose...</option>
                            @foreach($designation_details as $designation_detail)
                            <option value="{{$designation_detail['id']}}" @if(old('new_designation_id')==$designation_detail['id']) selected @endif>{{$designation_detail['name']}}</option>
                            @endforeach
                          </select>
                          <span class="text-danger" id="new_designation_idError"></span>
                        </div>

                        <br>
                        <div class="col-md-12 position-relative">
                          <label for="name" class="form-label">Promotion Date</label>
                          <input type="date" name="promotion_date" id="promotion_date" class="form-control" required>
                          <span class="text-danger" id="promotion_dateError"></span>
                        </div>

                
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="save_member_promotions">Save</button>
                      </div>

                  </div>


                </div>
              </div>
              <!-- save member Promotions, start here  -->




              <!-- save member Appraisals, start here  -->
              <a href="#" data-bs-toggle="modal" data-bs-target="#verticalycenteredAppraisals">Add Appraisals</a>

              <div class="modal fade" id="verticalycenteredAppraisals" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                  
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Appraisals</h5>
                      <button type="button" class="btn-close" id="appraisals_close_id" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                      <div class="modal-body">
                
                        <div class="col-md-12 position-relative">
                          <label for="name" class="form-label">Type</label>
                          <select class="form-select" name="appraisal_type" id="appraisal_type" required>
                            <option value="">Choose...</option>
                            <option value="INR">INR</option>
                            <option value="%">%</option>
                          </select>
                          
                          <span class="text-danger" id="appraisal_typeError"></span>
                         
                        </div>

                        
                        <div class="col-md-12 position-relative" style="display: none;" id="appraisal_amount_div">
                          <br>
                          <label for="name" class="form-label">Amount</label>
                          <input type="number" name="appraisal_amount" id="appraisal_amount" class="form-control">
                          <span class="text-danger" id="appraisal_amountError"></span>
                        </div>

                        
                        <div class="col-md-12 position-relative" style="display: none;" id="appraisal_percentage_div">
                          <br>
                          <label for="name" class="form-label">Percentage</label>
                          <input type="number" name="appraisal_percentage" id="appraisal_percentage" class="form-control">
                          <span class="text-danger" id="appraisal_percentageError"></span>
                        </div>

                        <br>
                        <div class="col-md-12 position-relative">
                          <label for="name" class="form-label">Appraisals Date</label>
                          <input type="date" name="appraisal_date" id="appraisal_date" class="form-control" required>
                          <span class="text-danger" id="appraisal_dateError"></span>
                        </div>

                
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="save_member_appraisals">Save</button>
                      </div>

                  </div>


                </div>
              </div>
              <!-- save member Appraisals, start here  -->



				  
            @if($users['energy']>0)
				      <!-- save member Appreciations, start here  -->
              <a href="#" data-bs-toggle="modal" data-bs-target="#verticalycenteredAppreciations">Add Appreciation</a>

              <div class="modal fade" id="verticalycenteredAppreciations" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                  
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Appreciation</h5>
                      <button type="button" class="btn-close" id="appreciation_close_id" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                      <div class="modal-body">
                
                        <div class="col-md-12 position-relative">
                          <label for="name" class="form-label">Appreciation To</label>
                          <select class="form-select" name="appreciation_to" id="appreciation_to" required>
                            <option value="">Choose...</option>
                            @foreach($all_members as $all_member)
                            <option value="{{$all_member['id']}}">{{$all_member['full_name']}}</option>
                            @endforeach
                          </select>
                          
                          <span class="text-danger" id="appreciation_toError"></span>
                         
                        </div>

                        <br>
                        <div class="col-md-12 position-relative">
                          <label for="name" class="form-label">Comment</label>
                          
                          <textarea class="form-control" name="appreciation_comment" id="appreciation_comment" style="height: 100px;">{{ old('appreciation_comment')}}</textarea>

                          <script>
                            CKEDITOR.replace('appreciation_comment');
                          </script>
                          
                          <span class="text-danger" id="appreciation_commentError"></span>
                          
                        </div>

                
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="save_member_appreciation">Save</button>
                      </div>

                  </div>


                </div>
              </div>
              <!-- save member Appreciations, start here  -->
              @endif


              <!-- save member Achievements, start here  -->
              <a href="#" data-bs-toggle="modal" data-bs-target="#verticalycenteredAchievements">Add Achievements</a>

              <div class="modal fade" id="verticalycenteredAchievements" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                  
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Achievements</h5>
                      <button type="button" class="btn-close" id="achievements_close_id" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                      <div class="modal-body">
                
                        <div class="col-md-12 position-relative">
                          <label for="name" class="form-label">Achievement Category</label>
                          <select class="form-select" name="achievement_id" id="achievement_id" required>
                            <option value="">Choose...</option>
                            @foreach($achievement_category_lists as $achievement_category_list)
                            <option value="{{$achievement_category_list['id']}}">{{$achievement_category_list['name']}}</option>
                            @endforeach
                          </select>
                          
                          <span class="text-danger" id="achievement_idError"></span>
                         
                        </div>


                        <div class="col-md-12 position-relative">
                          <label for="name" class="form-label">Achievement Date</label>
                          <input type="date" name="achievement_year_month" id="achievement_year_month" class="form-control" required>
                          
                          <span class="text-danger" id="achievement_year_monthError"></span>
                          
                        </div>

                
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="save_member_achievements">Save</button>
                      </div>

                  </div>


                </div>
              </div>
              <!-- save member Achievements, start here  -->


				  
				      <!-- save member skills, start here  -->
              <a href="#" data-bs-toggle="modal" data-bs-target="#largeModal">Edit Education</a>

              <div class="modal fade" id="largeModal" tabindex="-1">
                <div class="modal-dialog modal-lg">
                  
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Education</h5>
                      <button type="button" class="btn-close" id="education_close_id" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                      <div class="modal-body">
                        <input type="hidden" name="ajax_user_id" id="ajax_user_id" value="{{ Auth::user()->id }}">
                        <div class="container">
                          @if($edu_count>0)
                              <?php $add=1;?>
                              @foreach($logged_in_education_deatils as $logged_in_education_deatil)
                              <div class='element' id="div_{{ $add }}">
                                
                                  <div style="float: left; width: 100%; margin-top:5px;">
                                    <div style="float: left; width: 20%;">
                                      <input type='text' placeholder='Course' name='course_name[]' id='txt_1' value="{{ $logged_in_education_deatil->course_name }}" class="form-control" style="width: 98%;">
                                    </div>
                                    <div style="float: left; width: 34%;">
                                      <input type='text' placeholder='University' name='university_name[]' id='txt_2' value="{{ $logged_in_education_deatil->university_name }}" class="form-control" style="width: 98%;">
                                    </div>
                                    <div style="float: left; width: 25%;">
                                      <input type='text' placeholder='Year' name='passing_year[]' id='txt_3' value="{{ $logged_in_education_deatil->passing_year }}" class="form-control" style="width: 98%;">
                                    </div>
                                    <div style="float: left; width: 15%;">
                                      <input type='text' placeholder='Marks' name='percentage[]' id='txt_4' value="{{ $logged_in_education_deatil->percentage }}" class="form-control">
                                    </div>
                                    @if($add==1)
                                    <div style="float: left; width: 6%; font-size: 31px; color: green; cursor: pointer; text-align: center; ">
                                      
                                      <span class='add'>
                                        <i class="bi bi-plus"></i>
                                      </span>

                                    </div>
                                    @else
                                    <div style="float: left; width: 6%; font-size: 18px; color: red; cursor: pointer; text-align: center;line-height: 46px;">
                                      
                                      <span id="remove_{{$add}}" class='remove'>X</span>
                                      
                                    </div>
                                    @endif
                                  </div>
                                  
                              </div>

                              <?php $add++;?>
                              @endforeach

                          @else

                              <div class='element' id="div_1">
                                
                                  <div style="float: left; width: 100%; margin-top:5px;">
                                    <div style="float: left; width: 20%;">
                                      <input type='text' placeholder='Course' name='course_name[]' id='txt_1' value="" class="form-control" style="width: 98%;">
                                    </div>
                                    <div style="float: left; width: 34%;">
                                      <input type='text' placeholder='University' name='university_name[]' id='txt_2' value="" class="form-control" style="width: 98%;">
                                    </div>
                                    <div style="float: left; width: 25%;">
                                      <input type='text' placeholder='Year' name='passing_year[]' id='txt_3' value="" class="form-control" style="width: 98%;">
                                    </div>
                                    <div style="float: left; width: 15%;">
                                      <input type='text' placeholder='Marks' name='percentage[]' id='txt_4' value="" class="form-control">
                                    </div>
                                    
                                    <div style="float: left; width: 6%; font-size: 31px; color: green; cursor: pointer; text-align: center; ">
                                      <span class='add'>
                                        <i class="bi bi-plus"></i>
                                      </span>
                                    </div>

                                  </div>
                                  
                              </div>

                          @endif

                        </div>
                
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="save_member_education">Save</button>
                      </div>

                  </div>


                </div>
              </div>
              <!-- save member skills, start here  -->
				  
				  
				  <!-- Vertically centered Modal -->
              <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#verticalycentered">
                Edit Skilss
              </button> -->

              <!-- save member skills, start here  -->
              <a href="#" data-bs-toggle="modal" data-bs-target="#verticalycentered">Edit Skills</a>

              <div class="modal fade" id="verticalycentered" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                  
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Skills</h5>
                      <button type="button" class="btn-close" id="skills_close_id" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                      <div class="modal-body">
                
                        <div class="col-md-12 position-relative">
                          <label for="name" class="form-label">Skills</label>
                          <input type="text" class="form-control" id="member_skills" data-role="tagsinput" name="member_skills" value="{{ old('member_skills', $users['skills'] ) }}" required>
                          <div class="valid-tooltip">
                            Looks good!
                          </div>
                          @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                          @endif
                        </div>
                
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="save_member_skills">Save</button>
                      </div>

                  </div>


                </div>
              </div>
              <!-- save member skills, start here  -->
				  
				  
				  
				    <!-- save member address, start here  -->
              <!-- <a href="#" data-bs-toggle="modal" data-bs-target="#verticalycenteredAddress">Edit Address</a> -->

              <div class="modal fade" id="verticalycenteredAddress" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                  
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Update Address</h5>
                      <button type="button" class="btn-close" id="address_close_id" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!-- <form method="post" class="row g-3 needs-validation" novalidate>
                    @csrf -->

                      <div class="modal-body">
                        <!-- Custom Styled Validation with Tooltips -->
                
                        <div class="col-md-12 position-relative">
                          <label for="name" class="form-label">Permanent Address</label>
                          <textarea name="permanent_address" id="permanent_address" class="form-control">{{ old('permanent_address', $users['permanent_address'])}}</textarea>
                          @if ($errors->has('permanent_address'))
                            <span class="text-danger">{{ $errors->first('permanent_address') }}</span>
                          @endif
                        </div>


                        <div class="col-md-12 position-relative">
                          <label for="name" class="form-label">Current Address</label>
                          <textarea name="current_address" id="current_address" class="form-control">{{ old('current_address', $users['current_address'])}}</textarea>
                          @if ($errors->has('current_address'))
                            <span class="text-danger">{{ $errors->first('current_address') }}</span>
                          @endif
                        </div>

                
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="save_member_address">Save</button>
                      </div>

                   <!--  </form> -->

                  </div>


                </div>
              </div>
              <!-- save member address, start here  -->


              <!-- save member birthday, start here  -->
              <!-- <a href="#" data-bs-toggle="modal" data-bs-target="#verticalycenteredBirthday">Edit Birthday</a> -->

              <div class="modal fade" id="verticalycenteredBirthday" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                  
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Update Birthday</h5>
                      <button type="button" class="btn-close" id="birthday_close_id" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                      <div class="modal-body">
                
                        <div class="col-md-12 position-relative">
                          <label for="name" class="form-label">Birthday Date</label>
                          <input type="date" name="birthday_date" id="birthday_date" value="{{ old('birthday_date', $users['birthday_date']) }}" class="form-control">
                          @if ($errors->has('birthday_date'))
                            <span class="text-danger">{{ $errors->first('birthday_date') }}</span>
                          @endif
                        </div>
                
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="save_member_birthday">Save</button>
                      </div>

                  </div>


                </div>
              </div>
              <!-- save member birthday, start here  -->
				  
				  
				  
                <!-- Sales Card -->
                <div class="col-xxl-4 col-md-6">
                  <div class="card info-card sales-card">

                    <div class="filter">
                      <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                      <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                        <li class="dropdown-header text-start">
                          <h6>Filter</h6>
                        </li>

                        <li><a class="dropdown-item" href="#">Today</a></li>
                        <li><a class="dropdown-item" href="#">This Month</a></li>
                        <li><a class="dropdown-item" href="#">This Year</a></li>
                      </ul>
                    </div>

                    <div class="card-body">
                      <h5 class="card-title">Sales <span>| Today</span></h5>

                      <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                          <i class="bi bi-cart"></i>
                        </div>
                        <div class="ps-3">
                          <h6>145</h6>
                          <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span>

                        </div>
                      </div>
                    </div>

                  </div>
                </div><!-- End Sales Card -->

                <!-- Revenue Card -->
                <div class="col-xxl-4 col-md-6">
                  <div class="card info-card revenue-card">

                    <div class="filter">
                      <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                      <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                        <li class="dropdown-header text-start">
                          <h6>Filter</h6>
                        </li>

                        <li><a class="dropdown-item" href="#">Today</a></li>
                        <li><a class="dropdown-item" href="#">This Month</a></li>
                        <li><a class="dropdown-item" href="#">This Year</a></li>
                      </ul>
                    </div>

                    <div class="card-body">
                      <h5 class="card-title">Revenue <span>| This Month</span></h5>

                      <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                          <i class="bi bi-currency-dollar"></i>
                        </div>
                        <div class="ps-3">
                          <h6>$3,264</h6>
                          <span class="text-success small pt-1 fw-bold">8%</span> <span class="text-muted small pt-2 ps-1">increase</span>

                        </div>
                      </div>
                    </div>

                  </div>
                </div><!-- End Revenue Card -->

                <!-- Customers Card -->
                <div class="col-xxl-4 col-xl-12">

                  <div class="card info-card customers-card">

                    <div class="filter">
                      <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                      <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                        <li class="dropdown-header text-start">
                          <h6>Filter</h6>
                        </li>

                        <li><a class="dropdown-item" href="#">Today</a></li>
                        <li><a class="dropdown-item" href="#">This Month</a></li>
                        <li><a class="dropdown-item" href="#">This Year</a></li>
                      </ul>
                    </div>

                    <div class="card-body">
                      <h5 class="card-title">Customers <span>| This Year</span></h5>

                      <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                          <i class="bi bi-people"></i>
                        </div>
                        <div class="ps-3">
                          <h6>1244</h6>
                          <span class="text-danger small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">decrease</span>

                        </div>
                      </div>

                    </div>
                  </div>

                </div><!-- End Customers Card -->

                <!-- Reports -->
                <div class="col-12">
                  <div class="card">

                    <div class="filter">
                      <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                      <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                        <li class="dropdown-header text-start">
                          <h6>Filter</h6>
                        </li>

                        <li><a class="dropdown-item" href="#">Today</a></li>
                        <li><a class="dropdown-item" href="#">This Month</a></li>
                        <li><a class="dropdown-item" href="#">This Year</a></li>
                      </ul>
                    </div>

                    <div class="card-body">
                      <h5 class="card-title">Reports <span>/Today</span></h5>

                      <!-- Line Chart -->
                      <div id="reportsChart"></div>

                      <script>
                        document.addEventListener("DOMContentLoaded", () => {
                          new ApexCharts(document.querySelector("#reportsChart"), {
                            series: [{
                              name: 'Sales',
                              data: [31, 40, 28, 51, 42, 82, 56],
                            }, {
                              name: 'Revenue',
                              data: [11, 32, 45, 32, 34, 52, 41]
                            }, {
                              name: 'Customers',
                              data: [15, 11, 32, 18, 9, 24, 11]
                            }],
                            chart: {
                              height: 350,
                              type: 'area',
                              toolbar: {
                                show: false
                              },
                            },
                            markers: {
                              size: 4
                            },
                            colors: ['#4154f1', '#2eca6a', '#ff771d'],
                            fill: {
                              type: "gradient",
                              gradient: {
                                shadeIntensity: 1,
                                opacityFrom: 0.3,
                                opacityTo: 0.4,
                                stops: [0, 90, 100]
                              }
                            },
                            dataLabels: {
                              enabled: false
                            },
                            stroke: {
                              curve: 'smooth',
                              width: 2
                            },
                            xaxis: {
                              type: 'datetime',
                              categories: ["2018-09-19T00:00:00.000Z", "2018-09-19T01:30:00.000Z", "2018-09-19T02:30:00.000Z", "2018-09-19T03:30:00.000Z", "2018-09-19T04:30:00.000Z", "2018-09-19T05:30:00.000Z", "2018-09-19T06:30:00.000Z"]
                            },
                            tooltip: {
                              x: {
                                format: 'dd/MM/yy HH:mm'
                              },
                            }
                          }).render();
                        });
                      </script>
                      <!-- End Line Chart -->

                    </div>

                  </div>
                </div><!-- End Reports -->

                <!-- Recent Sales -->
                <div class="col-12">
                  <div class="card recent-sales overflow-auto">

                    <div class="filter">
                      <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                      <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                        <li class="dropdown-header text-start">
                          <h6>Filter</h6>
                        </li>

                        <li><a class="dropdown-item" href="#">Today</a></li>
                        <li><a class="dropdown-item" href="#">This Month</a></li>
                        <li><a class="dropdown-item" href="#">This Year</a></li>
                      </ul>
                    </div>

                    <div class="card-body">
                      <h5 class="card-title">Recent Sales <span>| Today</span></h5>

                      <table class="table table-borderless datatable">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Customer</th>
                            <th scope="col">Product</th>
                            <th scope="col">Price</th>
                            <th scope="col">Status</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <th scope="row"><a href="#">#2457</a></th>
                            <td>Brandon Jacob</td>
                            <td><a href="#" class="text-primary">At praesentium minu</a></td>
                            <td>$64</td>
                            <td><span class="badge bg-success">Approved</span></td>
                          </tr>
                          <tr>
                            <th scope="row"><a href="#">#2147</a></th>
                            <td>Bridie Kessler</td>
                            <td><a href="#" class="text-primary">Blanditiis dolor omnis similique</a></td>
                            <td>$47</td>
                            <td><span class="badge bg-warning">Pending</span></td>
                          </tr>
                          <tr>
                            <th scope="row"><a href="#">#2049</a></th>
                            <td>Ashleigh Langosh</td>
                            <td><a href="#" class="text-primary">At recusandae consectetur</a></td>
                            <td>$147</td>
                            <td><span class="badge bg-success">Approved</span></td>
                          </tr>
                          <tr>
                            <th scope="row"><a href="#">#2644</a></th>
                            <td>Angus Grady</td>
                            <td><a href="#" class="text-primar">Ut voluptatem id earum et</a></td>
                            <td>$67</td>
                            <td><span class="badge bg-danger">Rejected</span></td>
                          </tr>
                          <tr>
                            <th scope="row"><a href="#">#2644</a></th>
                            <td>Raheem Lehner</td>
                            <td><a href="#" class="text-primary">Sunt similique distinctio</a></td>
                            <td>$165</td>
                            <td><span class="badge bg-success">Approved</span></td>
                          </tr>
                        </tbody>
                      </table>

                    </div>

                  </div>
                </div><!-- End Recent Sales -->

                <!-- Top Selling -->
                <div class="col-12">
                  <div class="card top-selling overflow-auto">

                    <div class="filter">
                      <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                      <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                        <li class="dropdown-header text-start">
                          <h6>Filter</h6>
                        </li>

                        <li><a class="dropdown-item" href="#">Today</a></li>
                        <li><a class="dropdown-item" href="#">This Month</a></li>
                        <li><a class="dropdown-item" href="#">This Year</a></li>
                      </ul>
                    </div>

                    <div class="card-body pb-0">
                      <h5 class="card-title">Top Selling <span>| Today</span></h5>

                      <table class="table table-borderless">
                        <thead>
                          <tr>
                            <th scope="col">Preview</th>
                            <th scope="col">Product</th>
                            <th scope="col">Price</th>
                            <th scope="col">Sold</th>
                            <th scope="col">Revenue</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <th scope="row"><a href="#"><img src="assets/img/product-1.jpg" alt=""></a></th>
                            <td><a href="#" class="text-primary fw-bold">Ut inventore ipsa voluptas nulla</a></td>
                            <td>$64</td>
                            <td class="fw-bold">124</td>
                            <td>$5,828</td>
                          </tr>
                          <tr>
                            <th scope="row"><a href="#"><img src="assets/img/product-2.jpg" alt=""></a></th>
                            <td><a href="#" class="text-primary fw-bold">Exercitationem similique doloremque</a></td>
                            <td>$46</td>
                            <td class="fw-bold">98</td>
                            <td>$4,508</td>
                          </tr>
                          <tr>
                            <th scope="row"><a href="#"><img src="assets/img/product-3.jpg" alt=""></a></th>
                            <td><a href="#" class="text-primary fw-bold">Doloribus nisi exercitationem</a></td>
                            <td>$59</td>
                            <td class="fw-bold">74</td>
                            <td>$4,366</td>
                          </tr>
                          <tr>
                            <th scope="row"><a href="#"><img src="assets/img/product-4.jpg" alt=""></a></th>
                            <td><a href="#" class="text-primary fw-bold">Officiis quaerat sint rerum error</a></td>
                            <td>$32</td>
                            <td class="fw-bold">63</td>
                            <td>$2,016</td>
                          </tr>
                          <tr>
                            <th scope="row"><a href="#"><img src="assets/img/product-5.jpg" alt=""></a></th>
                            <td><a href="#" class="text-primary fw-bold">Sit unde debitis delectus repellendus</a></td>
                            <td>$79</td>
                            <td class="fw-bold">41</td>
                            <td>$3,239</td>
                          </tr>
                        </tbody>
                      </table>

                    </div>

                  </div>
                </div><!-- End Top Selling -->

              </div>
            </div><!-- End Left side columns -->

            <!-- Right side columns -->
            <div class="col-lg-4">

              <!-- Recent Activity -->
              <div class="card">
                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">Today</a></li>
                    <li><a class="dropdown-item" href="#">This Month</a></li>
                    <li><a class="dropdown-item" href="#">This Year</a></li>
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Recent Activity <span>| Today</span></h5>

                  <div class="activity">

                    <div class="activity-item d-flex">
                      <div class="activite-label">32 min</div>
                      <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                      <div class="activity-content">
                        Quia quae rerum <a href="#" class="fw-bold text-dark">explicabo officiis</a> beatae
                      </div>
                    </div><!-- End activity item-->

                    <div class="activity-item d-flex">
                      <div class="activite-label">56 min</div>
                      <i class='bi bi-circle-fill activity-badge text-danger align-self-start'></i>
                      <div class="activity-content">
                        Voluptatem blanditiis blanditiis eveniet
                      </div>
                    </div><!-- End activity item-->

                    <div class="activity-item d-flex">
                      <div class="activite-label">2 hrs</div>
                      <i class='bi bi-circle-fill activity-badge text-primary align-self-start'></i>
                      <div class="activity-content">
                        Voluptates corrupti molestias voluptatem
                      </div>
                    </div><!-- End activity item-->

                    <div class="activity-item d-flex">
                      <div class="activite-label">1 day</div>
                      <i class='bi bi-circle-fill activity-badge text-info align-self-start'></i>
                      <div class="activity-content">
                        Tempore autem saepe <a href="#" class="fw-bold text-dark">occaecati voluptatem</a> tempore
                      </div>
                    </div><!-- End activity item-->

                    <div class="activity-item d-flex">
                      <div class="activite-label">2 days</div>
                      <i class='bi bi-circle-fill activity-badge text-warning align-self-start'></i>
                      <div class="activity-content">
                        Est sit eum reiciendis exercitationem
                      </div>
                    </div><!-- End activity item-->

                    <div class="activity-item d-flex">
                      <div class="activite-label">4 weeks</div>
                      <i class='bi bi-circle-fill activity-badge text-muted align-self-start'></i>
                      <div class="activity-content">
                        Dicta dolorem harum nulla eius. Ut quidem quidem sit quas
                      </div>
                    </div><!-- End activity item-->

                  </div>

                </div>
              </div><!-- End Recent Activity -->

              <!-- Budget Report -->
              <div class="card">
                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">Today</a></li>
                    <li><a class="dropdown-item" href="#">This Month</a></li>
                    <li><a class="dropdown-item" href="#">This Year</a></li>
                  </ul>
                </div>

                <div class="card-body pb-0">
                  <h5 class="card-title">Budget Report <span>| This Month</span></h5>

                  <div id="budgetChart" style="min-height: 400px;" class="echart"></div>

                  <script>
                    document.addEventListener("DOMContentLoaded", () => {
                      var budgetChart = echarts.init(document.querySelector("#budgetChart")).setOption({
                        legend: {
                          data: ['Allocated Budget', 'Actual Spending']
                        },
                        radar: {
                          // shape: 'circle',
                          indicator: [{
                              name: 'Sales',
                              max: 6500
                            },
                            {
                              name: 'Administration',
                              max: 16000
                            },
                            {
                              name: 'Information Technology',
                              max: 30000
                            },
                            {
                              name: 'Customer Support',
                              max: 38000
                            },
                            {
                              name: 'Development',
                              max: 52000
                            },
                            {
                              name: 'Marketing',
                              max: 25000
                            }
                          ]
                        },
                        series: [{
                          name: 'Budget vs spending',
                          type: 'radar',
                          data: [{
                              value: [4200, 3000, 20000, 35000, 50000, 18000],
                              name: 'Allocated Budget'
                            },
                            {
                              value: [5000, 14000, 28000, 26000, 42000, 21000],
                              name: 'Actual Spending'
                            }
                          ]
                        }]
                      });
                    });
                  </script>

                </div>
              </div><!-- End Budget Report -->

              <!-- Website Traffic -->
              <div class="card">
                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">Today</a></li>
                    <li><a class="dropdown-item" href="#">This Month</a></li>
                    <li><a class="dropdown-item" href="#">This Year</a></li>
                  </ul>
                </div>

                <div class="card-body pb-0">
                  <h5 class="card-title">Website Traffic <span>| Today</span></h5>

                  <div id="trafficChart" style="min-height: 400px;" class="echart"></div>

                  <script>
                    document.addEventListener("DOMContentLoaded", () => {
                      echarts.init(document.querySelector("#trafficChart")).setOption({
                        tooltip: {
                          trigger: 'item'
                        },
                        legend: {
                          top: '5%',
                          left: 'center'
                        },
                        series: [{
                          name: 'Access From',
                          type: 'pie',
                          radius: ['40%', '70%'],
                          avoidLabelOverlap: false,
                          label: {
                            show: false,
                            position: 'center'
                          },
                          emphasis: {
                            label: {
                              show: true,
                              fontSize: '18',
                              fontWeight: 'bold'
                            }
                          },
                          labelLine: {
                            show: false
                          },
                          data: [{
                              value: 1048,
                              name: 'Search Engine'
                            },
                            {
                              value: 735,
                              name: 'Direct'
                            },
                            {
                              value: 580,
                              name: 'Email'
                            },
                            {
                              value: 484,
                              name: 'Union Ads'
                            },
                            {
                              value: 300,
                              name: 'Video Ads'
                            }
                          ]
                        }]
                      });
                    });
                  </script>

                </div>
              </div><!-- End Website Traffic -->

              <!-- News & Updates Traffic -->
              <div class="card">
                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">Today</a></li>
                    <li><a class="dropdown-item" href="#">This Month</a></li>
                    <li><a class="dropdown-item" href="#">This Year</a></li>
                  </ul>
                </div>

                <div class="card-body pb-0">
                  <h5 class="card-title">News &amp; Updates <span>| Today</span></h5>

                  <div class="news">
                    <div class="post-item clearfix">
                      <img src="assets/img/news-1.jpg" alt="">
                      <h4><a href="#">Nihil blanditiis at in nihil autem</a></h4>
                      <p>Sit recusandae non aspernatur laboriosam. Quia enim eligendi sed ut harum...</p>
                    </div>

                    <div class="post-item clearfix">
                      <img src="assets/img/news-2.jpg" alt="">
                      <h4><a href="#">Quidem autem et impedit</a></h4>
                      <p>Illo nemo neque maiores vitae officiis cum eum turos elan dries werona nande...</p>
                    </div>

                    <div class="post-item clearfix">
                      <img src="assets/img/news-3.jpg" alt="">
                      <h4><a href="#">Id quia et et ut maxime similique occaecati ut</a></h4>
                      <p>Fugiat voluptas vero eaque accusantium eos. Consequuntur sed ipsam et totam...</p>
                    </div>

                    <div class="post-item clearfix">
                      <img src="assets/img/news-4.jpg" alt="">
                      <h4><a href="#">Laborum corporis quo dara net para</a></h4>
                      <p>Qui enim quia optio. Eligendi aut asperiores enim repellendusvel rerum cuder...</p>
                    </div>

                    <div class="post-item clearfix">
                      <img src="assets/img/news-5.jpg" alt="">
                      <h4><a href="#">Et dolores corrupti quae illo quod dolor</a></h4>
                      <p>Odit ut eveniet modi reiciendis. Atque cupiditate libero beatae dignissimos eius...</p>
                    </div>

                  </div><!-- End sidebar recent posts-->

                </div>
              </div><!-- End News & Updates -->

            </div><!-- End Right side columns -->

          </div>
        </section>
        @endif

    </main><!-- End #main -->
@endsection
