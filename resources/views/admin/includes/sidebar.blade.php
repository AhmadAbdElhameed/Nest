<div class="main-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

            <li class="nav-item active"><a href="{{route('admin.dashboard')}}"><i class="la la-mouse-pointer"></i><span
                        class="menu-title" data-i18n="nav.add_on_drag_drop.main">{{__('admin/sidebar.home')}}</span></a>
            </li>

{{--            <li class="nav-item">--}}
{{--                <a href=""><i class="la la-home"></i>--}}
{{--                    <span class="menu-title" data-i18n="nav.dash.main">لغات الموقع </span>--}}
{{--                    <span--}}
{{--                        class="badge badge badge-info badge-pill float-right mr-2"></span>--}}
{{--                </a>--}}
{{--                <ul class="menu-content">--}}
{{--                    <li class="active"><a class="menu-item" href=""--}}
{{--                                          data-i18n="nav.dash.ecommerce"> عرض الكل </a>--}}
{{--                    </li>--}}
{{--                    <li><a class="menu-item" href="" data-i18n="nav.dash.crypto">أضافة--}}
{{--                            لغة جديده </a>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--            </li>--}}


{{--            @can('categories')--}}
                <li class="nav-item"><a href=""><i class="la la-group"></i>
                        <span class="menu-title" data-i18n="nav.dash.main">{{__('admin/sidebar.category_title')}}</span>
                        <span
                            class="badge badge badge-danger badge-pill float-right mr-2"></span>
                    </a>
                    <ul class="menu-content">
                        <li class="active"><a class="menu-item" href="{{route('admin.category.index')}}"
                                              data-i18n="nav.dash.ecommerce">{{__('admin/sidebar.category')}}</a>
                        </li>
                        <li><a class="menu-item" href="{{route('admin.category.create')}}" data-i18n="nav.dash.crypto">{{__('admin/sidebar.category_create')}}</a>
                        </li>
                    </ul>
                </li>
{{--            @endcan--}}


            <li class="nav-item"><a href=""><i class="la la-group"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">{{__('admin/sidebar.sub-category_title')}}</span>
                    <span
                        class="badge badge badge-danger badge-pill float-right mr-2">400</span>
                </a>
                <ul class="menu-content">
                    <li class="active"><a class="menu-item" href="{{route('admin.sub-category.index')}}"
                                          data-i18n="nav.dash.ecommerce">{{__('admin/sidebar.sub-category')}}</a>
                    </li>
                    <li><a class="menu-item" href="{{route('admin.sub-category.create')}}" data-i18n="nav.dash.crypto">{{__('admin/sidebar.sub-category_create')}}</a>
                    </li>
                </ul>
            </li>


            <li class="nav-item"><a href=""><i class="la la-male"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">{{__('admin/sidebar.brands_title')}}</span>
                    <span
                        class="badge badge badge-warning  badge-pill float-right mr-2"></span>
                </a>
                <ul class="menu-content">
                    <li class="active"><a class="menu-item" href="{{route('admin.brand.index')}}"
                                          data-i18n="nav.dash.ecommerce">{{__('admin/sidebar.brands')}} </a>
                    </li>
                    <li><a class="menu-item" href="{{route('admin.brand.create')}}" data-i18n="nav.dash.crypto">{{__('admin/sidebar.brands_create')}} </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item"><a href=""><i class="la la-male"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">{{__('admin/sidebar.tags_title')}}</span>
                    <span
                        class="badge badge badge-warning  badge-pill float-right mr-2"></span>
                </a>
                <ul class="menu-content">
                    <li class="active"><a class="menu-item" href="{{route('admin.tag.index')}}"
                                          data-i18n="nav.dash.ecommerce">{{__('admin/sidebar.tags')}} </a>
                    </li>
                    <li><a class="menu-item" href="{{route('admin.tag.create')}}" data-i18n="nav.dash.crypto">{{__('admin/sidebar.tags_create')}} </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item"><a href=""><i class="la la-male"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">{{__('admin/sidebar.products_title')}}</span>
                    <span
                        class="badge badge badge-warning  badge-pill float-right mr-2"></span>
                </a>
                <ul class="menu-content">
                    <li class="active"><a class="menu-item" href="{{route('admin.product.index')}}"
                                          data-i18n="nav.dash.ecommerce">{{__('admin/sidebar.products')}} </a>
                    </li>
                    <li><a class="menu-item" href="{{route('admin.product.create')}}" data-i18n="nav.dash.crypto">{{__('admin/sidebar.products_create')}} </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item"><a href=""><i class="la la-male"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">خصائص المنتج  </span>
                    <span
                        class="badge badge badge-success badge-pill float-right mr-2"></span>
                </a>
                <ul class="menu-content">
                    <li class="active"><a class="menu-item" href="{{route('admin.attribute.index')}}"
                                          data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                    </li>
                    <li><a class="menu-item" href="{{route('admin.attribute.create')}}" data-i18n="nav.dash.crypto">أضافة
                            جديدة  </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item"><a href=""><i class="la la-male"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">options  </span>
                    <span
                        class="badge badge badge-success badge-pill float-right mr-2"></span>
                </a>
                <ul class="menu-content">
                    <li class="active"><a class="menu-item" href="{{route('admin.option.index')}}"
                                          data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                    </li>
                    <li><a class="menu-item" href="{{route('admin.option.create')}}" data-i18n="nav.dash.crypto">أضافة
                            جديدة  </a>
                    </li>
                </ul>
            </li>



            <li><a class="nav-item" href="#" data-i18n="nav.templates.vert.main">Roles & Permissions</a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="{{route('admin.role.index')}}"
                           data-i18n="nav.templates.vert.classic_menu">All Roles</a>
                    </li>
                    <li><a class="menu-item" href="{{route('admin.role.create')}}"
                           data-i18n="nav.templates.vert.classic_menu">Create New Role</a>
                    </li>

                </ul>
            </li>

            <li><a class="nav-item" href="#" data-i18n="nav.templates.vert.main">Admins</a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="{{route('admin.user.index')}}"
                           data-i18n="nav.templates.vert.classic_menu">All Admins</a>
                    </li>
                    <li><a class="menu-item" href="{{route('admin.user.create')}}"
                           data-i18n="nav.templates.vert.classic_menu">Add New Admin</a>
                    </li>

                </ul>
            </li>

