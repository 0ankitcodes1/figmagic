@extends("layouts.adminLayout")
@section('content')
<div class="container">
    <div class="px-3">
        <div class="card">
            <div class="card-content">
                <a href="{{ env('APP_URL') }}/admin/users" class="has-text-black">
                    <div style="width:40px;height:40px;">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                        </svg>
                    </div>
                    <div>
                        Users
                        <span>0</span>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <div class="px-3 mt-3 columns">
        <div class="column">
            <div class="card">
                <div class="card-content">
                    <header class="mb-5">
                        <h3 class="has-text-weight-bold title">Change Social Links</h3>
                    </header>
                    <div class="field">
                        <label for="social-link-1" class="label">Instagram Link</label>
                        <div class="control has-icons-left has-icons-right">
                            <input id="social-link-1" class="input" type="text" placeholder="https://www.socialmedia.com/" />
                            <span class="icon is-small is-left">
                                <svg style="width:20px;height:20px;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                                </svg>
                            </span>
                        </div>
                    </div>
                    <div class="field">
                        <label for="social-link-2" class="label">Twitter Link</label>
                        <div class="control has-icons-left has-icons-right">
                            <input id="social-link-2" class="input" type="text" placeholder="https://www.socialmedia.com/" />
                            <span class="icon is-small is-left">
                                <svg style="width:20px;height:20px;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                                </svg>
                            </span>
                        </div>
                    </div>
                    <div class="field">
                        <label for="social-link-3" class="label">Facebook Link</label>
                        <div class="control has-icons-left has-icons-right">
                            <input id="social-link-3" class="input" type="text" placeholder="https://www.socialmedia.com/" />
                            <span class="icon is-small is-left">
                                <svg style="width:20px;height:20px;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                                </svg>
                            </span>
                        </div>
                    </div>
                    <footer class="mt-5">
                            <button id="about-save-change-btn" class="button is-link">
                                <span class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                                    </svg>
                                </span>
                                <span>Save Changes</span>
                            </button>
                            <button class="button is-danger">
                                <span class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </span>
                                <span>Cancel</span>
                            </button>
                    </footer>
                </div>
            </div>
        </div>
        <div class="column">
            <div class="card">
                <div class="card-content">
                    <header class="mb-5">
                        <h3 class="has-text-weight-bold title">Website Information</h3>
                    </header>
                    <div class="field">
                        <label for="social-link-4" class="label">Email Us</label>
                        <div class="control has-icons-left has-icons-right">
                            <input id="social-link-4" class="input" type="email" placeholder="info@nizeed.com" />
                            <span class="icon is-small is-left">
                                <svg style="width:20px;height:20px;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                  </svg>
                            </span>
                        </div>
                    </div>
                    <div class="field">
                        <label for="social-link-5" class="label">Request A New Feature</label>
                        <div class="control has-icons-left has-icons-right">
                            <input id="social-link-5" class="input" type="email" placeholder="info@nizeed.com" />
                            <span class="icon is-small is-left">
                                <svg style="width:20px;height:20px;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                  </svg>
                            </span>
                        </div>
                    </div>
                    <div class="field">
                        <label for="social-link-6" class="label">Report a Bug</label>
                        <div class="control has-icons-left has-icons-right">
                            <input id="social-link-6" class="input" type="email" placeholder="info@nizeed.com" />
                            <span class="icon is-small is-left">
                                <svg style="width:20px;height:20px;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                  </svg>
                            </span>
                        </div>
                    </div>
                    <footer class="mt-5">
                            <button id="about-save-change-btn" class="button is-link">
                                <span class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                                    </svg>
                                </span>
                                <span>Save Changes</span>
                            </button>
                            <button class="button is-danger">
                                <span class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </span>
                                <span>Cancel</span>
                            </button>
                    </footer>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="px-3 mt-3 columns">
        <div class="column">
            <div class="card">
                <div class="card-content">
                    <header class="mb-5">
                        <h3 class="has-text-weight-bold title is-size-5">Add FAQ</h3>
                        <div class="field">
                            <div class="control has-icons-left has-icons-right">
                                <input class="input" type="text" placeholder="https://www.socialmedia.com/" />
                                <span class="icon is-small is-left">
                                    <svg style="width:20px;height:20px;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </span>
                            </div>
                        </div>
                        <div>
                            <textarea class="textarea" placeholder="Write your answer" rows="5"></textarea>
                        </div>
                    </header>
                </div>
            </div>
        </div>
        <div class="column">
            <div class="card">
                <div class="card-content"></div>
            </div>
        </div>
    </div> --}}
</div>
@stop
@section('script')
<script>
    var token = Cookies.get();
    var tokenValue = token.token2;
</script>
@stop
