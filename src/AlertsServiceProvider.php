<?php

namespace LiveControls\Alerts;

use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\ServiceProvider;
use LiveControls\Alerts\Http\Livewire\SweetAlert;
use Livewire\Livewire;

class AlertsServiceProvider extends ServiceProvider
{
  public function register()
  {
    
  }

  public function boot()
  {

    $this->loadTranslationsFrom(__DIR__.'/../lang', 'livecontrols-alerts');
    $this->loadViewsFrom(__DIR__.'/../resources/views', 'livecontrols-alerts');

    Livewire::component('livecontrols-sweetalert', SweetAlert::class);
    
    //MACROS
    //Add alert Macros
    Redirector::macro('alert', function ($data) {
      return $this->with('alert', $data);
    });
    RedirectResponse::macro('alert', function ($data) {
      return $this->with('alert', $data);
    });
      
      $this->publishes([
        __DIR__.'/../config/config.php' => config_path('livecontrols.php'),
      ], 'livecontrols.alerts.config');

      $this->publishes([
        __DIR__.'/../lang' => $this->app->langPath('vendor/livecontrols'),
      ], 'livecontrols.alerts.localization');

      $this->publishes([
        __DIR__.'/../resources/views' => resource_path('views/vendor/livecontrols'),
      ], 'livecontrols.alerts.views');
  }
}
