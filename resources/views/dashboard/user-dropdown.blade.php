<div class="dropdown">
  <!-- Botão Trigger -->
  <button class="btn btn-link dropdown-toggle p-0 border-0" type="button" id="dropdownUser" data-bs-toggle="dropdown"
    aria-expanded="false">
    <div class="user-profile-mini">
      <img id="userAvatarMini"
        src="{{ Auth::check() ? Auth::user()->foto_url : asset('uploads/users/default-user.png') }}" alt="Foto"
        class="user-avatar-sm">
      <span id="userNameMini"
        class="user-name-sm">{{ Auth::check() ? explode(' ', Auth::user()->name)[0] : 'Utilizador' }}</span>
      <i class="bi bi-chevron-down"></i>
    </div>
  </button>

  <!-- Dropdown Menu -->
  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-user" aria-labelledby="dropdownUser">
    <!-- Header com Dados do Utilizador -->
    <li>
      <span class="dropdown-header">
        <div class="dropdown-user-info">
          <img id="dropdownAvatarLarge"
            src="{{ Auth::check() ? Auth::user()->foto_url : asset('uploads/users/default-user.png') }}" alt="Foto"
            class="avatar-md">
          <div class="user-info-text">
            <strong id="dropdownNameUser"> {{ Auth::check() ? Auth::user()->name : 'Utilizador' }} </strong>
            <small id="dropdownNivelUser" class="text-muted">
              @if(Auth::check())
                {{ ucfirst(Auth::user()->nivel) }} ·
                <span class="badge bg-success">{{ Auth::user()->estado }}</span>
              @else
                Sem sessão
              @endif
            </small>
          </div>
        </div>
      </span>
    </li>

    <li>
      <hr class="dropdown-divider">
    </li>

    <!-- Menu Items -->
    <li>
      <a class="dropdown-item" href="#" id="minhaConta">
        <i class="bi bi-person-gear"></i> Minha Conta
      </a>
    </li>
    <li>
      <a class="dropdown-item" href="#" id="themeToggle">
        <i class="bi bi-moon-stars-fill" id="themeIcon"></i>
        <span id="themeLabel">Modo Escuro</span>
      </a>
    </li>

    <li>
      <hr class="dropdown-divider">
    </li>

    <!-- Logout -->
    <li>
      <form id="logoutForm" method="POST" action="{{ route('logout') }}" class="dropdown-item item-logout p-0">
        @csrf
        <button type="submit" class="btn btn-link w-100 text-start">
          <i class="bi bi-box-arrow-right"></i> Sair
        </button>
      </form>
    </li>
  </ul>
</div>