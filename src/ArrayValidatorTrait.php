<?php namespace Sukohi\ArrayValidator;

trait ArrayValidatorTrait {

	// Override
	protected function getValidatorInstance()
	{
		$factory = $this->container->make('Illuminate\Validation\Factory');

		if (method_exists($this, 'validator')) {
			return $this->container->call([$this, 'validator'], compact('factory'));
		}

		$data = $this->all();
		$rules = $this->container->call([$this, 'rules']);
		$messages = $this->messages();
		$attributes = $this->attributes();

		foreach ($data as $key => $value) {

			if(is_array($value)) {

				$array_values = $value;

				if(isset($rules[$key])) {

					$rule = $rules[$key];

					foreach($array_values as $array_key => $array_value) {

						$new_key = $key .'.'. $array_key;
						$data[$new_key] = $array_value;
						$rules[$new_key] = $rule;

						if(isset($attributes[$key])) {

							$attributes[$new_key] = str_replace('{key}', $array_key, $attributes[$key]);

						}

					}

					unset(
						$data[$key], $rules[$key], $attributes[$key]
					);

				}

			}

		}

		return $factory->make(
			$data, $rules, $messages, $attributes
		);
	}
}