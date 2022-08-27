<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use Laravel\Passport\Passport;
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        VerifyEmail::toMailUsing(function($notifiable,$url){
          $spaUrl="http://spa.test?email_verify_url".$url ;
          return (new MailMessage)
          ->subject('verify Email Address')
          ->line('click the button below to verify your email Addrress')
          ->action('verify Email Address',$spaUrl);
        });
       // Passport::routes();
         Gate::define('drivers_create' , fn(User $user)=> $user->isAdmin);
         Gate::define('drivers_edit' , fn(User $user)=> $user->isAdmin);
         Gate::define('drivers_delete' , fn(User $user)=> $user->isAdmin);
         Gate::define('drivers_rating' , fn(User $user)=> $user->isAdmin);



         Gate::define('accept_request' , fn(User $user)=> $user->isDriver);
         Gate::define('show_requests' , fn(User $user)=> $user->isDriver);
         Gate::define('finish_ride' , fn(User $user)=> $user->isDriver);
         Gate::define('reject_request' , fn(User $user)=> $user->isDriver);
         Gate::define('driver_location' , fn(User $user)=> $user->isDriver);


    
    }
}
