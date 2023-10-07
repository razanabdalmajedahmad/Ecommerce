<aside id="sidebar"  class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link {{!(Route::currentRouteName() == "admin_home") ? 'collapsed' : ''}}" class="" href="{{route('admin_home')}}">
          <i class="bi bi-grid"></i>
          <span>{{__('all.Dashboard')}}</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link {{!(in_array(Route::currentRouteName(),['Categure_list','Categure_createnew','Categure_update'])) ? 'collapsed' : ''}}" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>{{__('all.Categure')}}</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse {{(in_array(Route::currentRouteName(),['Categure_list','Categure_createnew','Categure_update'])) ? 'show' : ''}}" data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{route('Categure_list')}}" class="{{(Route::currentRouteName()== 'Categure_list')? "active" : ""}}" >
              <i class="bi bi-circle"></i><span>{{__('all.ViewAll')}}</span>
            </a>
          </li>

        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link {{!(in_array(Route::currentRouteName(),['prodact_list','prodact_createnew','prodact_update'])) ? 'collapsed' : ''}}" data-bs-target="#components-nav1" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>{{__('all.Prodacts')}}</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav1" class="nav-content collapse {{(in_array(Route::currentRouteName(),['prodact_list','prodact_createnew','prodact_update'])) ? 'show' : ''}}" data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{route('prodact_list')}}" class="{{(Route::currentRouteName()== 'prodact_list')? "active" : ""}}" >
              <i class="bi bi-circle"></i><span>{{__('all.ViewAll')}}</span>
            </a>
          </li>

        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link {{!(in_array(Route::currentRouteName(),['coupon_list','coupon_createnew','coupon_update'])) ? 'collapsed' : ''}}" data-bs-target="#components-nav2" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>{{__('all.coupons')}}</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav2" class="nav-content collapse {{(in_array(Route::currentRouteName(),['coupon_list','coupon_createnew','coupon_update'])) ? 'show' : ''}}" data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{route('coupon_list')}}" class="{{(Route::currentRouteName()== 'coupon_list')? "active" : ""}}" >
              <i class="bi bi-circle"></i><span>{{__('all.ViewAll')}}</span>
            </a>
          </li>

        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link {{!(Route::currentRouteName() == "setting") ? 'collapsed' : ''}}" class="" href="{{route('setting')}}">
          <i class="bi bi-grid"></i>
          <span>{{__('all.setting')}}</span>
        </a>
      </li>




    </ul>

  </aside>
