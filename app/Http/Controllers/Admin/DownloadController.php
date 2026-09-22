<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Download;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class DownloadController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of(Download::with('product:id,name')->orderBy('sort_order')->get())
                ->addIndexColumn()
                ->addColumn('product', fn ($r) => $r->product?->name ?? '-')
                ->addColumn('status', fn ($r) => '<div class="form-check form-switch"><input type="checkbox" class="form-check-input toggle-status" data-id="'.$r->id.'" '.($r->status ? 'checked' : '').'></div>')
                ->addColumn('action', fn ($r) => '<a class="btn btn-sm btn-soft-info" href="'.url($r->file).'" target="_blank"><i class="ri-download-line"></i></a> <button class="btn btn-sm btn-soft-secondary editBtn" data-id="'.$r->id.'"><i class="ri-pencil-fill"></i> Edit</button> <button class="btn btn-sm btn-soft-danger deleteBtn" data-delete-url="'.route('downloads.delete', $r->id).'" data-method="DELETE" data-table="#downloadTable"><i class="ri-delete-bin-fill"></i></button>')
                ->rawColumns(['status', 'action'])
                ->make(true);
        }

        $products = Product::where('status', 1)->orderBy('name')->get(['id', 'name']);

        return view('admin.downloads.index', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'file' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,dwg,rvt,zip,jpg,jpeg,png,webp|max:51200',
            'format' => ['required', Rule::in(Download::FORMATS)],
            'product_id' => 'nullable|exists:products,id',
        ]);
        $path = public_path('uploads/downloads/');
        if (! file_exists($path)) {
            mkdir($path, 0755, true);
        }
        $ext = $request->file('file')->getClientOriginalExtension();
        $name = mt_rand(10000000, 99999999).'.'.$ext;
        $request->file('file')->move($path, $name);

        Download::create([
            'ref' => $request->ref,
            'product_id' => $request->product_id,
            'title' => $request->title,
            'file' => '/uploads/downloads/'.$name,
            'format' => $request->format,
            'size' => $this->humanSize($path.$name),
            'rev' => $request->rev,
            'sort_order' => (int) (Download::max('sort_order') ?? 0) + 1,
        ]);

        return response()->json(['message' => 'Download added']);
    }

    public function edit($id)
    {
        return response()->json(Download::findOrFail($id));
    }

    public function update(Request $request)
    {
        $d = Download::findOrFail($request->id);
        $request->validate([
            'title' => 'required|string|max:255',
            'format' => ['required', Rule::in(Download::FORMATS)],
            'product_id' => 'nullable|exists:products,id',
            'file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,dwg,rvt,zip,jpg,jpeg,png,webp|max:51200',
        ]);
        $data = $request->only(['ref', 'product_id', 'title', 'format', 'rev']);
        if ($request->hasFile('file')) {
            if ($d->file && file_exists(public_path($d->file))) {
                @unlink(public_path($d->file));
            }
            $path = public_path('uploads/downloads/');
            if (! file_exists($path)) {
                mkdir($path, 0755, true);
            }
            $ext = $request->file('file')->getClientOriginalExtension();
            $name = mt_rand(10000000, 99999999).'.'.$ext;
            $request->file('file')->move($path, $name);
            $data['file'] = '/uploads/downloads/'.$name;
            $data['size'] = $this->humanSize($path.$name);
        }
        $d->update($data);

        return response()->json(['message' => 'Download updated']);
    }

    public function destroy($id)
    {
        $d = Download::findOrFail($id);
        if ($d->file && file_exists(public_path($d->file))) {
            @unlink(public_path($d->file));
        }
        $d->delete();

        return response()->json(['message' => 'Download deleted']);
    }

    public function toggleStatus(Request $request)
    {
        $d = Download::findOrFail($request->id);
        $d->update(['status' => ! $d->status]);

        return response()->json(['message' => 'Status updated']);
    }

    private function humanSize(string $path): ?string
    {
        if (! file_exists($path)) {
            return null;
        }
        $bytes = filesize($path);
        if ($bytes >= 1048576) {
            return round($bytes / 1048576, 1).' MB';
        }
        if ($bytes >= 1024) {
            return round($bytes / 1024).' KB';
        }

        return $bytes.' B';
    }
}
