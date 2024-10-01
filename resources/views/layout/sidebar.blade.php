<!-- main-sidebar -->
<div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
<div class="sticky">
    <aside class="app-sidebar sidebar-scroll">
        <div class="main-sidemenu">

            <!-- User Info -->
            <div class="app-sidebar__user">
                <div class="dropdown user-pro-body text-center">
                    <div class="user-pic">
                        <img alt="user-img" class="avatar avatar-xl brround mb-1"
                            src="{{ asset('images/logo/2023-02-09-Pioneers-SA-Badge-Clear-Background.png') }}">
                    </div>
                    <div class="user-info text-center">
                        <h5 class="mb-1 font-weight-bold">
                            {{ trim((auth()->user()->member->family_name ?? '') . ' ' . (auth()->user()->member->given_name ?? '')) }}
                        </h5>
                    </div>
                </div>
            </div>

            <!-- Slide Left Icon -->
            <div class="slide-left disabled" id="slide-left">
                <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                    <path d="M13.293 6.293L7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z" />
                </svg>
            </div>

            <!-- Sidebar Menu -->
            <ul class="side-menu">
                <!--@php
                    $user = auth()->user();
                    $isAdmin = $user && $user->hasRole('Admin');
                @endphp-->

                @php
                    $user = auth()->user();
                    $isAdmin = $user && $user->role_id == 1;
                @endphp

                @if ($user)
                @if ($isAdmin)
                <!-- Admin Menu Items -->
                <li class="slide">
                    <a class="side-menu__item {{ request()->routeIs('index') ? 'active' : '' }}"
                        href="{{ route('index') }}">
                        <i class="fa fa-dashboard fa-2x mx-3"></i>
                        <span class="side-menu__label">{{ __('Dashboard') }}</span>
                    </a>
                </li>
                <li class="slide">
                    <a class="side-menu__item {{ request()->routeIs('payment.list') ? 'active' : '' }}"
                        href="{{ route('payment.list') }}">
                        <i class="fa fa-money fa-2x mx-3"></i>
                        <span class="side-menu__label">{{ __('Stripe Payments') }}</span>
                    </a>
                </li>
                <!-- Finance Section -->
                <li class="slide {{ request()->routeIs('accounts.index', 'transaction.index', 'transaction.create', 'transaction.show', 'gl-codes-parent.index',
                                'suppliers.index', 'customer.index') ? 'is-expanded' : '' }}">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)">
                        <i class="fa fa-bank fa-2x mx-3"></i>
                        <span class="side-menu__label">{{ __('Finance') }}</span>
                        <i class="angle fe fe-chevron-right"></i>
                    </a>
                    <ul class="slide-menu {{ request()->routeIs('accounts', 'transaction.index', 'gl-codes-parent.index') ? 'open' : '' }}">
                        <li>
                            <a class="sub-side-menu__item mx-5 {{ request()->routeIs('transaction.index') ? 'active' : '' }}"
                                href="{{ route('transaction.index') }}">
                                <span class="sub-side-menu__label">{{ __('Transactions') }}</span>
                            </a>
                        </li>
                        <li>
                            <a class="sub-side-menu__item mx-5 {{ request()->routeIs('gl-codes-parent.index') ? 'active' : '' }}"
                                href="{{ route('gl-codes-parent.index') }}">
                                <span class="sub-side-menu__label">{{ __('Accounts List') }}</span>
                            </a>
                        </li>
                        <li>
                            <a class="sub-side-menu__item mx-5 {{ request()->routeIs('accounts.index') ? 'active' : '' }}"
                                href="{{ route('accounts.index') }}">
                                <span class="sub-side-menu__label">{{ __('Transaction Accounts') }}</span>
                            </a>
                        </li>
                        
                        <li>
                            <a class="sub-side-menu__item mx-5 {{ request()->routeIs('suppliers.index') ? 'active' : '' }}"
                                href="{{ route('suppliers.index') }}">
                                <span class="sub-side-menu__label">{{ __('Suppliers') }}</span>
                            </a>
                        </li>
                        <li>
                            <a class="sub-side-menu__item mx-5 {{ request()->routeIs('customer.index') ? 'active' : '' }}"
                                href="{{ route('customer.index') }}">
                                <span class="sub-side-menu__label">{{ __('Customers') }}</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Memberships Section -->
                <li class="slide {{ request()->routeIs('members.create', 'members.index') ? 'is-expanded' : '' }}">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)">
                        <i class="fa fa-user fa-2x mx-3"></i>
                        <span class="side-menu__label">{{ __('Memberships') }}</span>
                        <i class="angle fe fe-chevron-right"></i>
                    </a>
                    <ul class="slide-menu {{ request()->routeIs('members.create', 'members.index') ? 'open' : '' }}">
                        <li>
                            <a class="sub-side-menu__item mx-5 {{ request()->routeIs('members.index') ? 'active' : '' }}"
                                href="{{ route('members.index') }}">
                                <span class="sub-side-menu__label">{{ __('List') }}</span>
                            </a>
                        </li>
                        <li>
                            <a class="sub-side-menu__item mx-5 {{ request()->routeIs('members.create') ? 'active' : '' }}"
                                href="{{ route('members.create') }}">
                                <span class="sub-side-menu__label">{{ __('Add') }}</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Ancestors Section -->
                <li class="slide {{ request()->routeIs('ancestor-data.create', 'ancestor-data.index') ? 'is-expanded' : '' }}">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)">
                        <i class="fa fa-sitemap fa-2x mx-3"></i>
                        <span class="side-menu__label">{{ __('Ancestors') }}</span>
                        <i class="angle fe fe-chevron-right"></i>
                    </a>
                    <ul class="slide-menu {{ request()->routeIs('ancestor-data.create', 'ancestor-data.index') ? 'open' : '' }}">
                        <li>
                            <a class="sub-side-menu__item mx-5 {{ request()->routeIs('ancestor-data.index') ? 'active' : '' }}"
                                href="{{ route('ancestor-data.index') }}">
                                <span class="sub-side-menu__label">{{ __('List') }}</span>
                            </a>
                        </li>
                        <li>
                            <a class="sub-side-menu__item mx-5 {{ request()->routeIs('ancestor-data.create') ? 'active' : '' }}"
                                href="{{ route('ancestor-data.create') }}">
                                <span class="sub-side-menu__label">{{ __('Add') }}</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Journey Section -->
                <li class="slide {{ request()->routeIs('mode-of-arrivals.create', 'mode-of-arrivals.index') ? 'is-expanded' : '' }}">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)">
                        <i class="fa fa-ship fa-2x mx-3"></i>
                        <span class="side-menu__label">{{ __('Journey') }}</span>
                        <i class="angle fe fe-chevron-right"></i>
                    </a>
                    <ul class="slide-menu {{ request()->routeIs('mode-of-arrivals.create', 'mode-of-arrivals.index') ? 'open' : '' }}">
                        <li>
                            <a class="sub-side-menu__item mx-5 {{ request()->routeIs('mode-of-arrivals.index') ? 'active' : '' }}"
                                href="{{ route('mode-of-arrivals.index') }}">
                                <span class="sub-side-menu__label">{{ __('List') }}</span>
                            </a>
                        </li>
                        <li>
                            <a class="sub-side-menu__item mx-5 {{ request()->routeIs('mode-of-arrivals.create') ? 'active' : '' }}"
                                href="{{ route('mode-of-arrivals.create') }}">
                                <span class="sub-side-menu__label">{{ __('Add') }}</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Reports Section -->
                <li class="slide {{ request()->routeIs('reports.index') ? 'is-expanded' : '' }}">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)">
                        <i class="fa fa-bar-chart-o fa-2x mx-3"></i>
                        <span class="side-menu__label">{{ __('Reports') }}</span>
                        <i class="angle fe fe-chevron-right"></i>
                    </a>
                    <ul class="slide-menu {{ request()->routeIs('reports.index') ? 'open' : '' }}">
                        <li>
                            <a class="sub-side-menu__item mx-5 {{ request()->routeIs('reports.index') ? 'active' : '' }}"
                                href="{{ route('reports.index') }}">
                                <span class="sub-side-menu__label">{{ __('List') }}</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Settings Section -->
                <li class="slide {{ request()->routeIs(
                                'title.index',
                                'user.index',
                                'states.index',
                                'ports.index',
                                'counties.index',
                                'countries.index',
                                'occupations.index',
                                'rigs.index',
                                'ship.index',
                                'source-of-arrivals.index',
                                'subscription-plans.index',
                                'cities.index',
                                'membership-status.index'
                            ) ? 'is-expanded' : '' }}">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)">
                        <i class="fa fa-gears fa-2x mx-3"></i>
                        <span class="side-menu__label">{{ __('Settings') }}</span>
                        <i class="angle fe fe-chevron-right"></i>
                    </a>
                    <ul class="slide-menu {{ request()->routeIs(
                                    'title.index',
                                    'user.index',
                                    'states.index',
                                    'ports.index',
                                    'counties.index',
                                    'countries.index',
                                    'occupations.index',
                                    'rigs.index',
                                    'ship.index',
                                    'subscription-plans.index',
                                    'membership-status.index',
                                    'suppliers.index', 'customer.index',
                                ) ? 'open' : '' }}">
                        <li>
                            <a class="sub-side-menu__item mx-5 {{ request()->routeIs('user.index') ? 'active' : '' }}"
                                href="{{ route('user.index') }}">
                                <span class="sub-side-menu__label">{{ __('Users') }}</span>
                            </a>
                        </li>
                        <li>
                            <a class="sub-side-menu__item mx-5 {{ request()->routeIs('title.index') ? 'active' : '' }}"
                                href="{{ route('title.index') }}">
                                <span class="sub-side-menu__label">{{ __('Titles') }}</span>
                            </a>
                        </li>
                        <li>
                            <a class="sub-side-menu__item mx-5 {{ request()->routeIs('cities.index') ? 'active' : '' }}"
                                href="{{ route('cities.index') }}">
                                <span class="sub-side-menu__label">{{ __('Cities / Towns / Suburbs') }}</span>
                            </a>
                        </li>
                        <li>
                            <a class="sub-side-menu__item mx-5 {{ request()->routeIs('counties.index') ? 'active' : '' }}"
                                href="{{ route('counties.index') }}">
                                <span class="sub-side-menu__label">{{ __('States / Counties') }}</span>
                            </a>
                        </li>
                        <li>
                            <a class="sub-side-menu__item mx-5 {{ request()->routeIs('countries.index') ? 'active' : '' }}"
                                href="{{ route('countries.index') }}">
                                <span class="sub-side-menu__label">{{ __('Countries') }}</span>
                            </a>
                        </li>
                        <li>
                            <a class="sub-side-menu__item mx-5 {{ request()->routeIs('ports.index') ? 'active' : '' }}"
                                href="{{ route('ports.index') }}">
                                <span class="sub-side-menu__label">{{ __('Ports of Arrival in SA') }}</span>
                            </a>
                        </li>
                        <li>
                            <a class="sub-side-menu__item mx-5 {{ request()->routeIs('ship.index') ? 'active' : '' }}"
                                href="{{ route('ship.index') }}">
                                <span class="sub-side-menu__label">{{ __('Ships') }}</span>
                            </a>
                        </li>
                        <li>
                            <a class="sub-side-menu__item mx-5 {{ request()->routeIs('rigs.index') ? 'active' : '' }}"
                                href="{{ route('rigs.index') }}">
                                <span class="sub-side-menu__label">{{ __('Rigs') }}</span>
                            </a>
                        </li>
                        <li>
                            <a class="sub-side-menu__item mx-5 {{ request()->routeIs('occupations.index') ? 'active' : '' }}"
                                href="{{ route('occupations.index') }}">
                                <span class="sub-side-menu__label">{{ __('Occupations') }}</span>
                            </a>
                        </li>
                        <li>
                            <a class="sub-side-menu__item mx-5 {{ request()->routeIs('source-of-arrivals.index') ? 'active' : '' }}"
                                href="{{ route('source-of-arrivals.index') }}">
                                <span class="sub-side-menu__label">{{ __('Mode of Travel') }}</span>
                            </a>
                        </li>
                        <li>
                            <a class="sub-side-menu__item mx-5 {{ request()->routeIs('subscription-plans.index') ? 'active' : '' }}"
                                href="{{ route('subscription-plans.index') }}">
                                <span class="sub-side-menu__label">{{ __('Membership Type') }}</span>
                            </a>
                        </li>
                        <li>
                            <a class="sub-side-menu__item mx-5 {{ request()->routeIs('membership-status.index') ? 'active' : '' }}"
                                href="{{ route('membership-status.index') }}">
                                <span class="sub-side-menu__label">{{ __('Membership Status') }}</span>
                            </a>
                        </li>
                    </ul>
                </li>
                @else
                <!-- Regular User Menu Items -->
                <li class="slide">
                    <a class="side-menu__item {{ request()->routeIs('members.view-member', ['id' => $user->member_id]) ? 'active' : '' }}"
                        href="{{ route('members.view-member', ['id' => $user->member_id]) }}">
                        <i class="fa fa-user fa-2x mx-3"></i>
                        <span class="side-menu__label">{{ __('Profile') }}</span>
                    </a>
                </li>
                <li class="slide">
                    <a class="side-menu__item {{ request()->routeIs('ancestor-data.index') ? 'active' : '' }}"
                        href="{{ route('ancestor-data.index') }}">
                        <i class="fa fa-sitemap fa-2x mx-3"></i>
                        <span class="side-menu__label">{{ __('Ancestors') }}</span>
                    </a>
                </li>
                <li class="slide">
                    <a class="side-menu__item {{ request()->routeIs('members.view-pedigree', ['id' => $user->member_id]) ? 'active' : '' }}"
                        href="{{ route('members.view-pedigree', ['id' => $user->member_id]) }}">
                        <i class="fa fa-users fa-2x mx-3"></i>
                        <span class="side-menu__label">{{ __('Pedigree') }}</span>
                    </a>
                </li>
                <li class="slide">
                    <a class="side-menu__item {{ request()->routeIs('transaction.members_index') ? 'active' : '' }}"
                        href="{{ route('transaction.members_index') }}">
                        <i class="fa fa-money fa-2x mx-3"></i>
                        <span class="side-menu__label">{{ __('Transactions') }}</span>
                    </a>
                </li>
                @endif
                @else
                <!-- Guest User Menu Items -->
                <li class="slide">
                    <a class="side-menu__item" href="{{ route('login') }}">
                        <i class="fa fa-sign-in fa-2x mx-3"></i>
                        <span class="side-menu__label">{{ __('Login') }}</span>
                    </a>
                </li>
                @endif
            </ul>

            <!-- Slide Right Icon -->
            <div class="slide-right" id="slide-right">
                <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                    <path d="M10.707 17.707L16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z" />
                </svg>
            </div>
        </div>
    </aside>
</div>
<!-- main-sidebar -->