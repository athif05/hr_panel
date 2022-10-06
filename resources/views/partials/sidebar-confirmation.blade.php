<div class="sidebar">
    <div class="emp_profile">
      <div class="emp_img">

        @if(session('member_profile_image'))
          <img src="{{ str_replace('public/', '', asset('')).session('member_profile_image') }}" alt="VCOne">
        @else
          <img src="{{ asset('assests/confirmation-process/img/no-user-profile.png') }}" alt="img" class="mCS_img_loaded">
        @endif
        
      </div>
    </div>

      <ul>
          <li class="{{ request()->is('start-confirmation-process/*') ? 'active' : '' }}" >
            <a href="{{ url('/start-confirmation-process/'.$employee_id) }}">Member DETAILS</a>
          </li>

          <li class="{{ request()->is('recruitment-survey/*') ? 'active' : '' }}">
            <a href="{{ url('/recruitment-survey/'.$employee_id) }}">Recruitment Survey</a>
          </li>

          <li class="{{ request()->is('interview-survey/*') ? 'active' : '' }}">
            <a href="{{ url('/interview-survey/'.$employee_id) }}">Interview Survey</a>
          </li>

          <li class="{{ request()->is('training-survey/*') ? 'active' : '' }}">
            <a href="{{ url('/training-survey/'.$employee_id) }}">Training Survey</a>
          </li>

          <li class="{{ request()->is('member-check-in-from/*') ? 'active' : '' }}">
            <a href="{{ url('/member-check-in-from/'.$employee_id) }}">45 Days Member Check-In Form</a>
          </li>

          <li class="{{ request()->is('fresh-eye-journal/*') ? 'active' : '' }}">
            <a href="{{ url('/fresh-eye-journal/'.$employee_id) }}">Fresh Eye Journal</a>
          </li>

          <li class="{{ request()->is('ppt/*') ? 'active' : '' }}">
            <a href="{{ url('/ppt/'.$employee_id) }}">Member's PPT</a>
          </li>

          <li class="{{ request()->is('manager-check-in-from/*') ? 'active' : '' }}">
            <a href="{{ url('/manager-check-in-from/'.$employee_id) }}">45 Days Check-In Form (Manager's Feedback)</a>
          </li>

          <li class="{{ request()->is('manager-confirmation-feedback-form/*') ? 'active' : '' }}">
            <a href="{{ url('/manager-confirmation-feedback-form/'.$employee_id) }}">Manager Feedback For Confirmation</a>
          </li>

          <li class="{{ request()->is('stakeholder-feedback/*') ? 'active' : '' }}">
            <a href="{{ url('/stakeholder-feedback/'.$employee_id) }}">Stakeholder’s Feedback</a>
          </li>

          <li class="{{ request()->is('mom-form/*') ? 'active' : '' }}">
            <a href="{{ url('/mom-form/'.$employee_id) }}">MOM Form</a>
          </li>

          <!-- <li class="{{ request()->is('thankyou/*') ? 'active' : '' }}">
            <a href="{{ url('/thankyou/'.$employee_id) }}">THANK YOU</a>
          </li> -->
      </ul>  
      
</div>