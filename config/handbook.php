<?php

return [
    'email_template_types' => [
        [
            'id' => 1,
            'name' => 'Сервис'
        ],
        [
            'id' => 2,
            'name' => 'Обратная связь'
        ]
    ],
    'application_subject_types' => [
        [
            'id' => 1,
            'name' => 'Выступление на мероприятиях'
        ],
        [
            'id' => 2,
            'name' => 'Тема 2'
        ],
        [
            'id' => 3,
            'name' => 'Тема 3'
        ]
    ],
    'notification_types' => [
        [
            'id' => 1,
            'name' => 'Получать уведомления о добавленных мероприятиях'
        ],
        [
            'id' => 2,
            'name' => 'Получать напоминания о моих мероприятиях'
        ],
        [
            'id' => 3,
            'name' => 'Получать уведомления о новых статьях за неделю'
        ]
    ],
    'article_view_type' => [
        [
            'id' => 1,
            'name' => 'Малый прямоугольник',
            'class_postfix' => '_middle'
        ],
        [
            'id' => 2,
            'name' => 'Большой прямоугольник',
            'class_postfix' => '_big'
        ],
        [
            'id' => 3,
            'name' => 'Малый квадрат',
            'class_postfix' => '_small'
        ],
        [
            'id' => 4,
            'name' => 'Большой квадрат',
            'class_postfix' => '_big-main'
        ]
    ],
    'user_roles' => [
        [
            'id' => 1,
            'name' => 'Владелец',
            'inn_placeholder' => 'ИНН',
        ],
        [
            'id' => 2,
            'name' => 'Сотрудник',
            'inn_placeholder' => 'ИНН',
        ],
        [
            'id' => 3,
            'name' => 'Иное',
            'inn_placeholder' => 'Укажите роль',
        ],
    ],
    'closed_block_text' => 'Чтобы прочитать статью, войдите или зарегистрируйтесь',
    'limit_block_text' => 'Чтобы продолжить чтение, войдите или зарегистрируйтесь',
];
