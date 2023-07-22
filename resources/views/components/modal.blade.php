@props([ 'id' => Str::uuid(), 'title' => '' ])
<div>
    <button type="button" class="btn btn-warning mt-2" data-bs-toggle="modal" data-bs-target="#{{$id}}">
        {{ $title }}
    </button>

    <!-- Modal -->
    <div class="modal fade mainModal" id="{{$id}}" tabindex="-1" aria-labelledby="{{$id}}Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="{{$id}}Label">{{ $title }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{ $slot }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>