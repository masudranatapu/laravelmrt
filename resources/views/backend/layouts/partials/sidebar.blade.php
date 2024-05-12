<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
        <a href="{{ route('backend.home') }}">
            <img alt="image" src="{{ asset('backend/img/logo.png') }}" class="header-logo" />
            <span class="logo-name">
                Otika
            </span>
        </a>
    </div>
    <ul class="sidebar-menu">
        <li class="menu-header">
            Main
        </li>
        <li class="dropdown active">
            <a href="{{ route('backend.home') }}" class="nav-link">
                <i data-feather="monitor"></i>
                <span>
                    Dashboard
                </span>
            </a>
        </li>
        <li class="dropdown">
            <a href="#" class="menu-toggle nav-link has-dropdown">
                <i data-feather="briefcase"></i>
                <span>
                    Supplier
                </span>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a class="nav-link" href="{{ route('backend.supplier.index') }}">
                        Supplier
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="portfolio.html">
                        Portfolio
                    </a>
                </li>
            </ul>
        </li>
        <li class="dropdown">
            <a href="javascript:;" class="menu-toggle nav-link has-dropdown">
                <i data-feather="command"></i>
                <span>
                    Customer
                </span>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a class="nav-link" href="{{ route('backend.customer.index') }}">
                        Customer
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="portfolio.html">
                        Portfolio
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="{{ route('backend.customers-group.index') }}">
                        Customer Group
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="{{ route('backend.area.index') }}">
                        Area
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-header">
            Product
        </li>
        <li class="dropdown">
            <a href="#" class="menu-toggle nav-link has-dropdown">
                <i data-feather="filter"></i>
                <span>
                    Product
                </span>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a class="nav-link" href="email-compose.html">
                        Add Product
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="email-inbox.html">
                        Product List
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="email-read.html">
                        Category
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="email-read.html">
                        Sub Category
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="email-read.html">
                        Child Category
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="email-read.html">
                        Brand
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="email-read.html">
                        Units
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-header">
            Accounts
        </li>
        <li class="dropdown">
            <a href="#" class="menu-toggle nav-link has-dropdown">
                <i data-feather="copy"></i>
                <span>
                    Accounts
                </span>
            </a>
            <ul class="dropdown-menu">
                <li class="{{ Route::is('admin.account.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('backend.account.index') }}">
                        Account list
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="badge.html">
                        Badge
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="breadcrumb.html">
                        Breadcrumb
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="buttons.html">
                        Buttons
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="collapse.html">
                        Collapse
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="dropdown.html">
                        Dropdown
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="checkbox-and-radio.html">
                        Checkbox &amp; Radios
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="list-group.html">
                        List Group
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="media-object.html">
                        Media Object
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="navbar.html">
                        Navbar
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="pagination.html">
                        Pagination
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="popover.html">
                        Popover
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="progress.html">
                        Progress
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="tooltip.html">
                        Tooltip
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="flags.html">
                        Flag
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="typography.html">
                        Typography
                    </a>
                </li>
            </ul>
        </li>
        <li class="dropdown">
            <a href="#" class="menu-toggle nav-link has-dropdown">
                <i data-feather="shopping-bag"></i>
                <span>
                    Advanced
                </span>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a class="nav-link" href="avatar.html">
                        Avatar
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="card.html">
                        Card
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="modal.html">
                        Modal
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="sweet-alert.html">
                        Sweet Alert
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="toastr.html">
                        Toastr
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="empty-state.html">
                        Empty State
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="multiple-upload.html">
                        Multiple Upload
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="pricing.html">
                        Pricing
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="tabs.html">
                        Tab
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a class="nav-link" href="blank.html">
                <i data-feather="file"></i>
                <span>
                    Blank Page
                </span>
            </a>
        </li>
        <li class="menu-header">Otika</li>
        <li class="dropdown">
            <a href="#" class="menu-toggle nav-link has-dropdown">
                <i data-feather="layout"></i>
                <span>
                    Forms
                </span>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a class="nav-link" href="basic-form.html">
                        Basic Form
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="forms-advanced-form.html">
                        Advanced Form
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="forms-editor.html">
                        Editor
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="forms-validation.html">
                        Validation
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="form-wizard.html">
                        Form Wizard
                    </a>
                </li>
            </ul>
        </li>
        <li class="dropdown">
            <a href="#" class="menu-toggle nav-link has-dropdown">
                <i data-feather="grid"></i>
                <span>
                    Tables
                </span>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a class="nav-link" href="basic-table.html">
                        Basic Tables
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="advance-table.html">
                        Advanced Table
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="datatables.html">
                        Datatable
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="export-table.html">
                        Export Table
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="editable-table.html">
                        Editable Table
                    </a>
                </li>
            </ul>
        </li>
        <li class="dropdown">
            <a href="#" class="menu-toggle nav-link has-dropdown">
                <i data-feather="pie-chart"></i>
                <span>
                    Charts
                </span>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a class="nav-link" href="chart-amchart.html">
                        amChart
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="chart-apexchart.html">
                        apexchart
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="chart-echart.html">
                        eChart
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="chart-chartjs.html">
                        Chartjs
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="chart-sparkline.html">
                        Sparkline
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="chart-morris.html">
                        Morris
                    </a>
                </li>
            </ul>
        </li>
        <li class="dropdown">
            <a href="#" class="menu-toggle nav-link has-dropdown">
                <i data-feather="feather"></i>
                <span>
                    Icons
                </span>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a class="nav-link" href="icon-font-awesome.html">
                        Font Awesome
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="icon-material.html">
                        Material Design
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="icon-ionicons.html">
                        Ion Icons
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="icon-feather.html">
                        Feather Icons
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="icon-weather-icon.html">
                        Weather Icon
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</aside>
