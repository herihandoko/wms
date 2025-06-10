@extends('layouts.admin')

@section('title', 'Role Management')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/tables/datatable/dataTables.bootstrap5.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/tables/datatable/responsive.bootstrap5.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/tables/datatable/buttons.bootstrap5.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/tables/datatable/rowGroup.bootstrap5.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/select/select2.min.css') }}">
@endsection

@section('content')
<!-- roles list start -->
<section class="app-role-list">
    <div class="row">
        <div class="col-lg-4 col-sm-6">
            <div class="card">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <h3 class="fw-bolder mb-75">{{ $roles->count() }}</h3>
                        <span>Total Roles</span>
                    </div>
                    <div class="avatar bg-light-primary p-50">
                        <span class="avatar-content">
                            <i data-feather="shield" class="font-medium-4"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-6">
            <div class="card">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <h3 class="fw-bolder mb-75">{{ $permissions->count() }}</h3>
                        <span>Total Permissions</span>
                    </div>
                    <div class="avatar bg-light-success p-50">
                        <span class="avatar-content">
                            <i data-feather="key" class="font-medium-4"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- list and filter start -->
    <div class="card">
        <div class="card-body border-bottom">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="card-title">Search & Filter</h4>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modals-slide-in">
                    <i data-feather="plus"></i>
                    <span>Add New Role</span>
                </button>
            </div>
        </div>
        <div class="card-datatable table-responsive pt-0">
            <table class="role-list-table table">
                <thead class="table-light">
                    <tr>
                        <th></th>
                        <th>Role</th>
                        <th>Users</th>
                        <th>Permissions</th>
                        <th>Created Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($roles as $role)
                    <tr>
                        <td></td>
                        <td>{{ ucfirst($role->name) }}</td>
                        <td>{{ $role->users_count }}</td>
                        <td>
                            <span class="badge rounded-pill badge-light-primary">
                                {{ $role->permissions->count() }} Permissions
                            </span>
                        </td>
                        <td>{{ $role->created_at->format('d M Y') }}</td>
                        <td>
                            <div class="btn-group">
                                <a class="btn btn-sm dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="font-small-4" data-feather="more-vertical"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editRole{{ $role->id }}">
                                        <i class="font-small-4 me-50" data-feather="edit"></i>
                                        Edit
                                    </a>
                                    @if($role->name !== 'super-admin')
                                    <a href="#" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $role->id }}').submit();">
                                        <i class="font-small-4 me-50" data-feather="trash"></i>
                                        Delete
                                    </a>
                                    <form id="delete-form-{{ $role->id }}" action="{{ route('roles.destroy', $role->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    @endif
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- list and filter end -->
</section>
<!-- roles list ends -->

<!-- Add Role Modal -->
<div class="modal modal-slide-in new-role-modal fade" id="modals-slide-in">
    <div class="modal-dialog">
        <form class="add-new-role modal-content pt-0" method="POST" action="{{ route('roles.store') }}">
            @csrf
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
            <div class="modal-header mb-1">
                <h5 class="modal-title">Add New Role</h5>
            </div>
            <div class="modal-body flex-grow-1">
                <div class="mb-1">
                    <label class="form-label" for="name">Role Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter role name" required />
                </div>
                <div class="mb-1">
                    <h4 class="mt-2 pt-50">Role Permissions</h4>
                    <div class="table-responsive">
                        <table class="table table-flush-spacing">
                            <tbody>
                                <tr>
                                    <td class="text-nowrap fw-bolder">
                                        Administrator Access
                                        <span data-bs-toggle="tooltip" data-bs-placement="top" title="Allows a full access to the system">
                                            <i data-feather="info"></i>
                                        </span>
                                    </td>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="select-all" />
                                            <label class="form-check-label" for="select-all">Select All</label>
                                        </div>
                                    </td>
                                </tr>
                                @foreach($permissions->groupBy(function($item) {
                                    return explode('_', $item->name)[1];
                                }) as $module => $modulePermissions)
                                <tr>
                                    <td class="text-nowrap fw-bolder">{{ ucfirst($module) }}</td>
                                    <td>
                                        <div class="d-flex">
                                            @foreach($modulePermissions as $permission)
                                            <div class="form-check me-3 me-lg-5">
                                                <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $permission->name }}" />
                                                <label class="form-check-label">
                                                    {{ ucfirst(explode('_', $permission->name)[0]) }}
                                                </label>
                                            </div>
                                            @endforeach
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary me-1 data-submit">Submit</button>
                <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </form>
    </div>
