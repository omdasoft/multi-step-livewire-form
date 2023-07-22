@props([
    'path' => null,
    //'delete' => false,
    'height' => '300',
    'downloadable' => true,
    'filename' => 'file',
])

@php 
    $file = request()->root().'/storage/'.$path;
    $fileExists = Storage::disk('public')->exists($path); 
    $fileExtension = pathinfo($file, PATHINFO_EXTENSION);
@endphp
@if($fileExists)
    <div class="text-center">
        @if ($fileExtension == 'pdf')
            <iframe src="{{ $file }}#toolbar=0"
                    style="width: 100%; height: {{ $height }}px;"></iframe>
        @else 
            <img src="{{ $file }}" style="width:100%" height="{{ $height }}"> 
        @endif

        <div class="d-flex justify-content-between">
            @if ($downloadable)
                <a href="{{ route('files.download', [
                    'path' => $path,
                    'extension' => $fileExtension,
                    'filename' => "{$filename}.{$fileExtension}"
                ]) }}" type="button" class="btn btn-dark mt-2 ml-auto"><i class="fa-solid fa-download"></i> Download</a> 
            @endif

            {{ $slot }}

            {{-- @if($delete)
                <a href="{{ route('files.delete', ['path' => $path]) }}" type="button" class="btn btn-danger mt-2"><i class="fa fa-close"></i> Delete</a>
            @endif  --}}
        </div>
    </div>
@endif