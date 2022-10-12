
	    @foreach($items as $menu_item)
		<div class="col-xl-2 col-lg-3 col-md-3 col-sm-5">
			<div class="single-footer-caption mb-50">
				<div class="footer-tittle">
	        		<h4>{{ $menu_item->title }}</h4>
	        	@php
		            $submenu = $menu_item->children;

		        @endphp

		        @if(isset($submenu) && count($submenu) > 0)
		            <ul>
		                @foreach($submenu as $item)
		                    <li><a href="{{$item->link()}}">{{$item->title}} </a>
			                    @php
						            $sub2menu = $item->children;
						        @endphp

						        @if(isset($sub2menu) && count($sub2menu) > 0)
						            <ul>
						                @foreach($sub2menu as $sub2_item)
						                    <li><a href="{{$sub2_item->link()}}">{{$sub2_item->title}} </a></li>
						                @endforeach
						            </ul>
						        @endif
					        </li>
		                @endforeach
		            </ul>
		        @endif
				</div>
			</div>
		</div>
	    @endforeach