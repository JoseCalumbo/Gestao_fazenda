<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>SIAG – Safras</title>

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" />
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700&family=DM+Sans:wght@400;500&display=swap"
    rel="stylesheet" />

  <style>
    :root {
      --sidebar-bg: #1B5E20;
      --sidebar-hover: #2E7D32;
      --sidebar-active: #2E7D32;
      --accent: #66BB6A;
      --accent-lt: #E8F5E9;
      --primary: #2E7D32;
      --text-dark: #1C2B1E;
      --text-mid: #4A6350;
      --text-light: #8FA894;
      --border: rgba(0, 0, 0, .07);
      --card-bg: #ffffff;
      --page-bg: #F4F6F4;
      --sidebar-w: 240px;
      --sidebar-w-icons: 68px;
      --topbar-h: 64px;
      --danger: #C62828;
      --warning: #F57F17;
      --info: #1565C0;
    }

    *,
    *::before,
    *::after {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

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
      top: 0;
      left: 0;
      width: var(--sidebar-w);
      height: 100vh;
      background: var(--sidebar-bg);
      display: flex;
      flex-direction: column;
      transition: width .3s ease;
      z-index: 1000;
      overflow: hidden;
    }

    body.icons-only #sidebar {
      width: var(--sidebar-w-icons);
    }

    body.sidebar-hidden #sidebar {
      width: 0;
    }

    .sidebar-logo {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 14px 15px;
      border-bottom: 1px solid rgba(255, 255, 255, .1);
      white-space: nowrap;
      min-height: var(--topbar-h);
      overflow: hidden;
    }

    body.icons-only .sidebar-logo {
      justify-content: center;
      padding: 14px 0;
    }

    body.icons-only .sidebar-logo .logo-text-wrap {
      opacity: 0;
      pointer-events: none;
      width: 0;
      overflow: hidden;
    }

    .sidebar-nav {
      flex: 1;
      padding: 12px 0;
      overflow-y: auto;
      overflow-x: hidden;
    }

    .sidebar-nav::-webkit-scrollbar {
      width: 4px;
    }

    .sidebar-nav::-webkit-scrollbar-thumb {
      background: rgba(255, 255, 255, .18);
      border-radius: 10px;
    }

    .sidebar-nav {
      scrollbar-width: thin;
      scrollbar-color: rgba(255, 255, 255, .18) transparent;
    }

    .nav-section-title {
      font-size: 10px;
      font-weight: 600;
      letter-spacing: 1.2px;
      text-transform: uppercase;
      color: rgba(255, 255, 255, .4);
      padding: 18px 20px 6px;
      white-space: nowrap;
      transition: opacity .2s;
    }

    body.icons-only .nav-section-title {
      opacity: 0;
      height: 0;
      padding: 0;
      overflow: hidden;
    }

    .nav-item-link {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 11px 18px;
      color: rgba(255, 255, 255, .75);
      text-decoration: none;
      border-radius: 10px;
      margin: 2px 8px;
      transition: background .2s, color .15s;
      white-space: nowrap;
      position: relative;
    }

    .nav-item-link i {
      font-size: 18px;
      flex-shrink: 0;
      width: 22px;
      text-align: center;
    }

    .nav-item-link .nav-label {
      font-size: 14px;
      font-weight: 500;
      opacity: 1;
      transition: opacity .2s;
    }

    body.icons-only .nav-item-link .nav-label {
      opacity: 0;
      pointer-events: none;
      width: 0;
      overflow: hidden;
    }

    body.icons-only .nav-item-link {
      justify-content: center;
      padding: 11px 0;
      margin: 2px 6px;
    }

    .nav-item-link:hover {
      background: rgba(255, 255, 255, .1);
      color: #fff;
    }

    .nav-item-link.active {
      background: var(--accent);
      color: #fff;
      box-shadow: 0 4px 14px rgba(102, 187, 106, .35);
    }

    .sidebar-tooltip .tooltip-inner {
      background: #0f3d14;
      color: #fff;
      font-size: 12.5px;
      font-weight: 500;
      padding: 5px 12px;
      border-radius: 8px;
      box-shadow: 0 4px 14px rgba(0, 0, 0, .3);
    }

    .sidebar-tooltip.bs-tooltip-end .tooltip-arrow::before {
      border-right-color: #0f3d14;
    }

    .sidebar-user {
      padding: 14px 10px;
      border-top: 1px solid rgba(255, 255, 255, .1);
      display: flex;
      align-items: center;
      gap: 10px;
      cursor: pointer;
      transition: background .2s;
      border-radius: 10px;
      margin: 4px 6px;
      white-space: nowrap;
    }

    .sidebar-user:hover {
      background: rgba(255, 255, 255, .08);
    }

    .sidebar-user .avatar {
      width: 34px;
      height: 34px;
      background: var(--accent);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
      overflow: hidden;
    }

    .sidebar-user .avatar img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .sidebar-user .avatar i {
      color: #fff;
      font-size: 16px;
    }

    .sidebar-user .user-info {
      opacity: 1;
      transition: opacity .2s;
    }

    .sidebar-user .user-info .u-name {
      font-size: 13px;
      font-weight: 600;
      color: #fff;
    }

    .sidebar-user .user-info .u-role {
      font-size: 11px;
      color: rgba(255, 255, 255, .5);
    }

    body.icons-only .sidebar-user .user-info {
      opacity: 0;
      pointer-events: none;
    }

    /* ═══════════════════════════════════════════
       TOPBAR
    ═══════════════════════════════════════════ */
    #topbar {
      position: fixed;
      top: 0;
      left: var(--sidebar-w);
      right: 0;
      height: var(--topbar-h);
      background: #fff;
      border-bottom: 1px solid var(--border);
      display: flex;
      align-items: center;
      padding: 0 28px;
      gap: 16px;
      z-index: 900;
      transition: left .3s ease;
    }

    body.icons-only #topbar {
      left: var(--sidebar-w-icons);
    }

    body.sidebar-hidden #topbar {
      left: 0;
    }

    .topbar-toggle {
      background: none;
      border: none;
      font-size: 20px;
      color: var(--text-mid);
      cursor: pointer;
      padding: 6px;
      border-radius: 8px;
      transition: background .2s, color .2s;
    }

    .topbar-toggle:hover {
      background: var(--accent-lt);
      color: var(--primary);
    }

    .topbar-title {
      font-family: 'Sora', sans-serif;
      font-size: 16px;
      font-weight: 600;
      color: var(--text-dark);
    }

    .topbar-right {
      margin-left: auto;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .topbar-icon-btn {
      width: 38px;
      height: 38px;
      border: none;
      background: var(--accent-lt);
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: var(--primary);
      font-size: 17px;
      cursor: pointer;
      transition: background .2s, color .2s;
      position: relative;
    }

    .topbar-icon-btn:hover {
      background: var(--primary);
      color: #fff;
    }

    .bi {
      color: var(--primary);
    }

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
    .action-btn.view:hover .bi {
      color: inherit;
    }

    .topbar-title .bi,
    .table-card-header .bi,
    .modal-section-title .bi {
      color: var(--primary);
    }

    .badge-status .bi,
    .stat-badge .bi {
      color: inherit;
    }

    .search-wrap .bi {
      color: var(--text-light);
    }

    .notif-badge {
      position: absolute;
      top: 6px;
      right: 6px;
      width: 8px;
      height: 8px;
      background: #E53935;
      border-radius: 50%;
      border: 2px solid #fff;
    }

    .topbar-user {
      display: flex;
      align-items: center;
      gap: 8px;
      padding: 6px 12px;
      background: var(--accent-lt);
      border-radius: 30px;
      cursor: pointer;
      transition: background .2s;
    }

    .topbar-user:hover {
      background: #C8E6C9;
    }

    .topbar-user .t-avatar {
      width: 30px;
      height: 30px;
      background: var(--primary);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
    }

    .topbar-user .t-avatar img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .avatar-md {
      width: 30px !important;
      height: 30px;
      object-fit: cover;
      border-radius: 50%;
    }

    .topbar-user .t-avatar i {
      color: #fff;
      font-size: 14px;
    }

    .topbar-user span {
      font-size: 13px;
      font-weight: 500;
      color: var(--primary);
    }

    .dropdown-menu-user {
      min-width: 200px;
      border: 1px solid var(--border);
      border-radius: 14px;
      box-shadow: 0 12px 36px rgba(0, 0, 0, .12);
      padding: 6px;
      margin-top: 8px !important;
    }

    .dropdown-menu-user .dropdown-header {
      font-size: 11px;
      font-weight: 600;
      letter-spacing: .8px;
      text-transform: uppercase;
      color: var(--text-light);
      padding: 6px 12px 4px;
    }

    .dropdown-menu-user .dropdown-item {
      font-size: 13.5px;
      color: var(--text-mid);
      border-radius: 8px;
      padding: 9px 12px;
      display: flex;
      align-items: center;
      gap: 9px;
      transition: background .15s, color .15s;
    }

    .dropdown-menu-user .dropdown-item i {
      font-size: 15px;
      color: var(--text-light);
    }

    .dropdown-menu-user .dropdown-item:hover {
      background: var(--accent-lt);
      color: var(--primary);
    }

    .dropdown-menu-user .dropdown-item:hover i {
      color: var(--primary);
    }

    .dropdown-menu-user .dropdown-divider {
      margin: 4px 6px;
      border-color: var(--border);
    }

    .dropdown-menu-user .item-logout {
      color: #C62828;
    }

    .dropdown-menu-user .item-logout i {
      color: #C62828;
    }

    .dropdown-menu-user .item-logout:hover {
      background: #FFEBEE;
      color: #C62828;
    }

    .dropdown-menu-user form {
      margin: 0;
    }

    .dropdown-menu-user form button {
      background: none;
      border: none;
      font-size: 13.5px;
      color: #C62828;
      border-radius: 8px;
      padding: 9px 12px;
      width: 100%;
      text-align: left;
      display: flex;
      align-items: center;
      gap: 9px;
      cursor: pointer;
      transition: background .15s;
    }

    .dropdown-menu-user form button:hover {
      background: #FFEBEE;
    }

    .dropdown-menu-user form button i {
      font-size: 15px;
      color: #C62828;
    }

    /* ═══════════════════════════════════════════
       MAIN CONTENT
    ═══════════════════════════════════════════ */
    #main {
      margin-left: var(--sidebar-w);
      padding-top: var(--topbar-h);
      transition: margin-left .3s ease;
      min-height: 100vh;
    }

    body.icons-only #main {
      margin-left: var(--sidebar-w-icons);
    }

    body.sidebar-hidden #main {
      margin-left: 0;
    }

    .content-inner {
      padding: 28px;
    }

    /* ═══════════════════════════════════════════
       PAGE HEADER
    ═══════════════════════════════════════════ */
    .page-header {
      display: flex;
      align-items: flex-start;
      justify-content: space-between;
      margin-bottom: 28px;
      flex-wrap: wrap;
      gap: 12px;
    }

    .page-header h1 {
      font-family: 'Sora', sans-serif;
      font-size: 22px;
      font-weight: 700;
      color: var(--text-dark);
      margin-bottom: 3px;
    }

    .page-header p {
      font-size: 13.5px;
      color: var(--text-light);
    }

    .btn-green {
      background: var(--primary);
      color: #fff;
      border: none;
      border-radius: 10px;
      padding: 9px 18px;
      font-size: 13.5px;
      font-weight: 600;
      display: inline-flex;
      align-items: center;
      gap: 6px;
      cursor: pointer;
      transition: background .2s, transform .1s;
      text-decoration: none;
    }

    .btn-green:hover {
      background: var(--accent);
      color: #fff;
    }

    .btn-green:active {
      transform: scale(.97);
    }

    .btn-outline-green {
      background: transparent;
      color: var(--primary);
      border: 1.5px solid var(--primary);
      border-radius: 10px;
      padding: 8px 16px;
      font-size: 13.5px;
      font-weight: 600;
      display: inline-flex;
      align-items: center;
      gap: 6px;
      cursor: pointer;
      transition: background .2s, color .2s;
      text-decoration: none;
    }

    .btn-outline-green:hover {
      background: var(--accent-lt);
      color: var(--primary);
    }

    /* ═══════════════════════════════════════════
       STAT CARDS
    ═══════════════════════════════════════════ */
    .stat-card {
      background: var(--card-bg);
      border-radius: 16px;
      padding: 22px 20px;
      border: 1px solid var(--border);
      display: flex;
      align-items: center;
      gap: 16px;
      transition: box-shadow .2s, transform .2s;
    }

    .stat-card:hover {
      box-shadow: 0 8px 28px rgba(46, 125, 50, .1);
      transform: translateY(-2px);
    }

    .stat-icon {
      width: 52px;
      height: 52px;
      border-radius: 14px;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
      font-size: 22px;
    }

    .stat-icon.green {
      background: var(--accent-lt);
      color: var(--primary);
    }

    .stat-icon.blue {
      background: #E3F2FD;
      color: #1565C0;
    }

    .stat-icon.amber {
      background: #FFF8E1;
      color: #F57F17;
    }

    .stat-icon.purple {
      background: #EDE7F6;
      color: #6A1B9A;
    }

    .stat-info .s-label {
      font-size: 12.5px;
      color: var(--text-light);
      margin-bottom: 4px;
    }

    .stat-info .s-value {
      font-family: 'Sora', sans-serif;
      font-size: 22px;
      font-weight: 700;
      color: var(--text-dark);
      line-height: 1;
      margin-bottom: 5px;
    }

    .stat-badge {
      font-size: 11.5px;
      font-weight: 600;
      padding: 3px 8px;
      border-radius: 30px;
      display: inline-flex;
      align-items: center;
      gap: 3px;
    }

    .stat-badge.up {
      background: #E8F5E9;
      color: #2E7D32;
    }

    .stat-badge.info {
      background: #E3F2FD;
      color: #1565C0;
    }

    /* ═══════════════════════════════════════════
       TABLE CARD
    ═══════════════════════════════════════════ */
    .table-card {
      background: var(--card-bg);
      border-radius: 16px;
      border: 1px solid var(--border);
      overflow: hidden;
    }

    .table-card-header {
      padding: 18px 24px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      border-bottom: 1px solid var(--border);
      flex-wrap: wrap;
      gap: 12px;
    }

    .table-card-header h5 {
      font-family: 'Sora', sans-serif;
      font-size: 15px;
      font-weight: 600;
      color: var(--text-dark);
    }

    .search-filter-bar {
      padding: 14px 24px;
      border-bottom: 1px solid var(--border);
      display: flex;
      gap: 10px;
      flex-wrap: wrap;
      align-items: center;
    }

    .search-wrap {
      flex: 1;
      min-width: 220px;
      position: relative;
    }

    .search-wrap i {
      position: absolute;
      left: 13px;
      top: 50%;
      transform: translateY(-50%);
      color: var(--text-light);
      font-size: 14px;
      pointer-events: none;
    }

    .search-input {
      width: 100%;
      border: 1.5px solid var(--border);
      border-radius: 10px;
      padding: 10px 14px 10px 36px;
      font-size: 13.5px;
      color: var(--text-dark);
      background: #FAFAF9;
      outline: none;
      font-family: 'DM Sans', sans-serif;
      transition: border-color .2s, box-shadow .2s;
    }

    .search-input:focus {
      border-color: var(--primary);
      box-shadow: 0 0 0 3px rgba(46, 125, 50, .1);
      background: #fff;
    }

    .search-input::placeholder {
      color: #C3B8B4;
    }

    .filter-select {
      border: 1.5px solid var(--border);
      border-radius: 10px;
      padding: 10px 32px 10px 14px;
      font-size: 13.5px;
      color: var(--text-dark);
      background: #FAFAF9;
      appearance: none;
      cursor: pointer;
      outline: none;
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%238FA894' stroke-width='2'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E");
      background-repeat: no-repeat;
      background-position: right 12px center;
      transition: border-color .2s;
      min-width: 150px;
    }

    .filter-select:focus {
      border-color: var(--primary);
      box-shadow: 0 0 0 3px rgba(46, 125, 50, .1);
    }

    /* Safras Table */
    .safra-table {
      width: 100%;
      border-collapse: collapse;
    }

    .safra-table th {
      font-size: 11px;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: .8px;
      color: var(--text-light);
      padding: 12px 20px;
      background: #FAFBFA;
      border-bottom: 1px solid var(--border);
      text-align: left;
      white-space: nowrap;
    }

    .safra-table td {
      font-size: 13.5px;
      color: var(--text-dark);
      padding: 14px 20px;
      border-bottom: 1px solid var(--border);
      vertical-align: middle;
    }

    .safra-table tr:last-child td {
      border-bottom: none;
    }

    .safra-table tbody tr:hover td {
      background: #F8FBF8;
    }

    .safra-cell {
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .safra-cell .safra-name {
      font-weight: 600;
      font-size: 14px;
    }

    .safra-cell .safra-cultura {
      font-size: 11.5px;
      color: var(--text-light);
      margin-top: 1px;
    }

    .badge-status {
      font-size: 11px;
      font-weight: 600;
      padding: 4px 11px;
      border-radius: 30px;
    }

    .badge-status.planeada {
      background: #FFF8E1;
      color: #F57F17;
    }

    .badge-status.em_andamento {
      background: #E3F2FD;
      color: #1565C0;
    }

    .badge-status.concluida {
      background: #E8F5E9;
      color: #2E7D32;
    }

    .badge-status.cancelada {
      background: #FFEBEE;
      color: #C62828;
    }

    .action-btn {
      width: 32px;
      height: 32px;
      border: none;
      border-radius: 9px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      font-size: 14px;
      cursor: pointer;
      transition: background .15s, color .15s;
      text-decoration: none;
    }

    .action-btn.edit {
      background: var(--accent-lt);
      color: var(--primary);
    }

    .action-btn.edit:hover {
      background: var(--primary);
      color: #fff;
    }

    .action-btn.delete {
      background: #FFEBEE;
      color: #C62828;
    }

    .action-btn.delete:hover {
      background: #C62828;
      color: #fff;
    }

    .action-btn.view {
      background: #EDE7F6;
      color: #6A1B9A;
    }

    .action-btn.view:hover {
      background: #6A1B9A;
      color: #fff;
    }

    .table-footer {
      padding: 14px 24px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      border-top: 1px solid var(--border);
      flex-wrap: wrap;
      gap: 10px;
    }

    .table-footer span {
      font-size: 12.5px;
      color: var(--text-light);
    }

    .pagination-btns {
      display: flex;
      gap: 6px;
    }

    .page-btn {
      min-width: 34px;
      height: 34px;
      padding: 0 10px;
      border: 1.5px solid var(--border);
      border-radius: 9px;
      background: #fff;
      font-size: 13px;
      color: var(--text-mid);
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: all .15s;
      font-family: 'DM Sans', sans-serif;
    }

    .page-btn:hover {
      border-color: var(--primary);
      color: var(--primary);
    }

    .page-btn.active {
      background: var(--primary);
      color: #fff;
      border-color: var(--primary);
    }

    .empty-state {
      text-align: center;
      padding: 60px 20px;
    }

    .empty-state i {
      font-size: 52px;
      color: var(--accent);
      opacity: .5;
      display: block;
      margin-bottom: 16px;
    }

    .empty-state h6 {
      font-family: 'Sora', sans-serif;
      font-size: 16px;
      color: var(--text-dark);
      margin-bottom: 6px;
    }

    .empty-state p {
      font-size: 13px;
      color: var(--text-light);
    }

    /* ═══════════════════════════════════════════
       MODAL
    ═══════════════════════════════════════ */
    .modal-coop {
      max-width: 780px;
    }

    .modal-coop .modal-content {
      height: 620px;
      display: flex;
      flex-direction: column;
    }

    .modal-coop .modal-body {
      flex: 1;
      overflow-y: auto;
      overflow-x: hidden;
      padding: 0;
      background: var(--page-bg);
      scrollbar-width: thin;
      scrollbar-color: rgba(0, 0, 0, .15) transparent;
    }

    .modal-coop .modal-body::-webkit-scrollbar {
      width: 5px;
    }

    .modal-coop .modal-body::-webkit-scrollbar-track {
      background: transparent;
    }

    .modal-coop .modal-body::-webkit-scrollbar-thumb {
      background: rgba(0, 0, 0, .12);
      border-radius: 10px;
    }

    .modal-coop .modal-body::-webkit-scrollbar-thumb:hover {
      background: rgba(0, 0, 0, .22);
    }

    body.dark-mode .modal-coop .modal-body {
      scrollbar-color: rgba(255, 255, 255, .15) transparent;
    }

    body.dark-mode .modal-coop .modal-body::-webkit-scrollbar-thumb {
      background: rgba(255, 255, 255, .15);
    }

    .modal-tab-panel {
      display: none;
      padding: 22px;
    }

    .modal-tab-panel.active {
      display: block;
    }

    .modal-content {
      border: none;
      border-radius: 18px;
      box-shadow: 0 24px 64px rgba(0, 0, 0, .15);
      overflow: hidden;
    }

    .modal-header {
      padding: 11px 20px;
      border-bottom: 1px solid var(--border);
      background: linear-gradient(135deg, var(--sidebar-bg) 0%, var(--primary) 100%);
      flex-shrink: 0;
    }

    .modal-header .modal-title {
      font-family: 'Sora', sans-serif;
      font-size: 16px;
      font-weight: 700;
      color: #fff;
    }

    .modal-header .btn-close {
      filter: brightness(0) invert(1);
      opacity: .8;
    }

    .modal-header .btn-close:hover {
      opacity: 1;
    }

    .modal-header-icon {
      width: 36px;
      height: 36px;
      border-radius: 10px;
      background: rgba(255, 255, 255, .2);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 17px;
      color: #fff;
      flex-shrink: 0;
    }

    .modal-body {
      background: var(--page-bg);
    }

    .modal-footer {
      padding: 14px 20px;
      border-top: 1px solid var(--border);
      background: #fff;
      flex-shrink: 0;
    }

    .modal-section-title {
      font-size: 11px;
      font-weight: 700;
      letter-spacing: 1px;
      text-transform: uppercase;
      color: var(--text-light);
      margin-bottom: 14px;
      padding-bottom: 8px;
      border-bottom: 1px solid var(--border);
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .modal-section-title i {
      font-size: 13px;
      color: var(--primary);
    }

    .modal-form-card {
      background: var(--card-bg);
      border-radius: 14px;
      border: 1px solid var(--border);
      padding: 20px 22px;
      margin-bottom: 16px;
    }

    .cfg-label {
      display: block;
      font-size: 12px;
      font-weight: 600;
      color: var(--text-mid);
      margin-bottom: 5px;
      letter-spacing: .2px;
    }

    .cfg-input {
      width: 100%;
      border: 1.5px solid var(--border);
      border-radius: 10px;
      padding: 10px 13px;
      font-size: 13.5px;
      color: var(--text-dark);
      background: #FAFAF9;
      font-family: 'DM Sans', sans-serif;
      outline: none;
      transition: border-color .2s, box-shadow .2s;
    }

    .cfg-input:focus {
      border-color: var(--primary);
      box-shadow: 0 0 0 3px rgba(46, 125, 50, .1);
      background: #fff;
    }

    .cfg-input::placeholder {
      color: #C3B8B4;
    }

    .cfg-select {
      width: 100%;
      border: 1.5px solid var(--border);
      border-radius: 10px;
      padding: 10px 32px 10px 13px;
      font-size: 13.5px;
      color: var(--text-dark);
      background: #FAFAF9;
      appearance: none;
      cursor: pointer;
      outline: none;
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%238FA894' stroke-width='2'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E");
      background-repeat: no-repeat;
      background-position: right 12px center;
      transition: border-color .2s;
      font-family: 'DM Sans', sans-serif;
    }

    .cfg-select:focus {
      border-color: var(--primary);
      box-shadow: 0 0 0 3px rgba(46, 125, 50, .1);
    }

    .cfg-textarea {
      width: 100%;
      border: 1.5px solid var(--border);
      border-radius: 10px;
      padding: 10px 13px;
      font-size: 13.5px;
      color: var(--text-dark);
      background: #FAFAF9;
      resize: vertical;
      min-height: 80px;
      outline: none;
      font-family: 'DM Sans', sans-serif;
      transition: border-color .2s;
    }

    .cfg-textarea:focus {
      border-color: var(--primary);
      box-shadow: 0 0 0 3px rgba(46, 125, 50, .1);
    }

    .cfg-helper {
      font-size: 11.5px;
      color: var(--text-light);
      margin-top: 4px;
    }

    .modal-tabs {
      display: flex;
      gap: 0;
      border-bottom: 2px solid var(--border);
      background: var(--page-bg);
      padding: 0 24px;
      overflow-x: auto;
    }

    .modal-tabs::-webkit-scrollbar {
      height: 0;
    }

    .modal-tab-btn {
      display: flex;
      align-items: center;
      gap: 8px;
      padding: 14px 18px;
      font-size: 13px;
      font-weight: 500;
      color: var(--text-mid);
      background: none;
      border: none;
      border-bottom: 2px solid transparent;
      margin-bottom: -2px;
      cursor: pointer;
      transition: color .15s, border-color .15s;
      white-space: nowrap;
    }

    .modal-tab-btn .bi {
      color: var(--text-light);
      transition: color .15s;
      font-size: 15px;
    }

    .modal-tab-btn:hover {
      color: var(--primary);
    }

    .modal-tab-btn:hover .bi {
      color: var(--primary);
    }

    .modal-tab-btn.active {
      color: var(--primary);
      font-weight: 600;
      border-bottom-color: var(--primary);
    }

    .modal-tab-btn.active .bi {
      color: var(--primary);
    }

    /* Toast */
    .save-toast {
      position: fixed;
      bottom: 28px;
      right: 28px;
      z-index: 9999;
      background: #fff;
      border: 1px solid var(--border);
      border-radius: 14px;
      padding: 14px 20px;
      box-shadow: 0 12px 36px rgba(0, 0, 0, .12);
      display: flex;
      align-items: center;
      gap: 12px;
      transform: translateY(80px);
      opacity: 0;
      transition: all .35s cubic-bezier(.34, 1.56, .64, 1);
      pointer-events: none;
    }

    .save-toast.show {
      transform: translateY(0);
      opacity: 1;
      pointer-events: all;
    }

    .save-toast .toast-icon {
      width: 36px;
      height: 36px;
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 18px;
    }

    .save-toast .toast-icon.success {
      background: #E8F5E9;
      color: #2E7D32;
    }

    .save-toast .toast-icon.danger {
      background: #FFEBEE;
      color: #C62828;
    }

    .save-toast .toast-text .t-title {
      font-size: 13.5px;
      font-weight: 600;
      color: var(--text-dark);
    }

    .save-toast .toast-text .t-sub {
      font-size: 12px;
      color: var(--text-light);
    }

    /* Animations */
    @keyframes fadeUp {
      from {
        opacity: 0;
        transform: translateY(14px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .anim {
      animation: fadeUp .4s ease both;
    }

    .anim-d1 {
      animation-delay: .05s;
    }

    .anim-d2 {
      animation-delay: .10s;
    }

    .anim-d3 {
      animation-delay: .15s;
    }

    .anim-d4 {
      animation-delay: .20s;
    }

    /* Dark mode */
    body.dark-mode {
      --card-bg: #1e2a20;
      --page-bg: #141d15;
      --text-dark: #e8f0e9;
      --text-mid: #9ab89e;
      --text-light: #6a8a6e;
      --border: rgba(255, 255, 255, .07);
    }

    body.dark-mode #topbar {
      background: #1e2a20;
      border-color: rgba(255, 255, 255, .06);
    }

    body.dark-mode .topbar-title {
      color: #e8f0e9;
    }

    body.dark-mode .topbar-user {
      background: rgba(102, 187, 106, .15);
    }

    body.dark-mode .topbar-user span {
      color: #66BB6A;
    }

    body.dark-mode .topbar-icon-btn {
      background: rgba(102, 187, 106, .12);
    }

    body.dark-mode .safra-table th {
      background: #172518;
    }

    body.dark-mode .safra-table tbody tr:hover td {
      background: #1a2a1c;
    }

    body.dark-mode .search-input,
    body.dark-mode .filter-select,
    body.dark-mode .cfg-input,
    body.dark-mode .cfg-select,
    body.dark-mode .cfg-textarea {
      background: #172518;
      color: #e8f0e9;
      border-color: rgba(255, 255, 255, .1);
    }

    body.dark-mode .modal-body {
      background: #1a2a1c;
    }

    body.dark-mode .modal-form-card {
      background: #1e2a20;
      border-color: rgba(255, 255, 255, .07);
    }

    body.dark-mode .modal-footer {
      background: #1e2a20;
      border-color: rgba(255, 255, 255, .07);
    }

    /* Responsive */
    @media (max-width: 768px) {
      :root {
        --sidebar-w: 240px;
      }

      body:not(.sidebar-hidden) #sidebar {
        box-shadow: 4px 0 20px rgba(0, 0, 0, .2);
      }

      body.default #sidebar {
        width: 0;
      }

      body.default #main {
        margin-left: 0;
      }

      body.default #topbar {
        left: 0;
      }

      .content-inner {
        padding: 16px;
      }

      /* ─── FORÇAR CARDS EM COLUNA ÚNICA ─── */
      .row.g-3.mb-4 {
        display: flex;
        flex-direction: column;
        gap: 12px;
      }

      .row.g-3.mb-4 .col-6 {
        width: 100%;
        flex: 0 0 100%;
        max-width: 100%;
      }

      .stat-card {
        padding: 16px 18px;
      }

      .stat-info .s-value {
        font-size: 18px;
      }
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
          <circle cx="170" cy="170" r="145" fill="#66BB6A" />
          <g fill="#ffffff" stroke="#ffffff" stroke-width="1.5" stroke-linejoin="round" stroke-linecap="round">
            <circle cx="118" cy="188" r="48" fill="none" stroke-width="6" />
            <circle cx="118" cy="188" r="35" fill="none" stroke-width="4.5" />
            <circle cx="118" cy="188" r="16" fill="#ffffff" />
            <path
              d="M 118 135 L 118 144 M 118 232 L 118 241 M 65 188 L 74 188 M 162 188 L 171 188 M 81 151 L 88 157 M 155 219 L 162 225 M 81 225 L 88 219 M 155 151 L 162 157"
              stroke-width="6" />
            <path d="M 68 185 C 68 140, 108 120, 160 128 C 171 132, 174 144, 174 151" fill="none" stroke-width="6" />
            <circle cx="231" cy="204" r="26" fill="none" stroke-width="5" />
            <circle cx="231" cy="204" r="10" fill="#ffffff" />
            <path
              d="M 231 174 L 231 180 M 231 228 L 231 234 M 201 204 L 207 204 M 255 204 L 261 204 M 210 183 L 214 187 M 248 221 L 252 225 M 210 225 L 214 221 M 248 183 L 252 187"
              stroke-width="4" />
            <path
              d="M 117 125 L 117 105 C 117 102, 120 99, 125 99 L 176 99 C 181 99, 184 102, 185 107 L 202 157 L 176 157"
              fill="none" stroke-width="6" />
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
      <div class="logo-text-wrap">
        <div style="font-family:'Sora',sans-serif;font-size:17px;font-weight:700;color:#fff;letter-spacing:1px;line-height:1.1;">
          SIAG</div>
        <div style="font-size:10px;color:rgba(255,255,255,.5);letter-spacing:.5px;">Agrícola Cooperativas</div>
      </div>
    </div>

    <div class="sidebar-nav">
      <div class="nav-section-title">Principal</div>
      <a href="{{ route('dashboard') }}" class="nav-item-link" data-label="Dashboard"><i class="bi bi-grid-1x2-fill"></i><span class="nav-label">Dashboard</span></a>
      <a href="{{ route('cooperativas') }}" class="nav-item-link" data-label="Cooperativa"><i class="bi bi-building"></i><span class="nav-label">Cooperativa</span></a>
      <a href="{{ route('agricultores.index') }}" class="nav-item-link" data-label="Agricultores"><i class="bi bi-people-fill"></i><span class="nav-label">Agricultores</span></a>

      <div class="nav-section-title">Agrícola</div>
      <a href="{{ route('safras.painel') }}" class="nav-item-link active" data-label="Safras"><i class="bi bi-flower2"></i><span class="nav-label">Safras</span></a>
      <a href="{{ route('talhoes.index') }}" class="nav-item-link" data-label="Talhões"><i class="bi bi-map-fill"></i><span class="nav-label">Talhões</span></a>
      <a href="{{ route('insumos.index') }}" class="nav-item-link" data-label="Insumos"><i class="bi bi-box-seam-fill"></i><span class="nav-label">Insumos</span></a>

      <div class="nav-section-title">Comercial</div>
      <a href="{{ route('vendas') }}" class="nav-item-link" data-label="Vendas"><i class="bi bi-cart-fill"></i><span class="nav-label">Vendas</span></a>

      <div class="nav-section-title">Sistema</div>
      <a href="{{ route('configuracoes') }}" class="nav-item-link" data-label="Configurações"><i class="bi bi-gear-fill"></i><span class="nav-label">Configurações</span></a>
    </div>

    <div class="sidebar-user">
      <div class="user-info">
        <div class="u-name">SIAG</div>
        <div class="u-role">Sistema de Gestão de cooperativa @ 2026</div>
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
    <span class="topbar-title">Safras</span>
    <nav aria-label="breadcrumb" class="d-none d-md-flex ms-3">
      <ol class="breadcrumb mb-0" style="font-size:12.5px;">
        <li class="breadcrumb-item"><a href="#" style="color:var(--primary);text-decoration:none;">SIAG</a></li>
        <li class="breadcrumb-item active" style="color:var(--text-light);">Safras</li>
      </ol>
    </nav>
    <div class="topbar-right">
      <div class="dropdown d-none d-sm-flex">
        <div class="topbar-user" data-bs-toggle="dropdown" data-bs-offset="0,4" role="button">
          <div class="t-avatar">
            <img id="dropdownAvatarLarge"
              src="{{ Auth::check() ? Auth::user()->foto_url : asset('uploads/users/default-user.png') }}"
              alt="Foto-perfil" width="20" class="avatar-md">
          </div>
          <span>{{ Auth::check() ? Auth::user()->name : 'Utilizador' }}</span>
          <i class="bi bi-chevron-down" style="font-size:11px;color:var(--primary);"></i>
        </div>
        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-user">
          <li><span class="dropdown-header"> Nível: {{ Auth::user()->nivel }}</li>
          <li><hr class="dropdown-divider"></li>
          <li><a class="dropdown-item" href="#" id="themeToggle"><i class="bi bi-moon-stars-fill" id="themeIcon"></i><span id="themeLabel">Modo Escuro</span></a></li>
          <li><hr class="dropdown-divider"></li>
          <li>
            <div class="dropdown-item item-logout p-0">
              <form method="POST" action="/logout">@csrf<button type="submit"><i class="bi bi-box-arrow-right"></i> Sair</button></form>
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
          <h1>Gestão de Safras</h1>
          <p>Planeamento e acompanhamento das épocas agrícolas e produções</p>
        </div>
        <div style="display:flex;gap:10px;flex-wrap:wrap;">
          <button class="btn-outline-green" id="btnExportar"><i class="bi bi-download"></i> Exportar</button>
          <button class="btn-green" id="btnNovaSafra" data-bs-toggle="modal" data-bs-target="#modalSafra">
            <i class="bi bi-plus-lg"></i> Nova Safra
          </button>
        </div>
      </div>

      <!-- Stat Cards -->
      <div class="row g-3 mb-4 anim anim-d1">
        <div class="col-6 col-xl-3">
          <div class="stat-card">
            <div class="stat-icon green"><i class="bi bi-calendar-event-fill"></i></div>
            <div class="stat-info">
              <div class="s-label">Total de Safras</div>
              <div class="s-value">{{ $totalSafras ?? 0 }}</div>
            </div>
          </div>
        </div>
        <div class="col-6 col-xl-3">
          <div class="stat-card">
            <div class="stat-icon blue"><i class="bi bi-play-circle-fill"></i></div>
            <div class="stat-info">
              <div class="s-label">Em Andamento</div>
              <div class="s-value">{{ $emAndamento ?? 0 }}</div>
            </div>
          </div>
        </div>
        <div class="col-6 col-xl-3">
          <div class="stat-card">
            <div class="stat-icon amber"><i class="bi bi-check-circle-fill"></i></div>
            <div class="stat-info">
              <div class="s-label">Concluídas</div>
              <div class="s-value">{{ $concluidas ?? 0 }}</div>
            </div>
          </div>
        </div>
        <div class="col-6 col-xl-3">
          <div class="stat-card">
            <div class="stat-icon purple"><i class="bi bi-clock-fill"></i></div>
            <div class="stat-info">
              <div class="s-label">Planeadas</div>
              <div class="s-value">{{ $planeadas ?? 0 }}</div>
            </div>
          </div>
        </div>
      </div>

      <!-- Table Card -->
      <div class="table-card anim anim-d2">

        <div class="table-card-header">
          <h5><i class="bi bi-flower2 me-2" style="color:var(--primary);"></i>Lista de Safras</h5>
        </div>

        <form action="{{ route('safras.painel') }}" method="GET" class="search-filter-bar">
          <div class="search-wrap">
            <i class="bi bi-search"></i>
            <input type="text" name="search" class="search-input" placeholder="Pesquisar safra por nome ou cultura…" value="{{ request('search') }}">
          </div>

          <select class="filter-select" name="estado" onchange="this.form.submit()">
            <option value="">Todos os estados</option>
            <option value="planeada" {{ request('estado') == 'planeada' ? 'selected' : '' }}>Planeada</option>
            <option value="em_andamento" {{ request('estado') == 'em_andamento' ? 'selected' : '' }}>Em Andamento</option>
            <option value="concluida" {{ request('estado') == 'concluida' ? 'selected' : '' }}>Concluída</option>
            <option value="cancelada" {{ request('estado') == 'cancelada' ? 'selected' : '' }}>Cancelada</option>
          </select>

          <select class="filter-select" name="cultura" onchange="this.form.submit()">
            <option value="">Todas as culturas</option>
            <option value="Milho" {{ request('cultura') == 'Milho' ? 'selected' : '' }}>Milho</option>
            <option value="Feijão" {{ request('cultura') == 'Feijão' ? 'selected' : '' }}>Feijão</option>
            <option value="Mandioca" {{ request('cultura') == 'Mandioca' ? 'selected' : '' }}>Mandioca</option>
            <option value="Batata-doce" {{ request('cultura') == 'Batata-doce' ? 'selected' : '' }}>Batata-doce</option>
            <option value="Hortícolas" {{ request('cultura') == 'Hortícolas' ? 'selected' : '' }}>Hortícolas</option>
          </select>
        </form>

        <div style="overflow-x:auto;">
          <table class="safra-table">
            <thead>
              <tr>
                <th style="width:40px;"><input type="checkbox" id="selectAll" style="accent-color:var(--primary);width:15px;height:15px;cursor:pointer;"></th>
                <th>Safra / Cultura</th>
                <th>Período</th>
                <th>Área (ha)</th>
                <th>Estado</th>
                <th style="text-align:center;">Acções</th>
              </tr>
            </thead>
            <tbody>
              @forelse($safras ?? [] as $safra)
                <tr id="safra-row-{{ $safra->id }}">
                  <td><input type="checkbox" class="row-check" style="accent-color:var(--primary);width:15px;height:15px;cursor:pointer;"></td>
                  <td>
                    <div class="safra-cell">
                      <div style="width:40px;height:40px;background:var(--accent-lt);border-radius:10px;display:flex;align-items:center;justify-content:center;color:var(--primary);flex-shrink:0;">
                        <i class="bi bi-flower2" style="font-size:20px;"></i>
                      </div>
                      <div>
                        <div class="safra-name">{{ $safra->nome }}</div>
                        <div class="safra-cultura"><i class="bi bi-tag"></i> {{ $safra->cultura }}</div>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div style="font-size:13px;">{{ \Carbon\Carbon::parse($safra->data_inicio)->format('d/m/Y') }}</div>
                    <div style="font-size:12px;color:var(--text-light);">até {{ \Carbon\Carbon::parse($safra->data_fim)->format('d/m/Y') }}</div>
                  </td>
                  <td>{{ number_format($safra->area_plantada, 2, ',', '.') }}</td>
                  <td>
                    <span class="badge-status {{ $safra->estado }}">
                      {{ ucfirst(str_replace('_', ' ', $safra->estado)) }}
                    </span>
                  </td>
                  <td style="text-align:center;">
                    <div style="display:flex;gap:6px;justify-content:center;">
                      <a href="{{ route('safras.show', $safra->id) }}" class="action-btn view" title="Ver detalhes"><i class="bi bi-eye-fill"></i></a>
                      <button class="action-btn edit btn-editar-safra" title="Editar" data-id="{{ $safra->id }}" data-nome="{{ $safra->nome }}" data-cultura="{{ $safra->cultura }}" data-inicio="{{ $safra->data_inicio }}" data-fim="{{ $safra->data_fim }}" data-area="{{ $safra->area_plantada }}" data-estado="{{ $safra->estado }}"><i class="bi bi-pencil-fill"></i></button>
                      <button class="action-btn delete btn-eliminar-safra" title="Apagar" data-id="{{ $safra->id }}" data-nome="{{ $safra->nome }}"><i class="bi bi-trash-fill"></i></button>
                    </div>
                  </td>
                </tr>
              @empty
                <tr><td colspan="6"><div class="empty-state"><i class="bi bi-flower2"></i><h6>Nenhuma safra encontrada</h6><p>Tente ajustar os filtros ou registe uma nova safra.</p></div></td></tr>
              @endforelse
            </tbody>
          </table>
        </div>

        <div class="table-footer">
          <span>Mostrando {{ $safras->firstItem() ?? 0 }} até {{ $safras->lastItem() ?? 0 }} de {{ $safras->total() ?? 0 }} safras</span>
          <div class="pagination-btns">
            @if(isset($safras) && method_exists($safras, 'links'))
              {{ $safras->links('pagination::bootstrap-5') }}
            @endif
          </div>
        </div>

      </div>
    </div>
  </main>

  <!-- ══════════════════════════════════════
     MODAL — NOVA / EDITAR SAFRA
══════════════════════════════════════ -->
  <div class="modal fade" id="modalSafra" tabindex="-1" aria-labelledby="modalSafraLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-coop modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <div style="display:flex;align-items:center;gap:14px;flex:1;">
            <div class="modal-header-icon"><i class="bi bi-flower2" id="modalHeaderIcon"></i></div>
            <div><div class="modal-title" id="modalSafraLabel">Nova Safra</div></div>
          </div>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
        </div>

        <div class="modal-tabs">
          <button class="modal-tab-btn active" data-modal-tab="geral"><i class="bi bi-info-circle-fill"></i> Geral</button>
          <button class="modal-tab-btn" data-modal-tab="periodo"><i class="bi bi-calendar-range-fill"></i> Período</button>
          <button class="modal-tab-btn" data-modal-tab="status"><i class="bi bi-toggle-on"></i> Status</button>
        </div>

        <div class="modal-body">
          <form id="formSafra" novalidate>
            @csrf
            <input type="hidden" id="safraId" name="id" value="">

            <!-- TAB 1: Geral -->
            <div class="modal-tab-panel active" id="mtab-geral">
              <div class="modal-form-card">
                <div class="modal-section-title"><i class="bi bi-tag-fill"></i> Identificação da Safra</div>
                <div class="row g-3">
                  <div class="col-12 col-md-8">
                    <label class="cfg-label" for="safraNome">Nome da Safra *</label>
                    <input class="cfg-input" type="text" id="safraNome" name="nome" placeholder="Ex: Safra 2025/2026" required>
                  </div>
                  <div class="col-12 col-md-4">
                    <label class="cfg-label" for="safraCultura">Cultura *</label>
                    <select class="cfg-select" id="safraCultura" name="cultura" required>
                      <option value="">Seleccione…</option>
                      <option value="Milho">Milho</option>
                      <option value="Feijão">Feijão</option>
                      <option value="Mandioca">Mandioca</option>
                      <option value="Batata-doce">Batata-doce</option>
                      <option value="Hortícolas">Hortícolas</option>
                      <option value="Frutas tropicais">Frutas tropicais</option>
                      <option value="Café">Café</option>
                    </select>
                  </div>
                  <div class="col-12">
                    <label class="cfg-label" for="safraDescricao">Descrição</label>
                    <textarea class="cfg-textarea" id="safraDescricao" name="descricao" rows="2" placeholder="Observações sobre esta safra…"></textarea>
                  </div>
                </div>
              </div>
            </div>

            <!-- TAB 2: Período -->
            <div class="modal-tab-panel" id="mtab-periodo">
              <div class="modal-form-card">
                <div class="modal-section-title"><i class="bi bi-calendar-range-fill"></i> Datas e Área</div>
                <div class="row g-3">
                  <div class="col-12 col-md-6">
                    <label class="cfg-label" for="safraInicio">Data de Início *</label>
                    <input class="cfg-input" type="date" id="safraInicio" name="data_inicio" required>
                  </div>
                  <div class="col-12 col-md-6">
                    <label class="cfg-label" for="safraFim">Data de Fim *</label>
                    <input class="cfg-input" type="date" id="safraFim" name="data_fim" required>
                  </div>
                  <div class="col-12">
                    <label class="cfg-label" for="safraArea">Área Plantada (hectares) *</label>
                    <input class="cfg-input" type="number" id="safraArea" name="area_plantada" placeholder="0.00" step="0.01" min="0" required>
                  </div>
                </div>
              </div>
            </div>

            <!-- TAB 3: Status -->
            <div class="modal-tab-panel" id="mtab-status">
              <div class="modal-form-card">
                <div class="modal-section-title"><i class="bi bi-toggle-on"></i> Estado da Safra</div>
                <div class="row g-3">
                  <div class="col-12">
                    <label class="cfg-label" for="safraEstado">Estado *</label>
                    <select class="cfg-select" id="safraEstado" name="estado" required>
                      <option value="planeada">Planeada</option>
                      <option value="em_andamento">Em Andamento</option>
                      <option value="concluida">Concluída</option>
                      <option value="cancelada">Cancelada</option>
                    </select>
                    <div class="cfg-helper">Define a fase actual da safra.</div>
                  </div>
                </div>
              </div>
            </div>

          </form>
        </div>

        <div class="modal-footer">
          <div style="display:flex;align-items:center;gap:10px;width:100%;justify-content:space-between;flex-wrap:wrap;">
            <div style="font-size:12px;color:var(--text-light);"><i class="bi bi-info-circle me-1"></i> Campos com * são obrigatórios.</div>
            <div style="display:flex;gap:10px;">
              <button type="button" class="btn-outline-green" data-bs-dismiss="modal"><i class="bi bi-x-lg"></i> Cancelar</button>
              <button type="button" class="btn-green" id="btnGuardarSafra"><i class="bi bi-check2-circle"></i> <span id="btnGuardarSafraLabel">Registar Safra</span></button>
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
      <div class="modal-content">
        <div class="modal-header" style="background:linear-gradient(135deg, #7f0000, #C62828);">
          <div style="display:flex;align-items:center;gap:14px;flex:1;">
            <div class="modal-header-icon"><i class="bi bi-exclamation-triangle-fill"></i></div>
            <div><div class="modal-title">Confirmar Eliminação</div><div style="font-size:12px;color:rgba(255,255,255,.65);">Esta acção é irreversível</div></div>
          </div>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
        </div>
        <div class="modal-body" style="background:#fff;padding:28px;">
          <p style="font-size:13.5px;color:var(--text-mid);">Tem a certeza que deseja eliminar a safra:</p>
          <div style="background:#FFF8F8;border:1px solid #FFCDD2;border-radius:10px;padding:14px 18px;margin-bottom:16px;">
            <div style="font-family:'Sora',sans-serif;font-weight:700;font-size:15px;color:#C62828;" id="deleteSafraName">—</div>
            <div style="font-size:12px;color:var(--text-light);">Todos os dados associados serão removidos permanentemente.</div>
          </div>
        </div>
        <div class="modal-footer" style="border-top:1px solid #FFCDD2;">
          <button type="button" class="btn-outline-green" data-bs-dismiss="modal">Cancelar</button>
          <button type="button" class="btn-green" id="btnConfirmDelete" style="background:#C62828;box-shadow:none;"><i class="bi bi-trash-fill"></i> Eliminar Definitivamente</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Toast -->
  <div class="save-toast" id="saveToast">
    <div class="toast-icon success" id="toastIcon"><i class="bi bi-check-lg" id="toastIconI"></i></div>
    <div class="toast-text"><div class="t-title" id="toastTitle">Operação concluída</div><div class="t-sub" id="toastSub">Acção realizada com sucesso.</div></div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    /* ══════════════════════════════════════
       SIDEBAR TOGGLE (3 estados) + AJUSTE AUTOMÁTICO
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

    function adjustSidebarForScreen() {
      const width = window.innerWidth;
      let novoEstado = 0;
      if (width < 768) novoEstado = 1;
      else novoEstado = 0;
      if (novoEstado !== sideState) {
        sideState = novoEstado;
        body.classList.remove('icons-only', 'sidebar-hidden');
        if (sideState === 1) body.classList.add('icons-only');
        if (sideState === 2) body.classList.add('sidebar-hidden');
        applyTooltips();
      }
    }

    let resizeTimeout;
    function handleResize() {
      clearTimeout(resizeTimeout);
      resizeTimeout = setTimeout(adjustSidebarForScreen, 200);
    }

    document.addEventListener('DOMContentLoaded', () => {
      adjustSidebarForScreen();
      window.addEventListener('resize', handleResize);
    });

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
    const themeIcon = document.getElementById('themeIcon');
    const themeLabel = document.getElementById('themeLabel');
    let darkMode = false;
    themeToggle.addEventListener('click', function(e) {
      e.preventDefault();
      darkMode = !darkMode;
      body.classList.toggle('dark-mode', darkMode);
      themeIcon.className = darkMode ? 'bi bi-sun-fill' : 'bi bi-moon-stars-fill';
      themeLabel.textContent = darkMode ? 'Modo Claro' : 'Modo Escuro';
    });

    /* ══════════════════════════════════════
       NAV ACTIVE SIDEBAR
    ══════════════════════════════════════ */
    document.querySelectorAll('.nav-item-link').forEach(link => {
      link.addEventListener('click', function(e) {
        const href = this.getAttribute('href');
        if (!href || href === '#') e.preventDefault();
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
      const toast = document.getElementById('saveToast');
      const icon = document.getElementById('toastIcon');
      const iconI = document.getElementById('toastIconI');
      document.getElementById('toastTitle').textContent = title;
      document.getElementById('toastSub').textContent = sub;
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

    /* ══════════════════════════════════════
       MODAL — NOVA SAFRA (reset)
    ══════════════════════════════════════ */
    document.getElementById('modalSafra').addEventListener('show.bs.modal', function(e) {
      if (e.relatedTarget && e.relatedTarget.id === 'btnNovaSafra') {
        document.getElementById('formSafra').reset();
        document.getElementById('safraId').value = '';
        document.getElementById('modalSafraLabel').textContent = 'Nova Safra';
        document.getElementById('btnGuardarSafraLabel').textContent = 'Registar Safra';
        document.getElementById('modalHeaderIcon').className = 'bi bi-flower2';
        document.getElementById('safraEstado').value = 'planeada';
        switchModalTab('geral');
      }
    });

    /* ══════════════════════════════════════
       EDITAR SAFRA (carregar dados)
    ══════════════════════════════════════ */
    document.addEventListener('click', function(e) {
      const btn = e.target.closest('.btn-editar-safra');
      if (!btn) return;

      document.getElementById('safraId').value = btn.dataset.id;
      document.getElementById('safraNome').value = btn.dataset.nome || '';
      document.getElementById('safraCultura').value = btn.dataset.cultura || '';
      document.getElementById('safraInicio').value = btn.dataset.inicio || '';
      document.getElementById('safraFim').value = btn.dataset.fim || '';
      document.getElementById('safraArea').value = btn.dataset.area || '';
      document.getElementById('safraEstado').value = btn.dataset.estado || 'planeada';

      document.getElementById('modalSafraLabel').textContent = 'Editar Safra';
      document.getElementById('btnGuardarSafraLabel').textContent = 'Guardar Alterações';
      document.getElementById('modalHeaderIcon').className = 'bi bi-pencil-fill';

      const modal = new bootstrap.Modal(document.getElementById('modalSafra'));
      modal.show();
      switchModalTab('geral');
    });

    /* ══════════════════════════════════════
       GUARDAR SAFRA (criar/editar)
    ══════════════════════════════════════ */
    document.getElementById('btnGuardarSafra').addEventListener('click', function() {
      const id = document.getElementById('safraId').value;
      const nome = document.getElementById('safraNome').value.trim();
      const cultura = document.getElementById('safraCultura').value;
      const inicio = document.getElementById('safraInicio').value;
      const fim = document.getElementById('safraFim').value;
      const area = document.getElementById('safraArea').value;
      const estado = document.getElementById('safraEstado').value;

      if (!nome || !cultura || !inicio || !fim || !area) {
        showToast('Campos obrigatórios em falta', 'Preencha todos os campos marcados com *.', 'danger');
        return;
      }

      const btn = this;
      const orig = btn.innerHTML;
      btn.innerHTML = '<i class="bi bi-hourglass-split"></i> A guardar…';
      btn.disabled = true;

      const url = id ? `/safras/${id}` : '/safras';
      const formData = new FormData();
      if (id) formData.append('_method', 'PUT');
      formData.append('nome', nome);
      formData.append('cultura', cultura);
      formData.append('data_inicio', inicio);
      formData.append('data_fim', fim);
      formData.append('area_plantada', area);
      formData.append('estado', estado);

      fetch(url, {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
          'Accept': 'application/json'
        },
        body: formData
      })
      .then(r => r.json())
      .then(data => {
        btn.innerHTML = orig;
        btn.disabled = false;
        if (data.success) {
          bootstrap.Modal.getInstance(document.getElementById('modalSafra')).hide();
          showToast('Safra guardada', data.message || 'Operação realizada com sucesso.');
          setTimeout(() => location.reload(), 800);
        } else {
          showToast('Erro', data.message || 'Verifique os dados.', 'danger');
        }
      })
      .catch(() => {
        btn.innerHTML = orig;
        btn.disabled = false;
        showToast('Erro de ligação', 'Não foi possível comunicar com o servidor.', 'danger');
      });
    });

    /* ══════════════════════════════════════
       ELIMINAR SAFRA
    ══════════════════════════════════════ */
    let deleteTargetId = null;
    let deleteTargetName = '';

    document.addEventListener('click', function(e) {
      const btn = e.target.closest('.btn-eliminar-safra');
      if (!btn) return;
      deleteTargetId = btn.dataset.id;
      deleteTargetName = btn.dataset.nome;
      document.getElementById('deleteSafraName').textContent = deleteTargetName;
      new bootstrap.Modal(document.getElementById('modalDelete')).show();
    });

    document.getElementById('btnConfirmDelete').addEventListener('click', function() {
      if (!deleteTargetId) return;
      const btn = this;
      const orig = btn.innerHTML;
      btn.innerHTML = '<i class="bi bi-hourglass-split"></i> A eliminar…';
      btn.disabled = true;

      fetch(`/safras/${deleteTargetId}`, {
        method: 'DELETE',
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
          'Accept': 'application/json'
        }
      })
      .then(r => r.json())
      .then(data => {
        btn.innerHTML = orig;
        btn.disabled = false;
        bootstrap.Modal.getInstance(document.getElementById('modalDelete')).hide();
        if (data.success) {
          document.getElementById(`safra-row-${deleteTargetId}`)?.remove();
          showToast('Safra eliminada', deleteTargetName + ' foi removida do sistema.', 'danger');
        } else {
          showToast('Erro', data.message || 'Não foi possível eliminar.', 'danger');
        }
      })
      .catch(() => {
        btn.innerHTML = orig;
        btn.disabled = false;
        showToast('Erro de ligação', 'Verifique a sua conexão.', 'danger');
      });
    });

    /* ══════════════════════════════════════
       SELECT ALL & EXPORT
    ══════════════════════════════════════ */
    document.getElementById('selectAll')?.addEventListener('change', function() {
      document.querySelectorAll('.row-check').forEach(cb => cb.checked = this.checked);
    });

    document.getElementById('btnExportar')?.addEventListener('click', () => {
      showToast('A exportar…', 'O ficheiro será gerado em breve.');
    });
  </script>
</body>
</html>