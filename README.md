# ArrayValidator
A Laravel package to manage validation for array values.

# Installation

Add this package name in composer.json

    "require": {
      "sukohi/array-validator": "1.*"
    }

Execute composer command.

    composer update
    
#Usage

Make your own Request using the following command.

    php artisan make:request *****Request

* see [here](http://laravel.com/docs/5.1/validation#form-request-validation) for the details

Set ArrayValidator the Request class like this.

    <?php
    
    namespace App\Http\Requests;
    
    use Illuminate\Foundation\Http\FormRequest;
    use Sukohi\ArrayValidator\ArrayValidatorTrait;
    
    class YourRequest extends Request
    {
        use ArrayValidatorTrait;
        
        // Something..
    }
    
Now your Request class can manage array validation.
So add your validation rules there as usual.

    public function rules()
    {
        return [
            'emails' => 'required|email'
        ];
    }

**Set Attribute**

You also can set attribute names as usual.  
`{key}` will be replaced with array key like `0`, `1`, `2`, `key`.

    public function attributes() {

        return [
            'titles' => 'Title - {key}'
        ];

    }

**Get Error Message**

(in Blade)

    {{ $errors->first('titles.0') }}
    {{ $errors->first('titles.1') }}
    {{ $errors->first('titles.2') }}
    {{ $errors->first('titles.key') }}


**Note**

If you use `Collective` package, you need to set input names like this. 

    {!! Form::text('titles[0]') !!}<br>
    {!! Form::text('titles[1]') !!}<br>
    {!! Form::text('titles[2]') !!}<br>
    {!! Form::text('titles[key]') !!}
    
**HTML Example**

    <!-- Errors -->
    
    @if($errors->first('titles.0'))
        {{ $errors->first('titles.0') }}<br>
    @endif
    @if($errors->first('titles.1'))
        {{ $errors->first('titles.1') }}<br>
    @endif
    @if($errors->first('titles.2'))
        {{ $errors->first('titles.2') }}<br>
    @endif
    @if($errors->first('titles.key'))
        {{ $errors->first('titles.key') }}<br>
    @endif
    
    
    <!-- Form -->
    
    {!! Form::open(['route' => 'YOUR-ROUTE']) !!}
    {!! Form::text('titles[0]') !!}<br>
    {!! Form::text('titles[1]') !!}<br>
    {!! Form::text('titles[2]') !!}<br>
    {!! Form::text('titles[key]') !!}
    <button type="submit">Submit</button>
    {!! Form::close() !!}

License
====

This package is licensed under the MIT License.

Copyright 2015 Sukohi Kuhoh