</div>
<!-- Add Role Modal -->

<!-- Edit Role Modals -->
@foreach($roles as $role)
<div class="modal fade" id="editRole{{ $role->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-5 px-sm-5 pt-50">
                <div class="text-center mb-2">
                    <h1 class="mb-1">Edit Role Information</h1>
                </div>
                <form class="row" method="POST" action="{{ route('roles.update', $role->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="col-12">
                        <label class="form-label" for="name">Role Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $role->name }}" required {{ $role->name === 'super-admin' ? 'readonly' : '' }} />
                    </div>
                    <div class="col-12">
                        <h4 class="mt-2 pt-50">Role Permissions</h4>
                        <div class="table-responsive">
                            <table class="table table-flush-spacing">
                                <tbody>
                                    <tr>
                                        <td class="text-nowrap fw-bolder">
                                            Administrator Access
                                            <span data-bs-toggle="tooltip" data-bs-placement="top" title="Allows a full access to the system">
                                                <i data-feather="info"></i>
                                            </span>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="select-all-{{ $role->id }}" />
                                                <label class="form-check-label" for="select-all-{{ $role->id }}">Select All</label>
                                            </div>
                                        </td>
                                    </tr>
                                    @foreach($permissions->groupBy(function($item) {
                                        return explode('_', $item->name)[1];
                                    }) as $module => $modulePermissions)
                                    <tr>
                                        <td class="text-nowrap fw-bolder">{{ ucfirst($module) }}</td>
                                        <td>
                                            <div class="d-flex">
                                                @foreach($modulePermissions as $permission)
                                                <div class="form-check me-3 me-lg-5">
                                                    <input class="form-check-input" type="checkbox" name="permissions[]"
                                                        value="{{ $permission->name }}"
                                                        {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}
                                                        {{ $role->name === 'super-admin' ? 'disabled' : '' }} />
                                                    <label class="form-check-label">
                                                        {{ ucfirst(explode('_', $permission->name)[0]) }}
                                                    </label>
                                                </div>
                                                @endforeach
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-12 text-center mt-2 pt-50">
                        <button type="submit" class="btn btn-primary me-1">Submit</button>
                        <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close">
                            Discard
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach
<!-- Edit Role Modals -->

@endsection

@section('js')
<script src="{{ asset('app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('app-assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js') }}"></script>
<script src="{{ asset('app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('app-assets/vendors/js/tables/datatable/responsive.bootstrap5.min.js') }}"></script>
<script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.buttons.min.js') }}"></script>
<script src="{{ asset('app-assets/vendors/js/tables/datatable/buttons.bootstrap5.min.js') }}"></script>
<script src="{{ asset('app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>

<script>
$(function () {
    'use strict';

    // DataTable
    $('.role-list-table').DataTable({
        columns: [
            { data: 'id' },
            { data: 'role' },
            { data: 'users' },
            { data: 'permissions' },
            { data: 'created_at' },
            { data: '' }
        ],
        columnDefs: [
            {
                className: 'control',
                orderable: false,
                responsivePriority: 2,
                targets: 0
            },
            {
                targets: 4,
                orderable: true
            },
            {
                targets: -1,
                orderable: false
            }
        ],
        dom: '<"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
        displayLength: 10,
        lengthMenu: [10, 25, 50, 75, 100],
        responsive: {
            details: {
                display: $.fn.dataTable.Responsive.display.modal({
                    header: function (row) {
                        var data = row.data();
                        return 'Details of ' + data[1];
                    }
                }),
                type: 'column',
                renderer: function (api, rowIdx, columns) {
                    var data = $.map(columns, function (col, i) {
                        return col.title !== ''
                            ? '<tr data-dt-row="' +
                            col.rowIdx +
                            '" data-dt-column="' +
                            col.columnIndex +
                            '">' +
                            '<td>' +
                            col.title +
                            ':' +
                            '</td> ' +
                            '<td>' +
                            col.data +
                            '</td>' +
                            '</tr>'
                            : '';
                    }).join('');

                    return data ? $('<table class="table"/>').append('<tbody>' + data + '</tbody>') : false;
                }
            }
        }
    });

    // Select All checkbox click
    $(document).on('click', '#select-all', function() {
        $(this).closest('.modal-content').find('input[type="checkbox"]').prop('checked', this.checked);
    });

    $(document).on('click', '[id^="select-all-"]', function() {
        $(this).closest('.modal-content').find('input[type="checkbox"]:not([disabled])').prop('checked', this.checked);
    });
});
</script>
@endsection
