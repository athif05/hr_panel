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

          <li class="{{ request()->is('score-card/*') ? 'active' : '' }}">
            <a href="{{ url('/score-card/'.$employee_id) }}">SCORE CARD</a>
          </li>

          <li class="{{ request()->is('survey/*') ? 'active' : '' }}">
            <a href="{{ url('/survey/'.$employee_id) }}">SURVEY</a>
          </li>

          <li class="{{ request()->is('ppt/*') ? 'active' : '' }}">
            <a href="{{ url('/ppt/'.$employee_id) }}">PPT</a>
          </li>

          <li class="{{ request()->is('evaluation/*') ? 'active' : '' }}">
            <a href="{{ url('/evaluation/'.$employee_id) }}">EVALUATION</a>
          </li>

          <li class="{{ request()->is('feedback/*') ? 'active' : '' }}">
            <a href="{{ url('/feedback/'.$employee_id) }}">FEEDBACK</a>
          </li>

          <li class="{{ request()->is('thankyou/*') ? 'active' : '' }}">
            <a href="{{ url('/thankyou/'.$employee_id) }}">THANK YOU</a>
          </li>
      </ul>  
      
</div>