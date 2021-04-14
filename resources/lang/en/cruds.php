<?php

return [

    'permission'     => [
        'title'          => 'Permissions',
        'title_singular' => 'Permission',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'title'             => 'Title',
            'title_helper'      => '',
            'created_at'        => 'Created at',
            'created_at_helper' => '',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => '',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => '',
        ],
    ],
    'role'           => [
        'title'          => 'Roles',
        'title_singular' => 'Role',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => '',
            'title'              => 'Title',
            'title_helper'       => '',
            'permissions'        => 'Permissions',
            'permissions_helper' => '',
            'created_at'         => 'Created at',
            'created_at_helper'  => '',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => '',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => '',
        ],
    ],
    'user'           => [
        'title'          => 'Users Management',
        'title_add_modal' => 'Adding User',
        'title_edit_modal' => 'Editing User',
        'fields'         => [
            'id'                       => 'ID',
            'nip'                      => 'NIP',
            'name'                     => 'Full Name',
            'email'                    => 'Email',
            'verify'                   => 'Verify Email',
            'email_verified_at'        => 'Email verified at',
            'password'                 => 'Password',
            'password_confirm'         => 'Retype Password',
            'role'                     => 'Role',
            'status'                   => 'Status',
            'created_at'               => 'Created',
            'updated_at'               => 'Updated',
            'add'                      => 'Add Data',
            'edit'                     => 'Edit Data',
            'close'                    => 'Close',
            'action'                   => 'Action',

        ],
    ],

    'register'           => [
        'title'          => 'Register a new membership',
        'fields'         => [
            'name'                     => 'Full Name',
            'nip'                     => 'NIP',
            'email'                    => 'Email',
            'password'                 => 'Password',
            'password_confirm'           => 'Retype Password',
        ],
    ],

    'student'        => [
        'title'          => 'Students',
        'title_singular' => 'Student',
        'fields'         => [
            'id'                     => 'ID',
            'id_helper'              => '',
            'first_name'             => 'First Name',
            'first_name_helper'      => '',
            'last_name'              => 'Last Name',
            'last_name_helper'       => '',
            'email'                  => 'Email',
            'email_helper'           => '',
            'billing_address'        => 'Billing Address',
            'billing_address_helper' => '',
            'action'                 => 'Action',
            'action_helper'          => '',
            'created_at'             => 'Created at',
            'created_at_helper'      => '',
            'updated_at'             => 'Updated at',
            'updated_at_helper'      => '',
            'deleted_at'             => 'Deleted at',
            'deleted_at_helper'      => '',
        ],
    ],
    'attendance'     => [
        'title'          => 'Attendance',
        'title_singular' => 'Attendance',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'event_date'        => 'Event Date',
            'event_date_helper' => '',
            'student'           => 'Student',
            'student_helper'    => '',
            'created_at'        => 'Created at',
            'created_at_helper' => '',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => '',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => '',
        ],
    ],
];
