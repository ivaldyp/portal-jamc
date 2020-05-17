<li class="dropdown">
	<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#"> 
	  <?php if ($_SESSION['user_data']['foto'] && $_SESSION['user_data']['foto'] != '') : ?>
			<img src="{{ config('app.openfileimg') }}/{{ $_SESSION['user_data']['foto'] }}" width="36" class=" img-circle" alt="img">
		<?php else : ?>
			<img src="{{ config('app.openfileimgdefault') }}" width="36" class=" img-circle" alt="img">
		<?php endif ?>

	  <b class="hidden-xs pull-right">Welcome</b><span class="caret"></span> </a>
	<ul class="dropdown-menu dropdown-user animated flipInY">
		<li>
			<div class="dw-user-box">                
				<div class="u-text"><h4><?php echo isset($_SESSION['user_data']['nm_emp']) ? $_SESSION['user_data']['nm_emp'] : $_SESSION['user_data']['nama_user']; ?></h4><p class="text-muted"><?php echo isset($_SESSION['user_data']['email_emp']) ? $_SESSION['user_data']['email_emp'] : '-'; ?></p><h4><?php echo $_SESSION['user_data']['idgroup']; ?></h4></div>
			</div>
		</li>
		<li role="separator" class="divider"></li>
		<li><a href="#"><i class="ti-user"></i> My Profile</a></li>
		<li><a href="#"><i class="ti-email"></i> Inbox</a></li>
		<li role="separator" class="divider"></li>
		<li class="user-footer">
		  <div class="pull-right p-r-30">
			<!-- <a href="{{ route('logout') }}" class="btn btn-danger btn-flat">Sign out</a> -->
			<!-- <a class="dropdown-item btn btn-danger" href="{{ route('logout') }}"
			  onclick="event.preventDefault();
			  document.getElementById('logout-form').submit();">
			  {{ __('Logout') }}
			</a> -->
			<a class="dropdown-item btn btn-danger" href="{{ url('logout') }}">
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