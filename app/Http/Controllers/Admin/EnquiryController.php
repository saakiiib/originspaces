<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enquiry;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class EnquiryController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of(Enquiry::with('product:id,name')->orderByDesc('created_at')->get())
                ->addIndexColumn()
                ->addColumn('product', fn ($r) => $r->product?->name ?? '-')
                ->addColumn('price', fn ($r) => $r->guide_price ? '£'.number_format((float) $r->guide_price) : '-')
                ->addColumn('date', fn ($r) => $r->created_at->format('d M Y, h:i A'))
                ->addColumn('status', fn ($r) => '<div class="form-check form-switch"><input type="checkbox" class="form-check-input toggle-status" data-id="'.$r->id.'" '.($r->status ? 'checked' : '').'></div>')
                ->addColumn('action', fn ($r) => '<button class="btn btn-sm btn-soft-info viewBtn" data-id="'.$r->id.'"><i class="ri-eye-fill"></i> View</button> <button class="btn btn-sm btn-soft-danger deleteBtn" data-delete-url="'.route('enquiries.delete', $r->id).'" data-method="DELETE" data-table="#enquiryTable"><i class="ri-delete-bin-fill"></i></button>')
                ->rawColumns(['status', 'action'])
                ->make(true);
        }

        return view('admin.enquiries.index');
    }

    public function show($id)
    {
        return response()->json(['data' => Enquiry::with('product:id,name,model_code')->findOrFail($id)]);
    }

    public function toggleStatus(Request $request)
    {
        $e = Enquiry::findOrFail($request->id);
        $e->update(['status' => ! $e->status]);

        return response()->json(['message' => 'Status updated']);
    }

    public function destroy($id)
    {
        Enquiry::findOrFail($id)->delete();

        return response()->json(['message' => 'Enquiry deleted']);
    }
}
