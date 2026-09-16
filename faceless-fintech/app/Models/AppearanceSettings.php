<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppearanceSettings extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        // Primary color variants
        'primary_color',
        'primary_color_50',
        'primary_color_100',
        'primary_color_200',
        'primary_color_300',
        'primary_color_400',
        'primary_color_600',
        'primary_color_700',
        'primary_color_foreground',
        
        // Secondary color variants
        'secondary_color',
        'secondary_color_50',
        'secondary_color_100',
        'secondary_color_200',
        'secondary_color_300',
        'secondary_color_400',
        'secondary_color_600',
        'secondary_color_700',
        'secondary_color_foreground',
        
        // Accent color variants
        'accent_color',
        'accent_color_50',
        'accent_color_100',
        'accent_color_200',
        'accent_color_300',
        'accent_color_400',
        'accent_color_600',
        'accent_color_700',
        'accent_color_foreground',
        
        // Background, foreground, and other UI colors
        'background_color',
        'foreground_color',
        'card_color',
        'card_foreground_color',
        'muted_color',
        'muted_foreground_color',
        'border_color',
        'input_color',
        'ring_color',
        
        // Gradient colors
        'gradient_pink_from',
        'gradient_purple_via',
        'gradient_indigo_to',
        
        // Action colors
        'yellow_action',
        'green_positive',
        'red_negative',
        
        // Preloader specific colors
        'preloader_background',
        'preloader_background_dark',
        'preloader_text_color',
        'preloader_accent_color',
        
        // Other settings
        'use_gradient',
        'gradient_direction',
        'custom_css',
        'disable_animations',
        'notes'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'use_gradient' => 'boolean',
        'disable_animations' => 'boolean',
    ];

    /**
     * Get the appearance settings instance or create default if none exists.
     *
     * @return \App\Models\AppearanceSettings
     */
    public static function getSettings()
    {
        $settings = self::first();
        
        if (!$settings) {
            $settings = self::create([
                // Primary color variants (sky blue)
                'primary_color' => '#0ea5e9', // sky-500
                'primary_color_50' => '#f0f9ff',
                'primary_color_100' => '#e0f2fe',
                'primary_color_200' => '#bae6fd',
                'primary_color_300' => '#7dd3fc',
                'primary_color_400' => '#38bdf8',
                'primary_color_600' => '#0284c7',
                'primary_color_700' => '#0369a1',
                'primary_color_foreground' => '#ffffff',
                
                // Secondary color variants (slate)
                'secondary_color' => '#64748b', // slate-500
                'secondary_color_50' => '#f8fafc',
                'secondary_color_100' => '#f1f5f9',
                'secondary_color_200' => '#e2e8f0',
                'secondary_color_300' => '#cbd5e1',
                'secondary_color_400' => '#94a3b8',
                'secondary_color_600' => '#475569',
                'secondary_color_700' => '#334155',
                'secondary_color_foreground' => '#0f172a',
                
                // Accent color variants (pink)
                'accent_color' => '#ec4899',
                'accent_color_50' => '#fdf2f8',
                'accent_color_100' => '#fce7f3',
                'accent_color_200' => '#fbcfe8',
                'accent_color_300' => '#f9a8d4',
                'accent_color_400' => '#f472b6',
                'accent_color_600' => '#db2777',
                'accent_color_700' => '#be185d',
                'accent_color_foreground' => '#ffffff',
                
                // Background, foreground, and other UI colors
                'background_color' => '#f8fafc',
                'foreground_color' => '#1e293b',
                'card_color' => '#ffffff',
                'card_foreground_color' => '#1e293b',
                'muted_color' => '#f1f5f9',
                'muted_foreground_color' => '#64748b',
                'border_color' => '#e2e8f0',
                'input_color' => '#e2e8f0',
                'ring_color' => '#0ea5e9',
                
                // Gradient colors
                'gradient_pink_from' => '#ec4899',
                'gradient_purple_via' => '#a855f7',
                'gradient_indigo_to' => '#4f46e5',
                
                // Action colors
                'yellow_action' => '#facc15',
                'green_positive' => '#22c55e',
                'red_negative' => '#ef4444',
                
                // Preloader specific colors
                'preloader_background' => 'rgba(255, 255, 255, 0.95)',
                'preloader_background_dark' => 'radial-gradient(ellipse at center, rgba(14, 165, 233, 0.12) 0%, rgba(17, 24, 39, 0.95) 50%, rgba(17, 24, 39, 1) 100%)',
                'preloader_text_color' => '#1e293b',
                'preloader_accent_color' => '#0ea5e9',
                
                // Other settings
                'use_gradient' => true,
                'gradient_direction' => 'to right',
                'custom_css' => null,
                'disable_animations' => false,
                'notes' => 'Default appearance settings'
            ]);
        }
        
        return $settings;
    }
}