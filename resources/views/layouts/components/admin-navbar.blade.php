<div class="container px-4 py-4 my-5 m">
    <nav class="navbar is-transparent">
        <div class="navbar-brand">
            <a class="navbar-item" href="{{ env('APP_URL') }}/admin/dashboard">
                <img src="{{ URL::asset('images/logo.svg') }}" alt="Nizeed: logo for chrome and figma extension"
                    width="112" height="28">
            </a>
            <div class="navbar-burger" data-target="navbarExampleTransparentExample">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>

        <div id="navbarExampleTransparentExample" class="navbar-menu">
            <div class="navbar-start">
                <a id="navbar-users-link" class="navbar-item has-text-weight-bold" href="{{ env('APP_URL') }}/admin/users">Users</a>
                <a id="navbar-about-link" class="navbar-item has-text-weight-bold" href="{{ env('APP_URL') }}/admin/about-us">About Us</a>
                {{-- <a id="navbar-pricing-link" class="navbar-item has-text-weight-bold" href="{{ env('APP_URL') }}/admin/pricing">Pricing</a> --}}
                <a id="navbar-knowledgebase-link" class="navbar-item has-text-weight-bold" href="{{ env('APP_URL') }}/admin/knowledgebase">Knowledgebase</a>
                <a id="navbar-privacy-link" class="navbar-item has-text-weight-bold" href="{{ env('APP_URL') }}/admin/privacy-policy">Privacy Policy</a>
                <a id="navbar-terms-link" class="navbar-item has-text-weight-bold" href="{{ env('APP_URL') }}/admin/terms-of-service">Terms of Service</a>
            </div>

            <div class="navbar-end">
                <div class="navbar-item">
                    <div class="field is-grouped">
                        <p id="user-editable" class="control">
                            <a class="button has-background-black has-text-white" href="{{ env('APP_URL') }}/admin/setting">
                                <span>Change Password</span>
                                <span class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                      </svg>
                                </span>
                            </a>
                        </p>
                        <p class="control">
                            <a id="signout-btn" class="button is-danger has-text-white" >
                                <span>Logout</span>
                                <span class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                      </svg>
                                </span>
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</div>
