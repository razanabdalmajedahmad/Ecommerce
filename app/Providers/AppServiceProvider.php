<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if(!app()->runningInConsole())
        {
            $setting=Setting::first();
            if(!$setting){
                $setting=Setting::create([
                    'phone'=>'+021-95-51-84',
                    'email'=>'email@email.com',
                    'description_en'=>'store web site description',
                    'description_ar'=>'وصف موقع الويب الخاص بالمخزن',
                    'name_en'=>'store web site',
                    'name_ar'=>'متجر على شبكة الإنترنت',
                    'logo'=>'assets/img/logo.png',
                    'location'=>'1734 Stonecoal Road',
                ]);
            }
            view()->share('setting',$setting);
        }
    }
}
