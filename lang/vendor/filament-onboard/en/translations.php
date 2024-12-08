<?php

return [
    // You can also use a similar word like "Ready", "Finished" or "Complete".
    'done' => 'Done',
    'widgets' => [
        'onboard-track-widget' => [
            'actions' => [
                'skip-step-action' => [
                    'label' => 'Skip',
                    'modal_heading' => 'Are you sure you want to skip the :stepName step?',
                    'messages' => [
                        'success' => [
                            'title' => 'Track skipped',
                        ],
                    ],
                ],
            ],
        ],
    ],
    'livewire' => [
        'onboard' => [
            'step' => 'step',
            'actions' => [
                'skip-step-action' => [
                    'label' => 'Skip',
                    'modal_heading' => 'Are you sure you want to skip the :stepName step?',
                    'messages' => [
                        'success' => [
                            'title' => 'Track skipped',
                        ],
                    ],
                ],
            ],
        ],
    ],
];
