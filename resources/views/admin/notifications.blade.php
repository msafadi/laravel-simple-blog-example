@extends('layouts.admin')

@section('title', 'Notifications')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Notifications</li>
@endsection

@section('content')

<table class="table">
    <thead>
        <tr>
            <th></th>
            <th>Notification</th>
            <th>Time</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($notifications as $notification)
        <tr>
            <td>
                @if($notification->unread())
                <b>*</b>
                @endif
            </td>
            <td><a href="{{ $notification->data['link'] }}">
                {{ $notification->data['body'] }}</a></td>
            <td>{{ $notification->created_at }}</td>
            <td>
                @if($notification->unread())
                <form action="{{ route('admin.notifications.read', $notification->id)}}" method="post">
                    @csrf
                    @method('put')
                    <button type="submit" class="btn btn-sm btn-success">Mark as read</button>
                </form>
                @else
                <form action="{{ route('admin.notifications.unread', $notification->id)}}" method="post">
                    @csrf
                    @method('put')
                    <button type="submit" class="btn btn-sm btn-info">Mark as unread</button>
                </form>
                @endif
            </td>
            <td>
                <form action="{{ route('admin.notifications.destroy', $notification->id)}}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $notifications->links() }}

@endsection