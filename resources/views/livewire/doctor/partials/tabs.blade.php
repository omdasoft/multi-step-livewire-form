<ul class="nav nav-pills flex-column text-center profile-tabs">
    @foreach($tabs as $id => $title)
        @php
            $isCompleted = match($id) {
                'profile' => auth()->user()->drProfile()->exists(),
                'high-school' => $drProfile->highSchool()->exists(),
                'internship' => $drProfile->internship()->exists(),
                'default' => false
            }
        @endphp
        <li class="nav-item">
            <a class="nav-link {{ $id == $activeTab ? 'tab-active' : '' }} {{ !$isCompleted ? 'disabled' : '' }}" aria-current="page" href="{{ $id == 'profile' ? route("doctor.profile") : route("doctor.profile.{$id}") }}">
                @if($isCompleted)
                    <i class="fa fa-check-circle"></i>
                @endif
                {{ $title }}
            </a>
        </li>
    @endforeach
</ul>