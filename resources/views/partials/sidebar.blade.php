<?php
$todat_date=date('Y-m-d');
$last2days=date('Y-m-d', strtotime('-2 day', strtotime($todat_date)));
$last30days=date('Y-m-d', strtotime('-30 day', strtotime($todat_date)));
$last45days=date('Y-m-d', strtotime('-45 day', strtotime($todat_date)));
$last70days=date('Y-m-d', strtotime('-70 day', strtotime($todat_date)));
?>
<!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">
    <div class="logo">

      @if(session('company_logo'))
          <img src="{{ asset(session('company_logo')) }}" alt="VCOne">
      @else
        <img src="{{ asset('assests/assets/img/logo.png') }}" alt="VCOne">
      @endif

      <!-- <img src="{{ asset('assests/assets/img/logo.png') }}" alt="VCOne"> -->
    </div>
    <ul class="sidebar-nav" id="sidebar-nav">

      
      <li class="nav-item">
        <a class="nav-link " href="{{ url('/home') }}">
			
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->
      

      <!-- individual panel sidebar, start here -->
      <li class="nav-item">
        <a class="nav-link" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
			   <span class="shape1"></span>
          <span class="shape2"></span>
          <i class="bi bi-journal-text"></i><span>Confirmation Panel (Individual) </span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content  " data-bs-parent="#sidebar-nav">
          
            @if((Auth::user()->joining_date) <= $last2days)
              <li>
                <a href="{{ url('/interview-survey') }}" class="{{ request()->is('interview-survey','interview-survey-edit/*') ? 'active' : '' }}">
                  <i class="bi bi-circle"></i><span>Interview Survey</span>
                </a>
              </li>

              <li>
                <a href="{{ url('/recruitment-survey') }}" class="{{ request()->is('recruitment-survey','recruitment-survey-edit/*') ? 'active' : '' }}">
                  <i class="bi bi-circle"></i><span>Recruitment Survey</span>
                </a>
              </li>

            
            @endif

            @if((Auth::user()->joining_date) <= $last45days)
            <li>
              <a href="{{ url('/member-check-in-form') }}" class="{{ request()->is('member-check-in-form','member-check-in-form-edit/*') ? 'active' : '' }}">
                <i class="bi bi-circle"></i><span>45 Days Check-In Form</span>
              </a>
            </li>
            @endif

           <li>
              <a href="{{ url('/training-survey') }}" class="{{ request()->is('training-survey','training-survey-edit/*') ? 'active' : '' }}">
                <i class="bi bi-circle"></i><span>Training Survey</span>
              </a>
            </li>

            @if((Auth::user()->joining_date) <= $last70days)
            <li>
              <a href="{{ url('/fresh-eye-journal-form') }}" class="{{ request()->is('fresh-eye-journal-form','fresh-eye-journal-form-edit/*') ? 'active' : '' }}">
                <i class="bi bi-circle"></i><span>Fresh Eye Journal</span>
              </a>
            </li>
            @endif


            @if(session('is_under_pip_member'))
            <li>
              <a href="{{ url('/member-pip-show') }}" class="{{ request()->is('member-pip-show') ? 'active' : '' }}">
                <i class="bi bi-circle"></i><span>PIP Form</span>
              </a>
            </li>
            @endif


            <li>
              <a href="{{ url('/ppt-upload') }}" class="{{ request()->is('ppt-upload') ? 'active' : '' }}">
                <i class="bi bi-upload"></i>
                <span>Upload PPT</span>
              </a>
            </li>


            @if(Auth::user()->employee_type=='Confirmed')
            <li>
              <a href="{{ url('/manager-check-in-form-feedback') }}" class="{{ request()->is('manager-check-in-form-feedback') ? 'active' : '' }}">
                <i class="bi bi-circle"></i><span>45 Days Manager Check-In Form Feedback</span>
              </a>
            </li>

            <li>
              <a href="{{ url('/confirmation-feedback-show-to-member') }}" class="{{ request()->is('confirmation-feedback-show-to-member') ? 'active' : '' }}">
                <i class="bi bi-circle"></i><span>Manager Confirmation Feedback</span>
              </a>
            </li>
          @endif
          
          <li>
            <a href="{{ url('/stakeholder-form-list') }}" class="{{ request()->is('stakeholder-form-list','stake-holder-feedback-form/*','stake-holder-feedback-form-edit/*/*') ? 'active' : '' }}">
              <i class="bi bi-upload"></i>
              <span>Stakeholder Form</span>
            </a>
          </li>

        </ul>
      </li><!-- End Forms Nav -->
      <!-- individual panel sidebar, end here -->


      
      <!-- manager panel sidebar, start here -->
      @if(Auth::user()->role_id=='3')
        <li class="nav-item">
          <a class="nav-link" data-bs-target="#forms-nav-manager" data-bs-toggle="collapse" href="#">
           <span class="shape1"></span>
            <span class="shape2"></span>
            <i class="bi bi-journal-text"></i><span>Confirmation Panel (Manager) </span><i class="bi bi-chevron-down ms-auto"></i>
          </a>
          <ul id="forms-nav-manager" class="nav-content " data-bs-parent="#sidebar-nav">
          
            <li>
              <a href="{{ url('/hiring-survey-list') }}" class="{{ request()->is('hiring-survey-list','hiring-survey/*','hiring-survey-edit/*/*') ? 'active' : '' }}">
                <i class="bi bi-circle"></i><span>Hiring Survey</span>
              </a>
            </li>

            <li>
              <a href="{{ url('/manager-check-in-form') }}" class="{{ request()->is('manager-check-in-form','manager-check-in-form/*','manager-check-in-form-edit/*/*') ? 'active' : '' }}">
                <i class="bi bi-circle"></i><span>45 Days Manager Check-In Form List</span>
              </a>
            </li>

            <li>
              <a href="{{ url('/confirmation-feedback-form') }}" class="{{ request()->is('confirmation-feedback-form','confirmation-feedback-form/*','confirmation-feedback-form-edit/*/*','confirmation-feedback-form-show/*/*') ? 'active' : '' }}">
                <i class="bi bi-circle"></i><span>Manager’s Feedback for Confirmation List</span>
              </a>
            </li>

            <li>
              <a href="{{ url('/pip-member-list') }}" class="{{ request()->is('pip-member-list','initiating-pip-email-form/*','initiating-pip-email-form-edit/*','pip-closure-form-edit/*','closure-pip-email-form/*') ? 'active' : '' }}">
                <i class="bi bi-circle"></i><span>PIP Member List</span>
              </a>
            </li>

            
            <li>
              <a href="{{ url('/manager-mom') }}" class="{{ request()->is('manager-mom','manager-mom/*','manager-mom-form-edit/*/*','manager-mom-form-show/*/*') ? 'active' : '' }}">
                <i class="bi bi-journal-text"></i>
                <span>MOM</span>
              </a>
            </li>

          </ul>
        </li>
      @endif
      <!-- manager panel sidebar, end here -->



      <!-- hr panel sidebar, start here -->
      @if((Auth::user()->role_id=='5') || (Auth::user()->role_id=='6') || (Auth::user()->role_id=='7') || (Auth::user()->role_id=='8'))
        <li class="nav-item">
          <a class="nav-link" data-bs-target="#forms-nav-hr" data-bs-toggle="collapse" href="#">
           <span class="shape1"></span>
            <span class="shape2"></span>
            <i class="bi bi-journal-text"></i><span>Confirmation Panel (HR) </span><i class="bi bi-chevron-down ms-auto"></i>
          </a>
          <ul id="forms-nav-hr" class="nav-content" data-bs-parent="#sidebar-nav">
        

            @if(Auth::user()->role_id=='5')
            <li>
              <a href="{{ url('/confirmation-process-initation-form') }}">
                <i class="bi bi-circle"></i><span>Confirmation Process Initation Form</span>
              </a>
            </li>
            @endif

            
            <li>
              <a href="{{ url('confirmation-process-mom-email') }}" class="{{ request()->is('confirmation-process-mom-email','mom-email-view/*') ? 'active' : '' }}">
                <i class="bi bi-hand-thumbs-up-fill"></i>
                <span>Confirmation Process</span>
              </a>
            </li>

            <li>
              <a href="{{ url('/hr-generate-emails') }}" class="{{ request()->is('hr-generate-emails','generate-email-form/*','generate-email-form-edit/*') ? 'active' : '' }}">
                <i class="bi bi-journal-text"></i>
                <span>Generate Emails</span>
              </a>
            </li>

            <li>
              <a href="{{ url('/hr-mom') }}" class="{{ request()->is('hr-mom','manager-mom/*','manager-mom-form-edit/*/*','manager-mom-form-show/*/*') ? 'active' : '' }}">
                <i class="bi bi-journal-text"></i>
                <span>MOM</span>
              </a>
            </li>


            <li>
              <a href="{{ url('/hr-pip') }}" class="{{ request()->is('hr-pip','hr-pip-view/*') ? 'active' : '' }}">
                <i class="bi bi-journal-text"></i>
                <span>PIP</span>
              </a>
            </li>


          </ul>
        </li><!-- End Forms Nav -->
      @endif
      <!-- hr panel sidebar, end here -->

      
      

      <!-- @if(Auth::user()->role_id=='1')
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ url('/ppt-upload') }}">
          <i class="bi bi-upload"></i>
          <span>Upload PPT</span>
        </a>
      </li>
      @endif -->


      <li class="nav-item">
          <a class="nav-link" data-bs-target="#forms-nav-road-fy" data-bs-toggle="collapse" href="#">
           <span class="shape1"></span>
            <span class="shape2"></span>
            <i class="bi bi-journal-text"></i><span>ROAD to FY </span><i class="bi bi-chevron-down ms-auto"></i>
          </a>
          <ul id="forms-nav-road-fy" class="nav-content" data-bs-parent="#sidebar-nav">
            
            @if((Auth::user()->role_id=='5') || (Auth::user()->role_id=='6') || (Auth::user()->role_id=='7') || (Auth::user()->role_id=='8'))
            <!-- <li>
              <a href="{{ url('/create-annual-review-form') }}" class="{{ request()->is('confirmation-process-mom-email','mom-email-view/*') ? 'active' : '' }}">
                <i class="bi bi-hand-thumbs-up-fill"></i>
                <span>Create Review Form</span>
              </a>
            </li> -->

            <li>
              <a href="{{ url('/manage-annual-review-form') }}" class="{{ request()->is('confirmation-process-mom-email','mom-email-view/*') ? 'active' : '' }}">
                <i class="bi bi-hand-thumbs-up-fill"></i>
                <span>Manage Annual Review Form</span>
              </a>
            </li>
            @endif

            <li>
              <a href="{{ url('/road-fy') }}" class="{{ request()->is('hr-generate-emails','generate-email-form/*','generate-email-form-edit/*') ? 'active' : '' }}">
                <i class="bi bi-journal-text"></i>
                <span>Show ROAD Review</span>
              </a>
            </li>

            


          </ul>
        </li>

      

      @if(Auth::user()->role_id=='7')
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav-management" data-bs-toggle="collapse" href="#">
          <i class="bi bi-gear-fill"></i><span>Manage Setting</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav-management" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{ url('/manage-roles') }}" class="{{ request()->is('manage-roles','add-new-role','edit-role/*') ? 'active' : '' }}">
              <i class="bi bi-circle"></i><span>Manage Roles</span>
            </a>
          </li>


          <li>
            <a href="{{ url('/manage-company-names') }}" class="{{ request()->is('manage-company-names','add-new-company','edit-company-name/*') ? 'active' : '' }}">
              <i class="bi bi-circle"></i><span>Manage Company Name</span>
            </a>
          </li>


          <li>
            <a href="{{ url('/manage-company-locations') }}" class="{{ request()->is('manage-company-locations','add-new-location','edit-company-location/*') ? 'active' : '' }}">
              <i class="bi bi-circle"></i><span>Manage Company Locations</span>
            </a>
          </li>


          <li>
            <a href="{{ url('/manage-job-opening-types') }}" class="{{ request()->is('manage-job-opening-types','add-new-job-opening-type','edit-job-opening-type/*') ? 'active' : '' }}">
              <i class="bi bi-circle"></i><span>Manage Job Opening Types</span>
            </a>
          </li>

          <li>
            <a href="{{ url('/manage-departments') }}" class="{{ request()->is('manage-departments','add-new-department','edit-department/*') ? 'active' : '' }}">
              <i class="bi bi-circle"></i><span>Manage Departments</span>
            </a>
          </li>

          <li>
            <a href="{{ url('/manage-designations') }}" class="{{ request()->is('manage-designations','add-new-designation','edit-designation/*') ? 'active' : '' }}">
              <i class="bi bi-circle"></i><span>Manage Designations</span>
            </a>
          </li>

          <li>
            <a href="{{ url('/manage-achievements') }}" class="{{ request()->is('manage-achievements','add-new-achievement','edit-achievement/*') ? 'active' : '' }}">
              <i class="bi bi-circle"></i><span>Manage Achievements</span>
            </a>
          </li>

          
        </ul>
      </li><!-- End Tables Nav -->
      @endif

      
    </ul>



<!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>{{ env('MY_SITE_NAME') }}</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      Designed by <a href="https://vcommission.com/">VCOne</a>
    </div>
  </footer><!-- End Footer -->


  </aside><!-- End Sidebar-->