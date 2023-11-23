<?php

namespace App\Http\Controllers;

use Illuminate\Notifications\DatabaseNotification;

class NotificationSeenController extends Controller
{
    public function __invoke(DatabaseNotification $notification)
    {
        // * 延用NotificationPolicy.php的驗證,限制只有擁有者才能更改已讀日期，和前者有實體的listing Model不同，這個沒有實體的DatabaseNotification 還需要在p口人Providers\AuthServiceProvider.php中加註,才能執行
        $this->authorize('update', $notification);
        $notification->markAsRead();

        return redirect()->back()->with('success', 'Notification marked as read');
    }
}
