@foreach($sec_menu as $menu)
    <li> <a href="#" class="waves-effect"><i class="{{ $menu['icon'] }}"></i> <span class="hide-menu">{{ $menu['desk'] }}</span></a> </li>
@endforeach


<li class="devider"></li>