<nav>
	<ul>
	    @foreach($items as $menu_item)
	        <li class=""><a class="{{ Request::is($menu_item->link())? 'hot' : ''}}" href="{{ $menu_item->link() }}">{{ $menu_item->title }}</a>
	        	@php
		            $submenu = $menu_item->children;

		        @endphp

		        @if(isset($submenu) && count($submenu) > 0)
		            <ul class="submenu">
		                @foreach($submenu as $item)
		                    <li><a href="{{$item->link()}}">{{$item->title}} </a>
			                    @php
						            $sub2menu = $item->children;
						        @endphp

						        @if(isset($sub2menu) && count($sub2menu) > 0)
						            <ul class="submenu">
						                @foreach($sub2menu as $sub2_item)
						                    <li><a href="{{$sub2_item->link()}}">{{$sub2_item->title}} </a></li>
						                    
						                @endforeach
						            </ul>
						        @endif
					        </li>
		                @endforeach
		            </ul>
		        @endif
	        </li>
	    @endforeach
	</ul>
</nav>