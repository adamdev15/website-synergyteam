<?php

namespace App\Providers;

use App\Models\Subcategory;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        view()->composer('layouts.landing', function ($view) {
            $view->with('subcategories', Subcategory::with('products')->get());
        });

        ResetPassword::toMailUsing(function (object $notifiable, string $token) {
            $url = url(route('password.reset', [
                'token' => $token,
                'email' => $notifiable->getEmailForPasswordReset(),
            ], false));

            return (new MailMessage)
                ->subject('Atur Ulang Kata Sandi - Synergy Team')
                ->greeting('Halo, ' . ($notifiable->name ?? 'Pengguna Synergy Team') . '!')
                ->line('Kami menerima permintaan untuk mereset kata sandi akun Synergy Team Anda.')
                ->action('Atur Ulang Kata Sandi', $url)
                ->line('Tautan pengaturan ulang kata sandi ini hanya berlaku selama 60 menit.')
                ->line('Jika Anda tidak meminta pengaturan ulang kata sandi, silakan abaikan email ini. Akun Anda tetap aman.')
                ->salutation("Salam hangat,\nTim Synergy Team");
        });
    }
}
