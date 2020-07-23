<?php

namespace LumenFormRequest\Providers;


use Illuminate\Support\ServiceProvider;
use Laravel\Lumen\Http\Request;
use LumenFormRequest\Requests\FormRequest;

class FormRequestServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->extend(Request::class, function (Request $request) {
            return new FormRequest($request);
        });
    }

    public function boot()
    {
        $this->app->afterResolving(FormRequest::class, function (FormRequest $formRequest) {
            $formRequest->validate();
        });
    }
}
