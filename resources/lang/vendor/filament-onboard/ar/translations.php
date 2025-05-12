<?php

return [
    // يمكنك أيضًا استخدام كلمة مشابهة مثل "جاهز"، "منتهي" أو "مكتمل".
    'done' => 'تم',
    'widgets' => [
        'onboard-track-widget' => [
            'actions' => [
                'skip-step-action' => [
                    'label' => 'تخطي',
                    'modal_heading' => 'هل أنت متأكد أنك تريد تخطي خطوة :stepName؟',
                    'messages' => [
                        'success' => [
                            'title' => 'تم تخطي التتبع',
                        ],
                    ],
                ],
            ],
        ],
    ],
    'livewire' => [
        'onboard' => [
            'step' => 'الخطوة',
            'actions' => [
                'skip-step-action' => [
                    'label' => 'تخطي',
                    'modal_heading' => 'هل أنت متأكد أنك تريد تخطي خطوة :stepName؟',
                    'messages' => [
                        'success' => [
                            'title' => 'تم تخطي التتبع',
                        ],
                    ],
                ],
            ],
        ],
    ],
];
