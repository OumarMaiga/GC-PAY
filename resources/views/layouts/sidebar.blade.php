@switch(Auth::user()->type)
    @case("admin-systeme")
        <div class="sidebar">
            <div class="sidebar-title">
                <a href="{{ route('dashboard.index') }}" class="sidebar-link">
                    TABLEAU DE BORD
                </a>
            </div>
            <ul class="sidebar-list">
                <li class="sidebar-item">
                    <a href="{{ route('structure.index') }}" class="sidebar-link">
                        STRUCTURE
                    </a>
                </li>
                <li class="sidebar-item dropdown-btn">
                    <a href="{{ route('admin.index') }}" class="sidebar-link">
                        ADMINISTRATEUR
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('rubrique.index') }}" class="sidebar-link">
                        RUBRIQUE
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('service.index') }}" class="sidebar-link">
                        SERVICE
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('entreprise.index') }}" class="sidebar-link">
                        ENTREPRISE
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('usager.index') }}" class="sidebar-link">
                        UTILISATEUR
                    </a>
                </li>
            </ul>
        </div>
        @break
    @case("admin-structure" || "agent")
        <div class="sidebar">
            <div class="sidebar-title">
                <a href="{{ route('dashboard.index') }}" class="sidebar-link">
                    TABLEAU DE BORD
                </a>
            </div>
            <ul class="sidebar-list">
                <li class="sidebar-item">
                    <a href="{{ route('service.index') }}" class="sidebar-link">
                        SERVICE
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('agent.index') }}" class="sidebar-link">
                        AGENT
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{route('requete.index')}}" class="sidebar-link">
                        DEMANDE
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{route('notification.index')}}" class="sidebar-link">
                        NOTIFICATION
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{route('requete.archives')}}" class="sidebar-link">
                        ARCHIVE
                    </a>
                </li>
            </ul>
        </div>
        @break
    @default
        
@endswitch
