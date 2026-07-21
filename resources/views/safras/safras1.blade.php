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

        .badge-status {
            font-size: 12px;
            font-weight: 500;
            padding: 0;
            background: none;
            border-radius: 0;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .badge-status.activa {
            color: #2E7D32;
        }

        .badge-status.inactiva {
            color: #C62828;
        }

        .badge-status.pendente {
            color: #F57F17;
        }

        .badge-status.concluida {
            color: #1565C0;
        }

        .badge-status .dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            display: inline-block;
        }

        .badge-status.activa .dot {
            background: #2E7D32;
        }

        .badge-status.inactiva .dot {
            background: #C62828;
        }

        .badge-status.pendente .dot {
            background: #F57F17;
        }

        .badge-status.concluida .dot {
            background: #1565C0;
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

        .action-btn.view {
            background: #EDE7F6;
            color: #6A1B9A;
        }

        .action-btn.view:hover {
            background: #6A1B9A;
            color: #fff;
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

        .page-btn:disabled {
            opacity: .4;
            cursor: not-allowed;
        }

        /* ── MODAL SAFRA ── */
        .modal-coop {
            max-width: 2000px;
        }

        .modal-coop .modal-content {
            max-height: 90vh;
            display: flex;
            flex-direction: column;
        }

        .modal-coop .modal-body {
            overflow-y: auto;
            flex: 1;
            padding: 20px;
            background: var(--page-bg);
            scrollbar-width: thin;
            scrollbar-color: rgba(0, 0, 0, .15) transparent;
        }

        .modal-coop .modal-body::-webkit-scrollbar {
            width: 5px;
        }

        .modal-coop .modal-body::-webkit-scrollbar-thumb {
            background: rgba(0, 0, 0, .15);
            border-radius: 10px;
        }

        body.dark-mode .modal-coop .modal-body::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, .15);
        }

        .modal-form-card {
            background: var(--card-bg);
            border-radius: 14px;
            border: 1px solid var(--border);
            padding: 20px 22px;
            margin-bottom: 16px;
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

        .cfg-textarea {
            width: 100%;
            border: 1.5px solid var(--border);
            border-radius: 10px;
            padding: 11px 14px;
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

        /* ── MODAL HEADER / FOOTER ── */
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

        .modal-footer {
            padding: 14px 20px;
            border-top: 1px solid var(--border);
            background: #fff;
            flex-shrink: 0;
        }

        /* ── MODAL DELETE (mesmo layout da cooperativa) ── */
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

        .modal-delete .delete-warning-box .safra-name {
            font-family: 'Sora', sans-serif;
            font-weight: 700;
            font-size: 15px;
            color: #C62828;
        }

        /* ── TOAST ── */
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

        /* ── ANIMATIONS ── */
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

        /* ── DARK MODE ── */
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

        body.dark-mode .page-btn {
            background: #1e2a20;
            color: #e8f0e9;
            border-color: rgba(255, 255, 255, .1);
        }

        body.dark-mode .modal-coop .modal-body::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, .15);
        }

        /* ── RESPONSIVE ── */
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

            .modal-coop {
                max-width: 100%;
                margin: 10px;
            }

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
            <div class="logo-text-wrap" style="opacity:1;transition:opacity .2s;white-space:nowrap;">
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
            <a href="#" class="nav-item-link active" data-label="Safras"><i class="bi bi-flower2"></i><span
                    class="nav-label">Safras</span></a>
            <a href="{{ route('talhoes.index') }}" class="nav-item-link" data-label="Talhões"><i
                    class="bi bi-map-fill"></i><span class="nav-label">Talhões</span></a>
            <a href="{{ route('insumos.index') }}" class="nav-item-link" data-label="Insumos"><i
                    class="bi bi-box-seam-fill"></i><span class="nav-label">Insumos</span></a>

            <div class="nav-section-title">Comercial</div>
            <a href="{{ route('vendas') }}" class="nav-item-link" data-label="Vendas"><i
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

    <!-- ══════════════════════════════════════
         TOPBAR
    ═══════════════════════════════════════ -->
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
                        <img src="{{ Auth::check() ? Auth::user()->foto_url : asset('uploads/users/default-user.png') }}"
                            alt="Foto-perfil" class="avatar-md">
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
                    <h1>Gestão de Safras</h1>
                    <p>Registo e administração das safras agrícolas da cooperativa</p>
                </div>
                <div style="display:flex;gap:10px;flex-wrap:wrap;">
                    <button class="btn-outline-green" id="btnExportar">
                        <i class="bi bi-download"></i> Exportar
                    </button>
                    <button class="btn-green" id="btnNovaSafra">
                        <i class="bi bi-plus-lg"></i> Nova Safra
                    </button>
                </div>
            </div>

            <!-- Stat Cards -->
            <div class="row g-3 mb-4 anim anim-d1">
                <div class="col-6 col-xl-3">
                    <div class="stat-card">
                        <div class="stat-icon green"><i class="bi bi-flower2"></i></div>
                        <div class="stat-info">
                            <div class="s-label">Total de Safras</div>
                            <div class="s-value" id="totalSafras">0</div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-xl-3">
                    <div class="stat-card">
                        <div class="stat-icon blue"><i class="bi bi-check-circle-fill"></i></div>
                        <div class="stat-info">
                            <div class="s-label">Safras Activas</div>
                            <div class="s-value" id="safrasActivas">0</div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-xl-3">
                    <div class="stat-card">
                        <div class="stat-icon amber"><i class="bi bi-clock-fill"></i></div>
                        <div class="stat-info">
                            <div class="s-label">Pendentes</div>
                            <div class="s-value" id="safrasPendentes">0</div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-xl-3">
                    <div class="stat-card">
                        <div class="stat-icon purple"><i class="bi bi-check-all"></i></div>
                        <div class="stat-info">
                            <div class="s-label">Encerradas</div>
                            <div class="s-value" id="safrasConcluidas">0</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Table Card -->
            <div class="table-card anim anim-d2">

                <div class="table-card-header">
                    <div style="display:flex;align-items:center;gap:12px;">
                        <h5><i class="bi bi-flower2 me-2" style="color:var(--primary);"></i>Lista de Safras</h5>
                    </div>
                    <div style="display:flex;gap:8px;align-items:center;">
                        <span style="font-size:12.5px;color:var(--text-light);" id="totalRegistos">0 registos</span>
                    </div>
                </div>

                <div class="search-filter-bar">
                    <div class="search-wrap">
                        <i class="bi bi-search"></i>
                        <input type="text" class="search-input" id="searchSafra" placeholder="Pesquisar por nome da safra...">
                    </div>
                    <select class="filter-select" id="filterEstado">
                        <option value="">Todos os estados</option>
                        <option value="activa">Activa</option>
                        <option value="inactiva">Encerrada</option>
                        <option value="pendente">Planeada</option>
                    </select>
                    <select class="filter-select" id="filterCooperativa">
                        <option value="">Todas as cooperativas</option>
                        <!-- Preenchido via JS -->
                    </select>
                    <button class="btn-green" id="btnFiltrar" style="padding:8px 18px;">
                        <i class="bi bi-search"></i> Filtrar
                    </button>
                    <button class="btn-outline-green" id="btnLimparFiltros" style="padding:8px 18px;">
                        <i class="bi bi-eraser"></i> Limpar
                    </button>
                </div>

                <div style="overflow-x:auto;">
                    <table class="safra-table">
                        <thead>
                            <tr>
                                <th style="width:40px;">
                                    <input type="checkbox" id="selectAll"
                                        style="accent-color:var(--primary);width:15px;height:15px;cursor:pointer;">
                                </th>
                                <th>Nome</th>
                                <th>Ano</th>
                                <th>Data Início</th>
                                <th>Data Fim</th>
                                <th>Cooperativa</th>
                                <th>Estado</th>
                                <th style="text-align:center;">Acções</th>
                            </tr>
                        </thead>
                        <tbody id="safraTableBody">
                            <!-- Carregado via AJAX -->
                        </tbody>
                    </table>
                </div>

                <div class="table-footer">
                    <span id="tableCount">Carregando...</span>
                    <div class="pagination-btns" id="paginacaoSafras">
                        <!-- Carregado via JS -->
                    </div>
                </div>

            </div>

        </div>
    </main>

    <!-- ══════════════════════════════════════
         MODAL — SAFRA (CRIAR/EDITAR)
    ═══════════════════════════════════════ -->
    <div class="modal fade modal-coop" id="modalSafra" tabindex="-1" aria-labelledby="modalSafraLabel" aria-hidden="true"
        data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <div style="display:flex;align-items:center;gap:14px;flex:1;">
                        <div class="modal-header-icon"><i class="bi bi-flower2"></i></div>
                        <div>
                            <div class="modal-title" id="modalSafraLabel">Nova Safra</div>
                            <div style="font-size:12px;color:rgba(255,255,255,.65);margin-top:2px;" id="modalSafraSub">
                                Registe uma nova safra agrícola
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>

                <div class="modal-body">
                    <form id="formSafra" novalidate>
                        @csrf
                        <input type="hidden" id="safraId" name="id" value="">

                        <div class="modal-form-card">
                            <div class="modal-section-title">
                                <i class="bi bi-flower2"></i> Dados da Safra
                            </div>
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="cfg-label" for="safraNome">Nome da Safra *</label>
                                    <input type="text" class="cfg-input" id="safraNome" name="nome"
                                        placeholder="Ex: Safra 2024/2025 - Milho" required>
                                </div>

                                <div class="col-12 col-md-6">
                                    <label class="cfg-label" for="safraAno">Ano *</label>
                                    <input type="number" class="cfg-input" id="safraAno" name="ano"
                                        placeholder="Ex: 2024" required min="2000" max="2100">
                                </div>

                                <div class="col-12 col-md-6">
                                    <label class="cfg-label" for="safraEstado">Estado *</label>
                                    <select class="cfg-select" id="safraEstado" name="estado" required>
                                        <option value="pendente">Planeada</option>
                                        <option value="activa" selected>Activa</option>
                                        <option value="concluida">Encerrada</option>
                                    </select>
                                </div>

                                <div class="col-12 col-md-6">
                                    <label class="cfg-label" for="safraDataInicio">Data de Início *</label>
                                    <input type="date" class="cfg-input" id="safraDataInicio" name="data_inicio" required>
                                </div>

                                <div class="col-12 col-md-6">
                                    <label class="cfg-label" for="safraDataFim">Data de Fim *</label>
                                    <input type="date" class="cfg-input" id="safraDataFim" name="data_fim" required>
                                </div>

                                <div class="col-12">
                                    <label class="cfg-label" for="safraCooperativa">Cooperativa *</label>
                                    <select class="cfg-select" id="safraCooperativa" name="cooperativa_id" required>
                                        <option value="">Seleccione uma cooperativa</option>
                                        <!-- Preenchido via JS -->
                                    </select>
                                </div>

                                <div class="col-12">
                                    <label class="cfg-label" for="safraDescricao">Descrição (opcional)</label>
                                    <textarea class="cfg-textarea" id="safraDescricao" name="descricao" rows="2"
                                        placeholder="Detalhes adicionais sobre a safra..."></textarea>
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
                            <button type="button" class="btn-green" id="btnSalvarSafra">
                                <i class="bi bi-check2-circle"></i>
                                <span id="btnSalvarSafraLabel">Registar Safra</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ══════════════════════════════════════
         MODAL — ELIMINAR SAFRA
    ═══════════════════════════════════════ -->
    <div class="modal fade modal-delete" id="modalDeleteSafra" tabindex="-1" aria-hidden="true">
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
                        Tem a certeza que deseja eliminar a safra:
                    </p>
                    <div class="delete-warning-box">
                        <div class="safra-name" id="deleteSafraNome">—</div>
                    </div>
                    <input type="hidden" id="deleteSafraId">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-outline-green" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn-green" id="btnConfirmDeleteSafra" style="background:#C62828;box-shadow:none;">
                        <i class="bi bi-trash-fill"></i> Eliminar Definitivamente
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
           SIDEBAR TOGGLE (3 estados) + RESPONSIVO
        ══════════════════════════════════════ */
        const body = document.body;

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
            if (!toast) return;
            const icon = toast.querySelector('.toast-icon');
            const iconI = icon.querySelector('i');
            const tTitle = toast.querySelector('.t-title');
            const tSub = toast.querySelector('.t-sub');

            tTitle.textContent = title;
            tSub.textContent = sub || '';

            icon.className = 'toast-icon ' + type;
            iconI.className = type === 'danger' ? 'bi bi-x-lg' :
                type === 'warning' ? 'bi bi-exclamation-triangle-fill' : 'bi bi-check-lg';

            toast.classList.add('show');
            clearTimeout(toast._timeout);
            toast._timeout = setTimeout(() => toast.classList.remove('show'), 3500);
        }

        /* ══════════════════════════════════════
           FUNÇÕES AUXILIARES
        ══════════════════════════════════════ */
        function formatarData(dateStr) {
            if (!dateStr) return '--';
            const d = new Date(dateStr);
            if (isNaN(d)) return dateStr;
            const dia = String(d.getDate()).padStart(2, '0');
            const mes = String(d.getMonth() + 1).padStart(2, '0');
            const ano = d.getFullYear();
            return `${dia}/${mes}/${ano}`;
        }

        function normalizarDataInput(dateStr) {
            if (!dateStr) return '';
            const iso = dateStr.match(/^(\d{4})-(\d{2})-(\d{2})/);
            if (iso) return iso[1] + '-' + iso[2] + '-' + iso[3];
            const dmy = dateStr.match(/^(\d{2})[\/\-](\d{2})[\/\-](\d{4})/);
            if (dmy) return `${dmy[3]}-${dmy[2]}-${dmy[1]}`;
            return '';
        }

        /* ══════════════════════════════════════
           CARREGAR COOPERATIVAS (rota já existente)
        ══════════════════════════════════════ */
        function carregarCooperativasSelect() {
            const selectModal = document.getElementById('safraCooperativa');
            const selectFiltro = document.getElementById('filterCooperativa');

            // Se ambos os selects já tiverem opções, não recarregar
            if (selectModal && selectModal.options.length > 1 && selectFiltro && selectFiltro.options.length > 1) {
                return;
            }

            fetch('api/cooperativas/list', {
                headers: { 'Accept': 'application/json' }
            })
            .then(r => r.json())
            .then(data => {
                const cooperativas = data.data || [];

                // Preencher select do modal
                if (selectModal) {
                    selectModal.innerHTML = '<option value="">Seleccione uma cooperativa</option>';
                    cooperativas.forEach(coop => {
                        selectModal.innerHTML += `<option value="${coop.id}">${coop.nome}</option>`;
                    });
                }

                // Preencher select do filtro
                if (selectFiltro) {
                    selectFiltro.innerHTML = '<option value="">Todas as cooperativas</option>';
                    cooperativas.forEach(coop => {
                        selectFiltro.innerHTML += `<option value="${coop.id}">${coop.nome}</option>`;
                    });
                }
            })
            .catch(err => console.error('Erro ao carregar cooperativas:', err));
        }

        /* ══════════════════════════════════════
           CRUD SAFRAS (AJAX)
        ══════════════════════════════════════ */
        let safrasPage = 1;
        let safrasFiltros = { nome: '', estado: '', cooperativa_id: '' };

        // Carregar safras
        function carregarSafras(page = 1) {
            safrasPage = page;
            const params = new URLSearchParams({
                page: page,
                nome: safrasFiltros.nome,
                estado: safrasFiltros.estado,
                cooperativa_id: safrasFiltros.cooperativa_id
            });

            fetch(`/api/safras/list?${params}`, {
                headers: { 'Accept': 'application/json' }
            })
            .then(res => {
                if (!res.ok) throw new Error(`HTTP ${res.status}: ${res.statusText}`);
                return res.json();
            })
            .then(data => {
                renderTabelaSafras(data.data);
                renderPaginacaoSafras(data);
                document.getElementById('totalSafras').textContent = data.total || 0;
                const ativas = data.data?.filter(s => s.estado === 'activa').length || 0;
                const pendentes = data.data?.filter(s => s.estado === 'pendente').length || 0;
                const concluidas = data.data?.filter(s => s.estado === 'concluida').length || 0;
                document.getElementById('safrasActivas').textContent = ativas;
                document.getElementById('safrasPendentes').textContent = pendentes;
                document.getElementById('safrasConcluidas').textContent = concluidas;
            })
            .catch(err => {
                console.error('Erro ao carregar safras:', err);
                showToast('Erro', 'Falha ao carregar safras: ' + err.message, 'danger');
            });
        }

        // Renderizar tabela
        function renderTabelaSafras(safras) {
            const tbody = document.getElementById('safraTableBody');
            if (!tbody) return;

            if (!safras || safras.length === 0) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="8" style="text-align:center;padding:40px;color:var(--text-light);">
                            <i class="bi bi-inbox" style="font-size:28px;display:block;margin-bottom:8px;"></i>
                            Nenhuma safra encontrada.
                        </td>
                    </tr>
                `;
                return;
            }

            tbody.innerHTML = safras.map(s => {
                const estadoLower = s.estado?.toLowerCase() || 'pendente';
                return `
                    <tr id="safra-row-${s.id}" data-estado="${estadoLower}" data-cooperativa="${s.cooperativa?.id || ''}">
                        <td>
                            <input type="checkbox" class="row-check" style="accent-color:var(--primary);width:15px;height:15px;cursor:pointer;">
                        </td>
                        <td>
                            <div style="font-weight:600;font-size:14px;">${s.nome}</div>
                            ${s.descricao ? `<div style="font-size:11.5px;color:var(--text-light);">${s.descricao.substring(0, 50)}</div>` : ''}
                        </td>
                        <td><strong>${s.ano || '--'}</strong></td>
                        <td>${formatarData(s.data_inicio)}</td>
                        <td>${formatarData(s.data_fim)}</td>
                        <td>${s.cooperativa?.nome || '--'}</td>
                        <td>
                            <span class="badge-status ${estadoLower}">
                                <span class="dot"></span>
                                ${estadoLower.charAt(0).toUpperCase() + estadoLower.slice(1)}
                            </span>
                        </td>
                        <td style="text-align:center;">
                            <div style="display:flex;gap:6px;justify-content:center;">
                                <button class="action-btn edit btn-editar-safra" title="Editar" data-id="${s.id}">
                                    <i class="bi bi-pencil-fill"></i>
                                </button>
                                <button class="action-btn delete btn-delete-safra" title="Eliminar" data-id="${s.id}" data-nome="${s.nome}">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                `;
            }).join('');

            document.querySelectorAll('.btn-editar-safra').forEach(btn => {
                btn.removeEventListener('click', handleEditSafra);
                btn.addEventListener('click', handleEditSafra);
            });
            document.querySelectorAll('.btn-delete-safra').forEach(btn => {
                btn.removeEventListener('click', handleDeleteSafra);
                btn.addEventListener('click', handleDeleteSafra);
            });

            const total = safras.length;
            const info = document.getElementById('tableCount');
            if (info) {
                info.textContent = `Mostrando ${total} de ${total} safras`;
            }
        }

        // Renderizar paginação
        function renderPaginacaoSafras(data) {
            const container = document.getElementById('paginacaoSafras');
            if (!container) return;

            container.innerHTML = '';

            if (data.last_page <= 1) {
                container.innerHTML = `
                    <button class="page-btn" disabled><i class="bi bi-chevron-left"></i></button>
                    <button class="page-btn active">1</button>
                    <button class="page-btn" disabled><i class="bi bi-chevron-right"></i></button>
                `;
                return;
            }

            const prev = document.createElement('button');
            prev.className = 'page-btn';
            prev.disabled = !data.prev_page_url;
            prev.innerHTML = '<i class="bi bi-chevron-left"></i>';
            if (!prev.disabled) {
                prev.addEventListener('click', () => carregarSafras(data.current_page - 1));
            }
            container.appendChild(prev);

            const maxShow = 5;
            let start = Math.max(1, data.current_page - 2);
            let end = Math.min(data.last_page, start + maxShow - 1);
            if (end - start < maxShow - 1) start = Math.max(1, end - maxShow + 1);

            for (let i = start; i <= end; i++) {
                const btn = document.createElement('button');
                btn.className = 'page-btn' + (i === data.current_page ? ' active' : '');
                btn.textContent = i;
                if (i !== data.current_page) {
                    btn.addEventListener('click', () => carregarSafras(i));
                }
                container.appendChild(btn);
            }

            const next = document.createElement('button');
            next.className = 'page-btn';
            next.disabled = !data.next_page_url;
            next.innerHTML = '<i class="bi bi-chevron-right"></i>';
            if (!next.disabled) {
                next.addEventListener('click', () => carregarSafras(data.current_page + 1));
            }
            container.appendChild(next);

            const info = document.getElementById('tableCount');
            if (info) {
                info.textContent = `Mostrando ${data.from || 0} - ${data.to || 0} de ${data.total || 0} safras`;
            }
        }

        // Abrir modal para criar/editar
        function abrirModalSafra(id = null) {
            const modal = new bootstrap.Modal(document.getElementById('modalSafra'));

            // Garantir que as cooperativas estão carregadas
            carregarCooperativasSelect();

            if (id) {
                fetch(`/api/safras/${id}`)
                    .then(r => r.json())
                    .then(data => {
                        const s = data.data || data;
                        document.getElementById('safraId').value = s.id;
                        document.getElementById('safraNome').value = s.nome || '';
                        document.getElementById('safraAno').value = s.ano || '';
                        document.getElementById('safraEstado').value = s.estado || 'Activa';
                        document.getElementById('safraDataInicio').value = normalizarDataInput(s.data_inicio);
                        document.getElementById('safraDataFim').value = normalizarDataInput(s.data_fim);
                        document.getElementById('safraDescricao').value = s.descricao || '';
                        const select = document.getElementById('safraCooperativa');
                        if (s.cooperativa_id) {
                            select.value = s.cooperativa_id;
                        }
                        document.getElementById('modalSafraLabel').textContent = 'Editar Safra';
                        document.getElementById('modalSafraSub').textContent = 'Actualizar dados da safra';
                        document.getElementById('btnSalvarSafraLabel').textContent = 'Actualizar Safra';
                        modal.show();
                    })
                    .catch(err => {
                        showToast('Erro', 'Falha ao carregar dados da safra.', 'danger');
                        console.error(err);
                    });
            } else {
                document.getElementById('safraId').value = '';
                document.getElementById('formSafra').reset();
                document.getElementById('modalSafraLabel').textContent = 'Nova Safra';
                document.getElementById('modalSafraSub').textContent = 'Registe uma nova safra agrícola';
                document.getElementById('btnSalvarSafraLabel').textContent = 'Registar Safra';
                const hoje = new Date().toISOString().split('T')[0];
                document.getElementById('safraDataInicio').value = hoje;
                document.getElementById('safraDataFim').value = hoje;
                modal.show();
            }
        }

        // Handlers
        function handleEditSafra(e) {
            const id = e.currentTarget.dataset.id;
            abrirModalSafra(id);
        }

        function handleDeleteSafra(e) {
            const id = e.currentTarget.dataset.id;
            const nome = e.currentTarget.dataset.nome;
            document.getElementById('deleteSafraId').value = id;
            document.getElementById('deleteSafraNome').textContent = nome;
            const modal = new bootstrap.Modal(document.getElementById('modalDeleteSafra'));
            modal.show();
        }

        // Guardar safra
        document.getElementById('btnSalvarSafra').addEventListener('click', function() {
            const id = document.getElementById('safraId').value;
            const nome = document.getElementById('safraNome').value.trim();
            const ano = document.getElementById('safraAno').value;
            const estado = document.getElementById('safraEstado').value;
            const data_inicio = document.getElementById('safraDataInicio').value;
            const data_fim = document.getElementById('safraDataFim').value;
            const cooperativa_id = document.getElementById('safraCooperativa').value;
            const descricao = document.getElementById('safraDescricao').value.trim();

            if (!nome || !ano || !data_inicio || !data_fim || !cooperativa_id) {
                showToast('Campos obrigatórios', 'Preencha todos os campos marcados com *.', 'warning');
                return;
            }
            if (data_fim < data_inicio) {
                showToast('Datas inválidas', 'A data de fim não pode ser anterior à data de início.', 'danger');
                return;
            }

            const btn = this;
            const orig = btn.innerHTML;
            btn.innerHTML = '<i class="bi bi-hourglass-split"></i> A guardar…';
            btn.disabled = true;

            const dados = { nome, ano, estado, data_inicio, data_fim, cooperativa_id, descricao };
            const url = id ? `/api/safras/${id}` : '/api/safras';
            const method = id ? 'PUT' : 'POST';

            fetch(url, {
                method: method,
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                },
                body: JSON.stringify(dados)
            })
            .then(r => r.json())
            .then(data => {
                btn.innerHTML = orig;
                btn.disabled = false;
                if (data.success) {
                    bootstrap.Modal.getInstance(document.getElementById('modalSafra')).hide();
                    showToast(
                        id ? 'Safra actualizada' : 'Safra registada',
                        data.message || 'Operação concluída.'
                    );
                    carregarSafras(safrasPage);
                } else {
                    showToast('Erro', data.message || 'Falha ao guardar.', 'danger');
                }
            })
            .catch(err => {
                btn.innerHTML = orig;
                btn.disabled = false;
                showToast('Erro de ligação', 'Verifique a sua conexão.', 'danger');
                console.error(err);
            });
        });

        // Eliminar safra
        document.getElementById('btnConfirmDeleteSafra').addEventListener('click', function() {
            const id = document.getElementById('deleteSafraId').value;

            fetch(`/api/safras/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                }
            })
            .then(r => r.json())
            .then(data => {
                if (data.success) {
                    document.getElementById(`safra-row-${id}`)?.remove();
                    bootstrap.Modal.getInstance(document.getElementById('modalDeleteSafra')).hide();
                    showToast('Safra eliminada', 'Registo removido com sucesso.');
                    setTimeout(() => carregarSafras(safrasPage), 300);
                } else {
                    showToast('Erro', data.message || 'Não foi possível eliminar.', 'danger');
                }
            })
            .catch(() => showToast('Erro', 'Problema de ligação.', 'danger'));
        });

        /* ══════════════════════════════════════
           FILTROS
        ══════════════════════════════════════ */
        const inputPesquisa = document.getElementById('searchSafra');
        const filterEstado = document.getElementById('filterEstado');
        const filterCooperativa = document.getElementById('filterCooperativa');
        const btnFiltrar = document.getElementById('btnFiltrar');
        const btnLimpar = document.getElementById('btnLimparFiltros');

        function aplicarFiltros() {
            safrasFiltros.nome = inputPesquisa.value.trim();
            safrasFiltros.estado = filterEstado.value;
            safrasFiltros.cooperativa_id = filterCooperativa.value;
            carregarSafras(1);
        }

        function limparFiltros() {
            inputPesquisa.value = '';
            filterEstado.value = '';
            filterCooperativa.value = '';
            safrasFiltros = { nome: '', estado: '', cooperativa_id: '' };
            carregarSafras(1);
        }

        btnFiltrar.addEventListener('click', aplicarFiltros);
        btnLimpar.addEventListener('click', limparFiltros);

        let timeoutId;
        inputPesquisa.addEventListener('input', function() {
            clearTimeout(timeoutId);
            timeoutId = setTimeout(aplicarFiltros, 500);
        });

        filterEstado.addEventListener('change', aplicarFiltros);
        filterCooperativa.addEventListener('change', aplicarFiltros);

        /* ══════════════════════════════════════
           SELECT ALL
        ══════════════════════════════════════ */
        document.getElementById('selectAll')?.addEventListener('change', function() {
            document.querySelectorAll('.row-check').forEach(cb => cb.checked = this.checked);
        });

        /* ══════════════════════════════════════
           EXPORTAR
        ══════════════════════════════════════ */
        document.getElementById('btnExportar')?.addEventListener('click', function() {
            showToast('A exportar…', 'O ficheiro será gerado em breve.');
        });

        /* ══════════════════════════════════════
           BOTÃO "NOVA SAFRA"
        ══════════════════════════════════════ */
        document.getElementById('btnNovaSafra')?.addEventListener('click', function() {
            abrirModalSafra();
        });

        /* ══════════════════════════════════════
           INICIALIZAÇÃO
        ══════════════════════════════════════ */
        document.addEventListener('DOMContentLoaded', function() {
            carregarCooperativasSelect();
            carregarSafras(1);
        });

    </script>

</body>

</html>