{{-- resources/views/vendas/cooperativas.blade.php --}}
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SIAG – Cooperativas - Vendas</title>

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

        /* Suprime TODAS as transições enquanto a página está a carregar,
           para que o estado inicial da sidebar (icons-only em ecrãs < 760px)
           apareça directamente, sem qualquer animação/flash visível. */
        body.no-transition,
        body.no-transition * {
            transition: none !important;
        }

        /* ===== SIDEBAR ===== */
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

        /* ===== TOPBAR ===== */
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
        .cfg-card-title .bi,
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

        /* ===== MAIN CONTENT ===== */
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

        /* ===== PAGE HEADER ===== */
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

        .btn-green:disabled {
            opacity: .6;
            cursor: not-allowed;
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

        /* ===== STAT CARDS ===== */
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

        /* ===== SEARCH FILTER BAR ===== */
        .search-filter-bar {
            padding: 14px 24px;
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            align-items: center;
            background: var(--card-bg);
            border-radius: 16px;
            border: 1px solid var(--border);
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

        /* ===== COOPERATIVAS CARDS ===== */
        .cooperativa-card {
            background: var(--card-bg);
            border-radius: 16px;
            border: 1px solid var(--border);
            overflow: hidden;
            transition: all .3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .cooperativa-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 28px rgba(46, 125, 50, .12);
        }

        .cooperativa-card .card-header {
            padding: 20px 20px 16px;
            display: flex;
            align-items: center;
            gap: 16px;
            border-bottom: 1px solid var(--border);
        }

        .cooperativa-card .card-logo {
            width: 56px;
            height: 56px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            font-weight: 800;
            color: #fff;
            flex-shrink: 0;
            text-transform: uppercase;
        }

        .cooperativa-card .card-info {
            flex: 1;
            min-width: 0;
        }

        .cooperativa-card .card-info .coop-nome {
            font-family: 'Sora', sans-serif;
            font-size: 16px;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 2px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .cooperativa-card .card-info .coop-local {
            font-size: 13px;
            color: var(--text-light);
        }

        .cooperativa-card .card-body {
            padding: 16px 20px 20px;
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .cooperativa-card .card-body .produtos-info {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            background: var(--accent-lt);
            border-radius: 10px;
        }

        .cooperativa-card .card-body .produtos-info i {
            font-size: 24px;
            color: var(--primary);
        }

        .cooperativa-card .card-body .produtos-info .produtos-count {
            font-size: 24px;
            font-weight: 700;
            color: var(--primary);
            line-height: 1;
        }

        .cooperativa-card .card-body .produtos-info .produtos-label {
            font-size: 12px;
            color: var(--text-light);
        }

        .cooperativa-card .card-body .coop-contato {
            font-size: 13px;
            color: var(--text-mid);
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 4px 0;
        }

        .cooperativa-card .card-body .coop-contato i {
            color: var(--primary);
            width: 18px;
            font-size: 14px;
        }

        .cooperativa-card .card-footer {
            padding: 12px 20px;
            background: #FAFBFA;
            border-top: 1px solid var(--border);
            display: flex;
            gap: 8px;
            margin-top: auto;
        }

        .btn-painel {
            background: var(--primary);
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 8px 16px;
            font-size: 13px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            cursor: pointer;
            transition: background .2s, transform .1s;
            text-decoration: none;
        }

        .btn-painel:hover {
            background: var(--accent);
            color: #fff;
            transform: translateY(-1px);
        }

        .btn-painel:active {
            transform: scale(.97);
        }

        .cooperativas-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }

        /* ===== EMPTY STATE ===== */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            background: var(--card-bg);
            border-radius: 16px;
            border: 1px solid var(--border);
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

        /* ===== LOADING ===== */
        .spinner-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, .5);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 99999;
        }

        .spinner-overlay.show {
            display: flex;
        }

        /* ===== TOAST ===== */
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

        /* ===== ANIMATIONS ===== */
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

        /* ===== DARK MODE ===== */
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

        body.dark-mode .cooperativa-card .card-footer {
            background: #172518;
        }

        body.dark-mode .cooperativa-card .card-body .produtos-info {
            background: rgba(102, 187, 106, .12);
        }

        body.dark-mode .search-input,
        body.dark-mode .filter-select {
            background: #172518;
            color: #e8f0e9;
            border-color: rgba(255, 255, 255, .1);
        }

        /* ===== RESPONSIVE ===== */
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

            .cooperativas-grid {
                grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
                gap: 16px;
            }
        }
    </style>
