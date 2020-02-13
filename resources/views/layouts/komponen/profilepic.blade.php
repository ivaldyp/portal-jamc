<li class="dropdown">
    <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#"> 
      <?php 
        if (isset($_SESSION['user_data']['foto'])) {
          echo "<img src='http://bpad.jakarta.go.id/images/emp/".$_SESSION['user_data']['foto']."' alt='user-img' width='36' class='img-circle'>";
        }
      ?>

      <b class="hidden-xs">Welcome</b><span class="caret"></span> </a>
    <ul class="dropdown-menu dropdown-user animated flipInY">
        <li>
            <div class="dw-user-box">                
                <div class="u-text"><h4><?php echo isset($_SESSION['user_data']['nm_emp']) ? $_SESSION['user_data']['nm_emp'] : $_SESSION['user_data']['nama_user']; ?></h4><p class="text-muted"><?php echo isset($_SESSION['user_data']['email_emp']) ? $_SESSION['user_data']['email_emp'] : $_SESSION['user_data']['email_user']; ?></p></div>
            </div>
        </li>
        <li role="separator" class="divider"></li>
        <li><a href="#"><i class="ti-user"></i> My Profile</a></li>
        <li><a href="#"><i class="ti-email"></i> Inbox</a></li>
        <li role="separator" class="divider"></li>
        <li class="user-footer">
          <div class="pull-right p-r-30">
            <!-- <a href="{{ route('logout') }}" class="btn btn-danger btn-flat">Sign out</a> -->
            <a class="dropdown-item btn btn-danger" href="{{ route('logout') }}"
              onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
              {{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          </div>
        </li>
    </ul>
    <!-- /.dropdown-user -->
</li>
<!-- /.dropdown -->