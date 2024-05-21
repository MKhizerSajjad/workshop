
<div class="topnav">
    <div class="container-fluid">
        <nav class="navbar navbar-light navbar-expand-lg topnav-menu">

            <div class="collapse navbar-collapse" id="topnav-menu-content">
                <ul class="navbar-nav">

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="{{route('dashboard')}}" id="topnav-dashboard" role="button"
                        >
                            <i class="bx bx-home-circle me-1"></i>
                            <span key="t-dashboards">Dashboards</span>
                        </a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none text-danger" href="{{route('tools')}}" id="topnav-dashboard" role="button"
                        >
                            <i class="bx bx-wrench me-1 text-danger"></i>
                            <span key="t-aitool">Tools</span>
                        </a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="{{route('ai-tools')}}" id="topnav-dashboard" role="button"
                        >
                            <i class="bx bx-bot me-1"></i>
                            <span key="t-aitool">AI Tools</span>
                        </a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="{{route('vpn.create')}}" id="topnav-dashboard" role="button"
                        >
                            <i class="bx bx-label me-1"></i>
                            <span key="t-aitool">VPN</span>
                        </a>
                    </li>
                    @if (Auth::user()->user_type == 1)
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle arrow-none" href="{{route('suggestion.index')}}" id="topnav-dashboard" role="button"
                            >
                                <i class="bx bx-message me-1"></i>
                                <span key="t-aitool">Suggestions</span>
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle arrow-none" href="{{route('notification.index')}}" id="topnav-dashboard" role="button"
                            >
                                <i class="bx bx-bell me-1"></i>
                                <span key="t-aitool">Notifications</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </div>

            @if (Auth::user()->user_type != 1)
                <div class="mt-2 text-center">
                    <button type="button" class="mb-1 btn btn-primary waves-effect btn-label waves-light btn-sm right-bar-toggle me-2"><i class="bx bx-help-circle label-icon"></i> Need Any Help</button>
                    <button type="button" class="mb-1 btn btn-success waves-effect btn-label waves-light btn-sm"  data-bs-toggle="modal" data-bs-target="#suggestionModal"><i class="bx bx-chat label-icon"></i> Have Suggestion</button>
                </div>
            @endif
        </nav>
    </div>
</div>
