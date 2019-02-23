<div class="col-md-3">
    <div class="card border-0">
        <ul class="list-group">
            <li class="list-group-item {{ Request::is('admin') ? 'bg-light' : '' }}">
                <a href="{{ route('admin.index') }}" class="text-dark {{ Request::is('admin') ? 'font-weight-bold' : '' }}">Dashboard</a>
            </li>
            <li class="list-group-item {{ Request::is('admin/lostuser') ? 'bg-light' : '' }}">
                <a href="{{ route('admin.user.lost') }}" class="text-dark {{ Request::is('admin/lostuser') ? 'font-weight-bold' : '' }}">Lost</a>
            </li>
            <li class="list-group-item {{ Request::is('admin/returned') ? 'bg-light' : '' }}">
                <a href="{{ route('admin.user.returned') }}" class="text-dark {{ Request::is('admin/returned') ? 'font-weight-bold' : '' }}">Returned</a>
            </li>
        </ul>
    </div>
</div>