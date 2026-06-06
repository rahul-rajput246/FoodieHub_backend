@extends('layouts.allAdmin')

@section('content')

<div class="main_dashboard">

    <div class="dashboard_header">
        <div class="dashboard_header_left">
            <h1>All Users</h1>
            <p class="dashboard_desc">Manage all registered users</p>
        </div>
    </div>

    <div class="dashboard_table_box">

        <div class="box_title_row">
            <h3>User List</h3>
        </div>

        <div class="dashboard_table_wrapper">
            <table class="dashboard_table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Joined</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($users as $user)
                    <tr>
                        <td>#{{ $loop->iteration }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at->format('d M Y') }}</td>

                        <td>
                            <form action="{{ route('admin.deleteUser', $user->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="action_btn delete_btn">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5">No users found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="pagination_box">
            {{ $users->links() }}
        </div>

    </div>

</div>

@endsection