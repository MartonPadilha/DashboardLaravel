<div class="sidebar" data-color="orange" data-background-color="white" data-image="{{ asset('material') }}/img/sidebar-1.jpg">
  <div class="logo">
    <a href="#" class="simple-text logo-normal">
      {{ __('FrangoPan') }}
    </a>
  </div>
  <div class="sidebar-wrapper">
        
        <ul class="nav">
            <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('home') }}">
                <i class="material-icons">dashboard</i>
                  <span>{{ __('DASHBOARD') }}</span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'profile' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('profile.edit') }}">
                <i class="material-icons">account_circle</i>
                <span class="sidebar-normal">{{ __('MEU PERFIL') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'client-management' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('client.index') }}">
              <i class="material-icons">supervisor_account</i>
                <span class="sidebar-normal"> {{ __('CLIENTES') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'demand-management' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('demand.index') }}">
              <i class="material-icons">content_paste</i>
                <span class="sidebar-normal"> {{ __('PEDIDOS') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'product-management' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('product.index') }}">
              <i class="material-icons">fastfood</i>
                <span class="sidebar-normal"> {{ __('PRODUTOS') }} </span>
              </a>
            </li>
            
            <li class="nav-item {{ ($activePage == 'category-management' || $activePage == 'um-management') ? ' active' : '' }}">
              <a class="nav-link" data-toggle="collapse" href="#laravelExample" aria-expanded="true">
                <i class="material-icons">format_align_left</i>
                <span class="sidebar-normal">{{ __('COMPLEMENTOS') }}
                  <b class="caret"></b>
                </span>
              </a>
              <div class="collapse show" id="laravelExample">
                <ul class="nav">
                  <li class="nav-item{{ $activePage == 'category-management' ? ' active' : '' }}">
                    <a class="nav-link" href="{{ route('category.index') }}">
                    <i class="material-icons">local_dining</i>
                      <span class="sidebar-normal"> {{ __('CATEGORIAS') }} </span>
                    </a>
                  </li>
                  <li class="nav-item{{ $activePage == 'um-management' ? ' active' : '' }}">
                    <a class="nav-link" href="{{ route('um.index') }}">
                    <i class="material-icons">info</i>
                      <span class="sidebar-normal"> {{ __('UNIDADES DE MEDIDA') }} </span>
                    </a>
                  </li>
                </ul>
              </div>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="{{ route('logout') }}">
              <i class="material-icons">close</i>
                <span class="sidebar-normal"> {{ __('SAIR') }} </span>
              </a>
            </li>
      </li>

      <style>
        ul li span{
          font-size: 15px;
          white-space: nowrap;
          letter-spacing: 1px;
        }
      </style>

    </ul>
  </div>
</div>