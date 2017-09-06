<?php

namespace CodePub\Providers;

use Illuminate\Foundation\AliasLoader;
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
        \Form::macro('error', function ($field, $errors){
            if(!str_contains($field, '.*') && $errors->has($field) || count($errors->get($field)) > 0){
                return view('errors.error_field', compact('field'));
            }
            return null;
        });

        \Form::macro('check', function ($field, $value) {
            return '<div class="checkbox checkbox-primary">'.
                        \Form::checkbox($field, $value, $value, ['id' => $field]).
                        '<label for="published">Publicado?</label>
                    </div>';
        });

        \Html::macro('openFormGroup', function($field = null, $errors = null){
            $result = false;
            if($field != null && $errors != null){
                if(is_array($field)){
                    foreach ($field as $value) {
                        if(!str_contains($value, '.*') && $errors->has($value) || count($errors->get($value)) > 0){
                            $result = true;
                            break;
                        }
                    }
                } else {
                    if(!str_contains($field, '.*') && $errors->has($field) || count($errors->get($field)) > 0){
                        $result = true;
                    }
                }
            }
            $hasError = $result ? ' has-error' : '';
            return "<div class=\"form-group{$hasError}\">";
        });

        \Html::macro('closeFormGroup', function(){
            return "</div>";
        });

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

        \Html::macro('search', function ($field) {
            $input = \Form::text($field, null, ['class' => 'form-control input-lg', 'placeholder' => 'Buscar']);
            $button = \Button::withValue()->prependIcon(\Icon::search())->submit();

            return "<div id=\"custom-search-input\" style=\"margin-top: 10px;\">
                        <div class=\"input-group col-md-12\">
                            {$input}
                            <span class=\"input-group-btn\">{$button}</span>
                        </div>
                    </div>";
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // See: https://gist.github.com/richnicholls404/7449378
        if ($this->app->environment() !== 'production') {
            $this->registerPackagesEnv();
            $this->registerAliases();
        }
        //
    }

    public function registerPackagesEnv()
    {
        $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        $this->app->register(\Nwidart\Modules\LaravelModulesServiceProvider::class);
    }

    public function registerAliases()
    {
        AliasLoader::getInstance()->alias('Module', \Nwidart\Modules\Facades\Module::class);
    }
}
