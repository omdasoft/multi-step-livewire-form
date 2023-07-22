<?php
namespace App\Traits;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

trait FileUpload 
{
    use WithFileUploads;

    public function upload(object $file, string $field, string $folder)
    {
        $fileName = $field . '-' . Str::uuid() . ".{$file->extension()}";

        $file->storeAs("{$folder}", $fileName, 'public');

        $destination = "{$folder}/$fileName";
        return $destination;
    }

    public function removeUploadedFile(string $path)
    {
        if(Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}