<?php

namespace CodePub\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Html::macro('formGroup', function ($field, $label, $errors) {
            $class_erro = $errors->has($field) ? 'has-error' : '';
            $string = "<div class=\"form-group $class_erro \">";
            $string .= \Form::label($field, $label, ['class' => 'control-label']);
            $string .= \Form::text($field, null, ['class' => 'form-control']);
            if ($class_erro):
                $string .= "<span class='help-block'><strong>{$errors->first($field)}</strong></span>";
            endif;
            $string .= "</div>";
            return $string;
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
        //
    }
}
