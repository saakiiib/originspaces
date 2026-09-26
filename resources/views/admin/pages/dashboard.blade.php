@extends('admin.pages.master')
@section('title', 'Dashboard')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-1">Welcome</h4>
                        <p class="text-muted mb-0">Here's a quick overview of your site.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card">
                    <div class="card-body d-flex align-items-center gap-3">
                        <span class="avatar-sm bg-primary-subtle text-primary rounded d-inline-flex align-items-center justify-content-center">
                            <x-icon name="package" class="w-5 h-5" />
                        </span>
                        <div>
                            <p class="text-muted text-uppercase fw-semibold fs-12 mb-1">Products</p>
                            <h4 class="mb-0">{{ $productCount ?? 0 }}</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card">
                    <div class="card-body d-flex align-items-center gap-3">
                        <span class="avatar-sm bg-success-subtle text-success rounded d-inline-flex align-items-center justify-content-center">
                            <x-icon name="layout" class="w-5 h-5" />
                        </span>
                        <div>
                            <p class="text-muted text-uppercase fw-semibold fs-12 mb-1">Categories</p>
                            <h4 class="mb-0">{{ $categoryCount ?? 0 }}</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card">
                    <div class="card-body d-flex align-items-center gap-3">
                        <span class="avatar-sm bg-warning-subtle text-warning rounded d-inline-flex align-items-center justify-content-center">
                            <x-icon name="mail" class="w-5 h-5" />
                        </span>
                        <div>
                            <p class="text-muted text-uppercase fw-semibold fs-12 mb-1">Enquiries</p>
                            <h4 class="mb-0">{{ $enquiryCount ?? 0 }}</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card">
                    <div class="card-body d-flex align-items-center gap-3">
                        <span class="avatar-sm bg-info-subtle text-info rounded d-inline-flex align-items-center justify-content-center">
                            <x-icon name="phone" class="w-5 h-5" />
                        </span>
                        <div>
                            <p class="text-muted text-uppercase fw-semibold fs-12 mb-1">Contacts</p>
                            <h4 class="mb-0">{{ $contactCount ?? 0 }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h5 class="card-title mb-0 flex-grow-1">Recent Enquiries</h5>
                    </div>
                    <div class="card-body">
                        @if (($recentEnquiries ?? collect())->isEmpty())
                            <p class="text-muted mb-0">No enquiries yet.</p>
                        @else
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Topic</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($recentEnquiries as $enquiry)
                                            <tr>
                                                <td>{{ $enquiry->name }}</td>
                                                <td>{{ $enquiry->email }}</td>
                                                <td>{{ $enquiry->topic ?? '—' }}</td>
                                                <td>{{ $enquiry->created_at?->format('d M Y') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
