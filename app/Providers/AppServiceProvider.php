<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
<<<<<<< HEAD
=======
use App\Models\Loan;
use App\Policies\LoanPolicy;
>>>>>>> 077f2ba7555bf4d01cbea2e7efd19cf3d7a1f086

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
        //
    }
<<<<<<< HEAD
=======
    protected $policies = [
    Loan::class => LoanPolicy::class,
    ];
>>>>>>> 077f2ba7555bf4d01cbea2e7efd19cf3d7a1f086
}
