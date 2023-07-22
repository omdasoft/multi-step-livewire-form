<aside class="sidebar">
    <div class="user">
        <div class="profile-image">
            <img src="{{ asset('images/profile.jpg') }}">
        </div>
        <h5 class="text-center mt-2">Welcome, {{ Auth::user()->name }}</h5>
    </div>
    <ul>
        <li>
            <a href="{{ route('doctor.dashbaord') }}" class="{{ request()->routeIs('doctor.dashbaord') ? 'active' : '' }}">Dashboard</a>
        </li>
        <li>
            <a href="{{ route('doctor.profile') }}" class="{{ request()->routeIs('doctor.profile') || request()->routeIs('doctor.profile.*') ? 'active' : '' }}">Create Profile</a>
        </li>
        <li>
            <a href="#">Edit Profile</a>
        </li>
    </ul>
</aside>