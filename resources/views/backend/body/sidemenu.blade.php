<div class="page-sidebar sidebar">
  <div class="page-sidebar-inner slimscroll">
    <ul class="menu accordion-menu">
      @if(routePrefix() === 'admin')
      <li class="@yield('dashboard_active')">
        <a href="{{ url( routePrefix() . '/dashboard') }}" class="waves-effect waves-button"><span
            class="menu-icon icon-home"></span>
          <p>Dashboard</p><span class="active-page"></span>
        </a>
      </li>

      <li class="@yield('slider_active')"><a href="{{ url( routePrefix() . '/sliders') }}"
          class="waves-effect waves-button"><span class="menu-icon icon-screen-desktop"></span>
          <p>Sliders</p>
        </a>
      </li>

      <li class="@yield('banner_active')"><a href="{{ url( routePrefix() . '/banner') }}"
          class="waves-effect waves-button"><span class="menu-icon icon-picture"></span>
          <p>Manage Banner</p>
        </a>
      </li>

      <li class="@yield('category_active')"><a href="{{ url( routePrefix() . '/category') }}"
          class="waves-effect waves-button"><span class="menu-icon icon-list"></span>
          <p>Category</p>
        </a>
      </li>

      <li class="@yield('subcategory_active')"><a href="{{ url( routePrefix() . '/subcategory') }}"
          class="waves-effect waves-button"><span class="menu-icon icon-grid"></span>
          <p>Sub-category</p>
        </a>
      </li>

      @endif

      @if(routePrefix() === 'admin' || routePrefix() === 'seller')

      @if(routePrefix() === 'seller')
      @if(auth()->user()->shop && auth()->user()->shop->status == 'Active')
      <li class="@yield('dashboard_active')">
        <a href="{{ url( routePrefix() . '/dashboard') }}" class="waves-effect waves-button"><span
            class="menu-icon icon-home"></span>
          <p>Dashboard</p><span class="active-page"></span>
        </a>
      </li>

      <li class="@yield('order_active')"><a href="{{ url( routePrefix() .'/orders') }}"
          class="waves-effect waves-button"><span class="menu-icon icon-basket-loaded"></span>
          <p>All Orders</p>
        </a>
      </li>

      <li class="@yield('customer_active')"><a href="{{ url( routePrefix() .'/customer-list') }}"
          class="waves-effect waves-button"><span class="menu-icon fa fa-users"></span>
          <p>All Customers</p>
        </a>
      </li>

      <li class="droplink @yield('product_active')"><a href="#" class="waves-effect waves-button"><span
            class="menu-icon icon-present"></span>
          <p>Product Manage</p><span class="arrow"></span>
        </a>
        <ul class="sub-menu">
          <li class="@yield('subproduct_active')"><a href="{{ url(routePrefix(). '/product') }}">Product
              List</a>
          </li>
          <li class="@yield('/subproduct_active1')"><a href="{{ url(routePrefix(). '/product/create') }}">Add New
              Product</a>
          </li>
          <li class="@yield('subproduct_active2')"><a href="{{ url(routePrefix() .'/product-draft') }}">Product
              Draft</a>
          </li>
        </ul>
      </li>
      @endif
      @else

      <li class="@yield('order_active')"><a href="{{ url( routePrefix() .'/orders') }}"
          class="waves-effect waves-button"><span class="menu-icon icon-basket-loaded"></span>
          <p>All Orders</p>
        </a>
      </li>

      <li class="@yield('customer_active')"><a href="{{ url( routePrefix() .'/customer-list') }}"
          class="waves-effect waves-button"><span class="menu-icon fa fa-users"></span>
          <p>All Customers</p>
        </a>
      </li>

      <li class="droplink @yield('product_active')"><a href="#" class="waves-effect waves-button"><span
            class="menu-icon icon-present"></span>
          <p>Product Manage</p><span class="arrow"></span>
        </a>
        <ul class="sub-menu">
          <li class="@yield('subproduct_active')"><a href="{{ url(routePrefix(). '/product') }}">Product
              List</a>
          </li>
          <li class="@yield('/subproduct_active1')"><a href="{{ url(routePrefix(). '/product/create') }}">Add New
              Product</a>
          </li>
          <li class="@yield('subproduct_active2')"><a href="{{ url(routePrefix() .'/product-draft') }}">Product
              Draft</a>
          </li>
        </ul>
      </li>

      <li class="@yield('coupon_active')"><a href="{{ url(routePrefix().'/coupon') }}"
          class="waves-effect waves-button"><span class="menu-icon icon-tag"></span>
          <p>Coupons</p>
        </a>
      </li>
      <li class="@yield('attributes_active')"><a href="{{ url(routePrefix().'/attributes') }}"
          class="waves-effect waves-button"><span class="menu-icon icon-hourglass"></span>
          <p>Attributes</p>
        </a>
      </li>
      <li class="droplink @yield('seller_active')"><a href="#" class="waves-effect waves-button"><span
            class="menu-icon fa fa-user-plus"></span>
          <p>Seller Manage</p><span class="arrow"></span>
        </a>
        <ul class="sub-menu">
          <li class="@yield('subseller')"><a href="{{ url(routePrefix() .'/seller-list') }}">Seller
              List</a></li>
          <li class="@yield('subseller2')"><a href="{{ url(routePrefix() .'/withdraw') }}">Withdraws</a></li>
        </ul>
      </li>


      <li class="@yield('settings_active')"><a href="{{ url( routePrefix() .'/settings') }}"
          class="waves-effect waves-button"><span class="menu-icon icon-settings"></span>
          <p>Settings</p>
        </a>
      </li>

      @endif

      @endif


      @if(routePrefix() === 'seller')
      <li class="@yield('withdraw_active')"><a href="{{ url(routePrefix(). '/withdraw') }}"
          class="waves-effect waves-button"><span class="menu-icon fa fa-users"></span>
          <p>My Withdraws</p>
        </a>
      </li>
      @endif

      @if(routePrefix() === 'customer')
      <li class="@yield('order_active')"><a href="{{ url( routePrefix() .'/orders') }}"
          class="waves-effect waves-button"><span class="menu-icon icon-basket-loaded"></span>
          <p>All Orders</p>
        </a>
      </li>
      @endif

    </ul>
  </div><!-- Page Sidebar Inner -->
</div><!-- Page Sidebar -->