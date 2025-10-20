<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Amange;
use App\Models\Copain;

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
        Schema::defaultStringLength(191);

        // Partager le nombre de repas à évaluer avec toutes les vues
        View::composer('*', function ($view) {
            $repasAEvaluer = 0;
            
            if (Auth::check()) {
                $copain = Copain::where('user_id', Auth::id())->first();
                
                if ($copain) {
                    $repasAEvaluer = Amange::where('id_copain', $copain->id_copain)
                        ->whereNull('prix')
                        ->whereNull('qualite_nourriture')
                        ->whereNull('ambiance')
                        ->whereNull('overall')
                        ->whereNull('avis')
                        ->count();
                }
            }
            
            $view->with('repasAEvaluer', $repasAEvaluer);
        });
    }
}
