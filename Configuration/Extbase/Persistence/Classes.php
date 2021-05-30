<?php
declare(strict_types=1);

return [
    \TN\Techradar\Domain\Model\FileReference::class => [
        'tableName' => 'sys_file_reference',
        'properties' => [
            'uid_local' => [
                'fieldName' => 'originalFileIdentifier'
            ],
        ]
    ],
];