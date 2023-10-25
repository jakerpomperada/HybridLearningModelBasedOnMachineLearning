<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            @if($role == 'admin')
            @include('template.sidebar-admin')
            @elseif($role == 'student')
                @include('template.sidebar-student')
            @else
                @include('template.sidebar-teacher')
            @endif
        </div>
    </div>
</div>
