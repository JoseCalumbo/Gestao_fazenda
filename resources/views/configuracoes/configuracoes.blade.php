<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SIAG – Configurações</title>

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

        body.no-transition,
        body.no-transition * {
            transition: none !important;
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

        .topbar-icon-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
            pointer-events: none;
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
        }

        .topbar-user .t-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
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
        }

        .btn-green:hover {
            background: var(--accent);
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
        }

        .btn-outline-green:hover {
            background: var(--accent-lt);
        }

        /* ═══════════════════════════════════════════
           SETTINGS LAYOUT
        ═══════════════════════════════════════════ */
        .settings-wrap {
            display: flex;
            gap: 24px;
            align-items: flex-start;
        }

        .settings-nav {
            flex-shrink: 0;
            width: 220px;
            background: var(--card-bg);
            border-radius: 16px;
            border: 1px solid var(--border);
            padding: 10px;
            position: sticky;
            top: calc(var(--topbar-h) + 28px);
        }

        .settings-nav-item {
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 11px 14px;
            border-radius: 10px;
            cursor: pointer;
            color: var(--text-mid);
            font-size: 13.5px;
            font-weight: 500;
            transition: background .15s, color .15s;
            border: none;
            background: none;
            width: 100%;
            text-align: left;
            white-space: nowrap;
        }

        .settings-nav-item i {
            font-size: 16px;
            color: var(--text-light);
            transition: color .15s;
        }

        .settings-nav-item:hover {
            background: var(--accent-lt);
            color: var(--primary);
        }

        .settings-nav-item:hover i {
            color: var(--primary);
        }

        .settings-nav-item.active {
            background: var(--accent-lt);
            color: var(--primary);
            font-weight: 600;
        }

        .settings-nav-item.active i {
            color: var(--primary);
        }

        .settings-nav-divider {
            height: 1px;
            background: var(--border);
            margin: 8px 0;
        }

        .settings-content {
            flex: 1;
            min-width: 0;
        }

        .settings-panel {
            display: none;
        }

        .settings-panel.active {
            display: block;
        }

        /* ── CARDS ─── */
        .cfg-card {
            background: var(--card-bg);
            border-radius: 16px;
            border: 1px solid var(--border);
            margin-bottom: 20px;
            overflow: hidden;
        }

        .cfg-card-header {
            padding: 18px 24px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }

        .cfg-card-header-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .cfg-card-icon {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            flex-shrink: 0;
        }

        .cfg-card-icon.green {
            background: var(--accent-lt);
            color: var(--primary);
        }

        .cfg-card-icon.blue {
            background: #E3F2FD;
            color: #1565C0;
        }

        .cfg-card-icon.amber {
            background: #FFF8E1;
            color: #F57F17;
        }

        .cfg-card-icon.purple {
            background: #EDE7F6;
            color: #6A1B9A;
        }

        .cfg-card-icon.teal {
            background: #E0F2F1;
            color: #00695C;
        }

        .cfg-card-title {
            font-family: 'Sora', sans-serif;
            font-size: 14.5px;
            font-weight: 600;
            color: var(--text-dark);
        }

        .cfg-card-sub {
            font-size: 12px;
            color: var(--text-light);
            margin-top: 2px;
        }

        .cfg-card-body {
            padding: 22px 24px;
        }

        /* ── FORM ELEMENTS ─── */
        .cfg-label {
            display: block;
            font-size: 12.5px;
            font-weight: 600;
            color: var(--text-mid);
            margin-bottom: 6px;
            letter-spacing: .2px;
        }

        .cfg-input {
            width: 100%;
            border: 1.5px solid var(--border);
            border-radius: 10px;
            padding: 11px 14px;
            font-size: 13.5px;
            color: var(--text-dark);
            background: #FAFAF9;
            transition: border-color .2s, box-shadow .2s;
            font-family: 'DM Sans', sans-serif;
            outline: none;
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
            padding: 11px 14px;
            font-size: 13.5px;
            color: var(--text-dark);
            background: #FAFAF9;
            appearance: none;
            cursor: pointer;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%238FA894' stroke-width='2'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 14px center;
            padding-right: 36px;
            transition: border-color .2s;
            outline: none;
        }

        .cfg-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(46, 125, 50, .1);
        }

        /* ── TABELAS ─── */
        .users-table {
            width: 100%;
            border-collapse: collapse;
        }

        .users-table th {
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .8px;
            color: var(--text-light);
            padding: 12px 16px;
            background: #FAFBFA;
            border-bottom: 1px solid var(--border);
            text-align: left;
        }

        .users-table td {
            font-size: 13.5px;
            color: var(--text-dark);
            padding: 13px 16px;
            border-bottom: 1px solid var(--border);
            vertical-align: middle;
        }

        .users-table tr:last-child td {
            border-bottom: none;
        }

        .users-table tr:hover td {
            background: #F8FBF8;
        }

        .user-avatar-sm {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 8px;
        }

        .user-cell {
            display: flex;
            align-items: center;
        }

        .badge-status {
            font-size: 12px;
            font-weight: 500;
            padding: 0;
        }

        .badge-status.activo {
            color: #2E7D32;
        }
        .badge-status.inactivo {
            color: #C62828;
        }
        .badge-status.pendente {
            color: #F57F17;
        }

        /* ── PERMISSÕES ─── */
        .perm-table {
            width: 100%;
            border-collapse: collapse;
        }

        .perm-table th {
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .8px;
            color: var(--text-light);
            padding: 12px 16px;
            background: #FAFBFA;
            border-bottom: 1px solid var(--border);
            text-align: center;
        }

        .perm-table th:first-child {
            text-align: left;
        }

        .perm-table td {
            font-size: 13px;
            color: var(--text-dark);
            padding: 12px 16px;
            border-bottom: 1px solid var(--border);
            text-align: center;
            vertical-align: middle;
        }

        .perm-table td:first-child {
            text-align: left;
            font-weight: 500;
        }

        .perm-table tr:last-child td {
            border-bottom: none;
        }

        .perm-table tr:hover td {
            background: #F8FBF8;
        }

        .perm-check {
            width: 18px;
            height: 18px;
            accent-color: var(--primary);
            cursor: pointer;
        }

        .perm-check:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        .perm-role-header {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 4px;
        }

        .perm-role-badge {
            font-size: 10px;
            font-weight: 700;
            padding: 2px 8px;
            border-radius: 30px;
        }

        /* ── MODAL UTILIZADOR ─── */
        .modal-user {
            max-width: 780px;
        }

        .modal-user .modal-content {
            height: 620px;
            display: flex;
            flex-direction: column;
            border: none;
            border-radius: 18px;
            box-shadow: 0 24px 64px rgba(0, 0, 0, .15);
            overflow: hidden;
        }

        .modal-user .modal-body {
            flex: 1;
            overflow-y: auto;
            padding: 0;
            background: var(--page-bg);
        }

        .modal-user .modal-body::-webkit-scrollbar {
            width: 4px;
        }

        .modal-user .modal-body::-webkit-scrollbar-thumb {
            background: rgba(0, 0, 0, .12);
            border-radius: 4px;
        }

        .modal-user .modal-header {
            padding: 11px 20px;
            border-bottom: 1px solid var(--border);
            background: linear-gradient(135deg, var(--sidebar-bg) 0%, var(--primary) 100%);
            flex-shrink: 0;
        }

        .modal-user .modal-title {
            font-family: 'Sora', sans-serif;
            font-size: 16px;
            font-weight: 700;
            color: #fff;
        }

        .modal-user .modal-header .btn-close {
            filter: brightness(0) invert(1);
            opacity: .8;
        }

        .modal-user .modal-header .btn-close:hover {
            opacity: 1;
        }

        .modal-user-header-icon {
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

        .modal-user .modal-footer {
            padding: 14px 20px;
            border-top: 1px solid var(--border);
            background: #fff;
            flex-shrink: 0;
        }

        .modal-user-tabs {
            display: flex;
            gap: 0;
            border-bottom: 2px solid var(--border);
            background: var(--page-bg);
            padding: 0 24px;
            overflow-x: auto;
            flex-shrink: 0;
        }

        .modal-user-tabs::-webkit-scrollbar {
            height: 0;
        }

        .modal-user-tab-btn {
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

        .modal-user-tab-btn i {
            color: var(--text-light);
            transition: color .15s;
            font-size: 15px;
        }

        .modal-user-tab-btn:hover {
            color: var(--primary);
        }

        .modal-user-tab-btn:hover i {
            color: var(--primary);
        }

        .modal-user-tab-btn.active {
            color: var(--primary);
            font-weight: 600;
            border-bottom-color: var(--primary);
        }

        .modal-user-tab-btn.active i {
            color: var(--primary);
        }

        .modal-user-tab-panel {
            display: none;
            padding: 22px;
        }

        .modal-user-tab-panel.active {
            display: block;
        }

        .mf-card {
            background: var(--card-bg);
            border-radius: 14px;
            border: 1px solid var(--border);
            padding: 20px 22px;
            margin-bottom: 16px;
        }

        .mf-section-title {
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

        .mf-section-title i {
            font-size: 13px;
            color: var(--primary);
        }

        .foto-upload-zone {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            border: 2px dashed var(--border);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: border-color .2s, background .2s;
            font-size: 11px;
            color: var(--text-light);
            text-align: center;
            gap: 4px;
            overflow: hidden;
        }

        .foto-upload-zone:hover {
            border-color: var(--primary);
            background: var(--accent-lt);
        }

        .foto-upload-zone i {
            font-size: 24px;
            color: var(--text-light);
        }

        .foto-upload-zone img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
        }

        .pwd-strength-bar {
            height: 4px;
            border-radius: 4px;
            background: var(--border);
            margin-top: 6px;
            overflow: hidden;
        }

        .pwd-strength-fill {
            height: 100%;
            border-radius: 4px;
            width: 0%;
            transition: width .3s, background .3s;
        }

        .pwd-strength-label {
            font-size: 11px;
            color: var(--text-light);
            margin-top: 4px;
        }

        /* ── TOAST ─── */
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
            flex-shrink: 0;
        }

        .save-toast .toast-icon.success {
            background: #E8F5E9;
            color: #2E7D32;
        }

        .save-toast .toast-icon.danger {
            background: #FFEBEE;
            color: #C62828;
        }

        .save-toast .toast-icon.warning {
            background: #FFF8E1;
            color: #F57F17;
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

        /* ── TEMA ─── */
        .theme-option {
            border: 2px solid var(--border);
            border-radius: 14px;
            padding: 14px;
            cursor: pointer;
            transition: border-color .2s, box-shadow .2s;
            text-align: center;
            position: relative;
        }

        .theme-option:hover {
            border-color: var(--primary);
        }

        .theme-option.selected {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(46, 125, 50, .15);
        }

        .theme-option.selected::after {
            content: '✓';
            position: absolute;
            top: 8px;
            right: 10px;
            background: var(--primary);
            color: #fff;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            font-weight: 700;
        }

        .theme-preview {
            border-radius: 10px;
            overflow: hidden;
            margin-bottom: 10px;
            aspect-ratio: 16/9;
            position: relative;
        }

        .theme-label {
            font-size: 13px;
            font-weight: 600;
            color: var(--text-mid);
        }

        .color-options {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .color-swatch {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            cursor: pointer;
            border: 3px solid transparent;
            transition: transform .15s, border-color .15s;
            position: relative;
        }

        .color-swatch:hover {
            transform: scale(1.12);
        }

        .color-swatch.selected {
            border-color: var(--text-dark);
        }

        .color-swatch.selected::after {
            content: '✓';
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 13px;
            font-weight: 700;
        }

        /* ── ANIMATIONS ─── */
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

        /* ── DARK MODE ─── */
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

        body.dark-mode .cfg-input,
        body.dark-mode .cfg-select {
            background: #172518;
            color: #e8f0e9;
            border-color: rgba(255, 255, 255, .1);
        }

        body.dark-mode .users-table th,
        body.dark-mode .perm-table th {
            background: #172518;
        }

        body.dark-mode .users-table tr:hover td,
        body.dark-mode .perm-table tr:hover td {
            background: #1a2a1c;
        }

        body.dark-mode .mf-card {
            background: #1e2a20;
        }

        body.dark-mode .modal-user .modal-body {
            background: #141d15;
        }

        body.dark-mode .modal-user .modal-footer {
            background: #1e2a20;
        }

        /* ── PAGINAÇÃO ─── */
        .pagination-wrapper {
            padding: 14px 24px;
            border-top: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 10px;
        }

        .pagination-wrapper .pagination-info {
            font-size: 12.5px;
            color: var(--text-light);
        }

        .pagination-wrapper .pagination {
            margin: 0;
            gap: 4px;
        }

        .pagination-wrapper .page-link {
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 6px 12px;
            font-size: 12.5px;
            color: var(--text-mid);
            background: transparent;
            text-decoration: none;
            cursor: pointer;
        }

        .pagination-wrapper .page-link:hover {
            background: var(--accent-lt);
            color: var(--primary);
            border-color: var(--primary);
        }

        .pagination-wrapper .page-item.active .page-link {
            background: var(--primary);
            color: #fff;
            border-color: var(--primary);
        }

        .pagination-wrapper .page-item.disabled .page-link {
            opacity: .4;
            cursor: not-allowed;
        }

        /* ── MODAL ELIMINAR (mesmo layout da cooperativa) ─── */
        .modal-delete .modal-content {
            border: none;
            border-radius: 18px;
            box-shadow: 0 24px 64px rgba(0, 0, 0, .15);
            overflow: hidden;
        }

        .modal-delete .modal-header {
            padding: 11px 20px;
            border-bottom: 1px solid var(--border);
            background: linear-gradient(135deg, #7f0000, #C62828);
            flex-shrink: 0;
        }

        .modal-delete .modal-header .modal-title {
            font-family: 'Sora', sans-serif;
            font-size: 16px;
            font-weight: 700;
            color: #fff;
        }

        .modal-delete .modal-header .btn-close {
            filter: brightness(0) invert(1);
            opacity: .8;
        }

        .modal-delete .modal-header .btn-close:hover {
            opacity: 1;
        }

        .modal-delete .modal-header-icon {
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

        .modal-delete .modal-body {
            background: #fff;
            padding: 28px;
        }

        .modal-delete .modal-footer {
            padding: 14px 20px;
            border-top: 1px solid #FFCDD2;
            background: #fff;
            flex-shrink: 0;
        }

        .modal-delete .delete-warning-box {
            background: #FFF8F8;
            border: 1px solid #FFCDD2;
            border-radius: 10px;
            padding: 14px 18px;
            margin-bottom: 16px;
        }

        .modal-delete .delete-warning-box .user-name {
            font-family: 'Sora', sans-serif;
            font-weight: 700;
            font-size: 15px;
            color: #C62828;
        }

        .modal-delete .delete-warning-box .user-email {
            font-size: 13px;
            color: var(--text-light);
            margin-top: 2px;
        }

        /* ── RESPONSIVE ─── */
        @media (max-width: 900px) {
            .settings-wrap {
                flex-direction: column;
            }

            .settings-nav {
                width: 100%;
                position: static;
                display: flex;
                flex-wrap: wrap;
                gap: 4px;
                padding: 8px;
            }

            .settings-nav-item {
                width: auto;
                padding: 8px 12px;
                font-size: 12.5px;
            }

            .settings-nav-divider {
                display: none;
            }
        }

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

            .modal-delete .modal-dialog {
                margin: 10px;
            }

            .perm-table {
                font-size: 12px;
            }

            .perm-table th,
            .perm-table td {
                padding: 8px 10px;
            }
        }
    </style>

</head>

<body>
    <!-- ─── ESTADO INICIAL DA SIDEBAR ─── -->
    <script>
        (function() {
            var isMobile = window.innerWidth < 760;
            document.body.classList.add('no-transition');
            if (isMobile) {
                document.body.classList.add('icons-only');
            }
        })();
    </script>

    <!-- ══════════════════════════════════════
         SIDEBAR
    ═══════════════════════════════════════ -->
    <nav id="sidebar">
        <div class="sidebar-logo">
            <div class="logo-svg-wrap">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 340 340" width="38" height="38" style="flex-shrink:0;">
                    <circle cx="170" cy="170" r="145" fill="#66BB6A" />
                    <g fill="#fff" stroke="#fff" stroke-width="1.5" stroke-linejoin="round" stroke-linecap="round">
                        <circle cx="118" cy="188" r="48" fill="none" stroke-width="6" />
                        <circle cx="118" cy="188" r="35" fill="none" stroke-width="4.5" />
                        <circle cx="118" cy="188" r="16" fill="#fff" />
                        <path
                            d="M118 135L118 144M118 232L118 241M65 188L74 188M162 188L171 188M81 151L88 157M155 219L162 225M81 225L88 219M155 151L162 157"
                            stroke-width="6" />
                        <path d="M68 185C68 140,108 120,160 128C171 132,174 144,174 151" fill="none" stroke-width="6" />
                        <circle cx="231" cy="204" r="26" fill="none" stroke-width="5" />
                        <circle cx="231" cy="204" r="10" fill="#fff" />
                        <path d="M117 125L117 105C117 102,120 99,125 99L176 99C181 99,184 102,185 107L202 157L176 157" fill="none"
                            stroke-width="6" />
                        <path d="M144 99L144 128L187 128" fill="none" stroke-width="4" />
                        <path d="M174 151L246 156C252 156,254 159,254 165L254 197L202 197Z" fill="#fff" />
                    </g>
                </svg>
            </div>
            <div class="logo-text-wrap" style="opacity:1;transition:opacity .2s;white-space:nowrap;">
                <div
                    style="font-family:'Sora',sans-serif;font-size:17px;font-weight:700;color:#fff;letter-spacing:1px;line-height:1.1;">
                    SIAG</div>
                <div style="font-size:10px;color:rgba(255,255,255,.5);letter-spacing:.5px;">Agrícola Cooperativas</div>
            </div>
        </div>

        <div class="sidebar-nav">
            <div class="nav-section-title">Principal</div>
            <a href="/dashboard" class="nav-item-link" data-label="Dashboard"><i class="bi bi-grid-1x2-fill"></i><span
                    class="nav-label">Dashboard</span></a>
            <a href="{{route('cooperativas')}}" class="nav-item-link" data-label="Cooperativa"><i
                    class="bi bi-building"></i><span class="nav-label">Cooperativa</span></a>
            <a href="{{route('agricultores.index')}}" class="nav-item-link" data-label="Agricultores"><i
                    class="bi bi-people-fill"></i><span class="nav-label">Agricultores</span></a>

            <div class="nav-section-title">Agrícola</div>
            <a href="{{route('safras.painel')}}" class="nav-item-link" data-label="Safras"><i class="bi bi-flower2"></i><span
                    class="nav-label">Safras</span></a>
            <a href="{{route('talhoes.index')}}" class="nav-item-link" data-label="Talhões"><i class="bi bi-map-fill"></i><span
                    class="nav-label">Talhões</span></a>
            <a href="{{route('insumos.index')}}" class="nav-item-link" data-label="Insumos"><i class="bi bi-box-seam-fill"></i><span
                    class="nav-label">Insumos</span></a>

            <div class="nav-section-title">Comercial</div>
            <a href="{{route('vendas')}}" class="nav-item-link" data-label="Vendas"><i class="bi bi-cart-fill"></i><span
                    class="nav-label">Vendas</span></a>

            <div class="nav-section-title">Sistema</div>
            <a href="#" class="nav-item-link active" data-label="Configurações"><i class="bi bi-gear-fill"></i><span
                    class="nav-label">Configurações</span></a>
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
    ═══════════════════════════════════════ -->
    <header id="topbar">
        <button class="topbar-toggle" id="sidebarToggle" title="Toggle Sidebar">
            <i class="bi bi-list"></i>
        </button>
        <span class="topbar-title">Configurações</span>
        <nav aria-label="breadcrumb" class="d-none d-md-flex ms-3">
            <ol class="breadcrumb mb-0" style="font-size:12.5px;">
                <li class="breadcrumb-item"><a href="#" style="color:var(--primary);text-decoration:none;">SIAG</a></li>
                <li class="breadcrumb-item active" style="color:var(--text-light);">Configurações</li>
            </ol>
        </nav>
        <div class="topbar-right">
            <div class="dropdown d-none d-sm-flex">
                <div class="topbar-user" data-bs-toggle="dropdown" data-bs-offset="0,4" role="button">
                    <div class="t-avatar">
                        <img src="{{ Auth::check() ? Auth::user()->foto_url : asset('uploads/users/default-user.png') }}"
                            alt="Foto-perfil" style="width:30px;height:30px;border-radius:50%;object-fit:cover;">
                    </div>
                    <span>{{ Auth::check() ? Auth::user()->name : 'Utilizador' }}</span>
                    <i class="bi bi-chevron-down" style="font-size:11px;color:var(--primary);"></i>
                </div>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-user">
                    <li><span class="dropdown-header">Nível: {{ Auth::user()->nivel ?? '--' }}</span></li>
                    <li>
                        <hr class="dropdown-divider">
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
    ═══════════════════════════════════════ -->
    <main id="main">
        <div class="content-inner">

            <!-- Page Header -->
            <div class="page-header anim">
                <div>
                    <h1>Configurações do Sistema</h1>
                    <p>Gerencie as preferências, utilizadores e parâmetros do SIAG</p>
                </div>
            </div>

            <!-- Settings Layout -->
            <div class="settings-wrap anim anim-d1">

                <!-- ── VERTICAL NAV ── -->
                <nav class="settings-nav">
                    <button class="settings-nav-item active" data-tab="aparencia">
                        <i class="bi bi-palette-fill"></i> Aparência
                    </button>
                    <div class="settings-nav-divider"></div>
                    <button class="settings-nav-item" data-tab="utilizadores">
                        <i class="bi bi-people-fill"></i> Utilizadores
                    </button>
                    <button class="settings-nav-item" data-tab="permissoes">
                        <i class="bi bi-key-fill"></i> Permissões
                    </button>
                    <div class="settings-nav-divider"></div>
                    <button class="settings-nav-item" data-tab="empresa">
                        <i class="bi bi-flower2"></i> Ano Agrícola
                    </button>
                </nav>

                <!-- ── CONTENT PANELS ── -->
                <div class="settings-content">

                    <!-- ════════════════════════════
                         TAB 1 — APARÊNCIA
                    ════════════════════════════ -->
                    <div class="settings-panel active" id="tab-aparencia">

                        <!-- Tema -->
                        <div class="cfg-card anim">
                            <div class="cfg-card-header">
                                <div class="cfg-card-header-left">
                                    <div class="cfg-card-icon green"><i class="bi bi-palette-fill"></i></div>
                                    <div>
                                        <div class="cfg-card-title">Tema do Sistema</div>
                                        <div class="cfg-card-sub">Escolha o modo visual preferido</div>
                                    </div>
                                </div>
                            </div>
                            <div class="cfg-card-body">
                                <div class="row g-3">
                                    <div class="col-4">
                                        <div class="theme-option selected" data-theme="claro">
                                            <div class="theme-preview" style="background:#F4F6F4;">
                                                <div
                                                    style="background:#fff;height:40%;border-radius:6px 6px 0 0;display:flex;align-items:center;padding:0 8px;gap:4px;">
                                                    <div style="width:8px;height:8px;background:#2E7D32;border-radius:50%;">
                                                    </div>
                                                    <div style="flex:1;height:4px;background:#E8F5E9;border-radius:4px;">
                                                    </div>
                                                </div>
                                                <div style="display:flex;height:60%;gap:4px;padding:4px 0 0 0;">
                                                    <div style="width:30%;background:#1B5E20;border-radius:0 0 0 6px;">
                                                    </div>
                                                    <div style="flex:1;padding:4px;display:flex;flex-direction:column;gap:3px;">
                                                        <div style="height:4px;background:#E8F5E9;border-radius:4px;"></div>
                                                        <div style="height:4px;background:#E8F5E9;border-radius:4px;width:70%;">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="theme-label">Claro</div>
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="theme-option" data-theme="escuro">
                                            <div class="theme-preview" style="background:#141d15;">
                                                <div
                                                    style="background:#1e2a20;height:40%;border-radius:6px 6px 0 0;display:flex;align-items:center;padding:0 8px;gap:4px;">
                                                    <div style="width:8px;height:8px;background:#66BB6A;border-radius:50%;">
                                                    </div>
                                                    <div style="flex:1;height:4px;background:#2E7D32;border-radius:4px;">
                                                    </div>
                                                </div>
                                                <div style="display:flex;height:60%;gap:4px;padding:4px 0 0 0;">
                                                    <div style="width:30%;background:#0f3d14;border-radius:0 0 0 6px;">
                                                    </div>
                                                    <div style="flex:1;padding:4px;display:flex;flex-direction:column;gap:3px;">
                                                        <div style="height:4px;background:#2E7D32;border-radius:4px;"></div>
                                                        <div style="height:4px;background:#2E7D32;border-radius:4px;width:70%;">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="theme-label">Escuro</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Cor Principal -->
                        <div class="cfg-card anim anim-d1">
                            <div class="cfg-card-header">
                                <div class="cfg-card-header-left">
                                    <div class="cfg-card-icon teal"><i class="bi bi-brush-fill"></i></div>
                                    <div>
                                        <div class="cfg-card-title">Cor Principal</div>
                                        <div class="cfg-card-sub">Tom dominante da interface</div>
                                    </div>
                                </div>
                            </div>
                            <div class="cfg-card-body">
                                <div class="color-options">
                                    <div class="color-swatch selected" style="background:#2E7D32;" title="Verde Principal"
                                        data-color="#2E7D32"></div>
                                    <div class="color-swatch" style="background:#1565C0;" title="Azul" data-color="#1565C0">
                                    </div>
                                    <div class="color-swatch" style="background:#6A1B9A;" title="Roxo" data-color="#6A1B9A">
                                    </div>
                                    <div class="color-swatch" style="background:#E65100;" title="Laranja"
                                        data-color="#E65100"></div>
                                    <div class="color-swatch" style="background:#00695C;" title="Verde Azulado"
                                        data-color="#00695C"></div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- /TAB APARÊNCIA -->


                    <!-- ════════════════════════════
                         TAB 2 — UTILIZADORES
                    ════════════════════════════ -->
                    <div class="settings-panel" id="tab-utilizadores">

                        <div class="cfg-card anim">
                            <div class="cfg-card-header">
                                <div class="cfg-card-header-left">
                                    <div class="cfg-card-icon blue"><i class="bi bi-people-fill"></i></div>
                                    <div>
                                        <div class="cfg-card-title">Gestão de Utilizadores</div>
                                        <div class="cfg-card-sub">Administradores, técnicos e gestores do sistema</div>
                                    </div>
                                </div>
                                <button class="btn-green" id="btnNovoUser" data-bs-toggle="modal" data-bs-target="#modalNovoUser">
                                    <i class="bi bi-person-plus-fill"></i> Novo Utilizador
                                </button>
                            </div>

                            <!-- Search & Filter -->
                            <div style="padding:14px 24px;border-bottom:1px solid var(--border);display:flex;gap:10px;flex-wrap:wrap;align-items:center;">
                                <div style="flex:1;min-width:200px;position:relative;">
                                    <i class="bi bi-search" style="position:absolute;left:13px;top:50%;transform:translateY(-50%);color:var(--text-light);font-size:14px;"></i>
                                    <input id="pesquisaUtilizador" class="cfg-input" type="text" placeholder="Pesquisar utilizador..."
                                        style="padding-left:36px;">
                                </div>
                                <select id="filtroNivel" class="cfg-select" style="width:160px;">
                                    <option value="">Todos os níveis</option>
                                    <option value="agricultor">Agricultor</option>
                                    <option value="gestor">Gestor</option>
                                    <option value="tecnico">Técnico</option>
                                </select>
                                <select id="filtroEstado" class="cfg-select" style="width:140px;">
                                    <option value="">Todos os estados</option>
                                    <option value="activo">Activo</option>
                                    <option value="inactivo">Inactivo</option>
                                </select>
                                <button class="btn-green btn-filter" id="btnFiltrarUsers" style="padding:8px 18px;">
                                    <i class="bi bi-search"></i> Filtrar
                                </button>
                                <button class="btn-outline-green btn-filter" id="btnLimparFiltrosUsers" style="padding:8px 18px;">
                                    <i class="bi bi-eraser"></i> Limpar
                                </button>
                            </div>

                            <!-- Table -->
                            <div style="overflow-x:auto;">
                                <table class="users-table">
                                    <thead>
                                        <tr>
                                            <th>Utilizador</th>
                                            <th>E-mail</th>
                                            <th>Nível</th>
                                            <th>Estado</th>
                                            <th>Último Acesso</th>
                                            <th style="text-align:center;">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tabela-utilizadores">
                                        <!-- Carregado via AJAX -->
                                    </tbody>
                                </table>
                            </div>

                            <!-- Pagination -->
                            <div class="pagination-wrapper" id="paginacaoUtilizadores">
                                <div class="pagination-info" id="pagination-info">Carregando...</div>
                                <nav>
                                    <ul class="pagination" id="pagination-buttons"></ul>
                                </nav>
                            </div>
                        </div>

                    </div>
                    <!-- /TAB UTILIZADORES -->


                    <!-- ════════════════════════════
                         TAB 3 — PERMISSÕES
                    ════════════════════════════ -->
                    <div class="settings-panel" id="tab-permissoes">

                        <div class="cfg-card anim">
                            <div class="cfg-card-header">
                                <div class="cfg-card-header-left">
                                    <div class="cfg-card-icon purple"><i class="bi bi-key-fill"></i></div>
                                    <div>
                                        <div class="cfg-card-title">Matriz de Permissões</div>
                                        <div class="cfg-card-sub">Controlo de acesso por nível de utilizador</div>
                                    </div>
                                </div>
                                <button class="btn-green" id="btnSalvarPermissoes">
                                    <i class="bi bi-check2-all"></i> Guardar
                                </button>
                            </div>

                            <div style="overflow-x:auto;padding:20px;">
                                <table class="perm-table">
                                    <thead>
                                        <tr>
                                            <th style="min-width:200px;">Módulo / Acção</th>
                                            <th>
                                                <div class="perm-role-header">
                                                    <span class="perm-role-badge" style="background:#EDE7F6;color:#6A1B9A;">Admin</span>
                                                    <span style="font-size:10px;font-weight:400;color:var(--text-light);">Total</span>
                                                </div>
                                            </th>
                                            <th>
                                                <div class="perm-role-header">
                                                    <span class="perm-role-badge" style="background:var(--accent-lt);color:var(--primary);">Gestor</span>
                                                    <span style="font-size:10px;font-weight:400;color:var(--text-light);">Operacional</span>
                                                </div>
                                            </th>
                                            <th>
                                                <div class="perm-role-header">
                                                    <span class="perm-role-badge" style="background:#E3F2FD;color:#1565C0;">Técnico</span>
                                                    <span style="font-size:10px;font-weight:400;color:var(--text-light);">Agrícola</span>
                                                </div>
                                            </th>
                                            <th>
                                                <div class="perm-role-header">
                                                    <span class="perm-role-badge" style="background:#E8F5E9;color:#2E7D32;">Agricultor</span>
                                                    <span style="font-size:10px;font-weight:400;color:var(--text-light);">Próprio</span>
                                                </div>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- ==================== DASHBOARD ==================== -->
                                        <tr style="background:var(--page-bg);">
                                            <td colspan="5" style="font-size:11px;font-weight:700;letter-spacing:.8px;text-transform:uppercase;color:var(--text-light);padding:8px 16px;">
                                                <i class="bi bi-grid-1x2-fill me-2"></i> Dashboard
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Visualizar Dashboard</td>
                                            <td><input type="checkbox" class="perm-check" checked disabled></td>
                                            <td><input type="checkbox" class="perm-check" checked></td>
                                            <td><input type="checkbox" class="perm-check" checked></td>
                                            <td><input type="checkbox" class="perm-check"></td>
                                        </tr>

                                        <!-- ==================== AGRICULTORES ==================== -->
                                        <tr style="background:var(--page-bg);">
                                            <td colspan="5" style="font-size:11px;font-weight:700;letter-spacing:.8px;text-transform:uppercase;color:var(--text-light);padding:8px 16px;">
                                                <i class="bi bi-people-fill me-2"></i> Agricultores / Cooperados
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Listar agricultores</td>
                                            <td><input type="checkbox" class="perm-check" checked disabled></td>
                                            <td><input type="checkbox" class="perm-check" checked></td>
                                            <td><input type="checkbox" class="perm-check" checked></td>
                                            <td><input type="checkbox" class="perm-check"></td>
                                        </tr>
                                        <tr>
                                            <td>Criar / Editar agricultor</td>
                                            <td><input type="checkbox" class="perm-check" checked disabled></td>
                                            <td><input type="checkbox" class="perm-check" checked></td>
                                            <td><input type="checkbox" class="perm-check"></td>
                                            <td><input type="checkbox" class="perm-check"></td>
                                        </tr>
                                        <tr>
                                            <td>Eliminar agricultor</td>
                                            <td><input type="checkbox" class="perm-check" checked disabled></td>
                                            <td><input type="checkbox" class="perm-check"></td>
                                            <td><input type="checkbox" class="perm-check"></td>
                                            <td><input type="checkbox" class="perm-check"></td>
                                        </tr>

                                        <!-- ==================== TALHÕES ==================== -->
                                        <tr style="background:var(--page-bg);">
                                            <td colspan="5" style="font-size:11px;font-weight:700;letter-spacing:.8px;text-transform:uppercase;color:var(--text-light);padding:8px 16px;">
                                                <i class="bi bi-map-fill me-2"></i> Talhões & Agrícola
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Visualizar talhões</td>
                                            <td><input type="checkbox" class="perm-check" checked disabled></td>
                                            <td><input type="checkbox" class="perm-check" checked></td>
                                            <td><input type="checkbox" class="perm-check" checked></td>
                                            <td><input type="checkbox" class="perm-check" checked></td>
                                        </tr>
                                        <tr>
                                            <td>Criar / Editar talhão</td>
                                            <td><input type="checkbox" class="perm-check" checked disabled></td>
                                            <td><input type="checkbox" class="perm-check" checked></td>
                                            <td><input type="checkbox" class="perm-check" checked></td>
                                            <td><input type="checkbox" class="perm-check"></td>
                                        </tr>
                                        <tr>
                                            <td>Eliminar talhão</td>
                                            <td><input type="checkbox" class="perm-check" checked disabled></td>
                                            <td><input type="checkbox" class="perm-check"></td>
                                            <td><input type="checkbox" class="perm-check"></td>
                                            <td><input type="checkbox" class="perm-check"></td>
                                        </tr>

                                        <!-- ==================== INSUMOS ==================== -->
                                        <tr style="background:var(--page-bg);">
                                            <td colspan="5" style="font-size:11px;font-weight:700;letter-spacing:.8px;text-transform:uppercase;color:var(--text-light);padding:8px 16px;">
                                                <i class="bi bi-box-seam-fill me-2"></i> Insumos
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Visualizar insumos</td>
                                            <td><input type="checkbox" class="perm-check" checked disabled></td>
                                            <td><input type="checkbox" class="perm-check" checked></td>
                                            <td><input type="checkbox" class="perm-check" checked></td>
                                            <td><input type="checkbox" class="perm-check"></td>
                                        </tr>
                                        <tr>
                                            <td>Registar / Editar insumos</td>
                                            <td><input type="checkbox" class="perm-check" checked disabled></td>
                                            <td><input type="checkbox" class="perm-check" checked></td>
                                            <td><input type="checkbox" class="perm-check" checked></td>
                                            <td><input type="checkbox" class="perm-check"></td>
                                        </tr>
                                        <tr>
                                            <td>Eliminar insumos</td>
                                            <td><input type="checkbox" class="perm-check" checked disabled></td>
                                            <td><input type="checkbox" class="perm-check"></td>
                                            <td><input type="checkbox" class="perm-check"></td>
                                            <td><input type="checkbox" class="perm-check"></td>
                                        </tr>

                                        <!-- ==================== SAFRAS ==================== -->
                                        <tr style="background:var(--page-bg);">
                                            <td colspan="5" style="font-size:11px;font-weight:700;letter-spacing:.8px;text-transform:uppercase;color:var(--text-light);padding:8px 16px;">
                                                <i class="bi bi-flower2 me-2"></i> Safras
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Visualizar safras</td>
                                            <td><input type="checkbox" class="perm-check" checked disabled></td>
                                            <td><input type="checkbox" class="perm-check" checked></td>
                                            <td><input type="checkbox" class="perm-check" checked></td>
                                            <td><input type="checkbox" class="perm-check"></td>
                                        </tr>
                                        <tr>
                                            <td>Criar / Editar safra</td>
                                            <td><input type="checkbox" class="perm-check" checked disabled></td>
                                            <td><input type="checkbox" class="perm-check" checked></td>
                                            <td><input type="checkbox" class="perm-check"></td>
                                            <td><input type="checkbox" class="perm-check"></td>
                                        </tr>
                                        <tr>
                                            <td>Eliminar safra</td>
                                            <td><input type="checkbox" class="perm-check" checked disabled></td>
                                            <td><input type="checkbox" class="perm-check"></td>
                                            <td><input type="checkbox" class="perm-check"></td>
                                            <td><input type="checkbox" class="perm-check"></td>
                                        </tr>

                                        <!-- ==================== VENDAS ==================== -->
                                        <tr style="background:var(--page-bg);">
                                            <td colspan="5" style="font-size:11px;font-weight:700;letter-spacing:.8px;text-transform:uppercase;color:var(--text-light);padding:8px 16px;">
                                                <i class="bi bi-cart-fill me-2"></i> Vendas
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Visualizar vendas</td>
                                            <td><input type="checkbox" class="perm-check" checked disabled></td>
                                            <td><input type="checkbox" class="perm-check" checked></td>
                                            <td><input type="checkbox" class="perm-check"></td>
                                            <td><input type="checkbox" class="perm-check" checked></td>
                                        </tr>
                                        <tr>
                                            <td>Registar venda</td>
                                            <td><input type="checkbox" class="perm-check" checked disabled></td>
                                            <td><input type="checkbox" class="perm-check" checked></td>
                                            <td><input type="checkbox" class="perm-check"></td>
                                            <td><input type="checkbox" class="perm-check" checked></td>
                                        </tr>
                                        <tr>
                                            <td>Eliminar venda</td>
                                            <td><input type="checkbox" class="perm-check" checked disabled></td>
                                            <td><input type="checkbox" class="perm-check"></td>
                                            <td><input type="checkbox" class="perm-check"></td>
                                            <td><input type="checkbox" class="perm-check"></td>
                                        </tr>

                                        <!-- ==================== CONFIGURAÇÕES ==================== -->
                                        <tr style="background:var(--page-bg);">
                                            <td colspan="5" style="font-size:11px;font-weight:700;letter-spacing:.8px;text-transform:uppercase;color:var(--text-light);padding:8px 16px;">
                                                <i class="bi bi-gear-fill me-2"></i> Sistema & Configurações
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Aceder às Configurações</td>
                                            <td><input type="checkbox" class="perm-check" checked disabled></td>
                                            <td><input type="checkbox" class="perm-check"></td>
                                            <td><input type="checkbox" class="perm-check"></td>
                                            <td><input type="checkbox" class="perm-check"></td>
                                        </tr>
                                        <tr>
                                            <td>Gerir utilizadores</td>
                                            <td><input type="checkbox" class="perm-check" checked disabled></td>
                                            <td><input type="checkbox" class="perm-check"></td>
                                            <td><input type="checkbox" class="perm-check"></td>
                                            <td><input type="checkbox" class="perm-check"></td>
                                        </tr>
                                        <tr>
                                            <td>Gerir permissões</td>
                                            <td><input type="checkbox" class="perm-check" checked disabled></td>
                                            <td><input type="checkbox" class="perm-check"></td>
                                            <td><input type="checkbox" class="perm-check"></td>
                                            <td><input type="checkbox" class="perm-check"></td>
                                        </tr>
                                        <tr>
                                            <td>Ver logs de auditoria</td>
                                            <td><input type="checkbox" class="perm-check" checked disabled></td>
                                            <td><input type="checkbox" class="perm-check" checked></td>
                                            <td><input type="checkbox" class="perm-check"></td>
                                            <td><input type="checkbox" class="perm-check"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div style="padding:14px 24px;border-top:1px solid var(--border);">
                                <p style="font-size:12px;color:var(--text-light);">
                                    <i class="bi bi-info-circle me-1"></i>
                                    As permissões marcadas como <strong>Admin</strong> estão bloqueadas por segurança.
                                    As alterações são salvas num arquivo de configuração.
                                </p>
                            </div>
                        </div>

                    </div>
                    <!-- /TAB PERMISSÕES -->


                    <!-- ════════════════════════════
                         TAB 4 — ANO AGRÍCOLA
                    ════════════════════════════ -->
                    <div class="settings-panel" id="tab-empresa">

                        <div class="cfg-card anim anim-d2">
                            <div class="cfg-card-header">
                                <div class="cfg-card-header-left">
                                    <div class="cfg-card-icon green"><i class="bi bi-calendar2-range-fill"></i></div>
                                    <div>
                                        <div class="cfg-card-title">Ano Agrícola</div>
                                        <div class="cfg-card-sub">Registo e controlo dos anos de actividade agrícola do sistema</div>
                                    </div>
                                </div>
                                <button class="btn-green" id="btnIniciarAno" data-bs-toggle="modal" data-bs-target="#modalAnoAgricola">
                                    <i class="bi bi-plus-circle-fill"></i> Registar Ano Agrícola
                                </button>
                            </div>

                            <!-- Tabela de anos -->
                            <div style="overflow-x:auto;">
                                <table class="users-table" id="tabelaAnosAgricolas">
                                    <thead>
                                        <tr>
                                            <th>Nome / Período</th>
                                            <th>Data Início</th>
                                            <th>Data Fim</th>
                                            <th>Estado</th>
                                            <th>Registado em</th>
                                            <th style="text-align:center;">Acções</th>
                                        </tr>
                                    </thead>
                                    <tbody id="corpoTabelaAnos">
                                        <!-- Carregado via AJAX -->
                                    </tbody>
                                </table>
                            </div>

                            <div class="pagination-wrapper" id="paginacaoAnos">
                                <div class="pagination-info" id="infoAnos">Carregando...</div>
                                <nav>
                                    <ul class="pagination" id="paginacaoLinksAnos"></ul>
                                </nav>
                            </div>
                        </div>

                    </div>
                    <!-- /TAB ANO AGRÍCOLA -->

                </div>
                <!-- /settings-content -->

            </div>
            <!-- /settings-wrap -->

        </div>
    </main>

    <!-- ══════════════════════════════════════
         TOAST
    ══════════════════════════════════════ -->
    <div class="save-toast" id="saveToast">
        <div class="toast-icon success">
            <i class="bi bi-check-lg"></i>
        </div>
        <div class="toast-text">
            <div class="t-title">Operação concluída</div>
            <div class="t-sub">Acção realizada com sucesso.</div>
        </div>
    </div>


    <!-- ══════════════════════════════════════
         MODAL — UTILIZADOR
    ══════════════════════════════════════ -->
    <div class="modal fade" id="modalNovoUser" tabindex="-1" aria-labelledby="modalNovoUserLabel" aria-hidden="true"
        data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-user modal-dialog-centered">
            <div class="modal-content">

                <!-- Header -->
                <div class="modal-header">
                    <div style="display:flex;align-items:center;gap:14px;flex:1;">
                        <div class="modal-user-header-icon">
                            <i class="bi bi-person-plus-fill"></i>
                        </div>
                        <div>
                            <div class="modal-title" id="modalNovoUserLabel">Novo Utilizador</div>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>

                <!-- Tabs nav -->
                <div class="modal-user-tabs">
                    <button class="modal-user-tab-btn active" data-user-tab="dados">
                        <i class="bi bi-person-fill"></i> Dados Pessoais
                    </button>
                    <button class="modal-user-tab-btn" data-user-tab="acesso">
                        <i class="bi bi-shield-lock-fill"></i> Acesso & Segurança
                    </button>
                    <button class="modal-user-tab-btn" data-user-tab="perfil">
                        <i class="bi bi-sliders"></i> Perfil & Estado
                    </button>
                </div>

                <!-- Body -->
                <div class="modal-body">
                    <form id="formNovoUser" novalidate>
                        @csrf
                        <input type="hidden" id="userId" name="id" value="">

                        <!-- ══ TAB 1 — DADOS PESSOAIS ══ -->
                        <div class="modal-user-tab-panel active" id="utab-dados">

                            <div class="mf-card">
                                <div class="mf-section-title">
                                    <i class="bi bi-camera-fill"></i> Fotografia do Utilizador
                                </div>
                                <div style="display:flex;align-items:center;gap:22px;">
                                    <div class="foto-upload-zone" onclick="document.getElementById('fotoInput').click()" id="fotoZone">
                                        <i class="bi bi-person-circle"></i>
                                        <span>Carregar foto</span>
                                    </div>
                                    <input type="file" id="fotoInput" name="foto" accept="image/*" style="display:none;">
                                    <div>
                                        <div style="font-size:13px;font-weight:600;color:var(--text-dark);margin-bottom:4px;">
                                            Foto de perfil
                                        </div>
                                        <div style="font-size:12px;color:var(--text-light);margin-bottom:10px;">
                                            JPG ou PNG · Máx. 2 MB · 200×200 px recomendado
                                        </div>
                                        <button type="button" class="btn-outline-green" style="padding:6px 14px;font-size:12.5px;"
                                            onclick="document.getElementById('fotoInput').click()">
                                            <i class="bi bi-upload"></i> Seleccionar ficheiro
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="mf-card">
                                <div class="mf-section-title">
                                    <i class="bi bi-person-vcard-fill"></i> Informação Pessoal
                                </div>
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label class="cfg-label" for="userName">Nome Completo *</label>
                                        <input class="cfg-input" type="text" id="userName" name="name" placeholder="" required>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="cfg-label" for="userEmail">E-mail *</label>
                                        <input class="cfg-input" type="email" id="userEmail" name="email"
                                            placeholder="utilizador@siag.ao" required>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="cfg-label" for="userTelefone">Telefone</label>
                                        <input class="cfg-input" type="tel" id="userTelefone" name="telefone" placeholder="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /TAB DADOS PESSOAIS -->

                        <!-- ══ TAB 2 — ACESSO & SEGURANÇA ══ -->
                        <div class="modal-user-tab-panel" id="utab-acesso">

                            <div class="mf-card">
                                <div class="mf-section-title">
                                    <i class="bi bi-key-fill"></i> Credenciais de Acesso
                                </div>
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label class="cfg-label" for="userPassword">Senha *</label>
                                        <div style="position:relative;">
                                            <input class="cfg-input" type="password" id="userPassword" name="password"
                                                placeholder="Mínimo 8 caracteres" autocomplete="new-password"
                                                oninput="avaliarSenha(this.value)" style="padding-right:44px;">
                                            <button type="button" onclick="togglePwd('userPassword','eyePwd1')"
                                                style="position:absolute;right:12px;top:50%;transform:translateY(-50%);background:none;border:none;color:var(--text-light);cursor:pointer;font-size:16px;">
                                                <i class="bi bi-eye-fill" id="eyePwd1"></i>
                                            </button>
                                        </div>
                                        <div class="pwd-strength-bar">
                                            <div class="pwd-strength-fill" id="pwdFill"></div>
                                        </div>
                                        <div class="pwd-strength-label" id="pwdLabel">Introduza a senha</div>
                                    </div>
                                    <div class="col-12">
                                        <label class="cfg-label" for="userPasswordConfirm">Confirmar Senha *</label>
                                        <div style="position:relative;">
                                            <input class="cfg-input" type="password" id="userPasswordConfirm"
                                                name="password_confirmation" placeholder="Repita a senha"
                                                autocomplete="new-password" style="padding-right:44px;">
                                            <button type="button" onclick="togglePwd('userPasswordConfirm','eyePwd2')"
                                                style="position:absolute;right:12px;top:50%;transform:translateY(-50%);background:none;border:none;color:var(--text-light);cursor:pointer;font-size:16px;">
                                                <i class="bi bi-eye-fill" id="eyePwd2"></i>
                                            </button>
                                        </div>
                                        <div class="cfg-helper" id="pwdMatchMsg"></div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- /TAB ACESSO & SEGURANÇA -->

                        <!-- ══ TAB 3 — PERFIL & ESTADO ══ -->
                        <div class="modal-user-tab-panel" id="utab-perfil">

                            <div class="mf-card">
                                <div class="mf-section-title">
                                    <i class="bi bi-person-gear"></i> Nível de Acesso
                                </div>
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label class="cfg-label" for="userNivel">Nível / Papel *</label>
                                        <select class="cfg-select" id="userNivel" name="nivel" required>
                                            <option value="">Seleccione o nível </option>
                                            <option value="agricultor">Agricultor</option>
                                            <option value="gestor">Gestor</option>
                                            <option value="tecnico">Técnico</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="mf-card">
                                <div class="mf-section-title">
                                    <i class="bi bi-toggle-on"></i> Estado da Conta
                                </div>
                                <div class="row g-3">
                                    <div class="col-12 col-md-6">
                                        <label class="cfg-label" for="userEstado">Estado *</label>
                                        <select class="cfg-select" id="userEstado" name="estado" required>
                                            <option value="activo" selected>Activo</option>
                                            <option value="inactivo">Inactivo</option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="cfg-label">Último Acesso</label>
                                        <input class="cfg-input" type="text" value="—" readonly
                                            style="background:#f5f5f5;color:var(--text-light);cursor:not-allowed;">
                                    </div>
                                </div>
                            </div>

                            <div class="mf-card">
                                <div class="mf-section-title">
                                    <i class="bi bi-info-circle-fill"></i> Informação do Registo
                                </div>
                                <div class="row g-2">
                                    <div class="col-6">
                                        <div style="padding:10px 12px;background:#FAFAF9;border:1px solid var(--border);border-radius:8px;">
                                            <div style="font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:.5px;color:var(--text-light);">
                                                Criado em
                                            </div>
                                            <div style="font-size:13px;font-weight:500;color:var(--text-dark);margin-top:2px;"
                                                id="userCreatedAt">— (novo registo)</div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div style="padding:10px 12px;background:#FAFAF9;border:1px solid var(--border);border-radius:8px;">
                                            <div style="font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:.5px;color:var(--text-light);">
                                                Actualizado em
                                            </div>
                                            <div style="font-size:13px;font-weight:500;color:var(--text-dark);margin-top:2px;"
                                                id="userUpdatedAt">— (novo registo)</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- /TAB PERFIL & ESTADO -->

                    </form>
                </div>

                <!-- Footer -->
                <div class="modal-footer">
                    <div style="display:flex;align-items:center;gap:10px;width:100%;justify-content:space-between;flex-wrap:wrap;">
                        <div style="font-size:12px;color:var(--text-light);">
                            <i class="bi bi-info-circle me-1"></i> Os campos marcados com * são obrigatórios.
                        </div>
                        <div style="display:flex;gap:10px;">
                            <button type="button" class="btn-outline-green" data-bs-dismiss="modal">
                                <i class="bi bi-x-lg"></i> Cancelar
                            </button>
                            <button type="button" class="btn-green" id="btnGuardarUser">
                                <i class="bi bi-check2-circle"></i>
                                <span id="btnGuardarUserLabel">Registar Utilizador</span>
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- /MODAL UTILIZADOR -->


    <!-- ══════════════════════════════════════
         MODAL — ELIMINAR UTILIZADOR (mesmo layout da cooperativa)
    ══════════════════════════════════════ -->
    <div class="modal fade modal-delete" id="modalDeleteUser" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width:420px;">
            <div class="modal-content">
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
                <div class="modal-body">
                    <p style="font-size:13.5px;color:var(--text-mid);margin-bottom:10px;">
                        Tem a certeza que deseja eliminar o utilizador:
                    </p>
                    <div class="delete-warning-box">
                        <div class="user-name" id="deleteUserName">—</div>
                        <div class="user-email" id="deleteUserEmail">—</div>
                    </div>
                    <input type="hidden" id="deleteUserId">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-outline-green" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn-green" id="btnConfirmDeleteUser" style="background:#C62828;box-shadow:none;">
                        <i class="bi bi-trash-fill"></i> Eliminar Definitivamente
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- /MODAL ELIMINAR UTILIZADOR -->


    <!-- ══════════════════════════════════════
         MODAL — ANO AGRÍCOLA
    ══════════════════════════════════════ -->
    <div class="modal fade" id="modalAnoAgricola" tabindex="-1" aria-hidden="true" data-bs-backdrop="static"
        data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <div style="display:flex;align-items:center;gap:14px;flex:1;">
                        <div class="modal-user-header-icon">
                            <i class="bi bi-calendar2-range-fill"></i>
                        </div>
                        <div>
                            <div class="modal-title" id="modalAnoLabel">Registar Ano Agrícola</div>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body" style="padding:20px;">
                    <form id="formAnoAgricola">
                        @csrf
                        <input type="hidden" id="anoId" name="id" value="">

                        <div class="mf-card">
                            <div class="mf-section-title">
                                <i class="bi bi-calendar3"></i> Dados do Ano Agrícola
                            </div>
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="cfg-label" for="anoNome">Nome / Período *</label>
                                    <input class="cfg-input" type="text" id="anoNome" name="nome"
                                        placeholder="Ex: 2024/2025" required>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="cfg-label" for="anoInicio">Data de Início *</label>
                                    <input class="cfg-input" type="date" id="anoInicio" name="data_inicio" required>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="cfg-label" for="anoFim">Data de Fim *</label>
                                    <input class="cfg-input" type="date" id="anoFim" name="data_fim" required>
                                </div>
                                <div class="col-12">
                                    <label class="cfg-label" for="anoEstado">Estado *</label>
                                    <select class="cfg-select" id="anoEstado" name="estado" required>
                                        <option value="iniciado">Iniciado</option>
                                        <option value="em_producao">Em Produção</option>
                                        <option value="finalizado">Finalizado</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <div style="display:flex;align-items:center;gap:10px;width:100%;justify-content:space-between;flex-wrap:wrap;">
                        <div style="font-size:12px;color:var(--text-light);">
                            <i class="bi bi-info-circle me-1"></i> Os campos marcados com * são obrigatórios.
                        </div>
                        <div style="display:flex;gap:10px;">
                            <button type="button" class="btn-outline-green" data-bs-dismiss="modal">
                                <i class="bi bi-x-lg"></i> Cancelar
                            </button>
                            <button type="button" class="btn-green" id="btnGuardarAno">
                                <i class="bi bi-check2-circle"></i>
                                <span id="btnGuardarAnoLabel">Registar Ano</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /MODAL ANO AGRÍCOLA -->


    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


    <!-- ══════════════════════════════════════
         SCRIPTS REORGANIZADOS (padrão cooperativa)
    ══════════════════════════════════════ -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // ----------------------------------------------
            // 1. TOAST (feedback visual)
            // ----------------------------------------------
            function showToast(title, sub, type = 'success') {
                const toast = document.getElementById('saveToast');
                if (!toast) return;
                const icon = toast.querySelector('.toast-icon');
                const iconI = icon.querySelector('i');
                const tTitle = toast.querySelector('.t-title');
                const tSub = toast.querySelector('.t-sub');

                tTitle.textContent = title;
                tSub.textContent = sub || '';

                const cores = {
                    success: '#E8F5E9',
                    danger: '#FFEBEE',
                    warning: '#FFF8E1'
                };
                icon.className = 'toast-icon ' + type;
                iconI.className = type === 'danger' ? 'bi bi-x-lg' :
                    type === 'warning' ? 'bi bi-exclamation-triangle-fill' : 'bi bi-check-lg';

                toast.classList.add('show');
                clearTimeout(toast._timeout);
                toast._timeout = setTimeout(() => toast.classList.remove('show'), 3500);
            }

            // ----------------------------------------------
            // 2. FUNÇÕES AUXILIARES (datas)
            // ----------------------------------------------

            function formatarData(dateStr, formato = 'completo') {
                if (!dateStr) return '';
                const d = new Date(dateStr);
                if (isNaN(d)) return dateStr;

                const meses = ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'];
                const dia = String(d.getDate()).padStart(2, '0');
                const mes = meses[d.getMonth()];
                const ano = d.getFullYear();
                const hora = String(d.getHours()).padStart(2, '0');
                const min = String(d.getMinutes()).padStart(2, '0');

                if (formato === 'M Y') return `${mes} ${ano}`;
                if (formato === 'd M Y') return `${dia} ${mes} ${ano}`;
                return `${dia}/${mes}/${ano}, ${hora}:${min}`;
            }

            function normalizarDataInput(dateStr) {
                if (!dateStr) return '';
                const iso = dateStr.match(/^(\d{4})-(\d{2})-(\d{2})/);
                if (iso) return iso[1] + '-' + iso[2] + '-' + iso[3];
                const dmy = dateStr.match(/^(\d{2})[\/\-](\d{2})[\/\-](\d{4})/);
                if (dmy) return `${dmy[3]}-${dmy[2]}-${dmy[1]}`;
                return '';
            }


            // ----------------------------------------------
            // 3. UTILIZADORES – CRUD completo
            // ----------------------------------------------

            let usersPage = 1;
            let usersFilters = { nome: '', nivel: '', estado: '' };

            // 3.1 Carregar utilizadores
            function carregarUtilizadores(page = 1) {
                usersPage = page;
                const params = new URLSearchParams({
                    page: page,
                    nome: usersFilters.nome,
                    nivel: usersFilters.nivel,
                    estado: usersFilters.estado
                });

                fetch(`/users?${params}`, {
                    headers: { 'Accept': 'application/json' }
                })
                    .then(res => {
                        if (!res.ok) {
                            throw new Error(`HTTP ${res.status}: ${res.statusText}`);
                        }
                        return res.json();
                    })
                    .then(data => {
                        renderTabelaUtilizadores(data.data);
                        renderPaginacaoUtilizadores(data);
                    })
                    .catch(err => {
                        console.error('Erro ao carregar utilizadores:', err);
                        showToast('Erro', 'Falha ao carregar utilizadores: ' + err.message, 'danger');
                    });
            }

            // 3.2 Renderizar tabela de utilizadores
            function renderTabelaUtilizadores(users) {
                const tbody = document.getElementById('tabela-utilizadores');
                if (!tbody) return;

                // Obtém o ID do utilizador logado (admin)
                const currentUserId = '{{ Auth::id() ?? 0 }}';
                const currentUserNivel = '{{ Auth::user()->nivel ?? "" }}';

                if (!users || users.length === 0) {
                    tbody.innerHTML = `
                        <tr>
                            <td colspan="6" style="text-align:center;padding:40px;color:var(--text-light);">
                                <i class="bi bi-inbox" style="font-size:28px;display:block;margin-bottom:8px;"></i>
                                Nenhum utilizador encontrado.
                            </td>
                        </tr>
                    `;
                    return;
                }

                tbody.innerHTML = users.map(u => {
                    // Verifica se é o admin logado (não pode ser editado/eliminado)
                    const isAdmin = u.nivel === 'admin';
                    const isCurrentUser = u.id == currentUserId;

                    // Desativa botões se for admin OU for o utilizador atual
                    const disableActions = isAdmin || isCurrentUser;

                    return `
                        <tr id="user-row-${u.id}" data-nivel="${u.nivel?.toLowerCase() || ''}" data-estado="${u.estado?.toLowerCase() || ''}">
                            <td>
                                <div class="user-cell">
                                    <img class="user-avatar-sm"
                                         src="${u.foto ? '/uploads/users/' + u.foto : '/uploads/users/default-user.png'}"
                                         alt="Foto"
                                         onerror="this.style.display='none';">
                                    <div>
                                        <div style="font-weight:600;">${u.name} ${isCurrentUser ? '<span style="font-size:10px;color:var(--primary);font-weight:700;">(Você)</span>' : ''}</div>
                                        <div style="font-size:11px;color:var(--text-light);">
                                            Criado em ${u.created_at ? formatarData(u.created_at, 'M Y') : '--'}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>${u.email}</td>
                            <td>${u.nivel}</td>
                            <td><span class="badge-status ${u.estado || 'inactivo'}">${u.estado || 'Inactivo'}</span></td>
                            <td>${u.ultimo_acesso ? formatarData(u.ultimo_acesso) : 'Nunca'}</td>
                            <td style="text-align:center;">
                                <div style="display:flex;gap:6px;justify-content:center;">
                                    <button class="topbar-icon-btn btn-editar-user" title="${disableActions ? 'Utilizador protegido' : 'Editar'}"
                                            data-id="${u.id}"
                                            ${disableActions ? 'disabled' : ''}>
                                        <i class="bi bi-pencil-fill"></i>
                                    </button>
                                    <button class="topbar-icon-btn btn-delete-user" title="${disableActions ? 'Utilizador protegido' : 'Apagar utilizador'}"
                                            data-id="${u.id}"
                                            style="${disableActions ? '' : 'width:30px;height:30px;font-size:14px;background:#FFEBEE;color:#C62828;'}"
                                            ${disableActions ? 'disabled' : ''}>
                                        <i class="bi ${disableActions ? 'bi-shield-lock-fill' : 'bi-person-x-fill'}"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    `;
                }).join('');

                // Reatribuir eventos (apenas para botões não desativados)
                document.querySelectorAll('.btn-delete-user:not([disabled])').forEach(btn => {
                    btn.removeEventListener('click', handleDeleteUser);
                    btn.addEventListener('click', handleDeleteUser);
                });
                document.querySelectorAll('.btn-editar-user:not([disabled])').forEach(btn => {
                    btn.removeEventListener('click', handleEditUser);
                    btn.addEventListener('click', handleEditUser);
                });
            }

            // 3.3 Renderizar paginação de utilizadores
            function renderPaginacaoUtilizadores(data) {
                const info = document.getElementById('pagination-info');
                const container = document.getElementById('pagination-buttons');
                if (!info || !container) return;

                info.textContent = data.total > 0 ?
                    `Mostrando ${data.from || 0} - ${data.to || 0} de ${data.total} utilizadores` :
                    'Nenhum utilizador encontrado';

                container.innerHTML = '';

                if (data.last_page <= 1) return;

                // Botão Anterior
                const prev = document.createElement('li');
                prev.className = `page-item ${data.prev_page_url ? '' : 'disabled'}`;
                prev.innerHTML = `<a class="page-link" href="#" onclick="carregarUtilizadores(${data.current_page - 1});return false;">«</a>`;
                container.appendChild(prev);

                // Números
                const maxShow = 5;
                let start = Math.max(1, data.current_page - 2);
                let end = Math.min(data.last_page, start + maxShow - 1);
                if (end - start < maxShow - 1) start = Math.max(1, end - maxShow + 1);

                for (let i = start; i <= end; i++) {
                    const li = document.createElement('li');
                    li.className = `page-item ${i === data.current_page ? 'active' : ''}`;
                    li.innerHTML = `<a class="page-link" href="#" onclick="carregarUtilizadores(${i});return false;">${i}</a>`;
                    container.appendChild(li);
                }

                // Botão Próximo
                const next = document.createElement('li');
                next.className = `page-item ${data.next_page_url ? '' : 'disabled'}`;
                next.innerHTML = `<a class="page-link" href="#" onclick="carregarUtilizadores(${data.current_page + 1});return false;">»</a>`;
                container.appendChild(next);
            }

            // 3.4 Abrir modal para editar utilizador
            function abrirModalEditarUtilizador(id) {
                fetch(`/users/${id}`)
                    .then(r => r.json())
                    .then(user => {
                        modoUser = 'edit';
                        document.getElementById('userId').value = user.id;
                        document.getElementById('userName').value = user.name;
                        document.getElementById('userEmail').value = user.email;
                        document.getElementById('userTelefone').value = user.telefone || '';
                        document.getElementById('userNivel').value = user.nivel;
                        document.getElementById('userEstado').value = user.estado;
                        document.getElementById('userPassword').value = '';
                        document.getElementById('userPasswordConfirm').value = '';
                        document.getElementById('modalNovoUserLabel').textContent = 'Editar Utilizador';
                        document.getElementById('btnGuardarUserLabel').textContent = 'Actualizar Utilizador';
                        document.getElementById('userCreatedAt').textContent = user.created_at ? formatarData(user
                            .created_at) : '--';
                        document.getElementById('userUpdatedAt').textContent = user.updated_at ? formatarData(user
                            .updated_at) : '--';

                        // Se tiver foto, mostra
                        if (user.foto) {
                            const zone = document.getElementById('fotoZone');
                            zone.innerHTML =
                                `<img src="/uploads/users/${user.foto}" alt="Foto" style="width:100%;height:100%;object-fit:cover;border-radius:50%;">`;
                            zone.style.border = '2px solid var(--primary)';
                        }

                        const modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('modalNovoUser'));
                        modal.show();
                    })
                    .catch(err => {
                        showToast('Erro', 'Falha ao carregar dados do utilizador.', 'danger');
                        console.error(err);
                    });
            }

            // 3.5 Handlers para eventos
            function handleEditUser(e) {
                const id = e.currentTarget.dataset.id;
                abrirModalEditarUtilizador(id);
            }

            // 3.5.1 Abrir modal de eliminação (mesmo layout da cooperativa)
            function abrirModalDeleteUser(id, nome, email) {
                document.getElementById('deleteUserId').value = id;
                document.getElementById('deleteUserName').textContent = nome;
                document.getElementById('deleteUserEmail').textContent = email || '';
                const modal = new bootstrap.Modal(document.getElementById('modalDeleteUser'));
                modal.show();
            }

            function handleDeleteUser(e) {
                const id = e.currentTarget.dataset.id;
                // Buscar dados do utilizador para mostrar no modal
                fetch(`/users/${id}`)
                    .then(r => r.json())
                    .then(user => {
                        abrirModalDeleteUser(id, user.name, user.email);
                    })
                    .catch(err => {
                        showToast('Erro', 'Falha ao carregar dados do utilizador.', 'danger');
                    });
            }

            // 3.5.2 Confirmar eliminação
            document.getElementById('btnConfirmDeleteUser').addEventListener('click', function() {
                const id = document.getElementById('deleteUserId').value;

                fetch(`/users/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    }
                })
                    .then(r => r.json())
                    .then(data => {
                        if (data.success) {
                            document.getElementById(`user-row-${id}`)?.remove();
                            bootstrap.Modal.getInstance(document.getElementById('modalDeleteUser')).hide();
                            showToast('Utilizador eliminado', 'Registo removido com sucesso.');
                            setTimeout(() => carregarUtilizadores(usersPage), 300);
                        } else {
                            showToast('Erro', data.message || 'Não foi possível eliminar.', 'danger');
                        }
                    })
                    .catch(() => showToast('Erro', 'Problema de ligação.', 'danger'));
            });

            // 3.6 Guardar utilizador (criar ou editar)
            function guardarUtilizador() {
                const userId = document.getElementById('userId').value;
                const nome = document.getElementById('userName').value.trim();
                const email = document.getElementById('userEmail').value.trim();
                const pwd = document.getElementById('userPassword').value;
                const pwdC = document.getElementById('userPasswordConfirm').value;
                const nivel = document.getElementById('userNivel').value;
                const estado = document.getElementById('userEstado').value;

                if (!nome || !email) {
                    showToast('Campos obrigatórios', 'Preencha Nome e E-mail.', 'warning');
                    return;
                }
                if (!userId && !pwd) {
                    showToast('Senha obrigatória', 'Defina uma senha para o novo utilizador.', 'warning');
                    return;
                }
                if (pwd && pwd !== pwdC) {
                    showToast('Senhas não coincidem', 'As senhas introduzidas são diferentes.', 'danger');
                    return;
                }
                if (!nivel) {
                    showToast('Nível obrigatório', 'Seleccione o nível de acesso.', 'warning');
                    return;
                }

                const btn = document.getElementById('btnGuardarUser');
                const orig = btn.innerHTML;
                btn.innerHTML = '<i class="bi bi-hourglass-split"></i> A guardar…';
                btn.disabled = true;

                const formData = new FormData();
                formData.append('name', nome);
                formData.append('email', email);
                formData.append('telefone', document.getElementById('userTelefone').value.trim());
                formData.append('nivel', nivel);
                formData.append('estado', estado);
                if (pwd) formData.append('password', pwd);

                // Foto
                const fotoInput = document.getElementById('fotoInput');
                if (fotoInput.files.length > 0) {
                    formData.append('foto', fotoInput.files[0]);
                }

                let url = '/users';
                let method = 'POST';
                if (userId) {
                    url = `/users/${userId}`;
                    formData.append('_method', 'PUT');
                }

                fetch(url, {
                    method: method,
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
                            bootstrap.Modal.getInstance(document.getElementById('modalNovoUser')).hide();
                            showToast(
                                userId ? 'Utilizador actualizado' : 'Utilizador criado',
                                data.message || 'Operação concluída.'
                            );
                            carregarUtilizadores(usersPage);
                        } else {
                            showToast('Erro', data.message || 'Falha ao guardar.', 'danger');
                        }
                    })
                    .catch(() => {
                        btn.innerHTML = orig;
                        btn.disabled = false;
                        showToast('Erro de ligação', 'Verifique a sua conexão.', 'danger');
                    });
            }

            // 3.7 Configurar eventos
            document.getElementById('btnGuardarUser').addEventListener('click', guardarUtilizador);

            // Filtros de utilizadores
            const inputPesquisa = document.getElementById('pesquisaUtilizador');
            const filtroNivel = document.getElementById('filtroNivel');
            const filtroEstado = document.getElementById('filtroEstado');
            const btnFiltrar = document.getElementById('btnFiltrarUsers');
            const btnLimparFiltros = document.getElementById('btnLimparFiltrosUsers');

            function aplicarFiltrosUsers() {
                usersFilters.nome = inputPesquisa.value.trim();
                usersFilters.nivel = filtroNivel.value;
                usersFilters.estado = filtroEstado.value;
                carregarUtilizadores(1);
            }

            function limparFiltrosUsers() {
                inputPesquisa.value = '';
                filtroNivel.value = '';
                filtroEstado.value = '';
                usersFilters = { nome: '', nivel: '', estado: '' };
                carregarUtilizadores(1);
            }

            // Event listeners
            btnFiltrar.addEventListener('click', aplicarFiltrosUsers);
            btnLimparFiltros.addEventListener('click', limparFiltrosUsers);

            // Enter na pesquisa
            inputPesquisa.addEventListener('keyup', function(e) {
                if (e.key === 'Enter') {
                    aplicarFiltrosUsers();
                }
            });

            // Botão "Novo Utilizador" – reset do modal
            document.getElementById('btnNovoUser').addEventListener('click', function() {
                modoUser = 'create';
                document.getElementById('formNovoUser').reset();
                document.getElementById('userId').value = '';
                document.getElementById('modalNovoUserLabel').textContent = 'Novo Utilizador';
                document.getElementById('btnGuardarUserLabel').textContent = 'Registar Utilizador';
                document.getElementById('fotoZone').innerHTML = '<i class="bi bi-person-circle"></i><span>Carregar foto</span>';
                document.getElementById('fotoZone').style.border = '2px dashed var(--border)';
                document.getElementById('userCreatedAt').textContent = '— (novo registo)';
                document.getElementById('userUpdatedAt').textContent = '— (novo registo)';
                document.getElementById('pwdFill').style.width = '0%';
                document.getElementById('pwdLabel').textContent = 'Introduza a senha';
                document.getElementById('pwdMatchMsg').textContent = '';

                // Força a primeira tab
                document.querySelectorAll('.modal-user-tab-btn').forEach(b => b.classList.remove('active'));
                document.querySelectorAll('.modal-user-tab-panel').forEach(p => p.classList.remove('active'));
                document.querySelector('.modal-user-tab-btn[data-user-tab="dados"]').classList.add('active');
                document.getElementById('utab-dados').classList.add('active');
            });

            // Tabs do modal utilizador
            document.querySelectorAll('.modal-user-tab-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const tab = this.dataset.userTab;
                    document.querySelectorAll('.modal-user-tab-btn').forEach(b => b.classList.remove('active'));
                    this.classList.add('active');
                    document.querySelectorAll('.modal-user-tab-panel').forEach(p => p.classList.remove('active'));
                    document.getElementById('utab-' + tab).classList.add('active');
                });
            });

            // Funções de senha
            window.avaliarSenha = function(val) {
                const fill = document.getElementById('pwdFill');
                const label = document.getElementById('pwdLabel');
                const confirm = document.getElementById('userPasswordConfirm');

                let score = 0;
                if (val.length >= 8) score++;
                if (/[A-Z]/.test(val)) score++;
                if (/[0-9]/.test(val)) score++;
                if (/[^A-Za-z0-9]/.test(val)) score++;

                const configs = [
                    { w: '0%', color: 'var(--border)', text: 'Introduza a senha' },
                    { w: '25%', color: '#C62828', text: 'Fraca' },
                    { w: '50%', color: '#F57F17', text: 'Razoável' },
                    { w: '75%', color: '#1565C0', text: 'Boa' },
                    { w: '100%', color: '#2E7D32', text: 'Forte' },
                ];
                const c = configs[score] || configs[0];
                fill.style.width = c.w;
                fill.style.background = c.color;
                label.textContent = c.text;
                label.style.color = c.color;

                // Verificar confirmação
                const pwd = document.getElementById('userPassword').value;
                const conf = document.getElementById('userPasswordConfirm').value;
                const msg = document.getElementById('pwdMatchMsg');
                if (!conf) { msg.textContent = ''; return; }
                if (pwd === conf) {
                    msg.textContent = '✓ As senhas coincidem';
                    msg.style.color = '#2E7D32';
                } else {
                    msg.textContent = '✗ As senhas não coincidem';
                    msg.style.color = '#C62828';
                }
            };

            window.togglePwd = function(inputId, iconId) {
                const input = document.getElementById(inputId);
                const icon = document.getElementById(iconId);
                if (input.type === 'password') {
                    input.type = 'text';
                    icon.className = 'bi bi-eye-slash-fill';
                } else {
                    input.type = 'password';
                    icon.className = 'bi bi-eye-fill';
                }
            };

            document.getElementById('userPasswordConfirm').addEventListener('input', function() {
                window.avaliarSenha(document.getElementById('userPassword').value);
            });

            // Preview foto
            document.getElementById('fotoInput').addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (!file) return;
                const reader = new FileReader();
                reader.onload = function(ev) {
                    const zone = document.getElementById('fotoZone');
                    zone.innerHTML =
                        `<img src="${ev.target.result}" style="width:100%;height:100%;object-fit:cover;border-radius:50%;">`;
                    zone.style.border = '2px solid var(--primary)';
                };
                reader.readAsDataURL(file);
            });


            // ----------------------------------------------
            // 4. ANOS AGRÍCOLAS – CRUD completo
            // ----------------------------------------------

            let anosPage = 1;
            let anosFilters = { nome: '', estado: '' };

            // 4.1 Carregar anos agrícolas
            function carregarAnosAgricolas(page = 1) {
                anosPage = page;
                const params = new URLSearchParams({
                    page: page,
                    nome: anosFilters.nome,
                    estado: anosFilters.estado
                });

                fetch(`/ano_agricola?${params}`, {
                    headers: { 'Accept': 'application/json' }
                })
                    .then(res => {
                        if (!res.ok) {
                            throw new Error(`HTTP ${res.status}: ${res.statusText}`);
                        }
                        return res.json();
                    })
                    .then(data => {
                        renderTabelaAnosAgricolas(data.data);
                        renderPaginacaoAnosAgricolas(data);
                    })
                    .catch(err => {
                        console.error('Erro ao carregar anos agrícolas:', err);
                        showToast('Erro', 'Falha ao carregar anos agrícolas: ' + err.message, 'danger');
                    });
            }

            // 4.2 Renderizar tabela de anos
            function renderTabelaAnosAgricolas(anos) {
                const tbody = document.getElementById('corpoTabelaAnos');
                if (!tbody) return;

                if (!anos || anos.length === 0) {
                    tbody.innerHTML = `
                        <tr>
                            <td colspan="6" style="text-align:center;padding:40px;color:var(--text-light);">
                                <i class="bi bi-inbox" style="font-size:28px;display:block;margin-bottom:8px;"></i>
                                Nenhum ano agrícola registado.
                            </td>
                        </tr>
                    `;
                    return;
                }

                tbody.innerHTML = anos.map(a => {
                    let estadoLabel = '';
                    let cor = '';
                    if (a.estado === 'em_producao') {
                        estadoLabel = 'Em Produção';
                        cor = '#2E7D32';
                    } else if (a.estado === 'iniciado') {
                        estadoLabel = 'Iniciado';
                        cor = '#F57F17';
                    } else {
                        estadoLabel = 'Finalizado';
                        cor = '#757575';
                    }

                    return `
                        <tr id="ano-row-${a.id}">
                            <td>
                                <div style="font-weight:600;">${a.nome}</div>
                                <div style="font-size:11px;color:var(--text-light);">ID #${a.id}</div>
                            </td>
                            <td>${formatarData(a.data_inicio)}</td>
                            <td>${formatarData(a.data_fim)}</td>
                            <td>
                                <span style="font-size:11px;font-weight:600;background:#E8F5E9;color:${cor};padding:3px 10px;border-radius:20px;">
                                    ${estadoLabel}
                                </span>
                            </td>
                            <td>${formatarData(a.created_at, 'd M Y')}</td>
                            <td style="text-align:center;">
                                <div style="display:flex;gap:6px;justify-content:center;">
                                    <button class="topbar-icon-btn btn-editar-ano" title="Editar"
                                            data-id="${a.id}"
                                            data-nome="${a.nome}"
                                            data-inicio="${a.data_inicio}"
                                            data-fim="${a.data_fim}"
                                            data-estado="${a.estado}">
                                        <i class="bi bi-pencil-fill"></i>
                                    </button>
                                    <button class="topbar-icon-btn btn-eliminar-ano" title="Eliminar"
                                            data-id="${a.id}">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    `;
                }).join('');

                // Reatribuir eventos
                document.querySelectorAll('.btn-editar-ano').forEach(btn => {
                    btn.removeEventListener('click', handleEditAno);
                    btn.addEventListener('click', handleEditAno);
                });
                document.querySelectorAll('.btn-eliminar-ano').forEach(btn => {
                    btn.removeEventListener('click', handleDeleteAno);
                    btn.addEventListener('click', handleDeleteAno);
                });
            }

            // 4.3 Renderizar paginação de anos
            function renderPaginacaoAnosAgricolas(data) {
                const info = document.getElementById('infoAnos');
                const container = document.getElementById('paginacaoLinksAnos');
                if (!info || !container) return;

                info.textContent = data.total > 0 ?
                    `Mostrando ${data.from || 0} - ${data.to || 0} de ${data.total} registos` :
                    'Nenhum registo encontrado';

                container.innerHTML = '';

                if (data.last_page <= 1) return;

                // Botão Anterior
                const prev = document.createElement('li');
                prev.className = `page-item ${data.prev_page_url ? '' : 'disabled'}`;
                prev.innerHTML = `<a class="page-link" href="#" onclick="carregarAnosAgricolas(${data.current_page - 1});return false;">«</a>`;
                container.appendChild(prev);

                // Números
                const maxShow = 5;
                let start = Math.max(1, data.current_page - 2);
                let end = Math.min(data.last_page, start + maxShow - 1);
                if (end - start < maxShow - 1) start = Math.max(1, end - maxShow + 1);

                for (let i = start; i <= end; i++) {
                    const li = document.createElement('li');
                    li.className = `page-item ${i === data.current_page ? 'active' : ''}`;
                    li.innerHTML = `<a class="page-link" href="#" onclick="carregarAnosAgricolas(${i});return false;">${i}</a>`;
                    container.appendChild(li);
                }

                // Botão Próximo
                const next = document.createElement('li');
                next.className = `page-item ${data.next_page_url ? '' : 'disabled'}`;
                next.innerHTML = `<a class="page-link" href="#" onclick="carregarAnosAgricolas(${data.current_page + 1});return false;">»</a>`;
                container.appendChild(next);
            }

            // 4.4 Abrir modal para editar ano
            function abrirModalEditarAno(id) {
                fetch(`/ano_agricola/${id}`)
                    .then(r => r.json())
                    .then(data => {
                        const ano = data.data || data;
                        document.getElementById('anoId').value = ano.id;
                        document.getElementById('anoNome').value = ano.nome;
                        document.getElementById('anoInicio').value = normalizarDataInput(ano.data_inicio);
                        document.getElementById('anoFim').value = normalizarDataInput(ano.data_fim);
                        document.getElementById('anoEstado').value = ano.estado;
                        document.getElementById('modalAnoLabel').textContent = 'Editar Ano Agrícola';
                        document.getElementById('btnGuardarAnoLabel').textContent = 'Guardar Alterações';
                        const modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('modalAnoAgricola'));
                        modal.show();
                    })
                    .catch(err => {
                        showToast('Erro', 'Falha ao carregar dados do ano.', 'danger');
                        console.error(err);
                    });
            }

            // 4.5 Handlers para ano
            function handleEditAno(e) {
                const id = e.currentTarget.dataset.id;
                abrirModalEditarAno(id);
            }

            function handleDeleteAno(e) {
                const id = e.currentTarget.dataset.id;
                if (!confirm('Tem a certeza que deseja eliminar este Ano Agrícola? Esta acção é irreversível.')) return;

                fetch(`/ano_agricola/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    }
                })
                    .then(r => r.json())
                    .then(data => {
                        if (data.success) {
                            document.getElementById(`ano-row-${id}`)?.remove();
                            showToast('Ano Agrícola eliminado', 'Registo removido com sucesso.');
                            setTimeout(() => carregarAnosAgricolas(anosPage), 300);
                        } else {
                            showToast('Erro', data.message || 'Não foi possível eliminar.', 'danger');
                        }
                    })
                    .catch(() => showToast('Erro', 'Problema de ligação.', 'danger'));
            }

            // 4.6 Guardar ano (criar ou editar)
            function guardarAno() {
                const id = document.getElementById('anoId').value;
                const nome = document.getElementById('anoNome').value.trim();
                const inicio = document.getElementById('anoInicio').value;
                const fim = document.getElementById('anoFim').value;
                const estado = document.getElementById('anoEstado').value;

                if (!nome || !inicio || !fim || !estado) {
                    showToast('Campos obrigatórios', 'Preencha todos os campos marcados com *.', 'warning');
                    return;
                }
                if (fim < inicio) {
                    showToast('Datas inválidas', 'A data de fim não pode ser anterior à data de início.', 'danger');
                    return;
                }

                const btn = document.getElementById('btnGuardarAno');
                const orig = btn.innerHTML;
                btn.innerHTML = '<i class="bi bi-hourglass-split"></i> A guardar…';
                btn.disabled = true;

                const url = id ? `/ano_agricola/${id}` : '/ano_agricola';
                const method = id ? 'PUT' : 'POST';

                fetch(url, {
                    method: method,
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        nome: nome,
                        data_inicio: inicio,
                        data_fim: fim,
                        estado: estado
                    })
                })
                    .then(r => r.json())
                    .then(data => {
                        btn.innerHTML = orig;
                        btn.disabled = false;

                        if (data.success) {
                            bootstrap.Modal.getInstance(document.getElementById('modalAnoAgricola')).hide();
                            showToast(
                                id ? 'Ano actualizado' : 'Ano registado',
                                data.message || 'Operação concluída.'
                            );
                            carregarAnosAgricolas(anosPage);
                        } else {
                            showToast('Erro', data.message || 'Falha ao guardar.', 'danger');
                        }
                    })
                    .catch(() => {
                        btn.innerHTML = orig;
                        btn.disabled = false;
                        showToast('Erro de ligação', 'Verifique a sua conexão.', 'danger');
                    });
            }

            // 4.7 Configurar eventos
            document.getElementById('btnGuardarAno').addEventListener('click', guardarAno);

            // Botão "Registar Ano Agrícola" – reset do modal
            document.getElementById('btnIniciarAno').addEventListener('click', function() {
                document.getElementById('formAnoAgricola').reset();
                document.getElementById('anoId').value = '';
                document.getElementById('modalAnoLabel').textContent = 'Registar Ano Agrícola';
                document.getElementById('btnGuardarAnoLabel').textContent = 'Registar Ano';
            });


            // ----------------------------------------------
            // 5. SETTINGS TABS
            // ----------------------------------------------

            document.querySelectorAll('.settings-nav-item').forEach(btn => {
                btn.addEventListener('click', function() {
                    const tab = this.dataset.tab;

                    document.querySelectorAll('.settings-nav-item').forEach(b => b.classList.remove('active'));
                    this.classList.add('active');

                    document.querySelectorAll('.settings-panel').forEach(p => {
                        p.classList.remove('active');
                    });
                    const panel = document.getElementById('tab-' + tab);
                    if (panel) {
                        panel.classList.add('active');
                        // Re-trigger animations
                        panel.querySelectorAll('.anim').forEach(el => {
                            el.style.animation = 'none';
                            el.offsetHeight;
                            el.style.animation = '';
                        });
                    }

                    // Recarregar dados quando a tab for ativada
                    if (tab === 'utilizadores') {
                        const tbody = document.getElementById('tabela-utilizadores');
                        if (tbody && tbody.children.length === 0) {
                            carregarUtilizadores(usersPage);
                        }
                    }
                    if (tab === 'empresa') {
                        const tbody = document.getElementById('corpoTabelaAnos');
                        if (tbody && tbody.children.length === 0) {
                            carregarAnosAgricolas(anosPage);
                        }
                    }
                });
            });


            // ----------------------------------------------
            // 6. SIDEBAR TOGGLE
            // ----------------------------------------------

            const body = document.body;
            let sideState = body.classList.contains('icons-only') ? 1 :
                body.classList.contains('sidebar-hidden') ? 2 : 0;

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
                let novoEstado = (width < 760) ? 1 : 0;
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

            applyTooltips();
            window.addEventListener('resize', handleResize);

            document.getElementById('sidebarToggle').addEventListener('click', () => {
                sideState = (sideState + 1) % 3;
                body.classList.remove('icons-only', 'sidebar-hidden');
                if (sideState === 1) body.classList.add('icons-only');
                if (sideState === 2) body.classList.add('sidebar-hidden');
                applyTooltips();
            });

            // Remove no-transition após carregamento
            requestAnimationFrame(() => {
                requestAnimationFrame(() => {
                    body.classList.remove('no-transition');
                });
            });


            // ----------------------------------------------
            // 7. DARK MODE
            // ----------------------------------------------

            const themeToggle = document.getElementById('themeToggle');
            const themeIcon = document.getElementById('themeIcon');
            const themeLabel = document.getElementById('themeLabel');
            let darkMode = false;

            if (themeToggle) {
                themeToggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    darkMode = !darkMode;
                    body.classList.toggle('dark-mode', darkMode);
                    themeIcon.className = darkMode ? 'bi bi-sun-fill' : 'bi bi-moon-stars-fill';
                    themeLabel.textContent = darkMode ? 'Modo Claro' : 'Modo Escuro';
                });
            }

            // Tema visual
            document.querySelectorAll('.theme-option').forEach(opt => {
                opt.addEventListener('click', () => {
                    document.querySelectorAll('.theme-option').forEach(o => o.classList.remove('selected'));
                    opt.classList.add('selected');
                    const t = opt.dataset.theme;
                    if (t === 'escuro') {
                        body.classList.add('dark-mode');
                        darkMode = true;
                        themeIcon.className = 'bi bi-sun-fill';
                        themeLabel.textContent = 'Modo Claro';
                    } else {
                        body.classList.remove('dark-mode');
                        darkMode = false;
                        themeIcon.className = 'bi bi-moon-stars-fill';
                        themeLabel.textContent = 'Modo Escuro';
                    }
                });
            });

            // Cor principal
            document.querySelectorAll('.color-swatch').forEach(swatch => {
                swatch.addEventListener('click', () => {
                    document.querySelectorAll('.color-swatch').forEach(s => s.classList.remove('selected'));
                    swatch.classList.add('selected');
                    document.documentElement.style.setProperty('--primary', swatch.dataset.color);
                });
            });


            // ----------------------------------------------
            // 8. PERMISSÕES – Salvar
            // ----------------------------------------------

            document.getElementById('btnSalvarPermissoes').addEventListener('click', function() {
                const btn = this;
                const orig = btn.innerHTML;
                btn.innerHTML = '<i class="bi bi-hourglass-split"></i> A guardar…';
                btn.disabled = true;

                // Recolhe todas as permissões (checkboxes não desativadas)
                const permissoes = {};

                document.querySelectorAll('.perm-check:not(:disabled)').forEach(checkbox => {
                    // Obtém o texto da linha para identificar a permissão
                    const row = checkbox.closest('tr');
                    const acao = row?.querySelector('td:first-child')?.textContent?.trim() || 'desconhecido';

                    // Obtém o módulo (título da seção anterior)
                    let modulo = 'Geral';
                    let prev = row?.previousElementSibling;
                    while (prev) {
                        if (prev.tagName === 'TR' && prev.querySelector('td[colspan="5"]')) {
                            modulo = prev.textContent.trim();
                            break;
                        }
                        prev = prev.previousElementSibling;
                    }

                    // Obtém o nível (pelo cabeçalho da coluna)
                    const ths = document.querySelectorAll('.perm-table thead th');
                    let nivel = '';
                    const colIndex = Array.from(row?.querySelectorAll('td') || []).indexOf(checkbox.closest('td'));
                    if (colIndex >= 0 && ths[colIndex]) {
                        const badge = ths[colIndex].querySelector('.perm-role-badge');
                        if (badge) nivel = badge.textContent.trim();
                    }

                    const key = `${modulo}|${acao}|${nivel}`;
                    permissoes[key] = checkbox.checked;
                });

                console.log('Permissões a guardar:', permissoes);

                // Simula salvamento (substituir por fetch real depois)
                setTimeout(() => {
                    btn.innerHTML = orig;
                    btn.disabled = false;
                    showToast('Permissões guardadas', 'As permissões foram salvas com sucesso.');
                }, 800);
            });


            // ----------------------------------------------
            // 9. INICIALIZAÇÃO – carregar dados
            // ----------------------------------------------

            carregarUtilizadores(1);
            carregarAnosAgricolas(1);

        }); // fim DOMContentLoaded
    </script>

</body>

</html>