@extends("admin.layouts.admin")

@section("top-header",localize('Users'))

@section("top-actions")
    <a
        href="{{ route('admin.users.create') }}"
        class="btn btn-success ms-2">
        <i class="fa fa-plus me-2"></i> {{ localize('New Record') }}
    </a>
@endsection

@section("content")

    <div class="row g-3 mb-3">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">

                        <table class="table tt-footable border-top" data-use-parent-width="true">
                            <thead>
                            <tr>
                                <th data-breakpoints="xs" data-type="number" class="text-center">S/L</th>
                                <th>{{ localize('Username') }}</th>
                                <th>{{ localize('Name') }}</th>
                                <th>{{ localize('Email') }}</th>
                                <th>{{ localize('Roles') }}</th>
                                <th>{{ localize("Created At") }}</th>
                                <th data-breakpoints="xs sm md" class="text-end">{{ localize("Action") }}</th>
                            </tr>
                            </thead>
                            <tbody>

                            @forelse ($users as $user)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }} </td>
                                    <td>
                                        <a href="#" class="d-flex align-items-center">
                                            <h6 class="fs-sm mb-0 ms-2">{{ $user->username }}</h6>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="#" class="d-flex align-items-center">
                                            <h6 class="fs-sm mb-0 ms-2">{{ $user->fullName }}</h6>
                                        </a>
                                    </td>
                                    <td>
                                       <h6 class="fs-sm mb-0 ms-2">{{ $user->email }}</h6>
                                    </td>

                                    <td>
                                        @if(isCustomerType($user->user_type))
                                            <strong class="badge bg-info"> {{ localize("Customer") }} </strong>
                                        @else
                                            @forelse($user->roles as $key=>$role)
                                                <strong class="badge bg-success"> {{ $role->title }} </strong>
                                            @empty
                                            @endforelse
                                        @endif
                                    </td>

                                    <td>
                                        {{ $user->created_at->diffForHumans() }}
                                    </td>

                                    <td class="text-end">

                                        @if(!isCustomerType($user->user_type) && appStatic()::TYPE_ADMIN != $user->user_type)
                                            <div class="dropdown tt-tb-dropdown">
                                                <button type="button" class="btn p-0" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i data-feather="more-vertical"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end shadow" style="">

                                                    @if(isRouteExists("admin.users.edit"))
                                                        <a
                                                            class="dropdown-item"
                                                            href="{{ route('admin.users.edit', $user) }}">
                                                            <i data-feather="edit-3" class="me-2"></i>
                                                            {{ localize('Edit') }}
                                                        </a>
                                                    @endif

                                                    @if(isRouteExists("admin.users.destroy"))
                                                        <?=  deleteAction(route('admin.users.destroy',$user->id), $user->id) ?>
                                                    @endif
                                                </div>
                                            </div>

                                        @else
                                            <p class="text-danger">{{ localize("Action Prevented") }}</p>
                                        @endif
                                    </td>
                                </tr>
                            @empty

                            @endforelse
                            </tbody>
                        </table>

                        <?=  $users->count() > 0 ? $users->links() : null ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('js')
    @include("admin.layouts.delete-core-script")
@endsection
