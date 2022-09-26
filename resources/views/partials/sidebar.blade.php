<?php
$todat_date=date('Y-m-d');
$last45days=date('Y-m-d', strtotime('-45 day', strtotime($todat_date)));

$last70days=date('Y-m-d', strtotime('-70 day', strtotime($todat_date)));
?>
<!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      @if(Auth::user()->role_id!='1')
      <li class="nav-item">
        <a class="nav-link " href="{{ url('/home') }}">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->
      @endif

      <!--<li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Components</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="components-alerts.html">
              <i class="bi bi-circle"></i><span>Alerts</span>
            </a>
          </li>
          <li>
            <a href="components-accordion.html">
              <i class="bi bi-circle"></i><span>Accordion</span>
            </a>
          </li>
          <li>
            <a href="components-badges.html">
              <i class="bi bi-circle"></i><span>Badges</span>
            </a>
          </li>
          <li>
            <a href="components-breadcrumbs.html">
              <i class="bi bi-circle"></i><span>Breadcrumbs</span>
            </a>
          </li>
          <li>
            <a href="components-buttons.html">
              <i class="bi bi-circle"></i><span>Buttons</span>
            </a>
          </li>
          <li>
            <a href="components-cards.html">
              <i class="bi bi-circle"></i><span>Cards</span>
            </a>
          </li>
          <li>
            <a href="components-carousel.html">
              <i class="bi bi-circle"></i><span>Carousel</span>
            </a>
          </li>
          <li>
            <a href="components-list-group.html">
              <i class="bi bi-circle"></i><span>List group</span>
            </a>
          </li>
          <li>
            <a href="components-modal.html">
              <i class="bi bi-circle"></i><span>Modal</span>
            </a>
          </li>
          <li>
            <a href="components-tabs.html">
              <i class="bi bi-circle"></i><span>Tabs</span>
            </a>
          </li>
          <li>
            <a href="components-pagination.html">
              <i class="bi bi-circle"></i><span>Pagination</span>
            </a>
          </li>
          <li>
            <a href="components-progress.html">
              <i class="bi bi-circle"></i><span>Progress</span>
            </a>
          </li>
          <li>
            <a href="components-spinners.html">
              <i class="bi bi-circle"></i><span>Spinners</span>
            </a>
          </li>
          <li>
            <a href="components-tooltips.html">
              <i class="bi bi-circle"></i><span>Tooltips</span>
            </a>
          </li>
        </ul>
      </li>--><!-- End Components Nav -->

      
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Confirmation Panel </span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          
          
            <li>
              <a href="{{ url('/interview-survey') }}">
                <i class="bi bi-circle"></i><span>Interview Survey</span>
              </a>
            </li>

            <li>
              <a href="{{ url('/recruitment-survey') }}">
                <i class="bi bi-circle"></i><span>Recruitment Survey</span>
              </a>
            </li>

            <li>
              <a href="{{ url('/training-survey') }}">
                <i class="bi bi-circle"></i><span>Training Survey</span>
              </a>
            </li>

            @if((Auth::user()->joining_date) <= $last45days)
            <li>
              <a href="{{ url('/member-check-in-form') }}">
                <i class="bi bi-circle"></i><span>Member Check-In Form</span>
              </a>
            </li>
            @endif

            @if((Auth::user()->joining_date) <= $last70days)
            <li>
              <a href="{{ url('/fresh-eye-journal-form') }}">
                <i class="bi bi-circle"></i><span>Fresh Eye Journal</span>
              </a>
            </li>
            @endif 

            <li>
              <a href="{{ url('/ppt-upload') }}">
                <i class="bi bi-upload"></i>
                <span>Upload PPT</span>
              </a>
            </li>
            
            
          

          
          
          @if(Auth::user()->role_id=='3')
          <li>
            <a href="{{ url('/hiring-survey') }}">
              <i class="bi bi-circle"></i><span>Hiring Survey</span>
            </a>
          </li>

          <li>
            <a href="{{ url('/manager-check-in-form') }}">
              <i class="bi bi-circle"></i><span>Manager Check-In Form</span>
            </a>
          </li>

          <li>
            <a href="{{ url('/confirmation-feedback-form') }}">
              <i class="bi bi-circle"></i><span>Confirmation Feedback Form</span>
            </a>
          </li>

          
          <li>
            <a href="{{ url('/manager-mom') }}">
              <i class="bi bi-journal-text"></i>
              <span>MOM</span>
            </a>
          </li>

          @endif


          @if(Auth::user()->role_id=='5')
          <li>
            <a href="{{ url('/confirmation-process-initation-form') }}">
              <i class="bi bi-circle"></i><span>Confirmation Process Initation Form</span>
            </a>
          </li>

          <!-- <li>
            <a href="{{ url('/fresh-eye-journal-form') }}">
              <i class="bi bi-circle"></i><span>Fresh Eye Journal Form</span>
            </a>
          </li> -->
          @endif

          @if((Auth::user()->role_id=='5') || (Auth::user()->role_id=='6') || (Auth::user()->role_id=='7') || (Auth::user()->role_id=='8'))
          <li>
            <a href="{{ url('confirmation-process-mom-email') }}">
              <i class="bi bi-hand-thumbs-up-fill"></i>
              <span>Confirmation Process</span>
            </a>
          </li>

          <li>
            <a href="{{ url('/hr-generate-emails') }}">
              <i class="bi bi-journal-text"></i>
              <span>Generate Emails</span>
            </a>
          </li>

          <li>
            <a href="{{ url('/hr-mom') }}">
              <i class="bi bi-journal-text"></i>
              <span>MOM</span>
            </a>
          </li>

          @endif

        </ul>
      </li><!-- End Forms Nav -->


      

      <!-- @if(Auth::user()->role_id=='1')
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ url('/ppt-upload') }}">
          <i class="bi bi-upload"></i>
          <span>Upload PPT</span>
        </a>
      </li>
      @endif -->


      

      @if(Auth::user()->role_id=='7')
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-gear-fill"></i><span>Manage Setting</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{ url('/manage-roles') }}">
              <i class="bi bi-circle"></i><span>Manage Roles</span>
            </a>
          </li>


          <li>
            <a href="{{ url('/manage-company-names') }}">
              <i class="bi bi-circle"></i><span>Manage Company Name</span>
            </a>
          </li>


          <li>
            <a href="{{ url('/manage-company-locations') }}">
              <i class="bi bi-circle"></i><span>Manage Company Locations</span>
            </a>
          </li>


          <li>
            <a href="{{ url('/manage-job-opening-types') }}">
              <i class="bi bi-circle"></i><span>Manage Job Opening Types</span>
            </a>
          </li>

          <li>
            <a href="{{ url('/manage-departments') }}">
              <i class="bi bi-circle"></i><span>Manage Departments</span>
            </a>
          </li>

          <li>
            <a href="{{ url('/manage-designations') }}">
              <i class="bi bi-circle"></i><span>Manage Designations</span>
            </a>
          </li>

          
        </ul>
      </li><!-- End Tables Nav -->
      @endif

      <!-- <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-bar-chart"></i><span>Charts</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="charts-chartjs.html">
              <i class="bi bi-circle"></i><span>Chart.js</span>
            </a>
          </li>
          <li>
            <a href="charts-apexcharts.html">
              <i class="bi bi-circle"></i><span>ApexCharts</span>
            </a>
          </li>
          <li>
            <a href="charts-echarts.html">
              <i class="bi bi-circle"></i><span>ECharts</span>
            </a>
          </li>
        </ul>
      </li> --><!-- End Charts Nav -->

      <!-- <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-gem"></i><span>Icons</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="icons-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="icons-bootstrap.html">
              <i class="bi bi-circle"></i><span>Bootstrap Icons</span>
            </a>
          </li>
          <li>
            <a href="icons-remix.html">
              <i class="bi bi-circle"></i><span>Remix Icons</span>
            </a>
          </li>
          <li>
            <a href="icons-boxicons.html">
              <i class="bi bi-circle"></i><span>Boxicons</span>
            </a>
          </li>
        </ul>
      </li> --><!-- End Icons Nav -->

      <!-- <li class="nav-heading">Pages</li> -->

      <!--
        <li class="nav-item">
        <a class="nav-link collapsed" href="users-profile.html">
          <i class="bi bi-person"></i>
          <span>Profile</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-faq.html">
          <i class="bi bi-question-circle"></i>
          <span>F.A.Q</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-contact.html">
          <i class="bi bi-envelope"></i>
          <span>Contact</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-register.html">
          <i class="bi bi-card-list"></i>
          <span>Register</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-login.html">
          <i class="bi bi-box-arrow-in-right"></i>
          <span>Login</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-error-404.html">
          <i class="bi bi-dash-circle"></i>
          <span>Error 404</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-blank.html">
          <i class="bi bi-file-earmark"></i>
          <span>Blank</span>
        </a>
      </li>
      -->

    </ul>

  </aside><!-- End Sidebar-->