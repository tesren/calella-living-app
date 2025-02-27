<?php

namespace App\Providers;

use App\Nova\Unit;
use App\Nova\Shape;
use App\Models\User;
use App\Nova\User as NovaUser;
use App\Nova\Message;
use App\Nova\Section;
use App\Nova\UnitType;
use Laravel\Nova\Nova;
use App\Nova\PaymentPlan;
use Laravel\Nova\Menu\Menu;
use Illuminate\Http\Request;
use App\Nova\Dashboards\Main;
use Laravel\Fortify\Features;
use Laravel\Nova\Menu\MenuItem;
use Laravel\Nova\Menu\MenuGroup;
use Laravel\Nova\Menu\MenuSection;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Blade;
use Laravel\Nova\NovaApplicationServiceProvider;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        parent::boot();

        Nova::withBreadcrumbs();

        Nova::mainMenu(function (Request $request) {
            return [
                MenuSection::dashboard(Main::class)->icon('template'),
               
                MenuSection::resource(Unit::class)->icon('home'), 
                MenuSection::resource(Section::class)->icon('template'), 
                MenuSection::resource(UnitType::class)->icon('collection'),     
                MenuSection::resource(PaymentPlan::class)->icon('currency-dollar'),
                MenuSection::resource(Message::class)->icon('inbox-in'),
                MenuSection::resource(Shape::class)->icon('cube'),
                MenuSection::resource(NovaUser::class)->icon('user-circle')
            ];
        });

        Nova::userMenu(function (Request $request, Menu $menu) {
            
            $menu->append(
                MenuItem::externalLink(__('Ver Sitio Web'), url('/'))
            );

            $menu->prepend(
                MenuItem::link(__('Mi Perfil'), '/resources/users/'.$request->user()->getKey())
            );

            return $menu;
        });
        

        Nova::footer(function ($request) {
            return Blade::render('
                <div class="mt-8 leading-normal text-xs text-gray-500 space-y-1">
                    <p class="text-center">Powered by <a href="https://punto401.com/" target="_blank" rel="noopener noreferrer" class="link-default">Punto401</a></p>
                </div>
            ');
        });
        //
    }

    /**
     * Register the configurations for Laravel Fortify.
     */
    protected function fortify(): void
    {
        Nova::fortify()
            ->features([
                Features::updatePasswords(),
                // Features::emailVerification(),
                // Features::twoFactorAuthentication(['confirm' => true, 'confirmPassword' => true]),
            ])
            ->register();
    }

    /**
     * Register the Nova routes.
     */
    protected function routes(): void
    {
        Nova::routes()
            ->withAuthenticationRoutes(default: true)
            ->withPasswordResetRoutes()
            ->withoutEmailVerificationRoutes()
            ->register();
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     */
    protected function gate(): void
    {
        Gate::define('viewNova', function (User $user) {
            return in_array($user->email, [
                //
            ]);
        });
    }

    /**
     * Get the dashboards that should be listed in the Nova sidebar.
     *
     * @return array<int, \Laravel\Nova\Dashboard>
     */
    protected function dashboards(): array
    {
        return [
            new \App\Nova\Dashboards\Main,
        ];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array<int, \Laravel\Nova\Tool>
     */
    public function tools(): array
    {
        return [];
    }

    /**
     * Register any application services.
     */
    public function register(): void
    {
        parent::register();

        //
    }
}
