<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Auth;
use \App\Task;
class yetki_servis extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        //admin_mi == 1 ise Ayarları gösterde kullanılıyor;
            view()->composer('*', function($view){
                if(Auth::check() == true){
                $user = Auth::user();
                $admin_mi = $user->admin_mi;
               $rt_mi = 0;
               if($user->name == "Taha Bahadır Durmuş" || $user->name == "Recai Yüksel" || $user->name == "Pelin Kuzgun"){
               $rt_mi = 1;
               }

                return $view->with('admin_mi',$admin_mi)->with('rt_mi',$rt_mi);
                }
            });
      
    }
}