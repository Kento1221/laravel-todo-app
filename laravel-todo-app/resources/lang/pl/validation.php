<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => ':attribute musi zostać zaakceptowany.',
    'accepted_if' => ':attribute musi zostać zaakceptowany, jeśli wartość :other to :value.',
    'active_url' => ':attribute nie jeest poprawnym adresem URL.',
    'after' => ':attribute musi być datą późniejszą niż :date.',
    'after_or_equal' => ':attribute musi być datą późniejszą, bądź równą :date.',
    'alpha' => ':attribute może zawierać tylko litery.',
    'alpha_dash' => ':attribute może zawierać wyłącznie litery, cyfry, myśliniki i podkreślenia.',
    'alpha_num' => ':attribute może zawierać wyłącznie litery i cyfry.',
    'array' => ':attribute musi być tablicą.',
    'before' => ':attribute musi być datą wcześniejszą niż :date.',
    'before_or_equal' => ':attribute musi być datą wcześniejszą lub równą :date.',
    'between' => [
        'numeric' => ':attribute musi być pomiędzy :min i :max.',
        'file' => ':attribute musi być ważyć pomiędzy :min i :max KB.',
        'string' => ':attribute musi mieć pomiędzy :min i :max znaków.',
        'array' => ':attribute musi zawierać pomiędzy :min i :max obiektów.',
    ],
    'boolean' => ':attribute musi być True albo False.',
    'confirmed' => ':attribute confirmation does not match.',
    'current_password' => 'hasło jest nieprawidłowe.',
    'date' => ':attribute nie jest poprawną datą.',
    'date_equals' => ':attribute musi być równy :date.',
    'date_format' => ':attribute nie pasuje formatem do :format.',
    'different' => ':attribute oraz :other muszą mieć różne wartości.',
    'digits' => ':attribute musi mieć :digits cyfr.',
    'digits_between' => ':attribute musi mieć pomiędzy :min a :max cyfr.',
    'dimensions' => ':attribute posiada nieprawidłowe rozmiary obrazu',
    'distinct' => 'Pole :attribute nie jest unikatowe.',
    'email' => ':attribute musi być poprawnym adresem email.',
    'ends_with' => ':attribute musi kończyć się jedną z podanych wartości: :values.',
    'exists' => 'Wybrane pole :attribute jest nieprawidłowe.',
    'file' => ':attribute musi być plikiem.',
    'filled' => ':attribute musi mieć wartość.',
    'gt' => [
        'numeric' => ':attribute musi być większe niż :value.',
        'file' => ':attribute musi ważyć więcej niż :value KB.',
        'string' => ':attribute musi być dłuższe niż :value znaków.',
        'array' => ':attribute musi zawierać więcej niż :value obiektów.',
    ],
    'gte' => [
        'numeric' => ':attribute musi być większe, bądź równe :value.',
        'file' => ':attribute musi ważyć więcej lub dokładnie :value KB.',
        'string' => ':attribute musi być dłuższy lub równy :value znakom.',
        'array' => ':attribute musi zawierać więcej lub dokładnie :value obiektów.',
    ],
    'image' => ':attribute musi być obrazem.',
    'in' => 'Wybrane pole :attribute jest nieprawidłowe.',
    'in_array' => 'Pole :attribute nie istnieje w :other.',
    'integer' => ':attribute musi być liczbą całkowitą.',
    'ip' => ':attribute musi być poprawnym adresem IP.',
    'ipv4' => ':attribute musi być poprawnym adresem IPv4.',
    'ipv6' => ':attribute musi być poprawnym adresem IPv6.',
    'json' => ':attribute musi byc poprawnym ciągiem JSON.',
    'lt' => [
        'numeric' => ':attribute musi być mniejszy niż :value.',
        'file' => ':attribute musi być mniejszy niż :value KB.',
        'string' => ':attribute musi być krótszy niż :value znaków.',
        'array' => ':attribute musi zawierać mniej niż :value obiektów.',
    ],
    'lte' => [
        'numeric' => ':attribute musi być mniejszy lub równy :value.',
        'file' => ':attribute musi ważyć mniej lub dokładnie :value KB.',
        'string' => ':attribute musi być krótszy lub równy :value znakom.',
        'array' => ':attribute musi zawierać więcej lub dokładnie :value obiektów.',
    ],
    'max' => [
        'numeric' => 'Pole :attribute musi być mniejszy od :max.',
        'file' => 'Pole :attribute musi ważyć mniej niż :max KB.',
        'string' => 'Pole :attribute musi być krótsze niż :max znaków.',
        'array' => 'Pole :attribute musi zawierać mniej niż :max obiektów.',
    ],
    'mimes' => ':attribute musi być plikiem typu: :values.',
    'mimetypes' => ':attribute musi być plikiem typu: :values.',
    'min' => [
        'numeric' => ':attribute musi być większy niż :min.',
        'file' => ':attribute musi ważyć przynajmniej :min KB.',
        'string' => ':attribute musi być dłuższy niż :min znaków.',
        'array' => ':attribute musi zawierać przynajmniej :min obiektów.',
    ],
    'multiple_of' => ':attribute musi być wielokrotnością :value.',
    'not_in' => 'Pole :attribute jest nieprawidłowe.',
    'not_regex' => 'Format pola :attribute jest nieprawidłowy.',
    'numeric' => ':attribute musi być numerem.',
    'password' => 'hasło jest nieprawidłowe.',
    'present' => 'Pole :attribute musi być obecne.',
    'regex' => 'Format pola :attribute jest nieprawidłowy.',
    'required' => 'Pole :attribute jest wymagane.',
    'required_if' => 'Pole :attribute jest wymagane jeśli :other to :value.',
    'required_unless' => 'Pole :attribute jest wymagane jeśli :other to jedna z wartości: :values.',
    'required_with' => 'Pole :attribute jest wymagane gdy pola: :values są obecne.',
    'required_with_all' => 'Pole :attribute jest wymagane jeśli wszystkie pola: :values są obecne.',
    'required_without' => 'Pole :attribute jest wymagane jeśli :values nie jest obecne.',
    'required_without_all' => 'Pole :attribute jest wymagane jeśli żadna z wartości: :values nie jest obecna.',
    'prohibited' => 'Pole :attribute jest zabronione.',
    'prohibited_if' => 'Pole :attribute jest zabronione jeśli :other to :value.',
    'prohibited_unless' => 'Pole :attribute jest zabronione, chyba że :other jest z zakresu :values.',
    'same' => ':attribute oraz :other muszą mieć te same wartości.',
    'size' => [
        'numeric' => ':attribute musi być :size.',
        'file' => ':attribute musi ważyć :size KB.',
        'string' => ':attribute musi mieć :size znaków.',
        'array' => ':attribute musi zawierać :size obiektów.',
    ],
    'starts_with' => 'Pole :attribute musi zaczynać się jedną z podanych wartości: :values.',
    'string' => ':attribute musi być ciągiem znaków.',
    'timezone' => ':attribute musi być poprawną strefą czasową.',
    'unique' => 'Wartość pola :attribute została juz zajęta.',
    'uploaded' => 'Zawartość pola :attribute nie została wysłana.',
    'url' => ':attribute musi być poprawnym adresem URL.',
    'uuid' => ':attribute musi być poprawnym UUID.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
