@php
    $systemSetting = App\Models\SystemSetting::first();
@endphp

<div class="sticky">
    <div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
    <div class="app-sidebar">
        <div class="side-header">
            <a class="header-brand1" href="{{ route('dashboard') }}">
                <img src="{{ asset($systemSetting->logo ?? 'frontend/eVento_logo.png') }}"
                    class="header-brand-img desktop-logo" alt="logo">
                <img src="{{ asset($systemSetting->favicon ?? 'frontend/eVento_logo.png') }}"
                    class="header-brand-img toggle-logo" alt="logo">
                <img src="{{ asset($systemSetting->favicon ?? 'frontend/eVento_logo.png') }}"
                    class="header-brand-img light-logo" alt="logo">
                <img src="{{ asset($systemSetting->logo ?? 'frontend/eVento_logo.png') }}"
                    class="header-brand-img light-logo1" alt="logo">
            </a>
        </div>

        <div class="main-sidemenu">
            <div class="slide-left disabled" id="slide-left">
                <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24"
                    viewBox="0 0 24 24">
                    <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z" />
                </svg>
            </div>

            <ul class="side-menu">
                <li class="slide">
                    <a class="side-menu__item has-link" data-bs-toggle="slide" href="{{ route('dashboard') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-house-icon lucide-house">
                            <path d="M15 21v-8a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v8" />
                            <path
                                d="M3 10a2 2 0 0 1 .709-1.528l7-5.999a2 2 0 0 1 2.582 0l7 5.999A2 2 0 0 1 21 10v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                        </svg>
                        <span class="side-menu__label icon-margin">Dashboard</span>
                    </a>
                </li>
                <li class="slide {{ request()->is('users*') ? 'active is-expanded' : '' }}">
                    <a class="side-menu__item {{ request()->is('users*') ? 'active is-expanded' : '' }}"
                        data-bs-toggle="slide" href="{{ route('users.index') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-circle-user-icon lucide-circle-user">
                            <circle cx="12" cy="12" r="10" />
                            <circle cx="12" cy="10" r="3" />
                            <path d="M7 20.662V19a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v1.662" />
                        </svg>
                        <span class="side-menu__label icon-margin">User Lists</span>
                    </a>
                </li>
                {{-- <li class="slide {{ request()->is('chat*') ? 'active is-expanded' : '' }}">
                    <a class="side-menu__item {{ request()->is('chat*') ? 'active is-expanded' : '' }}"
                        data-bs-toggle="slide" href="{{ route('chat.index') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"
                            class="lucide lucide-message-circle-more-icon lucide-message-circle-more">
                            <path
                                d="M2.992 16.342a2 2 0 0 1 .094 1.167l-1.065 3.29a1 1 0 0 0 1.236 1.168l3.413-.998a2 2 0 0 1 1.099.092 10 10 0 1 0-4.777-4.719" />
                            <path d="M8 12h.01" />
                            <path d="M12 12h.01" />
                            <path d="M16 12h.01" />
                        </svg>
                        <span class="side-menu__label icon-margin">Chatting with User</span>
                    </a>
                </li>
                <li class="slide {{ request()->is('question*') ? 'active is-expanded' : '' }}">
                    <a class="side-menu__item {{ request()->is('question*') ? 'active is-expanded' : '' }}"
                        data-bs-toggle="slide" href="{{ route('question.index') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"
                            class="lucide lucide-circle-question-mark-icon lucide-circle-question-mark">
                            <circle cx="12" cy="12" r="10" />
                            <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3" />
                            <path d="M12 17h.01" />
                        </svg>
                        <span class="side-menu__label icon-margin">All Question</span>
                    </a>
                </li>
                <li class="slide {{ request()->is('options*') ? 'active is-expanded' : '' }}">
                    <a class="side-menu__item {{ request()->is('options*') ? 'active is-expanded' : '' }}"
                        data-bs-toggle="slide" href="{{ route('options.index') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"
                            class="lucide lucide-shield-question-mark-icon lucide-shield-question-mark">
                            <path
                                d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z" />
                            <path d="M9.1 9a3 3 0 0 1 5.82 1c0 2-3 3-3 3" />
                            <path d="M12 17h.01" />
                        </svg>
                        <span class="side-menu__label icon-margin">Questions Option</span>
                    </a>
                </li>
                <li class="slide {{ request()->is('plan*') ? 'active is-expanded' : '' }}">
                    <a class="side-menu__item {{ request()->is('plan*') ? 'active is-expanded' : '' }}"
                        data-bs-toggle="slide" href="{{ route('plan.index') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-square-activity-icon lucide-square-activity">
                            <rect width="18" height="18" x="3" y="3" rx="2" />
                            <path d="M17 12h-2l-2 5-2-10-2 5H7" />
                        </svg>
                        <span class="side-menu__label icon-margin">Care plan</span>
                    </a>
                </li>
                <li class="slide {{ request()->is('care*') ? 'active is-expanded' : '' }}">
                    <a class="side-menu__item {{ request()->is('care*') ? 'active is-expanded' : '' }}"
                        data-bs-toggle="slide" href="{{ route('care.task.index') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-square-check-icon lucide-square-check">
                            <rect width="18" height="18" x="3" y="3" rx="2" />
                            <path d="m9 12 2 2 4-4" />
                        </svg>
                        <span class="side-menu__label icon-margin">Care plan Tasks Section</span>
                    </a>
                </li>
                <li class="slide {{ request()->is('tasks*') ? 'active is-expanded' : '' }}">
                    <a class="side-menu__item {{ request()->is('tasks*') ? 'active is-expanded' : '' }}"
                        data-bs-toggle="slide" href="{{ route('tasks.index') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-calendar-check-icon lucide-calendar-check">
                            <path d="M8 2v4" />
                            <path d="M16 2v4" />
                            <rect width="18" height="18" x="3" y="4" rx="2" />
                            <path d="M3 10h18" />
                            <path d="m9 16 2 2 4-4" />
                        </svg>
                        <span class="side-menu__label icon-margin">Care plan Tasks</span>
                    </a>
                </li>
                <li class="slide {{ request()->is('product*') ? 'active is-expanded' : '' }}">
                    <a class="side-menu__item {{ request()->is('product*') ? 'active is-expanded' : '' }}"
                        data-bs-toggle="slide" href="{{ route('product.index') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-shopping-basket-icon lucide-shopping-basket">
                            <path d="m15 11-1 9" />
                            <path d="m19 11-4-7" />
                            <path d="M2 11h20" />
                            <path d="m3.5 11 1.6 7.4a2 2 0 0 0 2 1.6h9.8a2 2 0 0 0 2-1.6l1.7-7.4" />
                            <path d="M4.5 15.5h15" />
                            <path d="m5 11 4-7" />
                            <path d="m9 11 1 9" />
                        </svg>
                        <span class="side-menu__label icon-margin">Products</span>
                    </a>
                </li> --}}

                {{--  <li class="slide {{ request()->is('promotion*') ? 'active is-expanded' : '' }}">
                    <a class="side-menu__item {{ request()->is('promotion*') ? 'active is-expanded' : '' }}"
                        data-bs-toggle="slide" href="{{ route('promotion.index') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-circle-percent-icon lucide-circle-percent">
                            <circle cx="12" cy="12" r="10" />
                            <path d="m15 9-6 6" />
                            <path d="M9 9h.01" />
                            <path d="M15 15h.01" />
                        </svg>
                        <span class="side-menu__label icon-margin">Promotions(Promo Code)</span>
                    </a>
                </li> --}}

                {{-- <li class="slide {{ request()->is('promo*') ? 'active is-expanded' : '' }}">
                    <a class="side-menu__item {{ request()->is('promo*') ? 'active is-expanded' : '' }}"
                        data-bs-toggle="slide" href="{{ route('promo.index') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-circle-percent-icon lucide-circle-percent">
                            <circle cx="12" cy="12" r="10" />
                            <path d="m15 9-6 6" />
                            <path d="M9 9h.01" />
                            <path d="M15 15h.01" />
                        </svg>
                        <span class="side-menu__label icon-margin">Promotions Details</span>
                    </a>
                </li>
                <li class="slide {{ request()->is('delivery*') ? 'active is-expanded' : '' }}">
                    <a class="side-menu__item {{ request()->is('delivery*') ? 'active is-expanded' : '' }}"
                        data-bs-toggle="slide" href="{{ route('delivery.index') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-truck-icon lucide-truck">
                            <path d="M14 18V6a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v11a1 1 0 0 0 1 1h2" />
                            <path d="M15 18H9" />
                            <path d="M19 18h2a1 1 0 0 0 1-1v-3.65a1 1 0 0 0-.22-.624l-3.48-4.35A1 1 0 0 0 17.52 8H14" />
                            <circle cx="17" cy="18" r="2" />
                            <circle cx="7" cy="18" r="2" />
                        </svg>
                        <span class="side-menu__label icon-margin">Delivery Charge</span>
                    </a>
                </li>
                <li class="slide {{ request()->is('order*') ? 'active is-expanded' : '' }}">
                    <a class="side-menu__item {{ request()->is('order*') ? 'active is-expanded' : '' }}"
                        data-bs-toggle="slide" href="{{ route('order.index') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-shopping-cart-icon lucide-shopping-cart">
                            <circle cx="8" cy="21" r="1" />
                            <circle cx="19" cy="21" r="1" />
                            <path
                                d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12" />
                        </svg>
                        <span class="side-menu__label icon-margin">Orders</span>
                    </a>
                </li>
                <li class="slide {{ request()->is('article*') ? 'active is-expanded' : '' }}">
                    <a class="side-menu__item {{ request()->is('article*') ? 'active is-expanded' : '' }}"
                        data-bs-toggle="slide" href="{{ route('article.index') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-newspaper-icon lucide-newspaper">
                            <path d="M15 18h-5" />
                            <path d="M18 14h-8" />
                            <path
                                d="M4 22h16a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H8a2 2 0 0 0-2 2v16a2 2 0 0 1-4 0v-9a2 2 0 0 1 2-2h2" />
                            <rect width="8" height="4" x="10" y="6" rx="1" />
                        </svg>
                        <span class="side-menu__label icon-margin">Articles</span>
                    </a>
                </li> --}}

                <li class="slide {{ request()->is('dynamic*') ? 'active is-expanded' : '' }}">
                    <a class="side-menu__item {{ request()->is('dynamic*') ? 'active is-expanded' : '' }}"
                        data-bs-toggle="slide" href="{{ route('dynamic.index') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-notebook-pen-icon lucide-notebook-pen">
                            <path d="M13.4 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-7.4" />
                            <path d="M2 6h4" />
                            <path d="M2 10h4" />
                            <path d="M2 14h4" />
                            <path d="M2 18h4" />
                            <path
                                d="M21.378 5.626a1 1 0 1 0-3.004-3.004l-5.01 5.012a2 2 0 0 0-.506.854l-.837 2.87a.5.5 0 0 0 .62.62l2.87-.837a2 2 0 0 0 .854-.506z" />
                        </svg>
                        <span class="side-menu__label icon-margin">Dynamic Page</span>
                    </a>
                </li>

                {{-- <li class="slide {{ request()->is('help*') ? 'active is-expanded' : '' }}">
                    <a class="side-menu__item {{ request()->is('help*') ? 'active is-expanded' : '' }}"
                        data-bs-toggle="slide" href="{{ route('help.index') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-mail-question-mark-icon lucide-mail-question-mark"><path d="M22 10.5V6a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v12c0 1.1.9 2 2 2h12.5"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/><path d="M18 15.28c.2-.4.5-.8.9-1a2.1 2.1 0 0 1 2.6.4c.3.4.5.8.5 1.3 0 1.3-2 2-2 2"/><path d="M20 22v.01"/></svg>
                        <span class="side-menu__label icon-margin">Help & Support</span>
                    </a>
                </li> --}}
                {{-- <li class="slide {{ request()->is('faq*') ? 'active is-expanded' : '' }}">
                    <a class="side-menu__item {{ request()->is('faq*') ? 'active is-expanded' : '' }}"
                        data-bs-toggle="slide" href="{{ route('faq.index') }}">
                       <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-message-circle-question-mark-icon lucide-message-circle-question-mark"><path d="M2.992 16.342a2 2 0 0 1 .094 1.167l-1.065 3.29a1 1 0 0 0 1.236 1.168l3.413-.998a2 2 0 0 1 1.099.092 10 10 0 1 0-4.777-4.719"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><path d="M12 17h.01"/></svg>
                        <span class="side-menu__label icon-margin">F.A.Q</span>
                    </a>
                </li> --}}
                
                <li class="slide {{ request()->is('social*') ? 'active is-expanded' : '' }}">
                    <a class="side-menu__item {{ request()->is('social*') ? 'active is-expanded' : '' }}"
                        data-bs-toggle="slide" href="{{ route('social.index') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-share2-icon lucide-share-2">
                            <circle cx="18" cy="5" r="3" />
                            <circle cx="6" cy="12" r="3" />
                            <circle cx="18" cy="19" r="3" />
                            <line x1="8.59" x2="15.42" y1="13.51" y2="17.49" />
                            <line x1="15.41" x2="8.59" y1="6.51" y2="10.49" />
                        </svg>
                        <span class="side-menu__label icon-margin">Social Media</span>
                    </a>
                </li>

                <hr>

                <li class="slide {{ request()->is('admin/settings*') ? 'active is-expanded' : '' }}">
                    <a class="side-menu__item {{ request()->is('admin/settings*') ? 'active is-expanded' : '' }}"
                        data-bs-toggle="slide" href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-settings-icon lucide-settings">
                            <path
                                d="M9.671 4.136a2.34 2.34 0 0 1 4.659 0 2.34 2.34 0 0 0 3.319 1.915 2.34 2.34 0 0 1 2.33 4.033 2.34 2.34 0 0 0 0 3.831 2.34 2.34 0 0 1-2.33 4.033 2.34 2.34 0 0 0-3.319 1.915 2.34 2.34 0 0 1-4.659 0 2.34 2.34 0 0 0-3.32-1.915 2.34 2.34 0 0 1-2.33-4.033 2.34 2.34 0 0 0 0-3.831A2.34 2.34 0 0 1 6.35 6.051a2.34 2.34 0 0 0 3.319-1.915" />
                            <circle cx="12" cy="12" r="3" />
                        </svg>
                        <span class="side-menu__label icon-margin">Settings</span><i
                            class="angle fa fa-angle-right"></i>
                    </a>

                    <ul class="slide-menu">
                        <li><a href="{{ route('profile.setting') }}" class="slide-item">Profile Settings</a></li>
                        <li><a href="{{ route('system.index') }}" class="slide-item">System Settings</a></li>
                        <li><a href="{{ route('mail.setting') }}" class="slide-item">Mail Settings</a></li>
                        <li><a href="{{ route('stripe.index') }}" class="slide-item">Stripe Settings</a></li>
                    </ul>
                </li>
            </ul>

            <div class="slide-right" id="slide-right">
                <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24"
                    viewBox="0 0 24 24">
                    <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z" />
                </svg>
            </div>
        </div>
    </div>
</div>
