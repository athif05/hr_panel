<div class="sidebar">
    <div class="emp_profile">
      <div class="emp_img">
        <img src="{{ asset('resources/views/confirmation-process/img/no-user-profile.png') }}" alt="img" class="mCS_img_loaded">
      </div>
    </div>

      <ul>
          <li class="{{ request()->is('start-confirmation-process/*') ? 'active' : '' }}" >
            <a href="{{ url('/start-confirmation-process/'.$employee_id) }}">EMPLOYEE DETAILS</a>
          </li>

          <li class="{{ request()->is('interview-survey/*') ? 'active' : '' }}">
            <a href="{{ url('/interview-survey/'.$employee_id) }}">Interview Survey</a>
          </li>

          <li class="{{ request()->is('recruitment-survey/*') ? 'active' : '' }}">
            <a href="{{ url('/recruitment-survey/'.$employee_id) }}">Recruitment Survey</a>
          </li>

          <li class="{{ request()->is('ppt/*') ? 'active' : '' }}">
            <a href="{{ url('/ppt/'.$employee_id) }}">PPT</a>
          </li>

          <li class="{{ request()->is('thankyou/*') ? 'active' : '' }}">
            <a href="{{ url('/thankyou/'.$employee_id) }}">THANK YOU</a>
          </li>
      </ul>  
      
</div>