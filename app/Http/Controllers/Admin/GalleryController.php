<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\GalleryCategory;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Yajra\DataTables\Facades\DataTables;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $q = Gallery::with('category:id,name')->orderBy('sort_order');
            if ($request->filled('gallery_category_id')) {
                $q->where('gallery_category_id', $request->gallery_category_id);
            }

            return DataTables::of($q->get())
                ->addIndexColumn()
                ->addColumn('image', fn ($r) => ($r->image ? '<img src="'.url($r->image).'" class="img-thumbnail" style="max-width:100px;">' : ($r->video_file ? '<span class="badge bg-info">Video file</span>' : ($r->video_url ? '<span class="badge bg-success">Video URL</span>' : '<span class="text-muted">-</span>'))))
                ->addColumn('category', fn ($r) => $r->category?->name ?? '-')
                ->addColumn('status', fn ($r) => '<div class="form-check form-switch"><input type="checkbox" class="form-check-input toggle-status" data-id="'.$r->id.'" '.($r->status ? 'checked' : '').'></div>')
                ->addColumn('action', fn ($r) => '<button class="btn btn-sm btn-soft-secondary editBtn" data-id="'.$r->id.'"><i class="ri-pencil-fill"></i> Edit</button> <button class="btn btn-sm btn-soft-danger deleteBtn" data-delete-url="'.route('galleries.delete', $r->id).'" data-method="DELETE" data-table="#galleryTable"><i class="ri-delete-bin-fill"></i></button>')
                ->rawColumns(['image', 'status', 'action'])
                ->make(true);
        }

        $categories = GalleryCategory::where('status', 1)->orderBy('sort_order')->get(['id', 'name']);

        return view('admin.galleries.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'gallery_category_id' => 'nullable|exists:gallery_categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
            'video_file' => 'nullable|file|mimes:mp4,webm,mov,m4v,ogg|max:51200',
            'video_url' => 'nullable|string|max:2048',
        ]);
        if (! $request->hasFile('image') && ! $request->hasFile('video_file') && ! $request->filled('video_url')) {
            return response()->json(['message' => 'Add an image, a video file or a video URL.'], 422);
        }

        $data = [
            'gallery_category_id' => $request->gallery_category_id,
            'caption' => $request->caption,
            'sort_order' => (int) (Gallery::max('sort_order') ?? 0) + 1,
        ];

        if ($request->hasFile('image')) {
            $data['image'] = $this->storeImage($request->file('image'));
        }
        if ($request->hasFile('video_file')) {
            $data['video_file'] = $this->storeVideoFile($request->file('video_file'));
        }
        if ($request->filled('video_url')) {
            $data['video_url'] = $request->video_url;
        }

        Gallery::create($data);

        return response()->json(['message' => 'Gallery item added']);
    }

    public function edit($id)
    {
        $g = Gallery::findOrFail($id);

        return response()->json([
            ...$g->toArray(),
            'preview' => $g->image ? url($g->image) : null,
            'video_preview' => $g->video_file ? url($g->video_file) : null,
        ]);
    }

    public function update(Request $request)
    {
        $g = Gallery::findOrFail($request->id);
        $request->validate([
            'gallery_category_id' => 'nullable|exists:gallery_categories,id',
            'video_file' => 'nullable|file|mimes:mp4,webm,mov,m4v,ogg|max:51200',
            'video_url' => 'nullable|string|max:2048',
        ]);
        $data = $request->only(['gallery_category_id', 'caption']);
        if ($request->hasFile('image')) {
            $this->deleteUpload($g->image);
            $data['image'] = $this->storeImage($request->file('image'));
        } elseif ($request->boolean('remove_image')) {
            $this->deleteUpload($g->image);
            $data['image'] = null;
        }
        if ($request->hasFile('video_file')) {
            $this->deleteUpload($g->video_file);
            $data['video_file'] = $this->storeVideoFile($request->file('video_file'));
        } elseif ($request->boolean('remove_video_file')) {
            $this->deleteUpload($g->video_file);
            $data['video_file'] = null;
        }
        if ($request->filled('video_url')) {
            $data['video_url'] = $request->video_url;
        } elseif ($request->boolean('remove_video_url')) {
            $data['video_url'] = null;
        }
        $g->update($data);

        return response()->json(['message' => 'Gallery item updated']);
    }

    public function destroy($id)
    {
        $g = Gallery::findOrFail($id);
        $this->deleteUpload($g->image);
        $this->deleteUpload($g->video_file);
        $g->delete();

        return response()->json(['message' => 'Gallery item deleted']);
    }

    /** Store an uploaded still image as webp and return its public path. */
    private function storeImage($file): string
    {
        $path = public_path('uploads/gallery/');
        if (! file_exists($path)) {
            mkdir($path, 0755, true);
        }
        $name = mt_rand(10000000, 99999999).'.webp';
        Image::make($file)->resize(1600, null, function ($c) {
            $c->aspectRatio();
            $c->upsize();
        })->encode('webp', 75)->save($path.$name);

        return '/uploads/gallery/'.$name;
    }

    /** Store an uploaded video file and return its public path. */
    private function storeVideoFile($file): string
    {
        $path = public_path('uploads/gallery/videos/');
        if (! file_exists($path)) {
            mkdir($path, 0755, true);
        }
        $extension = strtolower($file->getClientOriginalExtension()) ?: 'mp4';
        $name = mt_rand(10000000, 99999999).'.'.$extension;
        $file->move($path, $name);

        return '/uploads/gallery/videos/'.$name;
    }

    /** Delete an uploaded file from the public directory. */
    private function deleteUpload(?string $path): void
    {
        if ($path && str_starts_with($path, '/uploads/') && file_exists(public_path($path))) {
            @unlink(public_path($path));
        }
    }

    public function toggleStatus(Request $request)
    {
        $g = Gallery::findOrFail($request->id);
        $g->update(['status' => ! $g->status]);

        return response()->json(['message' => 'Status updated']);
    }
}
