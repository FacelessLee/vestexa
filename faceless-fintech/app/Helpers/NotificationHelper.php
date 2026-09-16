<?php

namespace App\Helpers;

use App\Models\Notification;
use App\Models\User;
use App\Models\Admin;
use App\Models\GrantApplication;

class NotificationHelper
{
    /**
     * Create a new notification for a user.
     *
     * @param  User|int  $user  The user or user ID
     * @param  string  $message  Notification message
     * @param  string|null  $title  Notification title
     * @param  string  $type  Notification type (info, success, warning, danger)
     * @param  string|null  $icon  Lucide icon name
     * @param  string|null  $link  URL to redirect when clicked
     * @param  array|null  $data  Additional data
     * @return Notification
     */
    public static function create($user, $message, $title = null, $type = 'info', $icon = null, $link = null, $data = null)
    {
        $userId = $user instanceof User ? $user->id : $user;
        
        // Set default icon based on type if not provided
        if ($icon === null) {
            $icon = self::getDefaultIconForType($type);
        }
        
        return Notification::create([
            'user_id' => $userId,
            'title' => $title,
            'message' => $message,
            'type' => $type,
            'icon' => $icon,
            'link' => $link,
            'data' => $data ? json_encode($data) : null,
            'is_read' => false,
        ]);
    }
    
    /**
     * Get the default icon for a notification type.
     *
     * @param  string  $type
     * @return string
     */
    private static function getDefaultIconForType($type)
    {
        switch ($type) {
            case 'success':
                return 'check-circle';
            case 'warning':
                return 'alert-triangle';
            case 'danger':
                return 'alert-octagon';
            case 'info':
            default:
                return 'info';
        }
    }
    
    /**
     * Create grant application submitted notification for user
     *
     * @param User $user The user who submitted the application
     * @param GrantApplication $application The grant application
     * @return Notification
     */
    public static function grantApplicationSubmitted($user, $application)
    {
        $title = 'Grant Application Submitted';
        $message = 'Your grant application has been submitted successfully and is now being processed.';
        $type = 'info';
        $icon = 'file-text';
        $link = route('grant.processing');
        $data = [
            'application_id' => $application->id,
            'requested_amount' => $application->requested_amount,
            'application_type' => $application->application_type
        ];
        
        return self::create($user, $message, $title, $type, $icon, $link, $data);
    }
    
    /**
     * Create grant application notification for admin
     *
     * @param GrantApplication $application The grant application
     * @return void
     */
    public static function notifyAdminOfNewApplication($application)
    {
        // Get all admins or specific admin roles that should be notified
        $admins = Admin::all();
        
        $title = 'New Grant Application';
        $message = 'A new grant application has been submitted by ' . $application->user->name . ' ' . $application->user->lastname;
        $type = 'info';
        $icon = 'file-plus';
        $link = route('admin.grants.view', $application->id);
        $data = [
            'application_id' => $application->id,
            'user_id' => $application->user_id,
            'requested_amount' => $application->requested_amount,
            'application_type' => $application->application_type
        ];
        
        foreach ($admins as $admin) {
            // Assuming there's an admin notification system similar to user notifications
            // If not, you would need to implement or modify this part
            // AdminNotification::create(...)
        }
    }
    
    /**
     * Create grant application status update notification for user
     *
     * @param User $user The user who owns the application
     * @param GrantApplication $application The grant application
     * @return Notification
     */
    public static function grantApplicationStatusUpdated($user, $application)
    {
        $title = 'Grant Application Updated';
        $type = 'info';
        $icon = 'bell';
        $link = route('grant.view', $application->id);
        $data = [
            'application_id' => $application->id,
            'status' => $application->status,
            'application_type' => $application->application_type
        ];
        
        switch ($application->status) {
            case 'approved':
                $message = 'Your grant application has been approved for $' . number_format($application->approved_amount, 2) . '.';
                $type = 'success';
                $icon = 'check-circle';
                break;
            case 'rejected':
                $message = 'Your grant application was not approved. Please check the details for more information.';
                $type = 'danger';
                $icon = 'x-circle';
                break;
            case 'disbursed':
                $message = 'Your grant of $' . number_format($application->approved_amount, 2) . ' has been disbursed to your account.';
                $type = 'success';
                $icon = 'credit-card';
                break;
            default:
                $message = 'Your grant application status has been updated to ' . ucfirst($application->status) . '.';
        }
        
        return self::create($user, $message, $title, $type, $icon, $link, $data);
    }
    
    /**
     * Create grant funds disbursed notification for user
     *
     * @param User $user The user receiving the funds
     * @param GrantApplication $application The grant application
     * @return Notification
     */
    public static function grantFundsDisbursed($user, $application)
    {
        $title = 'Grant Funds Disbursed';
        $message = 'Your approved grant of $' . number_format($application->approved_amount, 2) . ' has been disbursed to your account balance.';
        $type = 'success';
        $icon = 'credit-card';
        $link = route('dashboard'); // Link to user dashboard page
        $data = [
            'application_id' => $application->id,
            'amount' => $application->approved_amount,
            'disbursed_at' => $application->disbursed_at
        ];
        
        return self::create($user, $message, $title, $type, $icon, $link, $data);
    }
    
    /**
     * Create grant application updated notification for user
     *
     * @param User $user The user who updated the application
     * @param GrantApplication $application The grant application
     * @return Notification
     */
    public static function grantApplicationUpdated($user, $application)
    {
        $title = 'Grant Application Updated';
        $message = 'Your grant application has been updated successfully.';
        $type = 'info';
        $icon = 'edit';
        $link = route('grant.view', $application->id);
        $data = [
            'application_id' => $application->id,
            'requested_amount' => $application->requested_amount,
            'application_type' => $application->application_type
        ];
        
        return self::create($user, $message, $title, $type, $icon, $link, $data);
    }
    
    /**
     * Create grant application updated notification for admin
     *
     * @param GrantApplication $application The grant application
     * @return void
     */
    public static function notifyAdminOfUpdatedApplication($application)
    {
        // Get all admins or specific admin roles that should be notified
        $admins = Admin::all();
        
        $title = 'Grant Application Updated';
        $message = 'A grant application has been updated by ' . $application->user->name . ' ' . $application->user->lastname;
        $type = 'info';
        $icon = 'edit';
        $link = route('admin.grants.view', $application->id);
        $data = [
            'application_id' => $application->id,
            'user_id' => $application->user_id,
            'requested_amount' => $application->requested_amount,
            'application_type' => $application->application_type
        ];
        
        foreach ($admins as $admin) {
            // Assuming there's an admin notification system similar to user notifications
            // If not, you would need to implement or modify this part
            // AdminNotification::create(...)
        }
    }
}