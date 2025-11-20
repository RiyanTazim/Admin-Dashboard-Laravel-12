<?php

namespace App\Helpers;

use App\Models\NotificationSave;
use App\Services\FirebaseService;
use Illuminate\Support\Facades\Log;
use App\Models\ReminderNotification;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;

class FirebaseHelper
{
    /**
     * 🔔 Send FCM notification and save to DB (for reminders)
     */
    public static function sendReminderNotification($fcmToken, $title, $body, $userId = null)
    {
        Log::info("🚀 sendReminderNotification() called | user_id=$userId | title=$title | token=$fcmToken");

        try {

            // ✅ Then send FCM notification
            $messaging = FirebaseService::messaging();
            if (!$messaging) {
                Log::error("❌ Firebase messaging service not initialized");
            }

            $message = CloudMessage::withTarget('token', $fcmToken)
                ->withNotification(Notification::create($title, $body));

            $response = $messaging->send($message);

            // ✅ Save to DB after sending successfully to FCM Notification

            Log::info("📝 Creating DB entry for user_id=$userId");

            if ($userId) {
                NotificationSave::create([
                    'user_id' => $userId,
                    'title' => $title,
                    'body' => $body,
                    'sent_at' => now(),
                ]);
            }

            // ✅ Success log
            Log::info("📬 FCM Notification Sent to {$fcmToken} | Title: {$title} | Body: {$body}");

            return $response;
        } catch (\Throwable $e) {
            // Error log
            Log::error("❌ FCM Send Error for reminder notification: " . $e->getMessage());
            Log::error($e->getTraceAsString());

            return null;
        }
    }

    /**
     * 🔔 Send FCM notification only (no DB save) — used for tasks
     */
    public static function sendFcmNotification($fcmToken, $title, $body, $userId = null)
    {
        Log::info("🚀 sendFcmNotification() called | user_id=$userId | title=$title");

        try {
            $messaging = FirebaseService::messaging();

            if (!$messaging) {
                Log::error("❌ Firebase messaging service not initialized");
                return null;
            }

            $message = CloudMessage::withTarget('token', $fcmToken)
                ->withNotification(Notification::create($title, $body));

            $response = $messaging->send($message);

            Log::info("📬 FCM Notification Sent  {$fcmToken} | Title: {$title} | Body: {$body}");

            return $response;
        } catch (\Throwable $e) {
            Log::error("❌ FCM Send Error: " . $e->getMessage());
            Log::error($e->getTraceAsString());
            return null;
        }
    }
}
