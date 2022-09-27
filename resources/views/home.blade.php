@extends('layouts.master')

@section("title")
    <meta content="" name="description">
    <meta content="" name="keywords">

    <title>Dashboard | {{ env('MY_SITE_NAME') }}</title>

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

                              if($value_genders["gender"]=='Male'){
                                $no_male=$no_male+1;
                              } else if($value_genders["gender"]=='Female'){
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

                                if($all_user_name["employee_type"]=='Confirmed'){
                                  $no_guru_conf=$no_guru_conf+1;
                                } else if($all_user_name["employee_type"]=='Probation'){
                                  $no_guru_prob=$no_guru_prob+1;
                                }
                                  
                              } else if($all_user_name["company_location_id"]==2){

                                if($all_user_name["employee_type"]=='Confirmed'){
                                  $no_moh_conf=$no_moh_conf+1;
                                } else if($all_user_name["employee_type"]=='Probation'){
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

                              if($company_name['id']=='1'){
                                $no_guru_bvc=$no_guru_bvc+1;

                              } else if($company_name['id']=='2'){
                                $no_guru_vc=$no_guru_vc+1;

                              } else if($company_name['id']=='3'){
                                $no_guru_adwys=$no_guru_adwys+1;

                              } else if($company_name['id']=='4'){
                                $no_guru_nutra=$no_guru_nutra+1;

                              } else if($company_name['id']=='5'){
                                $no_guru_letx=$no_guru_letx+1;

                              } else if($company_name['id']=='6'){
                                $no_guru_vfull=$no_guru_vfull+1;

                              } 
                              
                            } else if(($company_name['id']==$user_gender['department']) && ($user_gender['company_location_id']=='2')){

                              if($company_name['id']=='1'){
                                $no_moh_bvc=$no_moh_bvc+1;

                              } else if($company_name['id']=='2'){
                                $no_moh_vc=$no_moh_vc+1;

                              } else if($company_name['id']=='3'){
                                $no_moh_adwys=$no_moh_adwys+1;

                              } else if($company_name['id']=='4'){
                                $no_moh_nutra=$no_moh_nutra+1;

                              } else if($company_name['id']=='5'){
                                $no_moh_letx=$no_moh_letx+1;

                              } else if($company_name['id']=='6'){
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
           
                          foreach ($department_names as $department_name) {
                            echo "<br>".$department_name['id'];
                            if(($department_name['id']==$user_gender['department']) && ($user_gender['company_location_id']=='1')){

                              if($department_name['id']=='1'){
                                $no_guru_igam=$no_guru_igam+1;

                              } else if($department_name['id']=='2'){
                                $no_guru_pub=$no_guru_pub+1;

                              } else if($department_name['id']=='3'){
                                $no_guru_techOpe=$no_guru_techOpe+1;

                              } else if($department_name['id']=='4'){
                                $no_guru_finAcc=$no_guru_finAcc+1;

                              } else if($department_name['id']=='5'){
                                $no_guru_hr=$no_guru_hr+1;

                              } else if($department_name['id']=='6'){
                                $no_guru_mobile=$no_guru_mobile+1;

                              } else if($department_name['id']=='7'){
                                $no_guru_pm=$no_guru_pm+1;

                              } else if($department_name['id']=='8'){
                                $no_guru_media=$no_guru_media+1;

                              } else if($department_name['id']=='9'){
                                $no_guru_adope=$no_guru_adope+1;

                              } else if($department_name['id']=='10'){
                                $no_guru_edu=$no_guru_edu+1;

                              } else if($department_name['id']=='11'){
                                $no_guru_mng=$no_guru_mng+1;
                              }
                              
                            } else if(($department_name['id']==$user_gender['department']) && ($user_gender['company_location_id']=='2')){

                              if($department_name['id']=='1'){
                                $no_moh_igam=$no_moh_igam+1;

                              } else if($department_name['id']=='2'){
                                $no_moh_pub=$no_moh_pub+1;

                              } else if($department_name['id']=='3'){
                                $no_moh_techOpe=$no_moh_techOpe+1;

                              } else if($department_name['id']=='4'){
                                $no_moh_finAcc=$no_moh_finAcc+1;

                              } else if($department_name['id']=='5'){
                                $no_moh_hr=$no_moh_hr+1;

                              } else if($department_name['id']=='6'){
                                $no_moh_mobile=$no_moh_mobile+1;

                              } else if($department_name['id']=='7'){
                                $no_moh_pm=$no_moh_pm+1;

                              } else if($department_name['id']=='8'){
                                $no_moh_media=$no_moh_media+1;

                              } else if($department_name['id']=='9'){
                                $no_moh_adope=$no_moh_adope+1;

                              } else if($department_name['id']=='10'){
                                $no_moh_edu=$no_moh_edu+1;

                              } else if($department_name['id']=='11'){
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
                          data: [<?php echo $no_guru_adope;?>,<?php echo $no_guru_edu;?>,<?php echo $no_guru_finAcc;?>,<?php echo $no_guru_hr;?>,<?php echo $no_guru_igam;?>,<?php echo $no_guru_mng;?>,<?php echo $no_guru_media;?>,<?php echo $no_guru_mobile;?>,<?php echo $no_guru_pm;?>,<?php echo $no_guru_pub;?>,<?php echo $no_guru_techOpe;?>]
                        },
                        {
                          name: 'Mohali',
                          data: [<?php echo $no_moh_adope;?>,<?php echo $no_moh_edu;?>,<?php echo $no_moh_finAcc;?>,<?php echo $no_moh_hr;?>,<?php echo $no_moh_igam;?>,<?php echo $no_moh_mng;?>,<?php echo $no_moh_media;?>,<?php echo $no_moh_mobile;?>,<?php echo $no_moh_pm;?>,<?php echo $no_moh_pub;?>,<?php echo $no_moh_techOpe;?>]
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
                          categories: [<?php foreach ($department_names as $department_name) { ?>'<?php echo $department_name["name"]?>',<?php } ?>],
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

              if($all_user['company_location_id']=='1'){

                if($years=='1'){
                  $no_guru_tenure1=$no_guru_tenure1+1;

                } else if($years=='2'){
                  $no_guru_tenure2=$no_guru_tenure2+1;

                } else if($years=='3'){
                  $no_guru_tenure3=$no_guru_tenure3+1;

                } else if($years=='4'){
                  $no_guru_tenure4=$no_guru_tenure4+1;

                } else if($years=='5'){
                  $no_guru_tenure5=$no_guru_tenure5+1;

                } else if($years=='6'){
                  $no_guru_tenure6=$no_guru_tenure6+1;

                } else if($years=='7'){
                  $no_guru_tenure7=$no_guru_tenure7+1;

                } else if($years=='8'){
                  $no_guru_tenure8=$no_guru_tenure8+1;

                } else if($years=='9'){
                  $no_guru_tenure9=$no_guru_tenure9+1;

                } else if($years=='10'){
                  $no_guru_tenure10=$no_guru_tenure10+1;

                }
                
              } else if($all_user['company_location_id']=='2'){

                if($years=='1'){
                  $no_moh_tenure1=$no_moh_tenure1+1;

                } else if($years=='2'){
                  $no_moh_tenure2=$no_moh_tenure2+1;

                } else if($years=='3'){
                  $no_moh_tenure3=$no_moh_tenure3+1;

                } else if($years=='4'){
                  $no_moh_tenure4=$no_moh_tenure4+1;

                } else if($years=='5'){
                  $no_moh_tenure5=$no_moh_tenure5+1;

                } else if($years=='6'){
                  $no_moh_tenure6=$no_moh_tenure6+1;

                } else if($years=='7'){
                  $no_moh_tenure7=$no_moh_tenure7+1;

                } else if($years=='8'){
                  $no_moh_tenure8=$no_moh_tenure8+1;

                } else if($years=='9'){
                  $no_moh_tenure9=$no_moh_tenure9+1;

                } else if($years=='10'){
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
