<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ImageArrayRule implements Rule
{
    /**
     * @var Request
     */
    private Request $request;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $validator = Validator::make([$attribute => $value], [
            $attribute => 'required|array'
        ]);

        if($validator->fails()) {
            return false;
        }

        if(count($this->request->input('images') ?? []) + count($this->request->file('images') ?? []) > 3){
            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'images field must be an array of images and strings with not more than 3 items.';
    }
}
