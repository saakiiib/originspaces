<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FloorZone;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class FloorZoneController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of(FloorZone::orderBy('sort_order')->get())
                ->addIndexColumn()
                ->addColumn('status', fn ($r) => '<div class="form-check form-switch"><input type="checkbox" class="form-check-input toggle-status" data-id="'.$r->id.'" '.($r->status ? 'checked' : '').'></div>')
                ->addColumn('action', fn ($r) => '<button class="btn btn-sm btn-soft-secondary editBtn" data-id="'.$r->id.'"><i class="ri-pencil-fill"></i> Edit</button> <button class="btn btn-sm btn-soft-danger deleteBtn" data-delete-url="'.route('floor-zones.delete', $r->id).'" data-method="DELETE" data-table="#zoneTable"><i class="ri-delete-bin-fill"></i></button>')
                ->rawColumns(['status', 'action'])
                ->make(true);
        }

        return view('admin.floor-zones.index');
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);
        FloorZone::create([
            'name' => $request->name, 'dims' => $request->dims, 'desc' => $request->desc,
            'sort_order' => (int) (FloorZone::max('sort_order') ?? 0) + 1,
        ]);

        return response()->json(['message' => 'Floor zone added']);
    }

    public function edit($id)
    {
        return response()->json(FloorZone::findOrFail($id));
    }

    public function update(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);
        FloorZone::findOrFail($request->id)->update($request->only(['name', 'dims', 'desc']));

        return response()->json(['message' => 'Floor zone updated']);
    }

    public function destroy($id)
    {
        FloorZone::findOrFail($id)->delete();

        return response()->json(['message' => 'Floor zone deleted']);
    }

    public function toggleStatus(Request $request)
    {
        $z = FloorZone::findOrFail($request->id);
        $z->update(['status' => ! $z->status]);

        return response()->json(['message' => 'Status updated']);
    }
}
