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

    'accepted'             => '. :attribute يجب قبول',
    'active_url'           => 'رابط غير صالح : :attribute ',
    'after'                => ':date  يجب ان يكون تاريخا بعد :attribute ',
    'after_or_equal'       => ':date  يجب ان يكون تاريخا يكافئ او بعد :attribute ',
    'alpha'                => 'يجب ان يحتوي attribute: على أحرف فقط.',
    'alpha_dash'           => 'يجب ان يحتوي  attribute: على أحرف وأرقام وشَرطة فقط.',
    'alpha_num'            => 'يجب ان يحتوي attribute: على أحرف وأرقام فقط.',
    'array'                => 'يجب أن تكون attribute: عبارة عن قائمة.',
    'before'               => ':date  يجب ان يكون تاريخا قبل :attribute ',
    'before_or_equal'      => ':date  يجب ان يكون تاريخا قبل او يكافئ :attribute ',
    'between'              => [
        'numeric' => 'يجب أن تكون attribute: بين min: و max: .',
        'file'    => 'يجب أن تكون attribute: بين min: و max: كيلوبايت.',
        'string'  => 'يجب أن تكون attribute: بين min: و max: حروف.',
        'array'   => 'يجب أن تكون attribute: بين min: و max: عناصر.',
    ],
    'boolean'              => 'true و false تقبل قيمتين فقط :attribute  .',
    'confirmed'            => ' :attribute لا يتطابق التأكيد مع',
    'date'                 => ' :attribute ليس تاريخا صالحا',
    'date_format'          => ':format لا يتطابق مع :attribute ',
    'different'            => ':attribute و :other يجب أن يكون مختلف .',
    'digits'               => ':attribute يجب أن يكون :digits أرقام.',
    'digits_between'       => ':attribute يجب أن تكون :min  و :max أرقام.',
    'dimensions'           => ':attribute أبعاد الصورة غير صالحة.',
    'distinct'             => ':attribute تم ادخال المعلومة سابقا.',
    'email'                => ':attribute يجب أن يكون البريد الإلكتروني صالح.',
    'exists'               => 'المختار :attribute غير صالح.',
    'file'                 => ':attribute يجب أن يكون ملف.',
    'filled'               => ':attribute عليك ادخال قيمة.',
    'image'                => ':attribute عليك ادخال صورة.',
    'in'                   => 'المختار :attribute غير صالح.',
    'in_array'             => ':attribute محتوى الخانة غير موجود في :other.',
    'integer'              => ':attribute يجب أن يكون صحيحا.',
    'ip'                   => ':attribute يجب أن يكون عنوان IP صالحًا.',
    'ipv4'                 => ':attribute يجب أن يكون عنوان IPv4 صالحًا.',
    'ipv6'                 => ':attribute يجب أن يكون عنوان IPv6 صالحًا.',
    'json'                 => ':attribute يجب أن تكون سلسلة JSON صالحة.',
    'max'                  => [
        'numeric' => ':attribute  لا يكون أكبر من :max.',
        'file'    => ':attribute  لا يكون أكبر من :max كيلوبايت.',
        'string'  => ':attribute لا يكون أكبر من :max characters.',
        'array'   => ':attribute لا يكون لديه أكثر من :max العناصر.',
    ],
    'mimes'                => ':attribute   يجب أن يكون ملف من النوع: :values.',
    'mimetypes'            => ':attribute   يجب أن يكون ملف من النوع: :values.',
    'min'                  => [
        'numeric' => ':attribute لا بد أن يكون على الأقل :min.',
        'file'    => ':attribute لا بد أن يكون على الأقل :min كيلوبايت.',
        'string'  => ':attribute لا بد أن يكون على الأقل :min characters.',
        'array'   => ':attribute لا بد أن يكون على الأقل :min العناصر.',
    ],
    'not_in'               => 'المختار :attribute غير صالح.',
    'numeric'              => ':attribute يجب أن يكون رقما.',
    'present'              => ':attribute يجب أن يكون ملء الخانة اولا.',
    'regex'                => ':attribute التنسيق غير صالح.',
    'required'             => ':attribute محتوى الخانة مطلوب.',
    'required_if'          => ':attribute    محتوى الخانة مطلوب عندما:other يكون :value.',
    'required_unless'      => ':attribute محتوى الخانة مطلوب  إلا  :other يجب أن يكون في :values.',
    'required_with'        => ':attribute  مطلوب عندما :values يجب أن يكون حاضر.',
    'required_with_all'    => ':attribute محتوى الخانة مطلوب عندما  :values يجب أن يكون حاضر.',
    'required_without'     => ':attribute محتوى الخانة مطلوب عندما  :values يجب أن لا تكون موجودة.',
    'required_without_all' => ':attribute محتوى الخانة مطلوب عندما لا شيء من :values حاضرون.',
    'same'                 => ':attribute و :other يجب أن تتطابق.',
    'size'                 => [
        'numeric' => ':attribute يجب أن يكون :size.',
        'file'    => ':attribute  يجب أن يكون :size كيلوبايت.',
        'string'  => ':attribute يجب أن يكون :size characters.',
        'array'   => ':attribute يجب أن تحتوي على :size العناصر.',
    ],
    'string'               => ':attribute يجب أن يكون string.',
    'timezone'             => ':attribute يجب أن تكون صالحة.',
    'unique'               => ':attribute لقد اتخذت بالفعل.',
    'uploaded'             => ':attribute فشل في التحميل.',
    'url'                  => ':attribute الرابط غير صالح.',

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
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
