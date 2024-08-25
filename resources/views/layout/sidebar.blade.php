<!-- main-sidebar -->
<div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
<div class="sticky">
    <aside class="app-sidebar sidebar-scroll">
        <div class="main-sidemenu">
            <div class="app-sidebar__user">
                <div class="dropdown user-pro-body text-center">
                    <div class="user-pic">
                        <img alt="user-img" class="avatar avatar-xl brround mb-1"
                            src="{{ asset('images/logo/2023-02-09-Pioneers-SA-Badge-Clear-Background.png') }}">
                    </div>
                    <div class="user-info text-center">
                        <h5 class="mb-1 font-weight-bold">{{ auth()->user()->name }}</h5>
                    </div>
                </div>
            </div>
            <div class="slide-left disabled" id="slide-left">
                <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24"
                    viewBox="0 0 24 24">
                    <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z" />
                </svg>
            </div>
            <ul class="side-menu">
                <li class="slide">
                    <a class="side-menu__item @if (Route::is('index')) active @endif" data-bs-toggle="slide"
                        href="{{ route('index') }}">
                        <i class="fa fa-dashboard fa-2x mx-3"></i>
                        <span class="side-menu__label">Dashboard</span>
                    </a>
                </li>

                @php
                    use App\Models\User;

                    $user = auth()->user();
                    $isAdmin = $user->role->name === 'Admin';
                @endphp

                @if ($isAdmin)
                    <!-- Admin Access -->
                    <li class="slide">
                        <a class="side-menu__item @if (Route::is('payment.list')) active @endif"
                            data-bs-toggle="slide" href="{{ route('payment.list') }}">
                            <i class="fa fa-money fa-2x mx-3"></i>
                            <span class="side-menu__label">Stripe Payments</span>
                        </a>
                    </li>
                    <!--<li class="slide">
                        <a class="side-menu__item @if (Route::is('profile')) active @endif"
                            data-bs-toggle="slide" href="{{ route('profile') }}">
                            <i class="fa fa-user fa-2x mx-3"></i>
                            <span class="side-menu__label">Profile</span>
                        </a>
                    </li>-->
                    <li class="slide @if (Route::is('gl-codes.create', 'gl-codes.index', 'transaction.index', 'gl-codes-parent')) is-expanded @endif">
                        <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)">
                            <i class="fa fa-bank fa-2x mx-3"></i>
                            <span class="side-menu__label">Finance</span><i class="angle fe fe-chevron-right"></i></a>
                        <ul class="slide-menu @if (Route::is('gl-codes-parent.index', 'gl-codes.create', 'gl-codes.index', 'transaction.index')) open @endif">
                            @can('finance-list')
                                <li class="sub-slide">
                                    <a class="sub-side-menu__item mx-5 @if (Route::is('transaction.index')) active @endif"
                                        data-bs-toggle="sub-slide" href="{{ route('transaction.index') }}">
                                        <span class="sub-side-menu__label">Transaction</span>
                                    </a>
                                </li>
                            @endcan
                            @can('finance-list')
                                <li class="sub-slide">
                                    <a class="sub-side-menu__item mx-5 @if (Route::is('gl-codes-parent.index')) active @endif"
                                        data-bs-toggle="sub-slide" href="{{ route('gl-codes-parent.index') }}">
                                        <span class="sub-side-menu__label">Parent GL List</span>
                                    </a>
                                </li>
                            @endcan
                            @can('finance-list')
                                <li class="sub-slide">
                                    <a class="sub-side-menu__item mx-5 @if (Route::is('gl-codes.index')) active @endif"
                                        data-bs-toggle="sub-slide" href="{{ route('gl-codes.index') }}">
                                        <span class="sub-side-menu__label">Sub GL List</span>
                                    </a>
                                </li>
                            @endcan
                            @can('finance-list')
                                <li class="sub-slide">
                                    <a class="sub-side-menu__item mx-5 @if (Route::is('accounts.index')) active @endif"
                                        data-bs-toggle="sub-slide" href="{{ route('accounts.index') }}">
                                        <span class="sub-side-menu__label">Account List</span>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                    <li class="slide @if (Route::is('members.create', 'members.index')) is-expanded @endif">
                        <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)">
                            <i class="fa fa-user fa-2x mx-3"></i>
                            <span class="side-menu__label">Memberships</span><i
                                class="angle fe fe-chevron-right"></i></a>
                        <ul class="slide-menu @if (Route::is('members.create', 'members.index')) open @endif">
                            @can('membership-list')
                                <li class="sub-slide">
                                    <a class="sub-side-menu__item mx-5 @if (Route::is('members.index')) active @endif"
                                        data-bs-toggle="sub-slide" href="{{ route('members.index') }}">
                                        <span class="sub-side-menu__label">List</span>
                                    </a>
                                </li>
                            @endcan
                            @can('membership-create')
                                <li class="sub-slide">
                                    <a class="sub-side-menu__item mx-5 @if (Route::is('members.create')) active @endif"
                                        data-bs-toggle="sub-slide" href="{{ route('members.create') }}">
                                        <span class="sub-side-menu__label">Add</span>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                    <li class="slide @if (Route::is('ancestor-data.create', 'ancestor-data.index')) is-expanded @endif">
                        <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)">
                            <i class="fa fa-sitemap fa-2x mx-3"></i>
                            <span class="side-menu__label">Ancestors</span><i class="angle fe fe-chevron-right"></i></a>
                        <ul class="slide-menu @if (Route::is('ancestor-data.create', 'ancestor-data.index')) open @endif">
                            @can('ancestor-list')
                                <li class="sub-slide">
                                    <a class="sub-side-menu__item mx-5 @if (Route::is('ancestor-data.index')) active @endif"
                                        data-bs-toggle="sub-slide" href="{{ route('ancestor-data.index') }}">
                                        <span class="sub-side-menu__label">List</span>
                                    </a>
                                </li>
                            @endcan
                            @can('ancestor-create')
                                <li class="sub-slide">
                                    <a class="sub-side-menu__item mx-5 @if (Route::is('ancestor-data.create')) active @endif"
                                        data-bs-toggle="sub-slide" href="{{ route('ancestor-data.create') }}">
                                        <span class="sub-side-menu__label">Add</span>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                    <li class="slide @if (Route::is('mode-of-arrivals.create', 'mode-of-arrivals.index')) is-expanded @endif">
                        <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)">
                            <i class="fa fa-ship fa-2x mx-3"></i>
                            <span class="side-menu__label">Journey</span><i class="angle fe fe-chevron-right"></i></a>
                        <ul class="slide-menu @if (Route::is('mode-of-arrivals.create', 'mode-of-arrivals.index')) open @endif">
                            @can('mode-of-arrival-list')
                                <li class="sub-slide">
                                    <a class="sub-side-menu__item mx-5 @if (Route::is('mode-of-arrivals.index')) active @endif"
                                        data-bs-toggle="sub-slide" href="{{ route('mode-of-arrivals.index') }}">
                                        <span class="sub-side-menu__label">List</span>
                                    </a>
                                </li>
                            @endcan
                            @can('mode-of-arrival-create')
                                <li class="sub-slide">
                                    <a class="sub-side-menu__item mx-5 @if (Route::is('mode-of-arrivals.create')) active @endif"
                                        data-bs-toggle="sub-slide" href="{{ route('mode-of-arrivals.create') }}">
                                        <span class="sub-side-menu__label">Add</span>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                    <li class="slide @if (Route::is('settings.*')) is-expanded @endif">
                        <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)">
                            <i class="fa fa-cogs fa-2x mx-3"></i>
                            <span class="side-menu__label">Settings</span><i
                                class="angle fe fe-chevron-right"></i></a>
                        <ul class="slide-menu @if (Route::is('settings.*')) open @endif">
                            @can('setting-list')
                                <li class="sub-slide">
                                    <a class="sub-side-menu__item mx-5 @if (Route::is('settings.users')) active @endif"
                                        data-bs-toggle="sub-slide" href="{{ route('settings.users') }}">
                                        <span class="sub-side-menu__label">Users</span>
                                    </a>
                                </li>
                            @endcan
                            @can('setting-list')
                                <li class="sub-slide">
                                    <a class="sub-side-menu__item mx-5 @if (Route::is('settings.titles')) active @endif"
                                        data-bs-toggle="sub-slide" href="{{ route('settings.titles') }}">
                                        <span class="sub-side-menu__label">Titles</span>
                                    </a>
                                </li>
                            @endcan
                            @can('setting-list')
                                <li class="sub-slide">
                                    <a class="sub-side-menu__item mx-5 @if (Route::is('settings.cities')) active @endif"
                                        data-bs-toggle="sub-slide" href="{{ route('settings.cities') }}">
                                        <span class="sub-side-menu__label">Cities/Towns/Suburbs</span>
                                    </a>
                                </li>
                            @endcan
                            @can('setting-list')
                                <li class="sub-slide">
                                    <a class="sub-side-menu__item mx-5 @if (Route::is('settings.states')) active @endif"
                                        data-bs-toggle="sub-slide" href="{{ route('settings.states') }}">
                                        <span class="sub-side-menu__label">States/Counties</span>
                                    </a>
                                </li>
                            @endcan
                            @can('setting-list')
                                <li class="sub-slide">
                                    <a class="sub-side-menu__item mx-5 @if (Route::is('settings.countries')) active @endif"
                                        data-bs-toggle="sub-slide" href="{{ route('settings.countries') }}">
                                        <span class="sub-side-menu__label">Countries</span>
                                    </a>
                                </li>
                            @endcan
                            @can('setting-list')
                                <li class="sub-slide">
                                    <a class="sub-side-menu__item mx-5 @if (Route::is('settings.ports')) active @endif"
                                        data-bs-toggle="sub-slide" href="{{ route('settings.ports') }}">
                                        <span class="sub-side-menu__label">Ports of Arrival in SA</span>
                                    </a>
                                </li>
                            @endcan
                            @can('setting-list')
                                <li class="sub-slide">
                                    <a class="sub-side-menu__item mx-5 @if (Route::is('settings.ships')) active @endif"
                                        data-bs-toggle="sub-slide" href="{{ route('settings.ships') }}">
                                        <span class="sub-side-menu__label">Ships</span>
                                    </a>
                                </li>
                            @endcan
                            @can('setting-list')
                                <li class="sub-slide">
                                    <a class="sub-side-menu__item mx-5 @if (Route::is('settings.rigs')) active @endif"
                                        data-bs-toggle="sub-slide" href="{{ route('settings.rigs') }}">
                                        <span class="sub-side-menu__label">Rigs</span>
                                    </a>
                                </li>
                            @endcan
                            @can('setting-list')
                                <li class="sub-slide">
                                    <a class="sub-side-menu__item mx-5 @if (Route::is('settings.occupations')) active @endif"
                                        data-bs-toggle="sub-slide" href="{{ route('settings.occupations') }}">
                                        <span class="sub-side-menu__label">Occupations</span>
                                    </a>
                                </li>
                            @endcan
                            @can('setting-list')
                                <li class="sub-slide">
                                    <a class="sub-side-menu__item mx-5 @if (Route::is('settings.mode-of-travel')) active @endif"
                                        data-bs-toggle="sub-slide" href="{{ route('settings.mode-of-travel') }}">
                                        <span class="sub-side-menu__label">Mode of Travel</span>
                                    </a>
                                </li>
                            @endcan
                            @can('setting-list')
                                <li class="sub-slide">
                                    <a class="sub-side-menu__item mx-5 @if (Route::is('settings.subscription-plans')) active @endif"
                                        data-bs-toggle="sub-slide" href="{{ route('settings.subscription-plans') }}">
                                        <span class="sub-side-menu__label">Subscription Plans</span>
                                    </a>
                                </li>
                            @endcan
                            @can('setting-list')
                                <li class="sub-slide">
                                    <a class="sub-side-menu__item mx-5 @if (Route::is('settings.membership-status')) active @endif"
                                        data-bs-toggle="sub-slide" href="{{ route('settings.membership-status') }}">
                                        <span class="sub-side-menu__label">Membership Status</span>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @else
                    <!-- User Access -->
                    @can('finance-list')
                        <li class="slide @if (Route::is('gl-codes.create', 'gl-codes.index', 'transaction.index', 'gl-codes-parent')) is-expanded @endif">
                            <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)">
                                <i class="fa fa-bank fa-2x mx-3"></i>
                                <span class="side-menu__label">Finance</span><i class="angle fe fe-chevron-right"></i></a>
                            <ul class="slide-menu @if (Route::is('gl-codes-parent.index', 'gl-codes.create', 'gl-codes.index', 'transaction.index')) open @endif">
                                @can('finance-list')
                                    <li class="sub-slide">
                                        <a class="sub-side-menu__item mx-5 @if (Route::is('transaction.index')) active @endif"
                                            data-bs-toggle="sub-slide" href="{{ route('transaction.index') }}">
                                            <span class="sub-side-menu__label">Transaction</span>
                                        </a>
                                    </li>
                                @endcan
                                @can('finance-list')
                                    <li class="sub-slide">
                                        <a class="sub-side-menu__item mx-5 @if (Route::is('gl-codes-parent.index')) active @endif"
                                            data-bs-toggle="sub-slide" href="{{ route('gl-codes-parent.index') }}">
                                            <span class="sub-side-menu__label">Parent GL List</span>
                                        </a>
                                    </li>
                                @endcan
                                @can('finance-list')
                                    <li class="sub-slide">
                                        <a class="sub-side-menu__item mx-5 @if (Route::is('gl-codes.index')) active @endif"
                                            data-bs-toggle="sub-slide" href="{{ route('gl-codes.index') }}">
                                            <span class="sub-side-menu__label">Sub GL List</span>
                                        </a>
                                    </li>
                                @endcan
                                @can('finance-list')
                                    <li class="sub-slide">
                                        <a class="sub-side-menu__item mx-5 @if (Route::is('accounts.index')) active @endif"
                                            data-bs-toggle="sub-slide" href="{{ route('accounts.index') }}">
                                            <span class="sub-side-menu__label">Account List</span>
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcanany

                    @canany(['membership-list'])
                        <li class="slide @if (Route::is('members.create', 'members.index')) is-expanded @endif">
                            <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)">
                                <i class="fa fa-user fa-2x mx-3"></i>
                                <span class="side-menu__label">Memberships</span><i
                                    class="angle fe fe-chevron-right"></i></a>
                            <ul class="slide-menu @if (Route::is('members.create', 'members.index')) open @endif">
                                @can('membership-list')
                                    <li class="sub-slide">
                                        <a class="sub-side-menu__item mx-5 @if (Route::is('members.index')) active @endif"
                                            data-bs-toggle="sub-slide" href="{{ route('members.index') }}">
                                            <span class="sub-side-menu__label">List</span>
                                        </a>
                                    </li>
                                @endcan
                                @can('membership-create')
                                    <li class="sub-slide">
                                        <a class="sub-side-menu__item mx-5 @if (Route::is('members.create')) active @endif"
                                            data-bs-toggle="sub-slide" href="{{ route('members.create') }}">
                                            <span class="sub-side-menu__label">Add</span>
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcanany

                    @canany(['ancestor-list'])
                        <li class="slide @if (Route::is('ancestor-data.create', 'ancestor-data.index')) is-expanded @endif">
                            <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)">
                                <i class="fa fa-sitemap fa-2x mx-3"></i>
                                <span class="side-menu__label">Ancestors</span><i
                                    class="angle fe fe-chevron-right"></i></a>
                            <ul class="slide-menu @if (Route::is('ancestor-data.create', 'ancestor-data.index')) open @endif">
                                @can('ancestor-list')
                                    <li class="sub-slide">
                                        <a class="sub-side-menu__item mx-5 @if (Route::is('ancestor-data.index')) active @endif"
                                            data-bs-toggle="sub-slide" href="{{ route('ancestor-data.index') }}">
                                            <span class="sub-side-menu__label">List</span>
                                        </a>
                                    </li>
                                @endcan
                                @can('ancestor-create')
                                    <li class="sub-slide">
                                        <a class="sub-side-menu__item mx-5 @if (Route::is('ancestor-data.create')) active @endif"
                                            data-bs-toggle="sub-slide" href="{{ route('ancestor-data.create') }}">
                                            <span class="sub-side-menu__label">Add</span>
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcanany

                    @canany(['mode-of-arrival-list'])
                        <li class="slide @if (Route::is('mode-of-arrivals.create', 'mode-of-arrivals.index')) is-expanded @endif">
                            <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)">
                                <i class="fa fa-ship fa-2x mx-3"></i>
                                <span class="side-menu__label">Journey</span><i class="angle fe fe-chevron-right"></i></a>
                            <ul class="slide-menu @if (Route::is('mode-of-arrivals.create', 'mode-of-arrivals.index')) open @endif">
                                @can('mode-of-arrival-list')
                                    <li class="sub-slide">
                                        <a class="sub-side-menu__item mx-5 @if (Route::is('mode-of-arrivals.index')) active @endif"
                                            data-bs-toggle="sub-slide" href="{{ route('mode-of-arrivals.index') }}">
                                            <span class="sub-side-menu__label">List</span>
                                        </a>
                                    </li>
                                @endcan
                                @can('mode-of-arrival-create')
                                    <li class="sub-slide">
                                        <a class="sub-side-menu__item mx-5 @if (Route::is('mode-of-arrivals.create')) active @endif"
                                            data-bs-toggle="sub-slide" href="{{ route('mode-of-arrivals.create') }}">
                                            <span class="sub-side-menu__label">Add</span>
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcanany

                    @canany(['setting-list'])
                        <li class="slide @if (Route::is('settings.*')) is-expanded @endif">
                            <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)">
                                <i class="fa fa-cogs fa-2x mx-3"></i>
                                <span class="side-menu__label">Settings</span><i
                                    class="angle fe fe-chevron-right"></i></a>
                            <ul class="slide-menu @if (Route::is('settings.*')) open @endif">
                                @can('setting-list')
                                    <li class="sub-slide">
                                        <a class="sub-side-menu__item mx-5 @if (Route::is('settings.users')) active @endif"
                                            data-bs-toggle="sub-slide" href="{{ route('settings.users') }}">
                                            <span class="sub-side-menu__label">Users</span>
                                        </a>
                                    </li>
                                @endcan
                                @can('setting-list')
                                    <li class="sub-slide">
                                        <a class="sub-side-menu__item mx-5 @if (Route::is('settings.titles')) active @endif"
                                            data-bs-toggle="sub-slide" href="{{ route('settings.titles') }}">
                                            <span class="sub-side-menu__label">Titles</span>
                                        </a>
                                    </li>
                                @endcan
                                @can('setting-list')
                                    <li class="sub-slide">
                                        <a class="sub-side-menu__item mx-5 @if (Route::is('settings.cities')) active @endif"
                                            data-bs-toggle="sub-slide" href="{{ route('settings.cities') }}">
                                            <span class="sub-side-menu__label">Cities/Towns/Suburbs</span>
                                        </a>
                                    </li>
                                @endcan
                                @can('setting-list')
                                    <li class="sub-slide">
                                        <a class="sub-side-menu__item mx-5 @if (Route::is('settings.states')) active @endif"
                                            data-bs-toggle="sub-slide" href="{{ route('settings.states') }}">
                                            <span class="sub-side-menu__label">States/Counties</span>
                                        </a>
                                    </li>
                                @endcan
                                @can('setting-list')
                                    <li class="sub-slide">
                                        <a class="sub-side-menu__item mx-5 @if (Route::is('settings.countries')) active @endif"
                                            data-bs-toggle="sub-slide" href="{{ route('settings.countries') }}">
                                            <span class="sub-side-menu__label">Countries</span>
                                        </a>
                                    </li>
                                @endcan
                                @can('setting-list')
                                    <li class="sub-slide">
                                        <a class="sub-side-menu__item mx-5 @if (Route::is('settings.ports')) active @endif"
                                            data-bs-toggle="sub-slide" href="{{ route('settings.ports') }}">
                                            <span class="sub-side-menu__label">Ports of Arrival in SA</span>
                                        </a>
                                    </li>
                                @endcan
                                @can('setting-list')
                                    <li class="sub-slide">
                                        <a class="sub-side-menu__item mx-5 @if (Route::is('settings.ships')) active @endif"
                                            data-bs-toggle="sub-slide" href="{{ route('settings.ships') }}">
                                            <span class="sub-side-menu__label">Ships</span>
                                        </a>
                                    </li>
                                @endcan
                                @can('setting-list')
                                    <li class="sub-slide">
                                        <a class="sub-side-menu__item mx-5 @if (Route::is('settings.rigs')) active @endif"
                                            data-bs-toggle="sub-slide" href="{{ route('settings.rigs') }}">
                                            <span class="sub-side-menu__label">Rigs</span>
                                        </a>
                                    </li>
                                @endcan
                                @can('setting-list')
                                    <li class="sub-slide">
                                        <a class="sub-side-menu__item mx-5 @if (Route::is('settings.occupations')) active @endif"
                                            data-bs-toggle="sub-slide" href="{{ route('settings.occupations') }}">
                                            <span class="sub-side-menu__label">Occupations</span>
                                        </a>
                                    </li>
                                @endcan
                                @can('setting-list')
                                    <li class="sub-slide">
                                        <a class="sub-side-menu__item mx-5 @if (Route::is('settings.mode-of-travel')) active @endif"
                                            data-bs-toggle="sub-slide" href="{{ route('settings.mode-of-travel') }}">
                                            <span class="sub-side-menu__label">Mode of Travel</span>
                                        </a>
                                    </li>
                                @endcan
                                @can('setting-list')
                                    <li class="sub-slide">
                                        <a class="sub-side-menu__item mx-5 @if (Route::is('settings.subscription-plans')) active @endif"
                                            data-bs-toggle="sub-slide" href="{{ route('settings.subscription-plans') }}">
                                            <span class="sub-side-menu__label">Subscription Plans</span>
                                        </a>
                                    </li>
                                @endcan
                                @can('setting-list')
                                    <li class="sub-slide">
                                        <a class="sub-side-menu__item mx-5 @if (Route::is('settings.membership-status')) active @endif"
                                            data-bs-toggle="sub-slide" href="{{ route('settings.membership-status') }}">
                                            <span class="sub-side-menu__label">Membership Status</span>
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcanany
                @endif
            </ul>
        </div>
    </aside>
</div>
<!-- main-sidebar -->