</head>

<body>
    <script>
        // ─── ESTADO INICIAL DA SIDEBAR — aplicado ANTES de qualquer pintura ───
        // Este script corre de forma síncrona logo à entrada do <body>, antes
        // de o browser desenhar a sidebar, garantindo que não há transição
        // visível (nem "flash") entre o estado normal e o icons-only no carregamento.
        (function () {
            var isMobile = window.innerWidth < 760;
            document.body.classList.add('no-transition');
            if (isMobile) {
                document.body.classList.add('icons-only');
            }
        })();
    </script>

    <!-- ===== SIDEBAR ===== -->
    <nav id="sidebar">
        <div class="sidebar-logo">
            <div class="logo-svg-wrap">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 340 340" width="38" height="38"
                    style="flex-shrink:0;">
                    <circle cx="170" cy="170" r="145" fill="#66BB6A" />
                    <g fill="#ffffff" stroke="#ffffff" stroke-width="1.5" stroke-linejoin="round"
                        stroke-linecap="round">
                        <circle cx="118" cy="188" r="48" fill="none" stroke-width="6" />
                        <circle cx="118" cy="188" r="35" fill="none" stroke-width="4.5" />
                        <circle cx="118" cy="188" r="16" fill="#ffffff" />
                        <path
                            d="M 118 135 L 118 144 M 118 232 L 118 241 M 65 188 L 74 188 M 162 188 L 171 188 M 81 151 L 88 157 M 155 219 L 162 225 M 81 225 L 88 219 M 155 151 L 162 157"
                            stroke-width="6" />
                        <path d="M 68 185 C 68 140, 108 120, 160 128 C 171 132, 174 144, 174 151" fill="none"
                            stroke-width="6" />
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
                        <path d="M 174 151 L 246 156 C 252 156, 254 159, 254 165 L 254 197 L 202 197 Z"
                            fill="#ffffff" />
                        <rect x="168" y="173" width="18" height="9" fill="none" stroke-width="4.5" />
                        <rect x="168" y="185" width="18" height="7" fill="none" stroke-width="4.5" />
                        <path d="M 223 156 L 223 125 C 223 119, 219 117, 219 113 L 220 107" fill="none"
                            stroke-width="4.5" />
                        <ellipse cx="239" cy="171" rx="6" ry="4" fill="#66BB6A" stroke="none" />
                        <line x1="212" y1="170" x2="212" y2="188" stroke="#66BB6A" stroke-width="4" />
                        <line x1="220" y1="170" x2="220" y2="188" stroke="#66BB6A" stroke-width="4" />
                        <line x1="228" y1="170" x2="228" y2="188" stroke="#66BB6A" stroke-width="4" />
                    </g>
                </svg>
            </div>
            <div class="logo-text-wrap">
                <div
                    style="font-family:'Sora',sans-serif;font-size:17px;font-weight:700;color:#fff;letter-spacing:1px;line-height:1.1;">
                    SIAG</div>
                <div style="font-size:10px;color:rgba(255,255,255,.5);letter-spacing:.5px;">Agrícola Cooperativas</div>
            </div>
        </div>
        <div class="sidebar-nav">
            <div class="nav-section-title">Principal</div>
            <a href="{{ route('dashboard') }}" class="nav-item-link" data-label="Dashboard"><i
                    class="bi bi-grid-1x2-fill"></i><span class="nav-label">Dashboard</span></a>
            <a href="{{ route('cooperativas') }}" class="nav-item-link" data-label="Cooperativa"><i
                    class="bi bi-building"></i><span class="nav-label">Cooperativa</span></a>
            <a href="{{ route('agricultores.index') }}" class="nav-item-link" data-label="Agricultores"><i
                    class="bi bi-people-fill"></i><span class="nav-label">Agricultores</span></a>

            <div class="nav-section-title">Agrícola</div>

            <a href="{{route('safras.painel')}}" class="nav-item-link" data-label="Safras">
                <i class="bi bi-flower2"></i>
                <span class="nav-label">Safras</span>
            </a>
            <a href="{{route('talhoes.index')}}" class="nav-item-link" data-label="Talhões">
                <i class="bi bi-map-fill"></i>
                <span class="nav-label">Talhões</span>
            </a>
            <a href="{{route('insumos.index')}}" class="nav-item-link" data-label="Insumos">
                <i class="bi bi-box-seam-fill"></i>
                <span class="nav-label">Insumos</span>
            </a>

            <div class="nav-section-title">Comercial</div>
            <a href="{{route('vendas')}}" class="nav-item-link active" data-label="Vendas"><i
                    class="bi bi-cart-fill"></i><span class="nav-label">Vendas</span></a>

            <div class="nav-section-title">Sistema</div>
            <a href="{{ route('configuracoes') }}" class="nav-item-link" data-label="Configurações"><i
                    class="bi bi-gear-fill"></i><span class="nav-label">Configurações</span></a>
        </div>
        <div class="sidebar-user">
            <div class="user-info">
                <div class="u-name">SIAG</div>
                <div class="u-role">Sistema de Gestão de cooperativa @ 2026</div>
            </div>
        </div>
    </nav>

    <!-- ===== TOPBAR ===== -->
    <header id="topbar">
        <button class="topbar-toggle" id="sidebarToggle" title="Toggle Sidebar">
            <i class="bi bi-list"></i>
        </button>
        <span class="topbar-title">Selecionar Cooperativa</span>
        <nav aria-label="breadcrumb" class="d-none d-md-flex ms-3">
            <ol class="breadcrumb mb-0" style="font-size:12.5px;">
                <li class="breadcrumb-item"><a href="#" style="color:var(--primary);text-decoration:none;">SIAG</a></li>
                <li class="breadcrumb-item active" style="color:var(--text-light);">Vendas</li>
            </ol>
        </nav>
        <div class="topbar-right">
            <span class="badge rounded-pill d-none d-md-inline-flex align-items-center gap-1"
                style="background:var(--accent-lt);color:var(--primary);font-size:12px;padding:7px 13px;font-weight:600;">
                <i class="bi bi-building"></i> Cooperativas
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
                        <img src="{{ Auth::check() ? Auth::user()->foto_url : asset('uploads/users/default-user.png') }}"
                            alt="Foto-perfil" width="20" class="avatar-md">
                    </div>
                    <span>{{ Auth::check() ? Auth::user()->name : 'Utilizador' }}</span>
                    <i class="bi bi-chevron-down" style="font-size:11px;color:var(--primary);"></i>
                </div>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-user">
                    <li><span class="dropdown-header">Nível: {{ Auth::user()->nivel }}</span></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="#"><i class="bi bi-person-gear"></i> Minha Conta</a></li>
                    <li><a class="dropdown-item" href="#" id="themeToggle"><i class="bi bi-moon-stars-fill"
                                id="themeIcon"></i><span id="themeLabel">Modo Escuro</span></a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <div class="dropdown-item item-logout p-0">
                            <form method="POST" action="/logout">@csrf<button type="submit"><i
                                        class="bi bi-box-arrow-right"></i> Sair</button></form>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </header>

    <!-- ===== MAIN ===== -->
    <main id="main">
        <div class="content-inner">

            <!-- Page Header -->
            <div class="page-header anim">
                <div>
                    <h1>Cooperativas</h1>
                    <p>Selecione uma cooperativa para iniciar o painel de vendas</p>
                </div>
                <div style="display:flex;gap:10px;flex-wrap:wrap;">
                    <button class="btn-outline-green" id="btnRefresh">
                        <i class="bi bi-arrow-clockwise"></i> Atualizar
                    </button>
                </div>
            </div>

            <!-- Estatísticas -->
            <div class="row g-3 mb-4 anim anim-d1">
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <div class="stat-icon green"><i class="bi bi-building"></i></div>
                        <div class="stat-info">
                            <div class="s-label">Total Cooperativas</div>
                            <div class="s-value" id="totalCooperativas">0</div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <div class="stat-icon blue"><i class="bi bi-box-seam-fill"></i></div>
                        <div class="stat-info">
                            <div class="s-label">Total Produtos</div>
                            <div class="s-value" id="totalProdutos">0</div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <div class="stat-icon amber"><i class="bi bi-geo-alt-fill"></i></div>
                        <div class="stat-info">
                            <div class="s-label">Províncias</div>
                            <div class="s-value" id="totalProvincias">0</div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <div class="stat-icon purple"><i class="bi bi-cart-fill"></i></div>
                        <div class="stat-info">
                            <div class="s-label">Vendas Hoje</div>
                            <div class="s-value" id="vendasHoje">0</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Search -->
            <div class="search-filter-bar anim anim-d1 mb-4">
                <div class="search-wrap">
                    <i class="bi bi-search"></i>
                    <input type="text" class="search-input" id="searchCoop"
                        placeholder="Pesquisar cooperativa por nome ou local...">
                </div>
                <select class="filter-select" id="filterProvincia">
                    <option value="">Todas as províncias</option>
                    <option value="Luanda">Luanda</option>
                    <option value="Bengo">Bengo</option>
                    <option value="Malanje">Malanje</option>
                    <option value="Huíla">Huíla</option>
                    <option value="Bié">Bié</option>
                    <option value="Huambo">Huambo</option>
                    <option value="Cabinda">Cabinda</option>
                    <option value="Zaire">Zaire</option>
                    <option value="Uíge">Uíge</option>
                    <option value="Cuanza Norte">Cuanza Norte</option>
                    <option value="Cuanza Sul">Cuanza Sul</option>
                    <option value="Lunda Norte">Lunda Norte</option>
                    <option value="Lunda Sul">Lunda Sul</option>
                    <option value="Moxico">Moxico</option>
                    <option value="Cuando Cubango">Cuando Cubango</option>
                    <option value="Cunene">Cunene</option>
                    <option value="Namibe">Namibe</option>
                    <option value="Benguela">Benguela</option>
                </select>
                <button class="btn-green" id="btnFiltrar" style="padding:8px 18px;">
                    <i class="bi bi-search"></i> Filtrar
                </button>
                <button class="btn-outline-green" id="btnLimparFiltros" style="padding:8px 18px;">
                    <i class="bi bi-eraser"></i> Limpar
                </button>
            </div>

            <!-- Cards das Cooperativas -->
            <div class="anim anim-d2">
                <div id="cooperativasContainer">
                    <div id="cooperativasGrid" class="cooperativas-grid">
                        <!-- Cards serão renderizados via JS -->
                    </div>
                </div>
                <div class="empty-state" id="emptyState" style="display:none;">
                    <i class="bi bi-buildings"></i>
                    <h6>Nenhuma cooperativa encontrada</h6>
                    <p>Tente ajustar os filtros ou verifique se há cooperativas cadastradas.</p>
                </div>
                <div id="loadingCards" style="text-align:center;padding:40px;display:none;">
                    <div class="spinner-border text-success" role="status">
                        <span class="visually-hidden">Carregando...</span>
                    </div>
                    <p class="mt-2 text-muted">Carregando cooperativas...</p>
                </div>
            </div>

        </div><!-- /content-inner -->
    </main>

    <!-- Toast -->
    <div class="save-toast" id="saveToast">
        <div class="toast-icon success" id="toastIcon"><i class="bi bi-check-lg" id="toastIconI"></i></div>
        <div class="toast-text">
            <div class="t-title" id="toastTitle">Operação concluída</div>
            <div class="t-sub" id="toastSub">Acção realizada com sucesso.</div>
        </div>
    </div>

    <!-- Loading Spinner -->
    <div class="spinner-overlay" id="loadingSpinner">
        <div class="spinner-border text-light" style="width: 4rem; height: 4rem;" role="status">
            <span class="visually-hidden">Carregando...</span>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        /* ══════════════════════════════════════
           CONFIGURAÇÕES
        ══════════════════════════════════════ */
        const API_URL = '/vendas/cooperativas';

        /* ══════════════════════════════════════
           SIDEBAR TOGGLE + AJUSTE AUTOMÁTICO
        ══════════════════════════════════════ */
        const body = document.body;

        // ─── ESTADO INICIAL ───
        // A classe icons-only (quando aplicável) já foi aplicada por um script
        // síncrono logo a seguir à tag <body>, antes de qualquer pintura.
        // Aqui apenas sincronizamos a variável de estado com o que já está no DOM.
        let sideState = body.classList.contains('icons-only') ? 1
                      : body.classList.contains('sidebar-hidden') ? 2
                      : 0;

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

        // ─── AJUSTE AUTOMÁTICO DO SIDEBAR SEGUNDO A LARGURA DA TELA (resize) ───
        function adjustSidebarForScreen() {
            const width = window.innerWidth;
            let novoEstado = (width < 760) ? 1 : 0; // < 760 → icons-only · ≥ 760 → normal

            // Só atualiza se o estado for diferente do atual para evitar loops
            if (novoEstado !== sideState) {
                sideState = novoEstado;
                body.classList.remove('icons-only', 'sidebar-hidden');
                if (sideState === 1) body.classList.add('icons-only');
                if (sideState === 2) body.classList.add('sidebar-hidden');
                applyTooltips();
            }
        }

        // Debounce para evitar chamadas excessivas no redimensionamento
        let resizeTimeout;

        function handleResize() {
            clearTimeout(resizeTimeout);
            resizeTimeout = setTimeout(adjustSidebarForScreen, 200);
        }

        // Ao carregar: activa os tooltips (se aplicável), liga o listener de
        // resize e só depois "liberta" as transições, para que o estado
        // inicial não seja animado mas as interacções seguintes sim.
        document.addEventListener('DOMContentLoaded', () => {
            applyTooltips();
            window.addEventListener('resize', handleResize);

            requestAnimationFrame(() => {
                requestAnimationFrame(() => {
                    body.classList.remove('no-transition');
                });
            });
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

        themeToggle.addEventListener('click', function (e) {
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
            link.addEventListener('click', function (e) {
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
           LOADING
        ══════════════════════════════════════ */
        function showLoading(show = true) {
            document.getElementById('loadingSpinner').classList.toggle('show', show);
        }

        function showLoadingCards(show = true) {
            document.getElementById('loadingCards').style.display = show ? 'block' : 'none';
        }

        /* ══════════════════════════════════════
           CARREGAR COOPERATIVAS
        ══════════════════════════════════════ */
        let cooperativasData = [];
        let vendasHoje = 0;

        function loadCooperativas() {
            showLoadingCards(true);
            const grid = document.getElementById('cooperativasGrid');
            const empty = document.getElementById('emptyState');

            fetch(API_URL)
                .then(res => {
                    if (!res.ok) throw new Error(`HTTP error! status: ${res.status}`);
                    return res.json();
                })
                .then(data => {
                    if (data.success) {
                        cooperativasData = data.data;
                        vendasHoje = data.vendas_hoje || 0;
                        renderCooperativas(cooperativasData);
                        updateStats(cooperativasData, vendasHoje);
                    } else {
                        showToast('Erro', data.message || 'Falha ao carregar cooperativas.', 'danger');
                        grid.innerHTML = '';
                        empty.style.display = 'block';
                    }
                })
                .catch(err => {
                    console.error('Erro ao carregar cooperativas:', err);
                    showToast('Erro', 'Falha ao carregar cooperativas.', 'danger');
                    grid.innerHTML = '';
                    empty.style.display = 'block';
                })
                .finally(() => {
                    showLoadingCards(false);
                });
        }

        /* ══════════════════════════════════════
           CARREGAR VENDAS DE HOJE (separado)
        ══════════════════════════════════════ */
        function loadVendasHoje() {
            fetch('/vendas/hoje')
                .then(res => {
                    if (!res.ok) throw new Error(`HTTP error! status: ${res.status}`);
                    return res.json();
                })
                .then(data => {
                    if (data.success) {
                        document.getElementById('vendasHoje').textContent = data.total || 0;
                    }
                })
                .catch(err => {
                    console.error('Erro ao carregar vendas de hoje:', err);
                });
        }

        /* ══════════════════════════════════════
           RENDERIZAR CARDS
        ══════════════════════════════════════ */
        function renderCooperativas(cooperativas) {
            const grid = document.getElementById('cooperativasGrid');
            const empty = document.getElementById('emptyState');

            if (!cooperativas || cooperativas.length === 0) {
                grid.innerHTML = '';
                empty.style.display = 'block';
                return;
            }

            empty.style.display = 'none';

            grid.innerHTML = cooperativas.map(coop => `
                <div class="cooperativa-card anim" data-id="${coop.id}" data-nome="${coop.nome}" data-provincia="${coop.provincia}">
                    <div class="card-header">
                        <div class="card-logo" style="background:${coop.cor || '#2E7D32'};">
                            ${coop.logo || 'CP'}
                        </div>
                        <div class="card-info">
                            <div class="coop-nome">${coop.nome}</div>
                            <div class="coop-local">
                                <i class="bi bi-geo-alt-fill" style="font-size:12px;color:var(--text-light);"></i>
                                ${coop.municipio || ''} ${coop.municipio && coop.provincia ? '·' : ''} ${coop.provincia || ''}
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="produtos-info">
                            <i class="bi bi-box-seam-fill"></i>
                            <div>
                                <div class="produtos-count">${coop.total_produtos || 0}</div>
                                <div class="produtos-label">Produtos Disponíveis</div>
                            </div>
                        </div>
                        ${coop.telefone ? `
                            <div class="coop-contato">
                                <i class="bi bi-telephone-fill"></i>
                                ${coop.telefone}
                            </div>
                        ` : ''}
                        ${coop.email ? `
                            <div class="coop-contato">
                                <i class="bi bi-envelope-fill"></i>
                                ${coop.email}
                            </div>
                        ` : ''}
                    </div>
                    <div class="card-footer">
                        <a href="/cooperativas/${coop.id}/vendas" class="btn-painel w-100">
                            <i class="bi bi-cart-fill"></i> Painel de Venda
                        </a>
                    </div>
                </div>
            `).join('');
        }

        /* ══════════════════════════════════════
           ATUALIZAR ESTATÍSTICAS
        ══════════════════════════════════════ */
        function updateStats(cooperativas, vendasHojeCount = 0) {
            const total = cooperativas.length;
            const totalProdutos = cooperativas.reduce((sum, c) => sum + (c.total_produtos || 0), 0);
            const provincias = new Set(cooperativas.map(c => c.provincia).filter(Boolean));

            document.getElementById('totalCooperativas').textContent = total;
            document.getElementById('totalProdutos').textContent = totalProdutos;
            document.getElementById('totalProvincias').textContent = provincias.size;
            document.getElementById('vendasHoje').textContent = vendasHojeCount || 0;
        }

        /* ══════════════════════════════════════
           FILTROS
        ══════════════════════════════════════ */
        function aplicarFiltros() {
            const search = document.getElementById('searchCoop').value.toLowerCase().trim();
            const provincia = document.getElementById('filterProvincia').value;

            let filtered = cooperativasData;

            if (search) {
                filtered = filtered.filter(c =>
                    c.nome.toLowerCase().includes(search) ||
                    (c.municipio && c.municipio.toLowerCase().includes(search)) ||
                    (c.provincia && c.provincia.toLowerCase().includes(search))
                );
            }

            if (provincia) {
                filtered = filtered.filter(c => c.provincia === provincia);
            }

            renderCooperativas(filtered);
            updateStats(filtered, vendasHoje);
        }

        document.getElementById('btnFiltrar').addEventListener('click', aplicarFiltros);
        document.getElementById('btnLimparFiltros').addEventListener('click', () => {
            document.getElementById('searchCoop').value = '';
            document.getElementById('filterProvincia').value = '';
            renderCooperativas(cooperativasData);
            updateStats(cooperativasData, vendasHoje);
        });

        document.getElementById('searchCoop').addEventListener('keyup', (e) => {
            if (e.key === 'Enter') {
                aplicarFiltros();
            }
        });

        document.getElementById('filterProvincia').addEventListener('change', aplicarFiltros);

        /* ══════════════════════════════════════
           REFRESH
        ══════════════════════════════════════ */
        document.getElementById('btnRefresh').addEventListener('click', () => {
            loadCooperativas();
            loadVendasHoje();
            showToast('Atualizado', 'Lista de cooperativas atualizada.');
        });

        /* ══════════════════════════════════════
           ATUALIZAR EM TEMPO REAL
        ══════════════════════════════════════ */
        // Atualizar vendas de hoje a cada 30 segundos
        setInterval(() => {
            if (!document.hidden) {
                loadVendasHoje();
            }
        }, 30000);

        // Função para ser chamada de outros módulos após uma venda
        function atualizarDashboardVendas() {
            loadVendasHoje();
            loadCooperativas();
        }

        // Expor função globalmente para ser chamada de outros scripts
        window.atualizarDashboardVendas = atualizarDashboardVendas;

        /* ══════════════════════════════════════
           INICIALIZAÇÃO
        ══════════════════════════════════════ */
        document.addEventListener('DOMContentLoaded', function () {
            loadCooperativas();
            loadVendasHoje();
        });
    </script>

</body>

</html>