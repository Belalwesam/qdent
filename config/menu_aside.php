<?php
// Aside menu
return [

    'items' => [
        // Dashboard
        [
            'title' => 'Dashboard',
            'root' => true,
            'icon' => 'media/svg/icons/Design/Layers.svg', // or can be 'flaticon-home' or any flaticon-*
            'page' => '/admin',
            'new-tab' => false,
        ],
        [
            'section' => 'App',
        ],
        [
            'title' => 'Category',
            'icon' => 'media/svg/icons/Text/Bullet-list.svg',
            'bullet' => 'dot',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'Add',
                    'page' => 'admin/category/create',

                ],
                [
                    'title' => 'All',
                    'page' => 'admin/category',

                ]
            ],
        ],
        [
            'title' => 'Sub Category ',
            'icon' => 'media/svg/icons/Shopping/Sort1.svg',
            'bullet' => 'dot',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'Add',
                    'bullet' => 'dot',
                    'page' => 'admin/subcategory/create'

                ],
                [
                    'title' => 'All',
                    'bullet' => 'dot',
                    'page' => 'admin/subcategory/'

                ],
            ]
        ],
        [
            'title' => '  Products ',
            'icon' => 'media/svg/icons/Shopping/Box2.svg',
            'bullet' => 'dot',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'Add',
                    'bullet' => 'dot',
                    'page' => 'admin/product/create'

                ],
                [
                    'title' => 'All',
                    'bullet' => 'dot',
                    'page' => 'admin/product/'

                ],
            ]
        ],
        [
            'title' => 'Attribute Product',
            'icon' => 'media/svg/icons/General/Other1.svg',
            'bullet' => 'dot',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'Add',
                    'bullet' => 'dot',
                    'page' => 'admin/attrabiute/create'

                ],
                [
                    'title' => 'All',
                    'bullet' => 'dot',
                    'page' => 'admin/attrabiute/'

                ],
            ]
        ],
        [
            'title' => 'Event',
            'icon' => 'media/svg/icons/Design/Circle.svg',
            'bullet' => 'dot',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'Add',
                    'bullet' => 'dot',
                    'page' => 'admin/event/create'

                ],
                [
                    'title' => 'All',
                    'bullet' => 'dot',
                    'page' => 'admin/event/'

                ],
            ]
        ],
        [
            'title' => 'Feeds',
            'icon' => 'media/svg/icons/General/Bookmark.svg',
            'bullet' => 'dot',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'Add',
                    'bullet' => 'dot',
                    'page' => 'admin/feed/create'

                ],
                [
                    'title' => 'All',
                    'bullet' => 'dot',
                    'page' => 'admin/feed/'

                ],
            ]
        ],
        [
            'title' => 'Catalog',
            'icon' => 'media/svg/icons/Files/Selected-file.svg',
            'bullet' => 'dot',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'Add',
                    'bullet' => 'dot',
                    'page' => 'admin/catalog/create'

                ],
                [
                    'title' => 'All',
                    'bullet' => 'dot',
                    'page' => 'admin/catalog/'

                ],
            ]
        ],
        [
            'title' => '  Orders',
            'icon' => 'media/svg/icons/Shopping/Sale1.svg',
            'bullet' => 'dot',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'Add',
                    'bullet' => 'dot',
                    'page' => 'admin/orders/create'

                ],
                [
                    'title' => 'All',
                    'bullet' => 'dot',
                    'page' => 'admin/orders/'

                ],
                [
                    'title' => 'Completed',
                    'bullet' => 'dot',
                    'page' => 'admin/orders/get/completed'

                ],
                [
                    'title' => ' Pending',
                    'bullet' => 'dot',
                    'page' => 'admin/orders/get/pending'

                ],
                [
                    'title' => 'processing',
                    'bullet' => 'dot',
                    'page' => 'admin/orders/get/processing'

                ], [
                    'title' => 'delivered',
                    'bullet' => 'dot',
                    'page' => 'admin/orders/get/delivered'

                ],

            ]
        ],
        [
            'title' => '   Brands  ',
            'icon' => 'media/svg/icons/Shopping/Bag2.svg',
            'bullet' => 'dot',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'Add',
                    'bullet' => 'dot',
                    'page' => 'admin/brand/create'

                ],
                [
                    'title' => 'All',
                    'bullet' => 'dot',
                    'page' => 'admin/brand/'

                ],
            ]
        ],
        [
            'section' => 'Users',
        ],


        [
            'title' => '   Admins ',
            'icon' => 'media/svg/icons/Communication/Shield-user.svg',
            'bullet' => 'dot',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'Add',
                    'bullet' => 'dot',
                    'page' => 'admin/admin/create'

                ],
                [
                    'title' => 'All',
                    'bullet' => 'dot',
                    'page' => 'admin/admin/'

                ],

            ]
        ],
        [
            'title' => '   Users ',
            'icon' => 'media/svg/icons/Communication/Group.svg',
            'bullet' => 'dot',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'Add',
                    'bullet' => 'dot',
                    'page' => 'admin/user/create'

                ],
                [
                    'title' => 'All',
                    'bullet' => 'dot',
                    'page' => 'admin/user'

                ],

            ]
        ],
        [
            'title' => '   Employees ',
            'icon' => 'media/svg/icons/Communication/Contact1.svg',
            'bullet' => 'dot',
            'root' => true,
            'submenu' => [
                [
                    'title' => 'Add',
                    'bullet' => 'dot',
                    'page' => 'admin/employee/create'

                ],
                [
                    'title' => 'All',
                    'bullet' => 'dot',
                    'page' => 'admin/employee/'

                ],

            ]
        ],
        // [
        //     'title' => '   My Account ',
        //     'icon' => 'media/svg/icons/General/User.svg',
        //     'bullet' => 'dot',
        //     'root' => true,
        //     'submenu' => [

        //         [
        //             'title' => 'Edit',
        //             'bullet' => 'dot',
        //             'page' => 'admin/account/'

        //         ],
        //         [
        //             'title' => ' Logout',
        //             'bullet' => 'dot',
        //             'page' => 'admin/account/logout'

        //         ],

        //     ]
        // ],
        [
            'title' => '   Chat  ',
            'icon' => 'media/svg/icons/Communication/Group-chat.svg',
            'bullet' => 'dot',
            'root' => true,
            'submenu' => [

                [
                    'title' => 'All',
                    'bullet' => 'dot',
                    'page' => 'admin/chat/'

                ],
                [
                    'title' => 'new',
                    'bullet' => 'dot',
                    'page' => 'admin/chat/new'

                ],


            ]
        ],
        [
            'section' => 'Setting',
        ],
        [
            'title' => 'Shipping Methods',
            'icon' => 'media/svg/icons/Shopping/Box2.svg',
            'bullet' => 'dot',
            'root' => true,
            'submenu' => [

                [
                    'title' => 'Create',
                    'bullet' => 'dot',
                    'page' => 'admin/shippingmethod/create'

                ],
                [
                    'title' => ' All',
                    'bullet' => 'dot',
                    'page' => 'admin/shippingmethod'

                ],

            ]
        ],

        [
            'title' => '   Setting ',
            'icon' => 'media/svg/icons/General/Settings-1.svg',
            'bullet' => 'dot',
            'root' => true,
            'submenu' => [

                [
                    'title' => 'Edit',
                    'bullet' => 'dot',
                    'page' => 'admin/setting/'

                ],
                [
                    'title' => 'Privacy',
                    'bullet' => 'dot',
                    'page' => 'admin/setting/privacy'

                ],
                [
                    'title' => 'Terms',
                    'bullet' => 'dot',
                    'page' => 'admin/setting/terms'

                ], [
                    'title' => 'About',
                    'bullet' => 'dot',
                    'page' => 'admin/setting/about'

                ],
                [
                    'title' => 'App Version',
                    'bullet' => 'dot',
                    'page' => 'admin/app-version'

                ],
                [
                    'title' => 'Guest Login',
                    'bullet' => 'dot',
                    'page' => 'admin/guest-login'

                ],
            ]
        ],

        // Custom





    ]

];
