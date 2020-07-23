# Lumen Form Request

![License](https://poser.pugx.org/laravel/lumen-framework/license.svg)

Lumen Form request is a solution based on Form Request from laravel to provide modularized request validations.

## Installation

Run command above do install with composer.

```composer require brunocrpontes/lumen-form-request```

## How to use


1. Add the following line to your `app.php` file:
    ```php
    $app->register(LumenFormRequest\Providers\FormRequestServiceProvider::class);
    ```
2. Create an ```Request``` class extending from ```FormRequest.php``` like above:
   ```php
   <?php
   
   use LumenFormRequest\Requests\FormRequest;
   
   class ExampleFormRequest extends FormRequest {
        
       // DO YOUR VALIDATION HERE 
       public function rules() : array
       {
           return [
               'email' => 'email|required'  
           ];
       } 
   
       //IF YOU WISH RETURN WITH CUSTOM MESSAGES
       public function messages(): array 
       {
           return [
               'email.required' => 'We need to know your e-mail address!',
           ];
       }
   }
   ```

