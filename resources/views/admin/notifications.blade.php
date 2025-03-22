@extends('admin.layouts.admin', [
    'title' => 'الاشعارات',
])
@section('content')
    <div class="main-side">

        <div class="main-title">
            <div class="small">
                الرئيسية
            </div>
            <div class="large">
                الاشعارات
            </div>
        </div>
        <div class="table-responsive">
            <table class="main-table mb-2">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>اللينك</th>
                        <th>الرسالة</th>
                        <th>مقروء</th>
                        <th><input type="checkbox" wire:model.live="SelectAll"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($notifications as $notification)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <a href="{{ $notification->link }}" class="text-primary">عرض</a>
                            </td>
                            <td>{{ $notification->title }}</td>
                            <td>


                                @if ($notification->seen_at)
                                    <span class="badge bg-success">نعم</span>
                                @else
                                    <span class="badge bg-danger">لا</span>
                                @endif
                            </td>
                            <td><input type="checkbox" value="{{ $notification->id }}"
                                    wire:model.live="selectedNotifications"></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">لا توجد نتائج</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $notifications->links() }}
        </div>
    </div>
@endsection
