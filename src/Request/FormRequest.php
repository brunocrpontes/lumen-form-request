<?php

namespace LumenFormRequest\Requests;

use Illuminate\Http\Request;
use Illuminate\Validation\Validator;
use Laravel\Lumen\Routing\ProvidesConvenienceMethods;

class FormRequest extends Request
{
    use ProvidesConvenienceMethods {
        validate as baseValidate;
        formatValidationErrors as baseFormatValidationErrors;
    }

    private $validatedFields = [];

    public function __construct(Request $request)
    {
        $files = $request->files->all();

        $files = is_array($files) ? array_filter($files) : $files;

        parent::__construct(
            $request->query->all(),
            $request->request->all(),
            $request->attributes->all(),
            $request->cookies->all(),
            $files,
            $request->server->all(),
            $request->getContent()
        );

        $request->headers->replace($request->headers->all());

        $request->setJson($request->json());

        if ($session = $request->getSession()) {
            $request->setLaravelSession($session);
        }

        $this->setUserResolver($request->getUserResolver());

        $this->setRouteResolver($request->getRouteResolver());
    }

    public function validate()
    {
        $validated = $this->baseValidate(
            $this,
            $this->rules(),
            $this->messages()
        );

        $this->validatedFields = $validated;

        return $validated;
    }

    public function validated()
    {
        return $this->validatedFields;
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [];
    }
}
