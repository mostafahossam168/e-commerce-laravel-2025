<script data-navigate-once src="{{ asset('admin-asset/js/bootstrap.bundle.min.js') }}"></script>
<script data-navigate-once src="{{ asset('admin-asset/js/all.min.js') }}"></script>
<script data-navigate-once src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script data-navigate-once src="{{ asset('admin-asset/js/main.js') }}"></script>
<script data-navigate-once src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script data-navigate-once>
    const Toast = Swal.mixin({
        toast: true,
        position: 'bottom',
        showConfirmButton: false,
        showCloseButton: true,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });

    window.addEventListener('alert', ({
        detail: {
            type,
            message
        }
    }) => {
        Toast.fire({
            icon: type,
            title: message
        })
    })
</script>

<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>

@if (auth()->check())
    <script>
        var pusher = new Pusher("{{ env('PUSHER_APP_KEY') }}", {
            cluster: "{{ env('PUSHER_APP_CLUSTER') }}"
        });


        var channel = pusher.subscribe('laravel');



        channel.bind('new-notification-event', function(data) {


            if (data.notification.user_id == "{{ auth()->id() }}") {
                let notificationBadge = $('.navbar-notification');
                // زيادة عدد الإشعارات غير المقروءة
                let currentCount = parseInt(notificationBadge.text()) || 0;
                notificationBadge.text(currentCount + 1);
                Swal.fire({
                    title: data.notification.title,
                    icon: 'info',
                    html: `
                    <a class="btn btn-success btn-sm text-nowrap" href="{{ route('admin.notifications') }}">
                    عرض كل الاشعارات
            </a>`,
                    showConfirmButton: false,
                    position: 'center',
                    padding: '13px',
                    customClass: 'swal-alert-info',
                    showCloseButton: false,
                    showCancelButton: false,
                    focusConfirm: false,
                })

                window.notificationListenerAttached = true;
            }
        });
    </script>
@endif




@stack('js')
