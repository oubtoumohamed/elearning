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

    'accepted'             => ' :attribute doit être accepté.',
    'active_url'           => ' :attribute n est pas une URL valide.',
    'after'                => ' :attribute doit être une date après :date.',
    'after_or_equal'       => ' :attribute doit être une date postérieure ou égale à :date.',
    'alpha'                => ' :attributene peut contenir que des lettres.',
    'alpha_dash'           => ' :attribute ne peut contenir que des lettres, des chiffres et des tirets.',
    'alpha_num'            => ' :attribute ne peut contenir que des lettres et des chiffres.',
    'array'                => ' :attribute doit être un tableau.',
    'before'               => ' :attribute  doit être une date antérieure à :date.',
    'before_or_equal'      => ' :attribute doit être une date antérieure ou égale à :date.',
    'between'              => [
        'numeric' => ' :attribute doit être compris entre :min et :max.',
        'file'    => ' :attribute doit être compris entre :min et :max kilo-octets.',
        'string'  => ' :attribute doit être compris entre :min et :max caractères.',
        'array'   => ' :attribute doit avoir entre :min et :max articles.',
      ],
    'boolean'              => ' :attribute attribute doit être vrai ou faux.',
    'confirmed'            => ' :attribute confirmation de l attribut ne correspond pas.',
    'date'                 => ' :attribute n est pas une date valide.',
    'date_format'          => ' :attribute ne correspond pas au format :format.',
    'different'            => ' :attribute et :other doit être différent.',
    'digits'               => ' :attribute Doit être  :digits chiffres.',
    'digits_between'       => ' :attribute Doit être entre :min et :max chiffres.',
    'dimensions'           => ' :attribute a des dimensions d image non valides.',
    'distinct'             => ' :attribute le champ a une valeur en double.',
    'email'                => ' :attribute Doit être une adresse e-mail valide.',
    'exists'               => ' The selected :attribute est invalide.',
    'file'                 => ' :attribute doit être un fichier.',
    'filled'               => ' :attribute le champ doit avoir une valeur.',
    'image'                => ' :attribute doit être une image.',
    'in'                   => 'The selected :attribute est invalide.',
    'in_array'             => ' :attribute champ n existe pas dans :other.',
    'integer'              => ' :attribute Doit être un entier.',
    'ip'                   => ' :attribute doit être une adresse IP valide.',
    'ipv4'                 => ' :attribute doit être une adresse IPv4 valide.',
    'ipv6'                 => ' :attribute doit être une adresse IPv6 valide.',
    'json'                 => ' :attribute doit être une chaîne JSON valide.',
    'max'                  => [
        'numeric' => ':attribute ne peut pas être supérieur à :max.',
        'file'    => ':attribute ne peut pas être supérieur à :max kilo-octets.',
        'string'  => ':attribute ne peut pas être supérieur à :max caractères.',
        'array'   => ':attribute ne peut pas avoir plus de :max articles.',
    ],
    'mimes'                => ':attribute doit être un fichier de type: :values.',
    'mimetypes'            => ':attribute doit être un fichier de type: :values.',
    'min'                  => [
        'numeric' => ':attribute doit être au moins :min.',
        'file'    => ':attribute doit être au moins :min kilo-octets.',
        'string'  => ':attribute doit être au moins :min caractères.',
        'array'   => ':attribute doit avoir au moins :min articles.',
    ],
    'not_in'               => 'La sélection :attribute est invalide.',
    'numeric'              => ':attribute doit être un nombre.',
    'present'              => ':attribute le champ doit être présent.',
    'regex'                => ':attribute le format n est pas valide.',
    'required'             => ':attribute Champ requis.',
    'required_if'          => ':attribute champ est obligatoire lorsque :other est :value.',
    'required_unless'      => ':attribute champ est obligatoire sauf si :other est dans :values.',
    'required_with'        => ':attribute Champ est obligatoire lorsque :values est présent.',
    'required_with_all'    => ':attribute Champ est obligatoire lorsque :values est présent.',
    'required_without'     => ':attribute Champ est obligatoire lorsque :values n est pas présent.',
    'required_without_all' => ':attribute Champ est obligatoire lorsqu aucune des :values sont présents.',
    'same'                 => ':attribute et :other doit correspondre.',
    'size'                 => [
        'numeric' => ':attribute doit être :size.',
        'file'    => ':attributedoit être :size kilo-octets.',
        'string'  => ':attribute doit être :size characters.',
        'array'   => ':attribute doit contenir :size articles.',
    ],
    'string'               => ':attribute doit être une chaîne.',
    'timezone'             => ':attribute doit être une zone valide.',
    'unique'               => ':attribute a déjà été pris.',
    'uploaded'             => ':attribute échec du téléchargement.',
    'url'                  => ':attribute le format n est pas valide.',

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
