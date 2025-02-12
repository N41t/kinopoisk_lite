<?php

namespace App\Kernel\Validator;

class Validator
{

    // свойство для ошибок
    private array $errors = [];
    private array $data;


    // первый аргумент - данные (ключ+значение), второй - правила валидации
    // validate (['name' => 'test'], ['name' => 'required|min:3|max:10'] )
    public function validate(array $data, array $rules): bool
    {
        // очищение errors
        $this->errors = [];
        $this->data = $data;

        foreach ($rules as $key => $rule) {
            // разбиение строки на правила обычно происходит через '|', но у нас будет все заносится в массив
            $rules = $rule;

            // разбиение строки внутри правил (min:3)
            foreach ($rules as $rule) {
                $rule = explode(':', $rule);

                // упаковка значений в переменные
                $ruleName = $rule[0];
                $ruleValue = $rule[1] ?? null;

                // собираем ошибку
                $error = $this->validateRule($key, $ruleName, $ruleValue);

                if ($error) {
                    $this->errors[$key][] = $error;
                }
            }
        }

        // если в errors есть ошибки - false, если ошибки отсутствуют - true
        return empty($this->errors);
    }


    // получение ошибок
    public function errors(): array
    {
        return $this->errors;
    }


    private function validateRule(string $key, string $ruleName, string $ruleValue = null): string|false
    {
        // ищем элемент по ключу
        $value = $this->data[$key];

        // проверка правил
        switch ($ruleName) {
            case 'required':
                if (empty($value)) {
                    return "Field $key is required";
                }
                break;

            case 'min':
                if (strlen($value) < $ruleValue) {
                    return "Field $key must be at least {$ruleValue} characters long";
                }
                break;

            case 'max':
                if (strlen($value) > $ruleValue) {
                    return "Field $key must be at most {$ruleValue} characters long";
                }
                break;

            case 'email':
                if (! filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    return "Field $key must be a valid email address";
                }
                break;
        }

        return false;
    }

}