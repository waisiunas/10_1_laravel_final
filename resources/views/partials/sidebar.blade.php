<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="{{ route('admin.dashboard') }}">
            <span class="align-middle">Magicians</span>
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('admin.dashboard') }}">
                    <i class="align-middle" data-feather="book"></i> <span class="align-middle">Dashboard</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('admin.subjects') }}">
                    <i class="align-middle" data-feather="book"></i> <span class="align-middle">Subjects</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('admin.topics') }}">
                    <i class="align-middle" data-feather="book"></i> <span class="align-middle">Topics</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{route('admin.questions')}}">
                    <i class="align-middle" data-feather="book"></i> <span class="align-middle">Questions</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
