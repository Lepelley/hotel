<?php

return [
    '_default' => [
        'controller' => 'Home',
        'view'       => 'home.phtml'
    ], 'clean' => [
        'controller' => 'Clean',
        'view'       => 'clean.phtml'
    ], 'login' => [
        'controller' => 'Login',
        'view'       => 'login.phtml'
    ], 'register' => [
        'controller' => 'Register',
        'view'       => 'register.phtml'
    ], 'booking/add' => [
        'controller' => 'BookingAdd',
        'view'       => 'booking_add.phtml'
    ], 'admin' => [
        'controller' => 'Admin',
        'view'       => 'admin',
        'view-admin' => 'home.phtml'
    ], 'admin/customers' => [
        'controller' => 'AdminCustomers',
        'view'       => 'admin',
        'view-admin' => 'customers_list.phtml'
    ], 'admin/customers/update' => [
        'controller' => 'CustomerUpdate',
        'view'       => 'admin',
        'view-admin' => 'customer_update.phtml'
    ], 'admin/customers/delete' => [
        'controller' => 'CustomerDelete',
    ], 'admin/rooms' => [
        'controller' => 'AdminRooms',
        'view'       => 'admin',
        'view-admin' => 'rooms_list.phtml'
    ], 'admin/rooms/update' => [
        'controller' => 'RoomUpdate',
        'view'       => 'admin',
        'view-admin' => 'room_update.phtml'
    ], 'admin/rooms/delete' => [
        'controller' => 'RoomDelete',
    ], 'admin/bookings' => [
        'controller' => 'AdminBookings',
        'view'       => 'admin',
        'view-admin' => 'bookings_list.phtml'
    ], 'admin/booking/check' => [
        'controller'    => 'BookingCheck',
        'view'          => 'admin',
        'view-admin'    => 'booking_check.phtml'
    ], 'admin/booking/delete' => [
        'controller'    => 'BookingDelete'
    ]
];
