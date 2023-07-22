<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
class FileController extends Controller
{
    public function download(Request $request)
    {
        $request->validate([
            'path' => ['required', 'string', 'max:190'],
            'extension' => ['required', 'in:pdf,jpg,png,jpeg'],
            'filename' => ['required', 'string', 'max:190'],
        ]);

        if (!Storage::disk('public')->exists($request->path)) {
            return back()->with('status-danger', 'File not found.');
        }
        
        $headers = $this->getHeaders($request->extension, $request->filename);

        return Response::make(Storage::disk('public')->get($request->path), 200, $headers);
    }

    public function delete(Request $request)
    {
        if(Storage::disk('public')->exists($request->path)) {
            Storage::disk('public')->delete($request->path);
        }

        return redirect()->back();
    }

    private function getHeaders($extension, $filename)
    {
        switch ($extension) {
            case 'pdf':
                $contentType = 'application/pdf';
                break;
            default:
                $contentType = "image/{$extension}";
                break;
        }

        return  [
            'Content-Type' => $contentType,
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];
    }
}
