        <div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
                <div id="sidebar-menu" class="sidebar-menu">
                    <ul>
                        <li class="menu-title">Main</li>
                        {{-- <li>
                            <a class="active" href=""><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
                        </li> --}}

                        <li class="submenu">
							<a href="#"><i class="fa fa-user" aria-hidden="true"></i> <span> Product </span> <span class="menu-arrow"></span></a>
                            <ul style="display: none;">
                                <li><a href="{{route('product.index')}}">All product</a></li>
                                <li><a href="{{route('product.create')}}">Add Product</a></li>
                                {{-- <li><a href="{{route('return_product.create')}}">Return Drug</a></li> --}}
                             </ul>
                        </li>

                        <li>
                            <a class="active" href="/receipt/create"><i class="fa fa-dashboard"></i> <span>Check Receipt</span></a>
                        </li>

                        {{-- <li>
                            <a class="active" href="{{route('product.create')}}"><i class="fa fa-dashboard"></i> <span>Submit Account</span></a>
                        </li> --}}

                        {{-- <li class="submenu">
							<a href="#"><i class="fa fa-user" aria-hidden="true"></i> <span> Stocks </span> <span class="menu-arrow"></span></a>
                            <ul style="display: none;">
                                <li><a href="{{route('stocks.index')}}">All Stocks</a></li>
                             </ul>
                        </li> --}}

                        <li class="submenu">
							<a href="#"><i class="fa fa-user" aria-hidden="true"></i> <span> Sales </span> <span class="menu-arrow"></span></a>
                            <ul style="display: none;">
                                <li><a href="{{route('sales.index')}}">All Confirmed Sales</a></li>
                                <li><a href="{{route('sales.create')}}">Unconfirmed Sales</a></li>
                             </ul>
                        </li>

                        <li>
                            <a class="active" href="{{route('user.create')}}"><i class="fa fa-dashboard"></i> <span>Add User</span></a>
                        </li>

                        <li class="submenu">
							<a href="#"><i class="fa fa-user" aria-hidden="true"></i> <span> Reports </span> <span class="menu-arrow"></span></a>
                            <ul style="display: none;">
                                <li><a href="{{route('monthly_index')}}">Monthly</a></li>
                                <li><a href="{{route('yearly_index')}}">Yearly</a></li>
                             </ul>
                        </li>

                        <li>
                            <form class="flogout" method="POST" action="{{route('logout')}}">
                                @csrf
                                <a class="active logout" href="javascript:void(0);"><i class="fa fa-dashboard"></i> <span>Logout</span></a>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <script>
            $('.logout').click(function(){
                $('.flogout').submit();
            });
        </script>
