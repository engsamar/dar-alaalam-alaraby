<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | such as the size rules. Feel free to tweak each of these messages.
    |
    */

    'accepted'         => 'يجب قبول الحقل :attribute',
    'active_url'       => 'الحقل :attribute لا يُمثّل رابطًا صحيحًا',
    'before'           => 'يجب على الحقل :attribute أن يكون تاريخًا سابقًا للتاريخ :date.',
    'after'            => 'يجب على الحقل :attribute أن يكون تاريخًا لاحقًا للتاريخ :date.',
    'alpha'            => 'يجب أن لا يحتوي الحقل :attribute سوى على حروف',
    'alpha_dash'       => 'يجب أن لا يحتوي الحقل :attribute على حروف، أرقام ومطّات.',
    'alpha_num'        => 'يجب أن يحتوي :attribute على حروفٍ وأرقامٍ فقط',
    'array'            => 'يجب أن يكون الحقل :attribute ًمصفوفة',
    'between'          => [
        'numeric' => 'يجب أن تكون قيمة :attribute محصورة ما بين :min و :max.',
        'file'    => 'يجب أن يكون حجم الملف :attribute محصورًا ما بين :min و :max كيلوبايت.',
        'string'  => 'يجب أن يكون عدد حروف النّص :attribute محصورًا ما بين :min و :max',
        'array'   => 'يجب أن يحتوي :attribute على عدد من العناصر محصورًا ما بين :min و :max',
    ],
    'boolean'          => 'يجب أن تكون قيمة الحقل :attribute إما true أو false ',
    'confirmed'        => 'حقل التأكيد غير مُطابق للحقل :attribute',
    'date'             => 'الحقل :attribute ليس تاريخًا صحيحًا',
    'date_format'      => 'لا يتوافق الحقل :attribute مع الشكل :format.',
    'different'        => 'يجب أن يكون الحقلان :attribute و :other مُختلفان',
    'digits'           => 'يجب أن يحتوي الحقل :attribute على :digits رقمًا/أرقام',
    'digits_between'   => 'يجب أن يحتوي الحقل :attribute ما بين :min و :max رقمًا/أرقام ',
    'email'            => 'فضلا  ادخال الايميل بطريقة صحيحة',
     'exists'           => 'هذا الحقل غير صحيح',
    'image'            => 'يجب أن يكون الحقل :attribute صورةً',
    'in'               => 'الحقل :attribute لاغٍ',
    'integer'          => 'يجب أن يكون الحقل :attribute عددًا صحيحًا',
    'ip'               => 'يجب أن يكون الحقل :attribute عنوان IP ذي بُنية صحيحة',
    'max'              => [
        'numeric' => 'يجب أن تكون قيمة الحقل :attribute أصغر من :max.',
        'file'    => 'يجب أن يكون حجم الملف :attribute أصغر من :max كيلوبايت',
        'string'  => 'يجب أن لا يتجاوز طول النّص :attribute :max حروفٍ/حرفًا',
        'array'   => 'يجب أن لا يحتوي الحقل :attribute على أكثر من :max عناصر/عنصر.',
    ],
    'mimes'            => 'يجب أن يكون الحقل ملفًا من نوع : :values.',
    'min'              => [
        'numeric' => 'يجب أن تكون قيمة الحقل :attribute أكبر من :min.',
        'file'    => 'يجب أن يكون حجم الملف :attribute أكبر من :min كيلوبايت',
        'string'  => 'يجب أن يكون طول النص :attribute أكبر :min حروفٍ/حرفًا',
        'array'   => 'يجب أن يحتوي الحقل :attribute على الأقل على :min عُنصرًا/عناصر',
    ],
    'not_in'           => 'الحقل :attribute لاغٍ',
    'numeric'          => 'يجب على الحقل :attribute أن يكون رقمًا',
    'regex'            => 'صيغة الحقل :attribute .غير صحيحة',
    'required'         => 'الحقل :attribute مطلوب ادخاله',
    'required_if'      => 'الحقل :attribute مطلوب في حال ما إذا كان :other يساوي :value.',
    'required_with'    => 'الحقل :attribute إذا توفّر :values.',
    'required_with_all' => 'الحقل :attribute إذا توفّر :values.',
    'required_without' => 'الحقل :attribute إذا لم يتوفّر :values.',
    'required_without_all' => 'الحقل :attribute إذا لم يتوفّر :values.',
    'same'             => 'يجب أن يتطابق الحقل :attribute مع :other',
    'size'             => [
        'numeric' => 'يجب أن تكون قيمة :attribute أكبر من :size.',
        'file'    => 'يجب أن يكون حجم الملف :attribute أكبر من :size كيلو بايت.',
        'string'  => 'يجب أن يحتوي النص :attribute عن ما لا يقل عن  :size حرفٍ/أحرف.',
        'array'   => 'يجب أن يحتوي الحقل :attribute عن ما لا يقل عن:min عنصرٍ/عناصر',
    ],
    'timezone'         => 'يجب أن يكون :attribute نطاقًا زمنيًا صحيحًا',
    'unique'           => 'قيمة الحقل :attribute مُستخدمة من قبل',
    'url'              => 'صيغة الرابط :attribute غير صحيحة',
    'phone' =>  'رقم الموبايل المدخل غير صالح',

    'mobile' => [
        'unique' =>  'قيمة الحقل رقم الهاتف مستخدمة من قبل',
        'phone' =>  'رقم الموبايل المدخل غير صالح',
    ],
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
        'email' => [
             'unique' => 'البريد الالكتروني مستخدم مسبقاً',
             'email' => 'فضلاً ادخل الايميل بطريقة صحيحة',
        ]
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

    'attributes' => [
        'name' => 'الاسم',
        'users' => 'المستخدمين',
        'username' => 'اسم المُستخدم',
        'email' => 'البريد الالكتروني',
        'first_name' => 'الاسم',
        'last_name' => 'اسم العائلة',
        'password' => 'كلمة المرور',
        'city' => 'المدينة',
        'country' => 'الدولة',
        'address' => 'العنوان',
        'phone' => 'الهاتف',
        'mobile' => 'الجوال',
        'age' => 'العمر',
        'sex' => 'الجنس',
        'gender' => 'النوع',
        'day' => 'اليوم',
        'month' => 'الشهر',
        'year' => 'السنة',
        'hour' => 'ساعة',
        'minute' => 'دقيقة',
        'second' => 'ثانية',
        'title' => 'اللقب',
        'content' => 'المُحتوى',
        'description' => 'الوصف',
        'excerpt' => 'المُلخص',
        'date' => 'التاريخ',
        'time' => 'الوقت',
        'available' => 'مُتاح',
        'size' => 'الحجم',
    ],

];