{{--            <li class="nav-item">--}}
{{--                <a href=""><i class="la la-male"></i>--}}
{{--                    <span class="menu-title" data-i18n="nav.dash.main">تذاكر المراسلات   </span>--}}
{{--                    <span--}}
{{--                        class="badge badge badge-danger  badge-pill float-right mr-2">0</span>--}}
{{--                </a>--}}
{{--                <ul class="menu-content">--}}
{{--                    <li class="active"><a class="menu-item" href=""--}}
{{--                                          data-i18n="nav.dash.ecommerce"> تذاكر الطلاب </a>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--            </li>--}}


            <li class=" nav-item"><a href="#"><i class="la la-television"></i><span class="menu-title"
                                            data-i18n="nav.templates.main">{{ __('admin/sidebar.settings') }}</span></a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="#" data-i18n="nav.templates.vert.main">{{ __('admin/sidebar.shipping_rules') }}</a>
                        <ul class="menu-content">
                            <li><a class="menu-item" href="{{route('admin.settings.shipping-method','free')}}"
                                   data-i18n="nav.templates.vert.classic_menu">{{ __('admin/sidebar.free_shipping') }}</a>
                            </li><li><a class="menu-item" href="{{route('admin.settings.shipping-method','inner')}}"
                                   data-i18n="nav.templates.vert.classic_menu">{{ __('admin/sidebar.inner_shipping') }}</a>
                            </li>
                            <li><a class="menu-item" href="{{route('admin.settings.shipping-method','outer')}}">{{ __('admin/sidebar.outer_shipping') }}</a>
                            </li>

                        </ul>
                    </li>
                    <li><a class="menu-item" href="#" data-i18n="nav.templates.vert.main">Sliders</a>
                        <ul class="menu-content">
                            <li><a class="menu-item" href="{{route('admin.slider.index')}}"
                                   data-i18n="nav.templates.vert.classic_menu">All Sliders</a>
                            </li>
                            <li><a class="menu-item" href="{{route('admin.slider.create')}}"
                                        data-i18n="nav.templates.vert.classic_menu">Create New Slider</a>
                            </li>

                        </ul>
                    </li>


                    <li><a class="menu-item" href="{{route('admin.settings.edit.2fa',auth()->guard('admin')->user())}}">Edit 2 FA</a>
                    </li>
                </ul>
            </li>


        </ul>
    </div>
</div>
