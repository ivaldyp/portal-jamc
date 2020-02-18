@section('content')

@foreach(App\Sec_menu::join('sec_access', 'sec_access.idtop', '=', 'sec_menu.ids')
          // ->where('sec_menu.sao', 'not like', '')
          ->where('sec_menu.tipe', 'l')
          ->whereRaw('LEN(sec_menu.urut) = 1')
          ->where('sec_access.idgroup', $_SESSION['user_data']['idgroup'])
          ->where('sec_access.zviw', 'y')
          ->orderByRaw('CONVERT(INT, sec_menu.sao)')
          ->orderBy('sec_menu.urut')
          ->get() as $menuItem)

  @if( $menuItem->sao == '' ) 
     <li {{ $menuItem->urlnew ? '' : "class=dropdown" }}>
     <a href="{{ $menuItem->children->isEmpty() ? $menuItem->urlnew : "#" }}"{{ $menuItem->children->isEmpty() ? '' : "class=dropdown-toggle data-toggle=dropdown role=button aria-expanded=false" }}>
        {{ $menuItem->desk }}
     </a>
  @endif

  @if( !($menuItem->children->isEmpty()) )
    <ul class="dropdown-menu" role="menu">
      @foreach($menuItem->children as $subMenuItem)
          <li><a href="{{ $subMenuItem->urlnew }}">{{ $subMenuItem->desk }}</a></li>
      @endforeach
    </ul>
  @endif
  </li> 

@endforeach
@php
die;
@endphp
@endsection
