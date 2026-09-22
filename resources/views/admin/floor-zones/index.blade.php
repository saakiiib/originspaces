@extends('admin.pages.master')
@section('title', 'Floor Zones')
@section('content')
<div class="container-fluid"><div class="row mb-3"><div class="col text-end"><button class="btn btn-primary" id="newBtn">Add Zone</button></div></div></div>
<div class="container-fluid" id="formBox" style="display:none;"><div class="row justify-content-center"><div class="col-xl-6"><div class="card"><div class="card-header"><h4 id="cardTitle">Add Zone</h4></div>
<div class="card-body"><form id="mainForm">@csrf<input type="hidden" id="codeid">
<div class="mb-2"><label class="form-label">Name *</label><input class="form-control" id="name"></div>
<div class="mb-2"><label class="form-label">Dimensions</label><input class="form-control" id="dims" placeholder="3.2 m × 3.0 m"></div>
<div class="mb-2"><label class="form-label">Description</label><textarea class="form-control" id="desc" rows="2"></textarea></div>
</form></div>
<div class="card-footer text-end"><button id="saveBtn" class="btn btn-primary" value="Create">Create</button> <button id="cancelBtn" class="btn btn-light">Cancel</button></div>
</div></div></div></div>
<div class="container-fluid"><div class="card"><div class="card-header"><h4>Floor Zones (global — shown on every product details page)</h4></div>
<div class="card-body"><div class="table-responsive"><table id="zoneTable" class="table table-bordered table-striped w-100"><thead><tr><th>Sl</th><th>Name</th><th>Dims</th><th>Status</th><th>Action</th></tr></thead></table></div></div></div></div>
@endsection
@section('script')
<script>
$(function () {
    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
    const t = $('#zoneTable').DataTable({ processing: true, serverSide: true, ajax: "{{ route('floor-zones.index') }}",
        columns: [{ data: 'DT_RowIndex', orderable: false, searchable: false }, { data: 'name' }, { data: 'dims' }, { data: 'status', orderable: false, searchable: false }, { data: 'action', orderable: false, searchable: false }] });
    $('#newBtn').click(() => { $('#mainForm')[0].reset(); $('#codeid').val(''); $('#saveBtn').val('Create').html('Create'); $('#formBox').show(300); $('#newBtn').hide(); });
    $('#cancelBtn').click(() => { $('#formBox').hide(); $('#newBtn').show(); });
    $('#saveBtn').click(function () {
        const create = $(this).val() === 'Create';
        $.post(create ? "{{ route('floor-zones.store') }}" : "{{ route('floor-zones.update') }}",
            { id: $('#codeid').val(), name: $('#name').val(), dims: $('#dims').val(), desc: $('#desc').val() },
            d => { showSuccess(d.message); $('#formBox').hide(); $('#newBtn').show(); t.ajax.reload(null, false); })
            .fail(xhr => showError(xhr.status === 422 ? Object.values(xhr.responseJSON.errors)[0][0] : 'Error'));
    });
    $(document).on('click', '.editBtn', function () { $.get("{{ url('/admin/floor-zones') }}/" + $(this).data('id') + '/edit', d => { $('#codeid').val(d.id); $('#name').val(d.name); $('#dims').val(d.dims); $('#desc').val(d.desc); $('#saveBtn').val('Update').html('Update'); $('#formBox').show(300); $('#newBtn').hide(); pagetop(); }); });
    $(document).on('change', '.toggle-status', function () { $.post("{{ route('floor-zones.toggleStatus') }}", { id: $(this).data('id') }, d => { showSuccess(d.message); t.ajax.reload(null, false); }); });
});
</script>
@endsection
