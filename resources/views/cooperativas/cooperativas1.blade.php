<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>SIAG – Cooperativas</title>

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet"/>
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700&family=DM+Sans:wght@400;500&display=swap" rel="stylesheet"/>

  <style>
    :root {
      --sidebar-bg:       #1B5E20;
      --sidebar-hover:    #2E7D32;
      --sidebar-active:   #2E7D32;
      --accent:           #66BB6A;
      --accent-lt:        #E8F5E9;
      --primary:          #2E7D32;
      --text-dark:        #1C2B1E;
      --text-mid:         #4A6350;
      --text-light:       #8FA894;
      --border:           rgba(0,0,0,.07);
      --card-bg:          #ffffff;
      --page-bg:          #F4F6F4;
      --sidebar-w:        240px;
      --sidebar-w-icons:  68px;
      --topbar-h:         64px;
      --danger:           #C62828;
      --warning:          #F57F17;
      --info:             #1565C0;
    }

    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    body {
      font-family: 'DM Sans', sans-serif;
      background: var(--page-bg);
      color: var(--text-dark);
      min-height: 100vh;
      overflow-x: hidden;
    }

    /* ═══════════════════════════════════════════
       SIDEBAR
    ═══════════════════════════════════════════ */
    #sidebar {
      position: fixed;
      top: 0; left: 0;
      width: var(--sidebar-w);
      height: 100vh;
      background: var(--sidebar-bg);
      display: flex;
      flex-direction: column;
      transition: width .3s ease;
      z-index: 1000;
      overflow: hidden;
    }
    body.icons-only  #sidebar { width: var(--sidebar-w-icons); }
    body.sidebar-hidden #sidebar { width: 0; }

    .sidebar-logo {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 14px 15px;
      border-bottom: 1px solid rgba(255,255,255,.1);
      white-space: nowrap;
      min-height: var(--topbar-h);
      overflow: hidden;
    }
    body.icons-only .sidebar-logo { justify-content: center; padding: 14px 0; }
    body.icons-only .sidebar-logo .logo-text-wrap { opacity: 0; pointer-events: none; width: 0; overflow: hidden; }

    .sidebar-nav { flex: 1; padding: 12px 0; overflow-y: auto; overflow-x: hidden; }
    .sidebar-nav::-webkit-scrollbar { width: 4px; }
    .sidebar-nav::-webkit-scrollbar-thumb { background: rgba(255,255,255,.18); border-radius: 10px; }
    .sidebar-nav { scrollbar-width: thin; scrollbar-color: rgba(255,255,255,.18) transparent; }

    .nav-section-title {
      font-size: 10px; font-weight: 600; letter-spacing: 1.2px;
      text-transform: uppercase; color: rgba(255,255,255,.4);
      padding: 18px 20px 6px; white-space: nowrap; transition: opacity .2s;
    }
    body.icons-only .nav-section-title { opacity: 0; height: 0; padding: 0; overflow: hidden; }

    .nav-item-link {
      display: flex; align-items: center; gap: 12px;
      padding: 11px 18px; color: rgba(255,255,255,.75);
      text-decoration: none; border-radius: 10px; margin: 2px 8px;
      transition: background .2s, color .15s; white-space: nowrap; position: relative;
    }
    .nav-item-link i { font-size: 18px; flex-shrink: 0; width: 22px; text-align: center; }
    .nav-item-link .nav-label { font-size: 14px; font-weight: 500; opacity: 1; transition: opacity .2s; }
    body.icons-only .nav-item-link .nav-label { opacity: 0; pointer-events: none; width: 0; overflow: hidden; }
    body.icons-only .nav-item-link { justify-content: center; padding: 11px 0; margin: 2px 6px; }
    .nav-item-link:hover { background: rgba(255,255,255,.1); color: #fff; }
    .nav-item-link.active {
      background: var(--accent); color: #fff;
      box-shadow: 0 4px 14px rgba(102,187,106,.35);
    }

    .sidebar-tooltip .tooltip-inner {
      background: #0f3d14; color: #fff; font-size: 12.5px; font-weight: 500;
      padding: 5px 12px; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,.3);
    }
    .sidebar-tooltip.bs-tooltip-end .tooltip-arrow::before { border-right-color: #0f3d14; }

    .sidebar-user {
      padding: 14px 10px; border-top: 1px solid rgba(255,255,255,.1);
      display: flex; align-items: center; gap: 10px;
      cursor: pointer; transition: background .2s;
      border-radius: 10px; margin: 4px 6px; white-space: nowrap;
    }
    .sidebar-user:hover { background: rgba(255,255,255,.08); }
    .sidebar-user .avatar {
      width: 34px; height: 34px; background: var(--accent);
      border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;
    }
    .sidebar-user .avatar i { color: #fff; font-size: 16px; }
    .sidebar-user .user-info { opacity: 1; transition: opacity .2s; }
    .sidebar-user .user-info .u-name { font-size: 13px; font-weight: 600; color: #fff; }
    .sidebar-user .user-info .u-role { font-size: 11px; color: rgba(255,255,255,.5); }
    body.icons-only .sidebar-user .user-info { opacity: 0; pointer-events: none; }

    /* ═══════════════════════════════════════════
       TOPBAR
    ═══════════════════════════════════════════ */
    #topbar {
      position: fixed; top: 0; left: var(--sidebar-w); right: 0;
      height: var(--topbar-h); background: #fff;
      border-bottom: 1px solid var(--border);
      display: flex; align-items: center; padding: 0 28px; gap: 16px;
      z-index: 900; transition: left .3s ease;
    }
    body.icons-only  #topbar { left: var(--sidebar-w-icons); }
    body.sidebar-hidden #topbar { left: 0; }

    .topbar-toggle {
      background: none; border: none; font-size: 20px; color: var(--text-mid);
      cursor: pointer; padding: 6px; border-radius: 8px; transition: background .2s, color .2s;
    }
    .topbar-toggle:hover { background: var(--accent-lt); color: var(--primary); }

    .topbar-title {
      font-family: 'Sora', sans-serif; font-size: 16px;
      font-weight: 600; color: var(--text-dark);
    }

    .topbar-right { margin-left: auto; display: flex; align-items: center; gap: 10px; }

    .topbar-icon-btn {
      width: 38px; height: 38px; border: none; background: var(--accent-lt);
      border-radius: 10px; display: flex; align-items: center; justify-content: center;
      color: var(--primary); font-size: 17px; cursor: pointer;
      transition: background .2s, color .2s; position: relative;
    }
    .topbar-icon-btn:hover { background: var(--primary); color: #fff; }
    /* Força todos os ícones Bootstrap para verde primário por defeito */
    .bi { color: var(--primary); }
    /* Excepções: ícones em fundo escuro ou colorido ficam brancos */
    .nav-item-link .bi,
    .sidebar-logo .bi,
    .sidebar-user .bi,
    .modal-header .bi,
    .modal-header-icon .bi,
    .btn-green .bi,
    .topbar-icon-btn:hover .bi,
    .action-btn.edit:hover .bi,
    .action-btn.print:hover .bi,
    .action-btn.delete:hover .bi,
    .action-btn.view:hover .bi,
    .weather-card .bi { color: inherit; }
    /* Ícones em texto normal herdam a cor do pai */
    .topbar-title .bi,
    .table-card-header .bi,
    .cfg-card-title .bi,
    .modal-section-title .bi { color: var(--primary); }
    /* Badges e status usam cor própria */
    .badge-status .bi,
    .badge-safra .bi,
    .stat-badge .bi { color: inherit; }
    /* Inputs e selects */
    .search-wrap .bi { color: var(--text-light); }
    .notif-badge {
      position: absolute; top: 6px; right: 6px; width: 8px; height: 8px;
      background: #E53935; border-radius: 50%; border: 2px solid #fff;
    }

    .topbar-user {
      display: flex; align-items: center; gap: 8px; padding: 6px 12px;
      background: var(--accent-lt); border-radius: 30px; cursor: pointer; transition: background .2s;
    }
    .topbar-user:hover { background: #C8E6C9; }
    .topbar-user .t-avatar {
      width: 30px; height: 30px; background: var(--primary);
      border-radius: 50%; display: flex; align-items: center; justify-content: center;
    }
    .topbar-user .t-avatar i { color: #fff; font-size: 14px; }
    .topbar-user span { font-size: 13px; font-weight: 500; color: var(--primary); }

    .dropdown-menu-user {
      min-width: 200px; border: 1px solid var(--border); border-radius: 14px;
      box-shadow: 0 12px 36px rgba(0,0,0,.12); padding: 6px; margin-top: 8px !important;
    }
    .dropdown-menu-user .dropdown-header {
      font-size: 11px; font-weight: 600; letter-spacing: .8px;
      text-transform: uppercase; color: var(--text-light); padding: 6px 12px 4px;
    }
    .dropdown-menu-user .dropdown-item {
      font-size: 13.5px; color: var(--text-mid); border-radius: 8px;
      padding: 9px 12px; display: flex; align-items: center; gap: 9px; transition: background .15s, color .15s;
    }
    .dropdown-menu-user .dropdown-item i { font-size: 15px; color: var(--text-light); }
    .dropdown-menu-user .dropdown-item:hover { background: var(--accent-lt); color: var(--primary); }
    .dropdown-menu-user .dropdown-item:hover i { color: var(--primary); }
    .dropdown-menu-user .dropdown-divider { margin: 4px 6px; border-color: var(--border); }
    .dropdown-menu-user .item-logout { color: #C62828; }
    .dropdown-menu-user .item-logout i { color: #C62828; }
    .dropdown-menu-user .item-logout:hover { background: #FFEBEE; color: #C62828; }
    .dropdown-menu-user form { margin: 0; }
    .dropdown-menu-user form button {
      background: none; border: none; font-size: 13.5px; color: #C62828;
      border-radius: 8px; padding: 9px 12px; width: 100%; text-align: left;
      display: flex; align-items: center; gap: 9px; cursor: pointer; transition: background .15s;
    }
    .dropdown-menu-user form button:hover { background: #FFEBEE; }
    .dropdown-menu-user form button i { font-size: 15px; color: #C62828; }

    /* ═══════════════════════════════════════════
       MAIN CONTENT
    ═══════════════════════════════════════════ */
    #main {
      margin-left: var(--sidebar-w); padding-top: var(--topbar-h);
      transition: margin-left .3s ease; min-height: 100vh;
    }
    body.icons-only  #main { margin-left: var(--sidebar-w-icons); }
    body.sidebar-hidden #main { margin-left: 0; }

    .content-inner { padding: 28px; }

    /* ═══════════════════════════════════════════
       PAGE HEADER
    ═══════════════════════════════════════════ */
    .page-header {
      display: flex; align-items: flex-start; justify-content: space-between;
      margin-bottom: 28px; flex-wrap: wrap; gap: 12px;
    }
    .page-header h1 {
      font-family: 'Sora', sans-serif; font-size: 22px; font-weight: 700;
      color: var(--text-dark); margin-bottom: 3px;
    }
    .page-header p { font-size: 13.5px; color: var(--text-light); }

    .btn-green {
      background: var(--primary); color: #fff; border: none; border-radius: 10px;
      padding: 9px 18px; font-size: 13.5px; font-weight: 600;
      display: inline-flex; align-items: center; gap: 6px; cursor: pointer;
      transition: background .2s, transform .1s; text-decoration: none;
    }
    .btn-green:hover { background: var(--accent); color: #fff; }
    .btn-green:active { transform: scale(.97); }

    .btn-outline-green {
      background: transparent; color: var(--primary); border: 1.5px solid var(--primary);
      border-radius: 10px; padding: 8px 16px; font-size: 13.5px; font-weight: 600;
      display: inline-flex; align-items: center; gap: 6px; cursor: pointer;
      transition: background .2s, color .2s; text-decoration: none;
    }
    .btn-outline-green:hover { background: var(--accent-lt); color: var(--primary); }

    /* ═══════════════════════════════════════════
       STAT CARDS
    ═══════════════════════════════════════════ */
    .stat-card {
      background: var(--card-bg); border-radius: 16px; padding: 22px 20px;
      border: 1px solid var(--border); display: flex; align-items: center; gap: 16px;
      transition: box-shadow .2s, transform .2s;
    }
    .stat-card:hover { box-shadow: 0 8px 28px rgba(46,125,50,.1); transform: translateY(-2px); }

    .stat-icon {
      width: 52px; height: 52px; border-radius: 14px;
      display: flex; align-items: center; justify-content: center; flex-shrink: 0; font-size: 22px;
    }
    .stat-icon.green  { background: var(--accent-lt); color: var(--primary); }
    .stat-icon.blue   { background: #E3F2FD; color: #1565C0; }
    .stat-icon.amber  { background: #FFF8E1; color: #F57F17; }
    .stat-icon.purple { background: #EDE7F6; color: #6A1B9A; }

    .stat-info .s-label { font-size: 12.5px; color: var(--text-light); margin-bottom: 4px; }
    .stat-info .s-value {
      font-family: 'Sora', sans-serif; font-size: 22px; font-weight: 700;
      color: var(--text-dark); line-height: 1; margin-bottom: 5px;
    }
    .stat-badge {
      font-size: 11.5px; font-weight: 600; padding: 3px 8px; border-radius: 30px;
      display: inline-flex; align-items: center; gap: 3px;
    }
    .stat-badge.up   { background: #E8F5E9; color: #2E7D32; }
    .stat-badge.info { background: #E3F2FD; color: #1565C0; }

    /* ═══════════════════════════════════════════
       TABLE CARD
    ═══════════════════════════════════════════ */
    .table-card {
      background: var(--card-bg); border-radius: 16px;
      border: 1px solid var(--border); overflow: hidden;
    }
    .table-card-header {
      padding: 18px 24px; display: flex; align-items: center;
      justify-content: space-between; border-bottom: 1px solid var(--border); flex-wrap: wrap; gap: 12px;
    }
    .table-card-header h5 {
      font-family: 'Sora', sans-serif; font-size: 15px; font-weight: 600; color: var(--text-dark);
    }

    /* Search bar */
    .search-filter-bar {
      padding: 14px 24px; border-bottom: 1px solid var(--border);
      display: flex; gap: 10px; flex-wrap: wrap; align-items: center;
    }
    .search-wrap {
      flex: 1; min-width: 220px; position: relative;
    }
    .search-wrap i {
      position: absolute; left: 13px; top: 50%; transform: translateY(-50%);
      color: var(--text-light); font-size: 14px; pointer-events: none;
    }
    .search-input {
      width: 100%; border: 1.5px solid var(--border); border-radius: 10px;
      padding: 10px 14px 10px 36px; font-size: 13.5px; color: var(--text-dark);
      background: #FAFAF9; outline: none; font-family: 'DM Sans', sans-serif;
      transition: border-color .2s, box-shadow .2s;
    }
    .search-input:focus { border-color: var(--primary); box-shadow: 0 0 0 3px rgba(46,125,50,.1); background: #fff; }
    .search-input::placeholder { color: #C3B8B4; }

    .filter-select {
      border: 1.5px solid var(--border); border-radius: 10px;
      padding: 10px 32px 10px 14px; font-size: 13.5px; color: var(--text-dark);
      background: #FAFAF9; appearance: none; cursor: pointer; outline: none;
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%238FA894' stroke-width='2'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E");
      background-repeat: no-repeat; background-position: right 12px center;
      transition: border-color .2s; min-width: 150px;
    }
    .filter-select:focus { border-color: var(--primary); box-shadow: 0 0 0 3px rgba(46,125,50,.1); }

    /* Cooperativas Table */
    .coop-table { width: 100%; border-collapse: collapse; }
    .coop-table th {
      font-size: 11px; font-weight: 600; text-transform: uppercase;
      letter-spacing: .8px; color: var(--text-light); padding: 12px 20px;
      background: #FAFBFA; border-bottom: 1px solid var(--border); text-align: left;
      white-space: nowrap;
    }
    .coop-table td {
      font-size: 13.5px; color: var(--text-dark); padding: 14px 20px;
      border-bottom: 1px solid var(--border); vertical-align: middle;
    }
    .coop-table tr:last-child td { border-bottom: none; }
    .coop-table tbody tr:hover td { background: #F8FBF8; }

    /* Coop avatar/logo */
    .coop-avatar {
      width: 40px; height: 40px; border-radius: 12px;
      display: inline-flex; align-items: center; justify-content: center;
      font-size: 12px; font-weight: 800; color: #fff; flex-shrink: 0;
      letter-spacing: -.5px;
    }
    .coop-cell { display: flex; align-items: center; gap: 12px; }
    .coop-cell .coop-name { font-weight: 600; font-size: 14px; }
    .coop-cell .coop-nif  { font-size: 11.5px; color: var(--text-light); margin-top: 1px; }

    /* Badges */
    .badge-status {
      font-size: 11px; font-weight: 600; padding: 4px 11px; border-radius: 30px;
    }
    .badge-status.activa   { background: #E8F5E9; color: #2E7D32; }
    .badge-status.inactiva { background: #FFEBEE; color: #C62828; }
    .badge-status.pendente { background: #FFF8E1; color: #F57F17; }

    .badge-safra {
      font-size: 11px; font-weight: 600; padding: 4px 10px; border-radius: 20px;
    }
    .badge-safra.activa   { background: var(--accent-lt); color: var(--primary); }
    .badge-safra.planeada { background: #FFF8E1; color: #F57F17; }
    .badge-safra.none     { background: #F5F5F5; color: #9E9E9E; }

    /* Action buttons in table */
    .action-btn {
      width: 32px; height: 32px; border: none; border-radius: 9px;
      display: inline-flex; align-items: center; justify-content: center;
      font-size: 14px; cursor: pointer; transition: background .15s, color .15s;
      text-decoration: none;
    }
    .action-btn.edit    { background: var(--accent-lt); color: var(--primary); }
    .action-btn.edit:hover    { background: var(--primary); color: #fff; }
    .action-btn.print   { background: #E3F2FD; color: #1565C0; }
    .action-btn.print:hover   { background: #1565C0; color: #fff; }
    .action-btn.delete  { background: #FFEBEE; color: #C62828; }
    .action-btn.delete:hover  { background: #C62828; color: #fff; }
    .action-btn.view    { background: #EDE7F6; color: #6A1B9A; }
    .action-btn.view:hover    { background: #6A1B9A; color: #fff; }

    /* Pagination */
    .table-footer {
      padding: 14px 24px; display: flex; align-items: center;
      justify-content: space-between; border-top: 1px solid var(--border);
      flex-wrap: wrap; gap: 10px;
    }
    .table-footer span { font-size: 12.5px; color: var(--text-light); }
    .pagination-btns { display: flex; gap: 6px; }
    .page-btn {
      min-width: 34px; height: 34px; padding: 0 10px; border: 1.5px solid var(--border);
      border-radius: 9px; background: #fff; font-size: 13px; color: var(--text-mid);
      cursor: pointer; display: flex; align-items: center; justify-content: center;
      transition: all .15s; font-family: 'DM Sans', sans-serif;
    }
    .page-btn:hover { border-color: var(--primary); color: var(--primary); }
    .page-btn.active { background: var(--primary); color: #fff; border-color: var(--primary); }

    /* ═══════════════════════════════════════════
       EMPTY STATE
    ═══════════════════════════════════════════ */
    .empty-state {
      text-align: center; padding: 60px 20px;
    }
    .empty-state i { font-size: 52px; color: var(--accent); opacity: .5; display: block; margin-bottom: 16px; }
    .empty-state h6 { font-family: 'Sora', sans-serif; font-size: 16px; color: var(--text-dark); margin-bottom: 6px; }
    .empty-state p { font-size: 13px; color: var(--text-light); }

    /* ═══════════════════════════════════════════
       MODAL
    ═══════════════════════════════════════════ */
    /* Modal tamanho fixo — igual em todas as tabs */
    .modal-coop { max-width: 780px; }
    .modal-coop .modal-content {
      height: 620px; display: flex; flex-direction: column;
    }
    .modal-coop .modal-body {
      flex: 1; overflow: hidden; padding: 0; background: var(--page-bg);
    }
    /* Cada tab-panel faz o seu próprio scroll interno */
    .modal-tab-panel {
      height: 100%; overflow-y: auto; padding: 0;
    }
    .modal-tab-panel::-webkit-scrollbar { width: 4px; }
    .modal-tab-panel::-webkit-scrollbar-thumb { background: rgba(0,0,0,.12); border-radius: 4px; }

    .modal-content {
      border: none; border-radius: 18px;
      box-shadow: 0 24px 64px rgba(0,0,0,.15);
      overflow: hidden;
    }
    .modal-header {
      padding: 11px 20px; border-bottom: 1px solid var(--border);
      background: linear-gradient(135deg, var(--sidebar-bg) 0%, var(--primary) 100%);
      flex-shrink: 0;
    }
    .modal-header .modal-title {
      font-family: 'Sora', sans-serif; font-size: 16px; font-weight: 700; color: #fff;
    }
    .modal-header .btn-close { filter: brightness(0) invert(1); opacity: .8; }
    .modal-header .btn-close:hover { opacity: 1; }
    .modal-header-icon {
      width: 36px; height: 36px; border-radius: 10px;
      background: rgba(255,255,255,.2); display: flex; align-items: center; justify-content: center;
      font-size: 17px; color: #fff; flex-shrink: 0;
    }

    .modal-body { background: var(--page-bg); }
    .modal-footer { padding: 14px 20px; border-top: 1px solid var(--border); background: #fff; flex-shrink: 0; }

    /* Modal section titles */
    .modal-section-title {
      font-size: 11px; font-weight: 700; letter-spacing: 1px; text-transform: uppercase;
      color: var(--text-light); margin-bottom: 14px; padding-bottom: 8px;
      border-bottom: 1px solid var(--border); display: flex; align-items: center; gap: 8px;
    }
    .modal-section-title i { font-size: 13px; color: var(--primary); }

    /* Form card inside modal */
    .modal-form-card {
      background: var(--card-bg); border-radius: 14px;
      border: 1px solid var(--border); padding: 20px 22px; margin-bottom: 16px;
    }

    /* Form elements */
    .cfg-label {
      display: block; font-size: 12px; font-weight: 600; color: var(--text-mid);
      margin-bottom: 5px; letter-spacing: .2px;
    }
    .cfg-input {
      width: 100%; border: 1.5px solid var(--border); border-radius: 10px;
      padding: 10px 13px; font-size: 13.5px; color: var(--text-dark);
      background: #FAFAF9; font-family: 'DM Sans', sans-serif; outline: none;
      transition: border-color .2s, box-shadow .2s;
    }
    .cfg-input:focus {
      border-color: var(--primary); box-shadow: 0 0 0 3px rgba(46,125,50,.1); background: #fff;
    }
    .cfg-input::placeholder { color: #C3B8B4; }
    .cfg-input[readonly] { background: #F5F5F5; color: var(--text-light); cursor: not-allowed; }

    .cfg-select {
      width: 100%; border: 1.5px solid var(--border); border-radius: 10px;
      padding: 10px 32px 10px 13px; font-size: 13.5px; color: var(--text-dark);
      background: #FAFAF9; appearance: none; cursor: pointer; outline: none;
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%238FA894' stroke-width='2'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E");
      background-repeat: no-repeat; background-position: right 12px center;
      transition: border-color .2s; font-family: 'DM Sans', sans-serif;
    }
    .cfg-select:focus { border-color: var(--primary); box-shadow: 0 0 0 3px rgba(46,125,50,.1); }

    .cfg-textarea {
      width: 100%; border: 1.5px solid var(--border); border-radius: 10px;
      padding: 10px 13px; font-size: 13.5px; color: var(--text-dark);
      background: #FAFAF9; resize: vertical; min-height: 80px; outline: none;
      font-family: 'DM Sans', sans-serif; transition: border-color .2s;
    }
    .cfg-textarea:focus { border-color: var(--primary); box-shadow: 0 0 0 3px rgba(46,125,50,.1); }
    .cfg-helper { font-size: 11.5px; color: var(--text-light); margin-top: 4px; }

    /* Step indicator in modal header */
    .modal-steps {
      display: flex; align-items: center; gap: 6px; margin-top: 12px;
    }
    .modal-step {
      display: flex; align-items: center; gap: 6px; font-size: 11.5px; color: rgba(255,255,255,.6);
    }
    .modal-step.active { color: #fff; font-weight: 600; }
    .modal-step-num {
      width: 22px; height: 22px; border-radius: 50%; border: 1.5px solid rgba(255,255,255,.4);
      display: flex; align-items: center; justify-content: center; font-size: 11px; font-weight: 700;
    }
    .modal-step.active .modal-step-num { background: var(--accent); border-color: var(--accent); color: #fff; }
    .modal-step.done .modal-step-num { background: rgba(255,255,255,.25); border-color: transparent; color: #fff; }
    .step-sep { width: 20px; height: 1px; background: rgba(255,255,255,.25); }

    /* Toast */
    .save-toast {
      position: fixed; bottom: 28px; right: 28px; z-index: 9999;
      background: #fff; border: 1px solid var(--border); border-radius: 14px;
      padding: 14px 20px; box-shadow: 0 12px 36px rgba(0,0,0,.12);
      display: flex; align-items: center; gap: 12px;
      transform: translateY(80px); opacity: 0; transition: all .35s cubic-bezier(.34,1.56,.64,1);
      pointer-events: none;
    }
    .save-toast.show { transform: translateY(0); opacity: 1; pointer-events: all; }
    .save-toast .toast-icon { width: 36px; height: 36px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 18px; }
    .save-toast .toast-icon.success { background: #E8F5E9; color: #2E7D32; }
    .save-toast .toast-icon.danger  { background: #FFEBEE; color: #C62828; }
    .save-toast .toast-text .t-title { font-size: 13.5px; font-weight: 600; color: var(--text-dark); }
    .save-toast .toast-text .t-sub   { font-size: 12px; color: var(--text-light); }

    /* ── MODAL TABS ─── */
    .modal-tabs {
      display: flex; gap: 0;
      border-bottom: 2px solid var(--border);
      background: var(--page-bg);
      padding: 0 24px; overflow-x: auto;
    }
    .modal-tabs::-webkit-scrollbar { height: 0; }
    .modal-tab-btn {
      display: flex; align-items: center; gap: 8px;
      padding: 14px 18px; font-size: 13px; font-weight: 500;
      color: var(--text-mid); background: none; border: none;
      border-bottom: 2px solid transparent; margin-bottom: -2px;
      cursor: pointer; transition: color .15s, border-color .15s;
      white-space: nowrap;
    }
    .modal-tab-btn .bi { color: var(--text-light); transition: color .15s; font-size: 15px; }
    .modal-tab-btn:hover { color: var(--primary); }
    .modal-tab-btn:hover .bi { color: var(--primary); }
    .modal-tab-btn.active { color: var(--primary); font-weight: 600; border-bottom-color: var(--primary); }
    .modal-tab-btn.active .bi { color: var(--primary); }
    .modal-tab-badge {
      background: var(--accent-lt); color: var(--primary);
      font-size: 10px; font-weight: 700; padding: 2px 7px;
      border-radius: 20px; min-width: 20px; text-align: center;
    }
    .modal-tab-badge.danger { background: #FFEBEE; color: #C62828; }
    .modal-tab-panel { display: none; padding: 22px; }
    .modal-tab-panel.active { display: block; }

    /* Cooperados inside modal */
    .coop-member-row {
      display: flex; align-items: center; gap: 12px;
      padding: 10px 0; border-bottom: 1px solid var(--border);
    }
    .coop-member-row:last-child { border-bottom: none; }
    .member-avatar {
      width: 34px; height: 34px; border-radius: 50%;
      display: flex; align-items: center; justify-content: center;
      font-size: 13px; font-weight: 700; color: #fff; flex-shrink: 0;
    }
    .member-info .m-name  { font-size: 13.5px; font-weight: 600; color: var(--text-dark); }
    .member-info .m-meta  { font-size: 11.5px; color: var(--text-light); margin-top: 1px; }
    .member-actions { margin-left: auto; display: flex; gap: 6px; }
    .add-member-form {
      display: flex; gap: 10px; align-items: flex-end;
      padding: 14px; background: var(--accent-lt);
      border-radius: 12px; margin-bottom: 16px; flex-wrap: wrap;
    }
    .add-member-form .cfg-input,
    .add-member-form .cfg-select { background: #fff; }

    /* Delete confirm modal */
    .modal-danger .modal-header {
      background: linear-gradient(135deg, #7f0000, #C62828);
    }
    .modal-danger .modal-header-icon { background: rgba(255,255,255,.15); }

    /* Print preview modal */
    .ficha-preview {
      background: #fff; border: 1px solid #ddd; border-radius: 10px;
      padding: 32px; font-family: 'DM Sans', sans-serif;
    }
    .ficha-header { display: flex; align-items: flex-start; gap: 20px; margin-bottom: 24px; padding-bottom: 20px; border-bottom: 2px solid var(--primary); }
    .ficha-logo { width: 60px; height: 60px; border-radius: 14px; background: var(--accent-lt); display: flex; align-items: center; justify-content: center; font-size: 20px; font-weight: 800; color: var(--primary); flex-shrink: 0; }
    .ficha-org-name { font-family: 'Sora', sans-serif; font-size: 18px; font-weight: 700; color: var(--text-dark); }
    .ficha-org-sub { font-size: 12px; color: var(--text-light); margin-top: 3px; }
    .ficha-badge { display: inline-block; background: var(--accent-lt); color: var(--primary); font-size: 11px; font-weight: 700; padding: 3px 10px; border-radius: 20px; margin-top: 6px; }
    .ficha-section-title { font-size: 10px; font-weight: 700; letter-spacing: 1px; text-transform: uppercase; color: var(--primary); margin: 18px 0 10px; }
    .ficha-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; }
    .ficha-field { padding: 8px 12px; background: #FAFAF9; border-radius: 8px; border: 1px solid var(--border); }
    .ficha-field-label { font-size: 10px; font-weight: 600; text-transform: uppercase; letter-spacing: .5px; color: var(--text-light); }
    .ficha-field-value { font-size: 13.5px; font-weight: 500; color: var(--text-dark); margin-top: 2px; }
    .ficha-footer { margin-top: 24px; padding-top: 16px; border-top: 1px solid var(--border); display: flex; justify-content: space-between; align-items: center; font-size: 11px; color: var(--text-light); }

    /* Animations */
    @keyframes fadeUp {
      from { opacity: 0; transform: translateY(14px); }
      to   { opacity: 1; transform: translateY(0); }
    }
    .anim { animation: fadeUp .4s ease both; }
    .anim-d1 { animation-delay: .05s; }
    .anim-d2 { animation-delay: .10s; }
    .anim-d3 { animation-delay: .15s; }
    .anim-d4 { animation-delay: .20s; }

    /* Dark mode */
    body.dark-mode {
      --card-bg: #1e2a20; --page-bg: #141d15; --text-dark: #e8f0e9;
      --text-mid: #9ab89e; --text-light: #6a8a6e; --border: rgba(255,255,255,.07);
    }
    body.dark-mode #topbar { background: #1e2a20; border-color: rgba(255,255,255,.06); }
    body.dark-mode .topbar-title { color: #e8f0e9; }
    body.dark-mode .topbar-user  { background: rgba(102,187,106,.15); }
    body.dark-mode .topbar-user span { color: #66BB6A; }
    body.dark-mode .topbar-icon-btn { background: rgba(102,187,106,.12); }
    body.dark-mode .coop-table th { background: #172518; }
    body.dark-mode .coop-table tbody tr:hover td { background: #1a2a1c; }
    body.dark-mode .search-input,
    body.dark-mode .filter-select,
    body.dark-mode .cfg-input,
    body.dark-mode .cfg-select,
    body.dark-mode .cfg-textarea { background: #172518; color: #e8f0e9; border-color: rgba(255,255,255,.1); }
    body.dark-mode .modal-body { background: #1a2a1c; }
    body.dark-mode .modal-form-card { background: #1e2a20; border-color: rgba(255,255,255,.07); }
    body.dark-mode .modal-footer { background: #1e2a20; border-color: rgba(255,255,255,.07); }
    body.dark-mode .ficha-preview { background: #1e2a20; border-color: rgba(255,255,255,.1); }
    body.dark-mode .ficha-field { background: #172518; border-color: rgba(255,255,255,.07); }

    /* Responsive */
    @media (max-width: 768px) {
      :root { --sidebar-w: 240px; }
      body:not(.sidebar-hidden) #sidebar { box-shadow: 4px 0 20px rgba(0,0,0,.2); }
      body.default #sidebar { width: 0; }
      body.default #main    { margin-left: 0; }
      body.default #topbar  { left: 0; }
      .content-inner { padding: 16px; }
    }

    @media print {
      body * { visibility: hidden; }
      #ficha-print, #ficha-print * { visibility: visible; }
      #ficha-print { position: fixed; top: 0; left: 0; width: 100%; }
    }
  </style>
</head>
<body>

<!-- ══════════════════════════════════════
     SIDEBAR
══════════════════════════════════════ -->
<nav id="sidebar">
  <div class="sidebar-logo">
    <div class="logo-svg-wrap">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 340 340" width="38" height="38" style="flex-shrink:0;">
        <circle cx="170" cy="170" r="145" fill="#66BB6A"/>
        <g fill="#ffffff" stroke="#ffffff" stroke-width="1.5" stroke-linejoin="round" stroke-linecap="round">
          <circle cx="118" cy="188" r="48" fill="none" stroke-width="6" />
          <circle cx="118" cy="188" r="35" fill="none" stroke-width="4.5" />
          <circle cx="118" cy="188" r="16" fill="#ffffff" />
          <path d="M 118 135 L 118 144 M 118 232 L 118 241 M 65 188 L 74 188 M 162 188 L 171 188 M 81 151 L 88 157 M 155 219 L 162 225 M 81 225 L 88 219 M 155 151 L 162 157" stroke-width="6" />
          <path d="M 68 185 C 68 140, 108 120, 160 128 C 171 132, 174 144, 174 151" fill="none" stroke-width="6" />
          <circle cx="231" cy="204" r="26" fill="none" stroke-width="5" />
          <circle cx="231" cy="204" r="10" fill="#ffffff" />
          <path d="M 231 174 L 231 180 M 231 228 L 231 234 M 201 204 L 207 204 M 255 204 L 261 204 M 210 183 L 214 187 M 248 221 L 252 225 M 210 225 L 214 221 M 248 183 L 252 187" stroke-width="4" />
          <path d="M 117 125 L 117 105 C 117 102, 120 99, 125 99 L 176 99 C 181 99, 184 102, 185 107 L 202 157 L 176 157" fill="none" stroke-width="6" />
          <path d="M 144 99 L 144 128 L 187 128" fill="none" stroke-width="4" />
          <path d="M 176 99 L 188 128" fill="none" stroke-width="4" />
          <path d="M 174 151 L 246 156 C 252 156, 254 159, 254 165 L 254 197 L 202 197 Z" fill="#ffffff" />
          <rect x="168" y="173" width="18" height="9" fill="none" stroke-width="4.5" />
          <rect x="168" y="185" width="18" height="7" fill="none" stroke-width="4.5" />
          <path d="M 223 156 L 223 125 C 223 119, 219 117, 219 113 L 220 107" fill="none" stroke-width="4.5" />
          <ellipse cx="239" cy="171" rx="6" ry="4" fill="#66BB6A" stroke="none" />
          <line x1="212" y1="170" x2="212" y2="188" stroke="#66BB6A" stroke-width="4" />
          <line x1="220" y1="170" x2="220" y2="188" stroke="#66BB6A" stroke-width="4" />
          <line x1="228" y1="170" x2="228" y2="188" stroke="#66BB6A" stroke-width="4" />
        </g>
      </svg>
    </div>
    <div class="logo-text-wrap" style="opacity:1;transition:opacity .2s;white-space:nowrap;">
      <div style="font-family:'Sora',sans-serif;font-size:17px;font-weight:700;color:#fff;letter-spacing:1px;line-height:1.1;">SIAG</div>
      <div style="font-size:10px;color:rgba(255,255,255,.5);letter-spacing:.5px;">Agrícola Cooperativas</div>
    </div>
  </div>

  <div class="sidebar-nav">
    <div class="nav-section-title">Principal</div>
    <a href="/dashboard" class="nav-item-link" data-label="Dashboard"><i class="bi bi-grid-1x2-fill"></i><span class="nav-label">Dashboard</span></a>
    <a href="#" class="nav-item-link active" data-label="Cooperativa"><i class="bi bi-building"></i><span class="nav-label">Cooperativa</span></a>
    <a href="{{route('agricultores.index')}}" class="nav-item-link" data-label="Agricultores"><i class="bi bi-people-fill"></i><span class="nav-label">Agricultores</span></a>

    <div class="nav-section-title">Agrícola</div>
    <a href="#" class="nav-item-link" data-label="Safras"><i class="bi bi-flower2"></i><span class="nav-label">Safras</span></a>
    <a href="#" class="nav-item-link" data-label="Talhões"><i class="bi bi-map-fill"></i><span class="nav-label">Talhões</span></a>
    <a href="#" class="nav-item-link" data-label="Insumos"><i class="bi bi-box-seam-fill"></i><span class="nav-label">Insumos</span></a>

    <div class="nav-section-title">Financeiro</div>
    <a href="#" class="nav-item-link" data-label="Contas a Pagar"><i class="bi bi-arrow-down-circle-fill"></i><span class="nav-label">Contas a Pagar</span></a>
    <a href="#" class="nav-item-link" data-label="Contas a Receber"><i class="bi bi-arrow-up-circle-fill"></i><span class="nav-label">Contas a Receber</span></a>
    <a href="#" class="nav-item-link" data-label="Fluxo de Caixa"><i class="bi bi-cash-stack"></i><span class="nav-label">Fluxo de Caixa</span></a>

    <div class="nav-section-title">Comercial</div>
    <a href="#" class="nav-item-link" data-label="Vendas"><i class="bi bi-cart-fill"></i><span class="nav-label">Vendas</span></a>
    <a href="#" class="nav-item-link" data-label="Contratos"><i class="bi bi-file-earmark-text-fill"></i><span class="nav-label">Contratos</span></a>

    <div class="nav-section-title">Sistema</div>
    <a href="#" class="nav-item-link" data-label="Relatórios"><i class="bi bi-bar-chart-fill"></i><span class="nav-label">Relatórios</span></a>
    <a href="{{ route('configuracoes') }}" class="nav-item-link" data-label="Configurações"><i class="bi bi-gear-fill"></i><span class="nav-label">Configurações</span></a>
  </div>

  <div class="sidebar-user">
    <div class="avatar"><i class="bi bi-person-fill"></i></div>
    <div class="user-info">
      <div class="u-name">Admin SIAG</div>
      <div class="u-role">Gestor · Viana</div>
    </div>
  </div>
</nav>

<!-- ══════════════════════════════════════
     TOPBAR
══════════════════════════════════════ -->
<header id="topbar">
  <button class="topbar-toggle" id="sidebarToggle" title="Toggle Sidebar">
    <i class="bi bi-list"></i>
  </button>
  <span class="topbar-title">Cooperativas</span>
  <nav aria-label="breadcrumb" class="d-none d-md-flex ms-3">
    <ol class="breadcrumb mb-0" style="font-size:12.5px;">
      <li class="breadcrumb-item"><a href="#" style="color:var(--primary);text-decoration:none;">SIAG</a></li>
      <li class="breadcrumb-item active" style="color:var(--text-light);">Cooperativas</li>
    </ol>
  </nav>
  <div class="topbar-right">
    <span class="badge rounded-pill d-none d-md-inline-flex align-items-center gap-1"
      style="background:var(--accent-lt);color:var(--primary);font-size:12px;padding:7px 13px;font-weight:600;">
      <i class="bi bi-calendar3"></i> Safra 2024/25
    </span>
    <button class="topbar-icon-btn" title="Notificações">
      <i class="bi bi-bell-fill"></i><span class="notif-badge"></span>
    </button>
    <button class="topbar-icon-btn" title="Mensagens">
      <i class="bi bi-chat-dots-fill"></i>
    </button>

       <div class="dropdown d-none d-sm-flex">
        <div class="topbar-user" data-bs-toggle="dropdown" data-bs-offset="0,4" role="button">
          <div class="t-avatar">
            <img id="dropdownAvatarLarge"
              src="{{ Auth::check() ? Auth::user()->foto_url : asset('uploads/users/default-user.png') }}"
              alt="Foto-perfil" width="20" class="avatar-md">
          </div>

          <span> {{ Auth::check() ? Auth::user()->name : 'Utilizador' }}</span>
          <i class="bi bi-chevron-down" style="font-size:11px;color:var(--primary);"></i>
        </div>
        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-user">
          <li><span class="dropdown-header"> Nível: {{ Auth::user()->nivel }}</li>
          <li>
            <hr class="dropdown-divider">
          </li>
          <li><a class="dropdown-item" href="#"><i class="bi bi-person-gear"></i> Minha Conta</a></li>
          <li>
            <a class="dropdown-item" href="#" id="themeToggle">
              <i class="bi bi-moon-stars-fill" id="themeIcon"></i>
              <span id="themeLabel">Modo Escuro</span>
            </a>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>
          <li>
            <div class="dropdown-item item-logout p-0">
              <form method="POST" action="/logout">
                @csrf
                <button type="submit"><i class="bi bi-box-arrow-right"></i> Sair</button>
              </form>
            </div>
          </li>
        </ul>
      </div>

  </div>
</header>

<!-- ══════════════════════════════════════
     MAIN
══════════════════════════════════════ -->
<main id="main">
  <div class="content-inner">

    <!-- Page Header -->
    <div class="page-header anim">
      <div>
        <h1>Gestão de Cooperativas</h1>
        <p>Registo e administração das cooperativas agrícolas da região de Viana</p>
      </div>
      <div style="display:flex;gap:10px;flex-wrap:wrap;">
        <button class="btn-outline-green" id="btnExportar">
          <i class="bi bi-download"></i> Exportar
        </button>
        <button class="btn-green" id="btnNovaCooperativa" data-bs-toggle="modal" data-bs-target="#modalCooperativa">
          <i class="bi bi-plus-lg"></i> Nova Cooperativa
        </button>
      </div>
    </div>

    <!-- Stat Cards -->
    <div class="row g-3 mb-4 anim anim-d1">
      <div class="col-6 col-xl-3">
        <div class="stat-card">
          <div class="stat-icon green"><i class="bi bi-building"></i></div>
          <div class="stat-info">
            <div class="s-label">Total Registadas</div>
            <div class="s-value">3</div>
            <span class="stat-badge info"><i class="bi bi-info-circle"></i> Todas activas</span>
          </div>
        </div>
      </div>
      <div class="col-6 col-xl-3">
        <div class="stat-card">
          <div class="stat-icon blue"><i class="bi bi-people-fill"></i></div>
          <div class="stat-info">
            <div class="s-label">Cooperados Totais</div>
            <div class="s-value">1.024</div>
            <span class="stat-badge up"><i class="bi bi-arrow-up"></i> +18 este mês</span>
          </div>
        </div>
      </div>
      <div class="col-6 col-xl-3">
        <div class="stat-card">
          <div class="stat-icon amber"><i class="bi bi-flower2"></i></div>
          <div class="stat-info">
            <div class="s-label">Em Safra Activa</div>
            <div class="s-value">2</div>
            <span class="stat-badge info"><i class="bi bi-calendar3"></i> Safra 24/25</span>
          </div>
        </div>
      </div>
      <div class="col-6 col-xl-3">
        <div class="stat-card">
          <div class="stat-icon purple"><i class="bi bi-map-fill"></i></div>
          <div class="stat-info">
            <div class="s-label">Talhões Registados</div>
            <div class="s-value">286</div>
            <span class="stat-badge up"><i class="bi bi-arrow-up"></i> +12 novos</span>
          </div>
        </div>
      </div>
    </div>

    <!-- Table Card -->
    <div class="table-card anim anim-d2">

      <!-- Header -->
      <div class="table-card-header">
        <div style="display:flex;align-items:center;gap:12px;">
          <h5><i class="bi bi-building me-2" style="color:var(--primary);"></i>Lista de Cooperativas</h5>
        </div>
        <div style="display:flex;gap:8px;align-items:center;">
          <span style="font-size:12.5px;color:var(--text-light);">3 registos</span>
          <div style="width:1px;height:20px;background:var(--border);"></div>
          <button class="action-btn view" title="Ver em grelha" id="btnViewGrid"><i class="bi bi-grid-3x3-gap-fill"></i></button>
          <button class="action-btn edit" title="Ver em lista" id="btnViewList" style="background:var(--primary);color:#fff;"><i class="bi bi-list-ul"></i></button>
        </div>
      </div>

      <!-- Search & Filters -->
      <div class="search-filter-bar">
        <div class="search-wrap">
          <i class="bi bi-search"></i>
          <input type="text" class="search-input" id="searchCoop" placeholder="Pesquisar cooperativa por nome, NIF ou município…">
        </div>
        <select class="filter-select" id="filterEstado">
          <option value="">Todos os estados</option>
          <option value="activa">Activa</option>
          <option value="inactiva">Inactiva</option>
          <option value="pendente">Pendente</option>
        </select>
        <select class="filter-select" id="filterProvincia">
          <option value="">Todas as províncias</option>
          <option value="Luanda">Luanda</option>
          <option value="Bengo">Bengo</option>
          <option value="Malanje">Malanje</option>
          <option value="Huíla">Huíla</option>
        </select>
        <select class="filter-select" id="filterSafra">
          <option value="">Safra: Todas</option>
          <option value="activa">Em safra activa</option>
          <option value="planeada">Safra planeada</option>
          <option value="none">Sem safra</option>
        </select>
      </div>

      <!-- Table -->
      <div style="overflow-x:auto;">
        <table class="coop-table" id="coopTable">
          <thead>
            <tr>
              <th style="width:40px;">
                <input type="checkbox" id="selectAll" style="accent-color:var(--primary);width:15px;height:15px;cursor:pointer;">
              </th>
              <th>Cooperativa</th>
              <th>Município / Província</th>
              <th>Contacto</th>
              <th>Cooperados</th>
              <th>Safra Activa</th>
              <th>Estado</th>
              <th style="text-align:center;">Acções</th>
            </tr>
          </thead>
          <tbody id="coopTableBody">

            <!-- Row 1 -->
            <tr data-estado="activa" data-provincia="Luanda" data-safra="activa">
              <td><input type="checkbox" class="row-check" style="accent-color:var(--primary);width:15px;height:15px;cursor:pointer;"></td>
              <td>
                <div class="coop-cell">
                  <div class="coop-avatar" style="background:#1B5E20;">CAV</div>
                  <div>
                    <div class="coop-name">Coop. Agrícola de Viana</div>
                    <div class="coop-nif">NIF: 5401234567</div>
                  </div>
                </div>
              </td>
              <td>
                <div style="font-weight:500;">Viana</div>
                <div style="font-size:12px;color:var(--text-light);">Luanda</div>
              </td>
              <td>
                <div style="font-size:13px;">+244 923 456 789</div>
                <div style="font-size:12px;color:var(--text-light);">geral@coop-viana.ao</div>
              </td>
              <td>
                <span style="font-family:'Sora',sans-serif;font-weight:700;font-size:16px;color:var(--primary);">348</span>
              </td>
              <td><span class="badge-safra activa"><i class="bi bi-calendar-check-fill me-1"></i>2024/25</span></td>
              <td><span class="badge-status activa">Activa</span></td>
              <td style="text-align:center;">
                <div style="display:flex;gap:6px;justify-content:center;">
                  <button class="action-btn view" title="Ver detalhes" onclick="viewCooperativa(1)"><i class="bi bi-eye-fill"></i></button>
                  <button class="action-btn edit" title="Editar" onclick="editCooperativa(1)"><i class="bi bi-pencil-fill"></i></button>
                  <button class="action-btn print" title="Imprimir ficha" onclick="printFicha(1)"><i class="bi bi-printer-fill"></i></button>
                  <button class="action-btn delete" title="Apagar" onclick="deleteCooperativa(1, 'Coop. Agrícola de Viana')"><i class="bi bi-trash-fill"></i></button>
                </div>
              </td>
            </tr>

            <!-- Row 2 -->
            <tr data-estado="activa" data-provincia="Luanda" data-safra="activa">
              <td><input type="checkbox" class="row-check" style="accent-color:var(--primary);width:15px;height:15px;cursor:pointer;"></td>
              <td>
                <div class="coop-cell">
                  <div class="coop-avatar" style="background:#1565C0;">CKI</div>
                  <div>
                    <div class="coop-name">Coop. Kilamba Kiaxi</div>
                    <div class="coop-nif">NIF: 5409876543</div>
                  </div>
                </div>
              </td>
              <td>
                <div style="font-weight:500;">Kilamba Kiaxi</div>
                <div style="font-size:12px;color:var(--text-light);">Luanda</div>
              </td>
              <td>
                <div style="font-size:13px;">+244 912 345 678</div>
                <div style="font-size:12px;color:var(--text-light);">info@coop-ki.ao</div>
              </td>
              <td>
                <span style="font-family:'Sora',sans-serif;font-weight:700;font-size:16px;color:var(--primary);">412</span>
              </td>
              <td><span class="badge-safra activa"><i class="bi bi-calendar-check-fill me-1"></i>2024/25</span></td>
              <td><span class="badge-status activa">Activa</span></td>
              <td style="text-align:center;">
                <div style="display:flex;gap:6px;justify-content:center;">
                  <button class="action-btn view" title="Ver detalhes" onclick="viewCooperativa(2)"><i class="bi bi-eye-fill"></i></button>
                  <button class="action-btn edit" title="Editar" onclick="editCooperativa(2)"><i class="bi bi-pencil-fill"></i></button>
                  <button class="action-btn print" title="Imprimir ficha" onclick="printFicha(2)"><i class="bi bi-printer-fill"></i></button>
                  <button class="action-btn delete" title="Apagar" onclick="deleteCooperativa(2, 'Coop. Kilamba Kiaxi')"><i class="bi bi-trash-fill"></i></button>
                </div>
              </td>
            </tr>

            <!-- Row 3 -->
            <tr data-estado="activa" data-provincia="Luanda" data-safra="planeada">
              <td><input type="checkbox" class="row-check" style="accent-color:var(--primary);width:15px;height:15px;cursor:pointer;"></td>
              <td>
                <div class="coop-cell">
                  <div class="coop-avatar" style="background:#6A1B9A;">CCA</div>
                  <div>
                    <div class="coop-name">Coop. Cazenga Agrícola</div>
                    <div class="coop-nif">NIF: 5407654321</div>
                  </div>
                </div>
              </td>
              <td>
                <div style="font-weight:500;">Cazenga</div>
                <div style="font-size:12px;color:var(--text-light);">Luanda</div>
              </td>
              <td>
                <div style="font-size:13px;">+244 935 678 901</div>
                <div style="font-size:12px;color:var(--text-light);">cazenga@coop.ao</div>
              </td>
              <td>
                <span style="font-family:'Sora',sans-serif;font-weight:700;font-size:16px;color:var(--primary);">264</span>
              </td>
              <td><span class="badge-safra planeada"><i class="bi bi-calendar3 me-1"></i>Planeada</span></td>
              <td><span class="badge-status activa">Activa</span></td>
              <td style="text-align:center;">
                <div style="display:flex;gap:6px;justify-content:center;">
                  <button class="action-btn view" title="Ver detalhes" onclick="viewCooperativa(3)"><i class="bi bi-eye-fill"></i></button>
                  <button class="action-btn edit" title="Editar" onclick="editCooperativa(3)"><i class="bi bi-pencil-fill"></i></button>
                  <button class="action-btn print" title="Imprimir ficha" onclick="printFicha(3)"><i class="bi bi-printer-fill"></i></button>
                  <button class="action-btn delete" title="Apagar" onclick="deleteCooperativa(3, 'Coop. Cazenga Agrícola')"><i class="bi bi-trash-fill"></i></button>
                </div>
              </td>
            </tr>

          </tbody>
        </table>
      </div>

      <!-- Empty state (hidden by default) -->
      <div class="empty-state" id="emptyState" style="display:none;">
        <i class="bi bi-buildings"></i>
        <h6>Nenhuma cooperativa encontrada</h6>
        <p>Tente ajustar os filtros ou registe uma nova cooperativa.</p>
      </div>

      <!-- Footer / Pagination -->
      <div class="table-footer">
        <span id="tableCount">Mostrando 3 de 3 cooperativas</span>
        <div class="pagination-btns">
          <button class="page-btn"><i class="bi bi-chevron-left"></i></button>
          <button class="page-btn active">1</button>
          <button class="page-btn"><i class="bi bi-chevron-right"></i></button>
        </div>
      </div>

    </div>
    <!-- /table-card -->

  </div><!-- /content-inner -->
</main>


<!-- ══════════════════════════════════════
     MODAL — NOVA / EDITAR COOPERATIVA
══════════════════════════════════════ -->
<div class="modal fade" id="modalCooperativa" tabindex="-1" aria-labelledby="modalCoopLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-coop modal-dialog-centered">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <div style="display:flex;align-items:center;gap:14px;flex:1;">
          <div class="modal-header-icon">
            <i class="bi bi-building" id="modalHeaderIcon"></i>
          </div>
          <div>
            <div class="modal-title" id="modalCoopLabel">Nova Cooperativa</div>
          </div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
      </div>

      <!-- Modal Tabs nav -->
      <div class="modal-tabs" id="modalTabsNav">
        <button class="modal-tab-btn active" data-modal-tab="identificacao">
          <i class="bi bi-building-fill"></i> Identificação
        </button>
        <button class="modal-tab-btn" data-modal-tab="localizacao">
          <i class="bi bi-geo-alt-fill"></i> Localização & Contactos
        </button>
        <button class="modal-tab-btn" data-modal-tab="safra">
          <i class="bi bi-flower2"></i> Safra & Agrícola
        </button>
        <button class="modal-tab-btn" data-modal-tab="cooperados">
          <i class="bi bi-people-fill"></i> Cooperados
          <span class="modal-tab-badge" id="tabBadgeCooperados">0</span>
        </button>
      </div>

      <!-- Modal Body (tabs content) -->
      <div class="modal-body" style="padding:0;background:var(--page-bg);">
        <form id="formCooperativa" novalidate>
          @csrf
          <input type="hidden" id="coopId" name="id" value="">

          <!-- ── TAB 1: Identificação Institucional ── -->
          <div class="modal-tab-panel active" id="mtab-identificacao">
            <div class="modal-form-card">
              <div class="modal-section-title">
                <i class="bi bi-building-fill"></i> Dados Institucionais
              </div>
              <div class="row g-3">
                <div class="col-12 col-md-7">
                  <label class="cfg-label" for="nomeCooperativa">Nome da Cooperativa *</label>
                  <input class="cfg-input" type="text" id="nomeCooperativa" name="nome"
                    placeholder="Ex: Cooperativa Agrícola de Viana" required>
                </div>
                <div class="col-12 col-md-5">
                  <label class="cfg-label" for="nifCooperativa">NIF / Nº de Registo *</label>
                  <input class="cfg-input" type="text" id="nifCooperativa" name="nif"
                    placeholder="Ex: 5401234567" required>
                </div>
                <div class="col-12 col-md-4">
                  <label class="cfg-label" for="dateFundacao">Data de Fundação</label>
                  <input class="cfg-input" type="date" id="dateFundacao" name="data_fundacao">
                </div>
                <div class="col-12 col-md-4">
                  <label class="cfg-label" for="numSocios">Nº Inicial de Sócios</label>
                  <input class="cfg-input" type="number" id="numSocios" name="num_socios" placeholder="0" min="0">
                </div>
                <div class="col-12 col-md-4">
                  <label class="cfg-label" for="estadoCoop">Estado *</label>
                  <select class="cfg-select" id="estadoCoop" name="estado">
                    <option value="activa">Activa</option>
                    <option value="inactiva">Inactiva</option>
                    <option value="pendente">Pendente</option>
                  </select>
                </div>
                <div class="col-12">
                  <label class="cfg-label" for="missaoCoop">Descrição / Missão</label>
                  <textarea class="cfg-textarea" id="missaoCoop" name="missao" rows="3"
                    placeholder="Breve descrição da missão e objectivos da cooperativa…"></textarea>
                </div>
              </div>
            </div>
          </div>

          <!-- ── TAB 2: Localização & Contactos ── -->
          <div class="modal-tab-panel" id="mtab-localizacao">
            <div class="modal-form-card">
              <div class="modal-section-title">
                <i class="bi bi-geo-alt-fill"></i> Localização
              </div>
              <div class="row g-3">
                <div class="col-12 col-md-5">
                  <label class="cfg-label" for="municipioCoop">Município *</label>
                  <input class="cfg-input" type="text" id="municipioCoop" name="municipio"
                    placeholder="Ex: Viana" required>
                </div>
                <div class="col-12 col-md-4">
                  <label class="cfg-label" for="provinciaCoop">Província *</label>
                  <select class="cfg-select" id="provinciaCoop" name="provincia">
                    <option value="">Seleccione…</option>
                    <option>Luanda</option><option>Bengo</option><option>Malanje</option>
                    <option>Huíla</option><option>Bié</option><option>Huambo</option>
                    <option>Cabinda</option><option>Zaire</option><option>Uíge</option>
                    <option>Cuanza Norte</option><option>Cuanza Sul</option>
                    <option>Lunda Norte</option><option>Lunda Sul</option>
                    <option>Moxico</option><option>Cuando Cubango</option>
                    <option>Cunene</option><option>Namibe</option><option>Benguela</option>
                  </select>
                </div>
                <div class="col-12 col-md-3">
                  <label class="cfg-label" for="paisCoop">País</label>
                  <input class="cfg-input" type="text" id="paisCoop" name="pais" value="Angola" readonly>
                </div>
                <div class="col-12">
                  <label class="cfg-label" for="enderecoCoop">Endereço Completo</label>
                  <input class="cfg-input" type="text" id="enderecoCoop" name="endereco"
                    placeholder="Ex: Km 12, Estrada de Viana, Luanda Sul">
                </div>
              </div>
            </div>
            <div class="modal-form-card">
              <div class="modal-section-title">
                <i class="bi bi-telephone-fill"></i> Contactos
              </div>
              <div class="row g-3">
                <div class="col-12 col-md-4">
                  <label class="cfg-label" for="telefCoop">Telefone Principal *</label>
                  <input class="cfg-input" type="tel" id="telefCoop" name="telefone"
                    placeholder="+244 9XX XXX XXX" required>
                </div>
                <div class="col-12 col-md-4">
                  <label class="cfg-label" for="emailCoop">E-mail Institucional</label>
                  <input class="cfg-input" type="email" id="emailCoop" name="email"
                    placeholder="geral@cooperativa.ao">
                </div>
                <div class="col-12 col-md-4">
                  <label class="cfg-label" for="websiteCoop">Website</label>
                  <input class="cfg-input" type="url" id="websiteCoop" name="website"
                    placeholder="https://www.cooperativa.ao">
                </div>
              </div>
            </div>
          </div>

          <!-- ── TAB 3: Safra & Agrícola ── -->
          <div class="modal-tab-panel" id="mtab-safra">
            <div class="modal-form-card">
              <div class="modal-section-title">
                <i class="bi bi-flower2"></i> Safra Activa
              </div>
              <div class="row g-3">
                <div class="col-12 col-md-4">
                  <label class="cfg-label" for="safraActiva">Designação da Safra</label>
                  <input class="cfg-input" type="text" id="safraActiva" name="safra_activa"
                    placeholder="Ex: 2024/2025">
                </div>
                <div class="col-12 col-md-4">
                  <label class="cfg-label" for="inicioSafra">Início da Safra</label>
                  <input class="cfg-input" type="date" id="inicioSafra" name="inicio_safra">
                </div>
                <div class="col-12 col-md-4">
                  <label class="cfg-label" for="fimSafra">Fim Previsto</label>
                  <input class="cfg-input" type="date" id="fimSafra" name="fim_safra">
                </div>
              </div>
            </div>
            <div class="modal-form-card">
              <div class="modal-section-title">
                <i class="bi bi-map-fill"></i> Parâmetros Agrícolas
              </div>
              <div class="row g-3">
                <div class="col-12 col-md-6">
                  <label class="cfg-label" for="areaTotal">Área Total Cultivada (ha)</label>
                  <input class="cfg-input" type="number" id="areaTotal" name="area_total"
                    placeholder="0.00" step="0.01" min="0">
                  <div class="cfg-helper">Soma dos talhões registados na cooperativa</div>
                </div>
                <div class="col-12 col-md-6">
                  <label class="cfg-label" for="principalCultura">Principal Cultura</label>
                  <select class="cfg-select" id="principalCultura" name="principal_cultura">
                    <option value="">Seleccione…</option>
                    <option>Milho</option><option>Feijão</option><option>Mandioca</option>
                    <option>Batata-doce</option><option>Hortícolas</option>
                    <option>Frutas tropicais</option><option>Café</option>
                    <option>Algodão</option><option>Outras</option>
                  </select>
                </div>
                <div class="col-12 col-md-6">
                  <label class="cfg-label" for="numTalhoes">Nº de Talhões</label>
                  <input class="cfg-input" type="number" id="numTalhoes" name="num_talhoes"
                    placeholder="0" min="0">
                </div>
                <div class="col-12 col-md-6">
                  <label class="cfg-label" for="producaoEstimada">Produção Estimada (ton)</label>
                  <input class="cfg-input" type="number" id="producaoEstimada" name="producao_estimada"
                    placeholder="0.0" step="0.1" min="0">
                </div>
              </div>
            </div>
          </div>

          <!-- ── TAB 4: Cooperados ── -->
          <div class="modal-tab-panel" id="mtab-cooperados">

            <!-- Aviso quando modal é para "Nova" (sem ID ainda) -->
            <div id="coopNoIdAlert" style="background:#FFF8E1;border:1px solid #FFE082;border-radius:12px;padding:14px 18px;margin-bottom:16px;display:flex;gap:12px;align-items:flex-start;">
              <i class="bi bi-info-circle-fill" style="color:#F57F17;font-size:18px;flex-shrink:0;margin-top:1px;"></i>
              <div>
                <div style="font-size:13.5px;font-weight:600;color:#7f5000;">Guarde a cooperativa primeiro</div>
                <div style="font-size:12.5px;color:#9a6000;margin-top:2px;">Para adicionar cooperados, preencha os dados básicos e registe a cooperativa. Depois pode associar agricultores.</div>
              </div>
            </div>

            <!-- Formulário de adicionar cooperado (visível só em modo edição) -->
            <div id="addMemberSection" style="display:none;">
              <div class="add-member-form">
                <div style="flex:1;min-width:160px;">
                  <label class="cfg-label">Nome do Agricultor *</label>
                  <input class="cfg-input" type="text" id="novoMemberNome" placeholder="Nome completo">
                </div>
                <div style="width:130px;">
                  <label class="cfg-label">BI / NIF</label>
                  <input class="cfg-input" type="text" id="novoMemberBI" placeholder="Nº BI">
                </div>
                <div style="width:130px;">
                  <label class="cfg-label">Telefone</label>
                  <input class="cfg-input" type="tel" id="novoMemberTel" placeholder="+244 9XX…">
                </div>
                <div style="width:130px;">
                  <label class="cfg-label">Função</label>
                  <select class="cfg-select" id="novoMemberFuncao">
                    <option value="agricultor">Agricultor</option>
                    <option value="dirigente">Dirigente</option>
                    <option value="tecnico">Técnico</option>
                    <option value="socio">Sócio</option>
                  </select>
                </div>
                <div>
                  <label class="cfg-label">&nbsp;</label>
                  <button type="button" class="btn-green" onclick="adicionarMembro()" style="height:42px;">
                    <i class="bi bi-plus-lg"></i> Adicionar
                  </button>
                </div>
              </div>

              <!-- Pesquisa de cooperados -->
              <div style="position:relative;margin-bottom:14px;">
                <i class="bi bi-search" style="position:absolute;left:13px;top:50%;transform:translateY(-50%);color:var(--text-light);font-size:13px;pointer-events:none;"></i>
                <input type="text" class="cfg-input" id="searchMembro" placeholder="Pesquisar cooperado por nome ou BI…"
                  style="padding-left:36px;" oninput="filtrarMembros()">
              </div>

              <!-- Lista de cooperados -->
              <div style="background:var(--card-bg);border-radius:12px;border:1px solid var(--border);overflow:hidden;">
                <div style="padding:10px 16px;background:#FAFBFA;border-bottom:1px solid var(--border);display:flex;align-items:center;justify-content:space-between;">
                  <span style="font-size:11px;font-weight:700;letter-spacing:.8px;text-transform:uppercase;color:var(--text-light);">Cooperados Associados</span>
                  <span style="font-size:12px;font-weight:600;color:var(--primary);" id="memberCount">3 cooperados</span>
                </div>
                <div id="memberList" style="padding:0 16px;max-height:260px;overflow-y:auto;">

                  <div class="coop-member-row" data-member-name="João Manuel Ferreira">
                    <div class="member-avatar" style="background:#1B5E20;">JF</div>
                    <div class="member-info">
                      <div class="m-name">João Manuel Ferreira</div>
                      <div class="m-meta">BI: 004512378LA041 · +244 923 111 222 · <span style="background:var(--accent-lt);color:var(--primary);padding:1px 7px;border-radius:10px;font-size:10px;font-weight:700;">Agricultor</span></div>
                    </div>
                    <div class="member-actions">
                      <button type="button" class="action-btn edit" title="Editar"><i class="bi bi-pencil-fill"></i></button>
                      <button type="button" class="action-btn delete" title="Remover" onclick="removerMembro(this)"><i class="bi bi-x-lg"></i></button>
                    </div>
                  </div>

                  <div class="coop-member-row" data-member-name="Maria das Dores Silva">
                    <div class="member-avatar" style="background:#1565C0;">MS</div>
                    <div class="member-info">
                      <div class="m-name">Maria das Dores Silva</div>
                      <div class="m-meta">BI: 006234890LA042 · +244 912 333 444 · <span style="background:#E3F2FD;color:#1565C0;padding:1px 7px;border-radius:10px;font-size:10px;font-weight:700;">Dirigente</span></div>
                    </div>
                    <div class="member-actions">
                      <button type="button" class="action-btn edit" title="Editar"><i class="bi bi-pencil-fill"></i></button>
                      <button type="button" class="action-btn delete" title="Remover" onclick="removerMembro(this)"><i class="bi bi-x-lg"></i></button>
                    </div>
                  </div>

                  <div class="coop-member-row" data-member-name="António Lopes Costa">
                    <div class="member-avatar" style="background:#F57F17;">AL</div>
                    <div class="member-info">
                      <div class="m-name">António Lopes Costa</div>
                      <div class="m-meta">BI: 009871230LA043 · +244 935 555 666 · <span style="background:#FFF8E1;color:#F57F17;padding:1px 7px;border-radius:10px;font-size:10px;font-weight:700;">Sócio</span></div>
                    </div>
                    <div class="member-actions">
                      <button type="button" class="action-btn edit" title="Editar"><i class="bi bi-pencil-fill"></i></button>
                      <button type="button" class="action-btn delete" title="Remover" onclick="removerMembro(this)"><i class="bi bi-x-lg"></i></button>
                    </div>
                  </div>

                </div>
              </div>

              <!-- Nota rodapé -->
              <div style="margin-top:12px;font-size:12px;color:var(--text-light);">
                <i class="bi bi-info-circle me-1"></i>
                Para gestão completa dos cooperados (talhões, produções, pagamentos) aceda ao módulo <strong>Cooperados</strong> no menu principal.
              </div>
            </div>

          </div>
          <!-- /TAB Cooperados -->

        </form>
      </div>

      <!-- Modal Footer -->
      <div class="modal-footer">
        <div style="display:flex;align-items:center;gap:10px;width:100%;justify-content:space-between;flex-wrap:wrap;">
          <div style="font-size:12px;color:var(--text-light);">
            <i class="bi bi-info-circle me-1"></i> Os campos marcados com * são obrigatórios.
          </div>
          <div style="display:flex;gap:10px;">
            <button type="button" class="btn-outline-green" data-bs-dismiss="modal">
              <i class="bi bi-x-lg"></i> Cancelar
            </button>
            <button type="button" class="btn-green" id="btnSalvarCoop">
              <i class="bi bi-check2-circle"></i> <span id="btnSalvarLabel">Registar Cooperativa</span>
            </button>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

<!-- ══════════════════════════════════════
     MODAL — CONFIRMAR ELIMINAÇÃO
══════════════════════════════════════ -->
<div class="modal fade" id="modalDelete" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" style="max-width:420px;">
    <div class="modal-content modal-danger">
      <div class="modal-header">
        <div style="display:flex;align-items:center;gap:14px;flex:1;">
          <div class="modal-header-icon"><i class="bi bi-exclamation-triangle-fill"></i></div>
          <div>
            <div class="modal-title">Confirmar Eliminação</div>
            <div style="font-size:12px;color:rgba(255,255,255,.65);margin-top:2px;">Esta acção é irreversível</div>
          </div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
      </div>
      <div class="modal-body" style="background:#fff;padding:28px;">
        <p style="font-size:13.5px;color:var(--text-mid);margin-bottom:10px;">
          Tem a certeza que deseja eliminar a cooperativa:
        </p>
        <div style="background:#FFF8F8;border:1px solid #FFCDD2;border-radius:10px;padding:14px 18px;margin-bottom:16px;">
          <div style="font-family:'Sora',sans-serif;font-weight:700;font-size:15px;color:#C62828;" id="deleteCoopName">—</div>
          <div style="font-size:12px;color:var(--text-light);margin-top:3px;">Todos os dados associados serão removidos permanentemente.</div>
        </div>
        <p style="font-size:12.5px;color:var(--text-light);">
          <i class="bi bi-info-circle me-1"></i>Cooperados, talhões e registos financeiros vinculados também serão afectados.
        </p>
      </div>
      <div class="modal-footer" style="border-top:1px solid #FFCDD2;">
        <button type="button" class="btn-outline-green" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn-green" id="btnConfirmDelete"
          style="background:#C62828;box-shadow:none;" onclick="confirmDelete()">
          <i class="bi bi-trash-fill"></i> Eliminar Definitivamente
        </button>
      </div>
    </div>
  </div>
</div>

<!-- ══════════════════════════════════════
     MODAL — FICHA DA COOPERATIVA (PRINT)
══════════════════════════════════════ -->
<div class="modal fade" id="modalFicha" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <div style="display:flex;align-items:center;gap:14px;flex:1;">
          <div class="modal-header-icon"><i class="bi bi-printer-fill"></i></div>
          <div>
            <div class="modal-title">Ficha da Cooperativa</div>
            <div style="font-size:12px;color:rgba(255,255,255,.65);margin-top:2px;">Pré-visualização para impressão</div>
          </div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
      </div>
      <div class="modal-body" style="padding:24px;">

        <div class="ficha-preview" id="ficha-print">
          <!-- Header ficha -->
          <div class="ficha-header">
            <div class="ficha-logo" id="fichaLogo">CAV</div>
            <div>
              <div class="ficha-org-name" id="fichaNome">Cooperativa Agrícola de Viana</div>
              <div class="ficha-org-sub">Sistema Integrado de Apoio à Gestão Agrícola – SIAG</div>
              <div class="ficha-badge" id="fichaEstado">Activa</div>
            </div>
            <div style="margin-left:auto;text-align:right;">
              <div style="font-size:11px;color:var(--text-light);">Data de emissão</div>
              <div style="font-size:13px;font-weight:600;color:var(--text-dark);" id="fichaDataEmissao">07/06/2026</div>
              <div style="font-size:11px;color:var(--text-light);margin-top:6px;">NIF</div>
              <div style="font-size:13px;font-weight:600;color:var(--text-dark);" id="fichaNIF">5401234567</div>
            </div>
          </div>

          <!-- Identificação -->
          <div class="ficha-section-title">Identificação</div>
          <div class="ficha-grid">
            <div class="ficha-field">
              <div class="ficha-field-label">Nome Completo</div>
              <div class="ficha-field-value" id="fNome">Cooperativa Agrícola de Viana</div>
            </div>
            <div class="ficha-field">
              <div class="ficha-field-label">NIF / Nº de Registo</div>
              <div class="ficha-field-value" id="fNIF">5401234567</div>
            </div>
            <div class="ficha-field">
              <div class="ficha-field-label">Data de Fundação</div>
              <div class="ficha-field-value" id="fFundacao">15/03/2018</div>
            </div>
            <div class="ficha-field">
              <div class="ficha-field-label">Estado</div>
              <div class="ficha-field-value" id="fEstado">Activa</div>
            </div>
          </div>

          <!-- Localização -->
          <div class="ficha-section-title">Localização</div>
          <div class="ficha-grid">
            <div class="ficha-field">
              <div class="ficha-field-label">Município</div>
              <div class="ficha-field-value" id="fMunicipio">Viana</div>
            </div>
            <div class="ficha-field">
              <div class="ficha-field-label">Província</div>
              <div class="ficha-field-value" id="fProvincia">Luanda</div>
            </div>
            <div class="ficha-field" style="grid-column:1/-1;">
              <div class="ficha-field-label">Endereço Completo</div>
              <div class="ficha-field-value" id="fEndereco">Km 12, Estrada de Viana, Luanda Sul, Angola</div>
            </div>
          </div>

          <!-- Contactos -->
          <div class="ficha-section-title">Contactos</div>
          <div class="ficha-grid">
            <div class="ficha-field">
              <div class="ficha-field-label">Telefone</div>
              <div class="ficha-field-value" id="fTelefone">+244 923 456 789</div>
            </div>
            <div class="ficha-field">
              <div class="ficha-field-label">E-mail</div>
              <div class="ficha-field-value" id="fEmail">geral@coop-viana.ao</div>
            </div>
          </div>

          <!-- Agrícola -->
          <div class="ficha-section-title">Dados Agrícolas</div>
          <div class="ficha-grid">
            <div class="ficha-field">
              <div class="ficha-field-label">Safra Activa</div>
              <div class="ficha-field-value" id="fSafra">2024/2025</div>
            </div>
            <div class="ficha-field">
              <div class="ficha-field-label">Principal Cultura</div>
              <div class="ficha-field-value" id="fCultura">Milho</div>
            </div>
            <div class="ficha-field">
              <div class="ficha-field-label">Nº de Cooperados</div>
              <div class="ficha-field-value" id="fCooperados">348</div>
            </div>
            <div class="ficha-field">
              <div class="ficha-field-label">Área Total (ha)</div>
              <div class="ficha-field-value" id="fArea">1.240</div>
            </div>
          </div>

          <!-- Footer ficha -->
          <div class="ficha-footer">
            <div>SIAG — Sistema Integrado de Apoio à Gestão Agrícola</div>
            <div>Documento gerado automaticamente · Válido sem assinatura</div>
          </div>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn-outline-green" data-bs-dismiss="modal">
          <i class="bi bi-x-lg"></i> Fechar
        </button>
        <button type="button" class="btn-green" onclick="window.print()">
          <i class="bi bi-printer-fill"></i> Imprimir Ficha
        </button>
      </div>
    </div>
  </div>
</div>

<!-- Toast -->
<div class="save-toast" id="saveToast">
  <div class="toast-icon success" id="toastIcon"><i class="bi bi-check-lg" id="toastIconI"></i></div>
  <div class="toast-text">
    <div class="t-title" id="toastTitle">Operação concluída</div>
    <div class="t-sub" id="toastSub">Acção realizada com sucesso.</div>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
/* ══════════════════════════════════════
   SIDEBAR TOGGLE (3 estados)
══════════════════════════════════════ */
const body = document.body;
let sideState = 0;

function applyTooltips() {
  document.querySelectorAll('.nav-item-link').forEach(el => {
    const tip = bootstrap.Tooltip.getInstance(el);
    if (tip) tip.dispose();
  });
  if (body.classList.contains('icons-only')) {
    document.querySelectorAll('.nav-item-link').forEach(el => {
      new bootstrap.Tooltip(el, {
        title: el.dataset.label || '',
        placement: 'right',
        trigger: 'hover',
        customClass: 'sidebar-tooltip'
      });
    });
  }
}

document.getElementById('sidebarToggle').addEventListener('click', () => {
  sideState = (sideState + 1) % 3;
  body.classList.remove('icons-only', 'sidebar-hidden');
  if (sideState === 1) body.classList.add('icons-only');
  if (sideState === 2) body.classList.add('sidebar-hidden');
  applyTooltips();
});

/* ══════════════════════════════════════
   DARK MODE
══════════════════════════════════════ */
const themeToggle = document.getElementById('themeToggle');
const themeIcon   = document.getElementById('themeIcon');
const themeLabel  = document.getElementById('themeLabel');
let darkMode = false;

themeToggle.addEventListener('click', function(e) {
  e.preventDefault();
  darkMode = !darkMode;
  body.classList.toggle('dark-mode', darkMode);
  themeIcon.className  = darkMode ? 'bi bi-sun-fill' : 'bi bi-moon-stars-fill';
  themeLabel.textContent = darkMode ? 'Modo Claro' : 'Modo Escuro';
});

/* ══════════════════════════════════════
   NAV ACTIVE SIDEBAR
══════════════════════════════════════ */
document.querySelectorAll('.nav-item-link').forEach(link => {
  link.addEventListener('click', function(e) {
    const href = this.getAttribute('href');
    if (!href || href === '#') {
      e.preventDefault();
    }
    document.querySelectorAll('.nav-item-link').forEach(l => l.classList.remove('active'));
    this.classList.add('active');
    const label = this.dataset.label || this.querySelector('.nav-label')?.textContent || '';
    document.querySelector('.topbar-title').textContent = label;
  });
});

/* ══════════════════════════════════════
   TOAST
══════════════════════════════════════ */
function showToast(title, sub, type = 'success') {
  const toast  = document.getElementById('saveToast');
  const icon   = document.getElementById('toastIcon');
  const iconI  = document.getElementById('toastIconI');
  document.getElementById('toastTitle').textContent = title;
  document.getElementById('toastSub').textContent   = sub;
  icon.className = 'toast-icon ' + (type === 'danger' ? 'danger' : 'success');
  iconI.className = type === 'danger' ? 'bi bi-x-lg' : 'bi bi-check-lg';
  toast.classList.add('show');
  setTimeout(() => toast.classList.remove('show'), 3500);
}

/* ══════════════════════════════════════
   MODAL TABS
══════════════════════════════════════ */
function switchModalTab(tabName) {
  document.querySelectorAll('.modal-tab-btn').forEach(btn => {
    btn.classList.toggle('active', btn.dataset.modalTab === tabName);
  });
  document.querySelectorAll('.modal-tab-panel').forEach(panel => {
    panel.classList.toggle('active', panel.id === 'mtab-' + tabName);
  });
}

document.querySelectorAll('.modal-tab-btn').forEach(btn => {
  btn.addEventListener('click', () => switchModalTab(btn.dataset.modalTab));
});

/* Reset tabs ao abrir o modal */
document.getElementById('modalCooperativa').addEventListener('show.bs.modal', () => {
  switchModalTab('identificacao');
});

/* ══════════════════════════════════════
   MODAL — NOVA / EDITAR COOPERATIVA
══════════════════════════════════════ */
let isEditing = false;
let currentEditId = null;

function resetModal() {
  document.getElementById('formCooperativa').reset();
  document.getElementById('coopId').value = '';
  document.getElementById('paisCoop').value = 'Angola';
  // Cooperados tab: mostrar aviso, esconder form
  document.getElementById('coopNoIdAlert').style.display = 'flex';
  document.getElementById('addMemberSection').style.display = 'none';
  updateMemberCount();
}

// Botão "Nova Cooperativa"
document.getElementById('btnNovaCooperativa').addEventListener('click', () => {
  isEditing = false;
  currentEditId = null;
  document.getElementById('modalCoopLabel').textContent = 'Nova Cooperativa';
  document.getElementById('btnSalvarLabel').textContent = 'Registar Cooperativa';
  document.getElementById('modalHeaderIcon').className = 'bi bi-building';
  resetModal();
});

// Editar cooperativa
function editCooperativa(id) {
  isEditing = true;
  currentEditId = id;

  const dados = {
    1: { nome:'Cooperativa Agrícola de Viana', nif:'5401234567', municipio:'Viana', provincia:'Luanda', endereco:'Km 12, Estrada de Viana, Luanda Sul', telefone:'+244 923 456 789', email:'geral@coop-viana.ao', website:'', safra:'2024/2025', cultura:'Milho', estado:'activa', missao:'Cooperativa dedicada ao apoio dos agricultores locais de Viana.', numSocios:'348', area:'1240', talhoes:'86', producao:'1153', inicio:'2024-09-01', fim:'2025-08-31' },
    2: { nome:'Cooperativa Kilamba Kiaxi', nif:'5409876543', municipio:'Kilamba Kiaxi', provincia:'Luanda', endereco:'Rua da Paz, Kilamba', telefone:'+244 912 345 678', email:'info@coop-ki.ao', website:'', safra:'2024/2025', cultura:'Feijão', estado:'activa', missao:'', numSocios:'412', area:'980', talhoes:'104', producao:'890', inicio:'2024-09-01', fim:'2025-08-31' },
    3: { nome:'Cooperativa Cazenga Agrícola', nif:'5407654321', municipio:'Cazenga', provincia:'Luanda', endereco:'Bairro Cazenga, Luanda', telefone:'+244 935 678 901', email:'cazenga@coop.ao', website:'', safra:'', cultura:'Mandioca', estado:'activa', missao:'', numSocios:'264', area:'620', talhoes:'96', producao:'', inicio:'', fim:'' },
  };

  const d = dados[id] || {};
  document.getElementById('modalCoopLabel').textContent = 'Editar Cooperativa';
  document.getElementById('btnSalvarLabel').textContent = 'Guardar Alterações';
  document.getElementById('modalHeaderIcon').className = 'bi bi-pencil-fill';
  document.getElementById('coopId').value              = id;
  document.getElementById('nomeCooperativa').value     = d.nome       || '';
  document.getElementById('nifCooperativa').value      = d.nif        || '';
  document.getElementById('municipioCoop').value       = d.municipio  || '';
  document.getElementById('provinciaCoop').value       = d.provincia  || '';
  document.getElementById('enderecoCoop').value        = d.endereco   || '';
  document.getElementById('telefCoop').value           = d.telefone   || '';
  document.getElementById('emailCoop').value           = d.email      || '';
  document.getElementById('websiteCoop').value         = d.website    || '';
  document.getElementById('safraActiva').value         = d.safra      || '';
  document.getElementById('missaoCoop').value          = d.missao     || '';
  document.getElementById('numSocios').value           = d.numSocios  || '';
  document.getElementById('areaTotal').value           = d.area       || '';
  document.getElementById('numTalhoes').value          = d.talhoes    || '';
  document.getElementById('producaoEstimada').value    = d.producao   || '';
  document.getElementById('inicioSafra').value         = d.inicio     || '';
  document.getElementById('fimSafra').value            = d.fim        || '';
  document.getElementById('estadoCoop').value          = d.estado     || 'activa';
  if (d.cultura) document.getElementById('principalCultura').value = d.cultura;

  // Cooperados tab: esconder aviso, mostrar form
  document.getElementById('coopNoIdAlert').style.display = 'none';
  document.getElementById('addMemberSection').style.display = 'block';
  updateMemberCount();

  const modal = new bootstrap.Modal(document.getElementById('modalCooperativa'));
  modal.show();
}

// Guardar
document.getElementById('btnSalvarCoop').addEventListener('click', () => {
  const nome = document.getElementById('nomeCooperativa').value.trim();
  const nif  = document.getElementById('nifCooperativa').value.trim();
  const mun  = document.getElementById('municipioCoop').value.trim();
  const tel  = document.getElementById('telefCoop').value.trim();

  if (!nome || !nif) {
    switchModalTab('identificacao');
    showToast('Campos obrigatórios em falta', 'Preencha o Nome e NIF da cooperativa.', 'danger');
    return;
  }
  if (!mun || !tel) {
    switchModalTab('localizacao');
    showToast('Campos obrigatórios em falta', 'Preencha o Município e Telefone.', 'danger');
    return;
  }

  const btn = document.getElementById('btnSalvarCoop');
  const orig = btn.innerHTML;
  btn.innerHTML = '<i class="bi bi-hourglass-split"></i> A guardar…';
  btn.disabled = true;

  setTimeout(() => {
    btn.innerHTML = orig;
    btn.disabled = false;
    bootstrap.Modal.getInstance(document.getElementById('modalCooperativa')).hide();
    showToast(
      isEditing ? 'Cooperativa actualizada' : 'Cooperativa registada',
      nome + (isEditing ? ' foi actualizada com sucesso.' : ' foi adicionada ao sistema.')
    );
  }, 1200);
});

/* ══════════════════════════════════════
   COOPERADOS — gestão dentro do modal
══════════════════════════════════════ */
function updateMemberCount() {
  const rows  = document.querySelectorAll('#memberList .coop-member-row:not([style*="display: none"])');
  const total = document.querySelectorAll('#memberList .coop-member-row').length;
  const badge = document.getElementById('tabBadgeCooperados');
  const countEl = document.getElementById('memberCount');
  if (badge) badge.textContent = total;
  if (countEl) countEl.textContent = total + ' cooperado' + (total !== 1 ? 's' : '');
}

function adicionarMembro() {
  const nome = document.getElementById('novoMemberNome').value.trim();
  const bi   = document.getElementById('novoMemberBI').value.trim();
  const tel  = document.getElementById('novoMemberTel').value.trim();
  const func = document.getElementById('novoMemberFuncao').value;

  if (!nome) {
    showToast('Nome obrigatório', 'Introduza o nome do agricultor.', 'danger');
    return;
  }

  const initials = nome.split(' ').map(w => w[0]).slice(0, 2).join('').toUpperCase();
  const colors   = ['#1B5E20','#1565C0','#6A1B9A','#F57F17','#00695C','#C62828'];
  const color    = colors[Math.floor(Math.random() * colors.length)];

  const funcLabels = {
    agricultor: { bg:'var(--accent-lt)', color:'var(--primary)', label:'Agricultor' },
    dirigente:  { bg:'#E3F2FD', color:'#1565C0', label:'Dirigente' },
    tecnico:    { bg:'#EDE7F6', color:'#6A1B9A', label:'Técnico' },
    socio:      { bg:'#FFF8E1', color:'#F57F17', label:'Sócio' },
  };
  const fl = funcLabels[func] || funcLabels.agricultor;

  const meta = [bi && 'BI: ' + bi, tel].filter(Boolean).join(' · ');

  const row = document.createElement('div');
  row.className = 'coop-member-row';
  row.dataset.memberName = nome;
  row.innerHTML = `
    <div class="member-avatar" style="background:${color};">${initials}</div>
    <div class="member-info">
      <div class="m-name">${nome}</div>
      <div class="m-meta">${meta} · <span style="background:${fl.bg};color:${fl.color};padding:1px 7px;border-radius:10px;font-size:10px;font-weight:700;">${fl.label}</span></div>
    </div>
    <div class="member-actions">
      <button type="button" class="action-btn edit" title="Editar"><i class="bi bi-pencil-fill"></i></button>
      <button type="button" class="action-btn delete" title="Remover" onclick="removerMembro(this)"><i class="bi bi-x-lg"></i></button>
    </div>`;

  document.getElementById('memberList').appendChild(row);

  // Reset inputs
  document.getElementById('novoMemberNome').value = '';
  document.getElementById('novoMemberBI').value   = '';
  document.getElementById('novoMemberTel').value  = '';

  updateMemberCount();
  showToast('Cooperado adicionado', nome + ' foi associado à cooperativa.');
}

function removerMembro(btn) {
  const row  = btn.closest('.coop-member-row');
  const nome = row.dataset.memberName || 'Cooperado';
  row.style.transition = 'opacity .2s';
  row.style.opacity = '0';
  setTimeout(() => { row.remove(); updateMemberCount(); }, 200);
  showToast('Cooperado removido', nome + ' foi desassociado.', 'danger');
}

function filtrarMembros() {
  const q = document.getElementById('searchMembro').value.toLowerCase();
  document.querySelectorAll('#memberList .coop-member-row').forEach(row => {
    const match = (row.dataset.memberName || '').toLowerCase().includes(q);
    row.style.display = match ? '' : 'none';
  });
}

updateMemberCount();

/* ══════════════════════════════════════
   VER DETALHES
══════════════════════════════════════ */
function viewCooperativa(id) {
  showToast('Detalhes da Cooperativa', 'Módulo de detalhe será implementado na próxima sprint.');
}

/* ══════════════════════════════════════
   DELETE
══════════════════════════════════════ */
let deleteTargetId = null;
let deleteTargetName = '';

function deleteCooperativa(id, nome) {
  deleteTargetId   = id;
  deleteTargetName = nome;
  document.getElementById('deleteCoopName').textContent = nome;
  new bootstrap.Modal(document.getElementById('modalDelete')).show();
}

function confirmDelete() {
  const btn = document.getElementById('btnConfirmDelete');
  btn.innerHTML = '<i class="bi bi-hourglass-split"></i> A eliminar…';
  btn.disabled = true;
  setTimeout(() => {
    btn.innerHTML = '<i class="bi bi-trash-fill"></i> Eliminar Definitivamente';
    btn.disabled = false;
    bootstrap.Modal.getInstance(document.getElementById('modalDelete')).hide();
    showToast('Cooperativa eliminada', deleteTargetName + ' foi removida do sistema.', 'danger');
  }, 1000);
}

/* ══════════════════════════════════════
   IMPRIMIR FICHA
══════════════════════════════════════ */
const fichaData = {
  1: { logo:'CAV', nome:'Cooperativa Agrícola de Viana', nif:'5401234567', estado:'Activa', municipio:'Viana', provincia:'Luanda', endereco:'Km 12, Estrada de Viana, Luanda Sul, Angola', telefone:'+244 923 456 789', email:'geral@coop-viana.ao', safra:'2024/2025', cultura:'Milho', cooperados:'348', area:'1.240', fundacao:'15/03/2018' },
  2: { logo:'CKI', nome:'Cooperativa Kilamba Kiaxi', nif:'5409876543', estado:'Activa', municipio:'Kilamba Kiaxi', provincia:'Luanda', endereco:'Rua da Paz, Kilamba, Luanda', telefone:'+244 912 345 678', email:'info@coop-ki.ao', safra:'2024/2025', cultura:'Feijão', cooperados:'412', area:'980', fundacao:'10/06/2019' },
  3: { logo:'CCA', nome:'Cooperativa Cazenga Agrícola', nif:'5407654321', estado:'Activa', municipio:'Cazenga', provincia:'Luanda', endereco:'Bairro Cazenga, Luanda', telefone:'+244 935 678 901', email:'cazenga@coop.ao', safra:'Planeada', cultura:'Mandioca', cooperados:'264', area:'620', fundacao:'22/01/2021' },
};

function printFicha(id) {
  const d = fichaData[id];
  if (!d) return;
  const today = new Date();
  const ds = String(today.getDate()).padStart(2,'0') + '/' + String(today.getMonth()+1).padStart(2,'0') + '/' + today.getFullYear();
  document.getElementById('fichaLogo').textContent  = d.logo;
  document.getElementById('fichaNome').textContent  = d.nome;
  document.getElementById('fichaEstado').textContent = d.estado;
  document.getElementById('fichaNIF').textContent   = d.nif;
  document.getElementById('fichaDataEmissao').textContent = ds;
  document.getElementById('fNome').textContent      = d.nome;
  document.getElementById('fNIF').textContent       = d.nif;
  document.getElementById('fFundacao').textContent  = d.fundacao;
  document.getElementById('fEstado').textContent    = d.estado;
  document.getElementById('fMunicipio').textContent = d.municipio;
  document.getElementById('fProvincia').textContent = d.provincia;
  document.getElementById('fEndereco').textContent  = d.endereco;
  document.getElementById('fTelefone').textContent  = d.telefone;
  document.getElementById('fEmail').textContent     = d.email;
  document.getElementById('fSafra').textContent     = d.safra;
  document.getElementById('fCultura').textContent   = d.cultura;
  document.getElementById('fCooperados').textContent = d.cooperados;
  document.getElementById('fArea').textContent      = d.area + ' ha';
  new bootstrap.Modal(document.getElementById('modalFicha')).show();
}

/* ══════════════════════════════════════
   SEARCH & FILTER
══════════════════════════════════════ */
function applyFilters() {
  const search   = document.getElementById('searchCoop').value.toLowerCase().trim();
  const estado   = document.getElementById('filterEstado').value;
  const provincia = document.getElementById('filterProvincia').value;
  const safra    = document.getElementById('filterSafra').value;
  const rows = document.querySelectorAll('#coopTableBody tr');
  let visible = 0;
  rows.forEach(row => {
    const text = row.textContent.toLowerCase();
    const show = (!search || text.includes(search))
              && (!estado   || row.dataset.estado   === estado)
              && (!provincia || row.dataset.provincia === provincia)
              && (!safra    || row.dataset.safra    === safra);
    row.style.display = show ? '' : 'none';
    if (show) visible++;
  });
  document.getElementById('emptyState').style.display = visible === 0 ? 'block' : 'none';
  document.getElementById('tableCount').textContent = `Mostrando ${visible} de 3 cooperativas`;
}

document.getElementById('searchCoop').addEventListener('input', applyFilters);
document.getElementById('filterEstado').addEventListener('change', applyFilters);
document.getElementById('filterProvincia').addEventListener('change', applyFilters);
document.getElementById('filterSafra').addEventListener('change', applyFilters);

/* ══════════════════════════════════════
   SELECT ALL CHECKBOXES
══════════════════════════════════════ */
document.getElementById('selectAll').addEventListener('change', function() {
  document.querySelectorAll('.row-check').forEach(cb => cb.checked = this.checked);
});

/* ══════════════════════════════════════
   VIEW TOGGLE
══════════════════════════════════════ */
document.getElementById('btnViewGrid').addEventListener('click', function() {
  this.style.background = 'var(--primary)'; this.style.color = '#fff';
  const l = document.getElementById('btnViewList');
  l.style.background = ''; l.style.color = '';
  showToast('Vista em Grelha', 'Funcionalidade disponível em breve.');
});
document.getElementById('btnViewList').addEventListener('click', function() {
  this.style.background = 'var(--primary)'; this.style.color = '#fff';
  const g = document.getElementById('btnViewGrid');
  g.style.background = ''; g.style.color = '';
});

/* ══════════════════════════════════════
   EXPORTAR
══════════════════════════════════════ */
document.getElementById('btnExportar').addEventListener('click', () => {
  showToast('A exportar…', 'O ficheiro será gerado e descarregado em breve.');
});
</script>

</body>
</html>
