@php
    function getNotificationTypeClass($type) {
        switch ($type->value) {
            case 'informative':
                return 'border-info';
            case 'success':
                return 'border-success';
            case 'important':
                return 'border-warning';
            case 'danger':
                return 'border-danger';
            default:
                return 'border-secondary';
        }
    }

@endphp

<div class="row my-4">
    <div class="col-lg-8 col-md-6 mb-md-0 mb-4">
        <div class="card shadow-soft border-radius-xl p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="mb-0">Ən son yeniliklər</h5>
                @if ($top_notifications->where('is_readed', 0)->count() > 0)
                    <div class="mark-all-container">
                        <button onclick="markAllAsRead()" class="btn btn-sm btn-primary">
                            <i class="fas fa-check-double"></i> Hamısını oxundu kimi qeyd et
                        </button>
                    </div>
                @endif
            </div>
            <div class="notifications-list overflow-auto overflow-x-hidden">
                @foreach ($top_notifications as $notification)
                    <div    onclick="showNotificationDetails(event)"
                            data-id="{{ $notification->id }}" 
                            data-type="{{ $notification->type }}" 
                            data-title="{{ $notification->title }}" 
                            data-content="{{ $notification->content }}" 
                            class="notification-item 
                            {{ $notification->is_readed ? 'notification-readed' : '' }}
                            card mb-3 border 
                            {{ getNotificationTypeClass($notification->type) }}
                            border-radius-lg p-3 d-flex flex-row justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-1">{{ $notification->title }}</h6>
                            <p class="text-sm mb-0">{{ Str::limit($notification->content, 50) }}</p>
                        </div>
                        <small class="text-muted">{{ $notification->created_at->format('d M') }}</small>
                    </div>
                    
                @endforeach
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="card h-100">
            <div class="card-header pb-0">
                <h6>Orders overview</h6>
                <p class="text-sm">
                    <i class="fa fa-arrow-up text-success" aria-hidden="true"></i>
                    <span class="font-weight-bold">24%</span> this month
                </p>
            </div>
            <div class="card-body p-3">
                <div class="timeline timeline-one-side">
                    <div class="timeline-block mb-3">
                <span class="timeline-step">
                <i class="ni ni-bell-55 text-success text-gradient"></i>
                </span>
                        <div class="timeline-content">
                            <h6 class="text-dark text-sm font-weight-bold mb-0">$2400, Design changes</h6>
                            <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">22 DEC 7:20 PM</p>
                        </div>
                    </div>
                    <div class="timeline-block mb-3">
                <span class="timeline-step">
                <i class="ni ni-html5 text-danger text-gradient"></i>
                </span>
                        <div class="timeline-content">
                            <h6 class="text-dark text-sm font-weight-bold mb-0">New order #1832412</h6>
                            <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">21 DEC 11 PM</p>
                        </div>
                    </div>
                    <div class="timeline-block mb-3">
                <span class="timeline-step">
                <i class="ni ni-cart text-info text-gradient"></i>
                </span>
                        <div class="timeline-content">
                            <h6 class="text-dark text-sm font-weight-bold mb-0">Server payments for April</h6>
                            <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">21 DEC 9:34 PM</p>
                        </div>
                    </div>
                    <div class="timeline-block mb-3">
                <span class="timeline-step">
                <i class="ni ni-credit-card text-warning text-gradient"></i>
                </span>
                        <div class="timeline-content">
                            <h6 class="text-dark text-sm font-weight-bold mb-0">New card added for order #4395133</h6>
                            <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">20 DEC 2:20 AM</p>
                        </div>
                    </div>
                    <div class="timeline-block mb-3">
                <span class="timeline-step">
                <i class="ni ni-key-25 text-primary text-gradient"></i>
                </span>
                        <div class="timeline-content">
                            <h6 class="text-dark text-sm font-weight-bold mb-0">Unlock packages for development</h6>
                            <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">18 DEC 4:54 AM</p>
                        </div>
                    </div>
                    <div class="timeline-block">
                <span class="timeline-step">
                <i class="ni ni-money-coins text-dark text-gradient"></i>
                </span>
                        <div class="timeline-content">
                            <h6 class="text-dark text-sm font-weight-bold mb-0">New order #9583120</h6>
                            <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">17 DEC</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>

.info-notification-border {
    border
}

.notifications-list {
    height: 400px;
    overflow: hidden;
    position: relative;
    padding-right: 10px;
}
.notifications-list::-webkit-scrollbar {
    display: none; /* Hide scrollbar for WebKit browsers */
}
.notifications-list {
    scrollbar-width: none; /* Hide scrollbar for Firefox */
}


.notification-item {
    cursor: pointer;
    transition: background-color 0.3s;
}

.notification-item:hover {
    background-color: rgba(0, 0, 0, 0.1);
}

</style>
<script>
document.addEventListener('DOMContentLoaded', function() {
    Scrollbar.init(document.querySelector('.notifications-list'), options);

    $('.notifications-list').on('mouseenter',function(){
        $(`.notifications-list .scrollbar-track.scrollbar-track-y`).addClass('show');
    });

    $('.notifications-list').on('mouseleave',function(){
        $(`.notifications-list .scrollbar-track.scrollbar-track-y`).removeClass('show');
    });
});

async function showNotificationDetails(e) {
    const notificationItem = e.currentTarget;

    const result = await Swal.fire({
        title: notificationItem.dataset.title,
        text: notificationItem.dataset.content,
        icon: notificationItem.dataset.type === 'informative' ? 'info' :
              notificationItem.dataset.type === 'success' ? 'success' :
              notificationItem.dataset.type === 'important' ? 'warning' : 'error',
        confirmButtonText: 'Detallı səhifəsine get',
        showCancelButton: true,
        cancelButtonText: 'Bağla',
        cancelButtonColor: '#d33',
    });

    // Wait for markAsRead if not already read
    if (!notificationItem.classList.contains('notification-readed')) {
        await markAsRead(notificationItem.dataset.id);
    }

    if (result.isConfirmed) {
        window.location.href = '{{ route("account.notifications.index") }}';
    }
}

async function markAsRead(notificationId) {
    return $.ajax({
        method: 'POST',
        url: `/account/notifications/${notificationId}/read`,
        success: function () {
            const notificationItem = document.querySelector(`.notification-item[data-id="${notificationId}"]`);
            if (notificationItem) {
                notificationItem.classList.add('notification-readed');
            }
        },
        error: function (xhr) {
            if (xhr.responseJSON?.error)
                console.error(xhr.responseJSON.error);
            else
                console.error('Xəta baş verdi, yenidən cəhd edin.');
        }
    });
}


function markAllAsRead() {
    $.ajax({
        method: 'POST',
        url: '{{ route('account.notifications.read.all') }}',
        success: function(response) {
            // Mark all notifications as read
            document.querySelectorAll('.notification-item').forEach(item => {
                item.classList.add('notification-readed');
            });
            $('.mark-all-container').remove();
            Swal.fire({
                title: 'Hamısı oxundu kimi qeyd edildi',
                icon: 'success',
                confirmButtonText: 'Bağla'
            });
        },
        error: function(xhr) {
            if(xhr.responseJSON.error)
                console.error(xhr.responseJSON.error);
            else
                console.error('Xəta baş verdi, yenidən cəhd edin.');
        }
    });
}
// $(document).ready(function() {
//     // Initialize Perfect Scrollbar
//     const container = document.querySelector('.notifications-list');
//     if (container) {
//         new PerfectScrollbar(container);
//     }
// });



</script>
