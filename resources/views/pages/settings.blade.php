@extends("layouts.dashboardLayout")
@section('content')
    <div class="container p-5" style="max-width: 1080px;">
        <div>
            <h1 class="custom-fs-36 custom-fw-700 custom-text-dark mb-4">Settings</h1>
        </div>
        <div class="mb-4" style="width: 360px;">
            <h2 class="custom-fw-700 custom-fs-24 custom-text-dark">Profile Details</h2>
            <div class="notification is-primary is-light is-hidden mt-2">
            </div>
            <div class="my-2"><input id="username"
                    class="custom-fw-400 custom-fs-14 custom-text-dark p-5 custom-br-20 custom-bg-light input remove-border-radius"
                    type="text" placeholder="Your Full Name" /></div>
            <div class="my-2"><input id="companyname"
                    class="custom-fw-400 custom-fs-14 custom-text-dark p-5 custom-br-20 custom-bg-light input remove-border-radius"
                    type="text" placeholder="Company Name" /></div>
            <div class="my-2">
                <select id="role" class="input is-medium custom-br-20">
                    <option id="empty-option" value="">Your Role</option>
                    <option value="Web Designer">Web Designer</option>
                    <option value="Logo Designer">Logo Designer</option>
                    <option value="UX Developer">UX Developer</option>
                    <option value="Others">Others</option>
                </select>
            </div>
            <div class="my-2"><button id="update-profile-btn" class="button p-5 custom-br-20 custom-bg-primary no-border"
                    onclick="checkUser();">Update Profile Details</button></div>
        </div>

        <div id="update-email-container" class="mt-6">
            <h2 class="custom-fw-700 custom-fs-24 custom-text-dark">Email Address</h2>
            <div class="notification is-hidden is-light mt-2"></div>
            <div class="is-flex">
                <p class="mr-2">your email address is yogesh@nizeed.com</p>
                <a style="text-decoration: underline;" class="has-text-weight-bold has-text-black"
                    href="{{ env('APP_URL') }}/settings">Change email</a>
            </div>
            <div class="is-flex my-2">
                <div class="mr-2">
                    <input id="update-email"
                        class="custom-fw-400 custom-fs-14 custom-text-dark p-5 custom-br-20 custom-bg-light input remove-border-radius"
                        type="email" placeholder="Enter new email address" />
                    <p id="update-email-msg" class="has-text-left has-text-danger"></p>
                </div>
                <div>
                    <input id="update-password"
                        class="custom-fw-400 custom-fs-14 custom-text-dark p-5 custom-br-20 custom-bg-light input remove-border-radius"
                        type="password" placeholder="Enter current password" />
                    <p id="update-password-msg" class="has-text-left has-text-danger"></p>
                </div>
            </div>
            <div class="my-2"><button id="update-email-btn"
                    class="button p-5 custom-br-20 custom-bg-primary no-border">Update email</button></div>
        </div>

        <div id="collaborator-disable-1">
            <div class="mt-6">
                <div class="is-flex is-align-items-center">
                    <h2 class="custom-fw-700 custom-fs-24 custom-text-dark mr-2">Password</h2>
                    <a style="text-decoration: underline;" class="custom-fw-600 custom-fs-16 custom-text-dark"
                        href="{{ env('APP_URL') }}/changepassword">Change password</a>
                </div>
            </div>
            <div style="width:100%; height: 3px;" class="has-background-light my-4"></div>
            <div>
                <div><a id="delete-account" style="text-decoration: underline;"
                        class="custom-fw-600 custom-fs-16 custom-text-dark">Delete my account</a></div>
                <p class="custom-text-dark custom-fw-400 custom-fs-14 mt-2">You will get an confirmation email</p>
            </div>
        </div>
        <div class="is-flex mt-6 has-text-left custom-fs-24 custom-fw-700 cutom-text-dark">
            <p class="mr-1">If you have any questions, fell free to reach out at</p>
            <a class="custom-text-secondary" href="mailto:yogesh@nizeed.com">yogesh@nizeed.com</a>
        </div>
    </div>
@stop

@section('script')
    <script>
        var signoutBtn, username, companyname, roles, options, emptyOption, updateProfileBtn, deleteAccount,
            updateEmailContainer, updateEmail, updatePassword, updateEmailBtn, notificationUpdate, tokenValue, emailMsg,
            passwordMsg;

        signoutBtn = document.querySelector("#signout-btn");
        username = document.querySelector("#username");
        companyname = document.querySelector("#companyname");
        roles = document.querySelector("#role");
        options = roles.querySelectorAll("option");
        emptyOption = roles.querySelector("#empty-option");
        updateProfileBtn = document.querySelector("#update-profile-btn");
        deleteAccount = document.querySelector("#delete-account");
        updateEmailContainer = document.querySelector("#update-email-container");
        updateEmail = updateEmailContainer.querySelector("#update-email");
        updatePassword = updateEmailContainer.querySelector("#update-password");
        updateEmailBtn = updateEmailContainer.querySelector("#update-email-btn");
        notificationUpdate = document.querySelector("#update-email-container .notification");
        emailMsg = document.querySelector("#update-email-msg");
        passwordMsg = document.querySelector("#update-password-msg");

        @if (isset($_COOKIE['token_key']))
            tokenValue = "{{ $_COOKIE['token_key'] }}";
        @else
            tokenValue = "this_is_an_empty_token_just_for_holding";
        @endif

        async function checkUser() {
            const response = await axios.post("{{ env('APP_URL') }}/api/v1/user/checkuser", {
                token: `${tokenValue}`
            });
            if (response.data.note == "collaborator") {
                companyname.setAttribute("disabled", "true");
                // updateEmail.setAttribute("disabled");
                // updatePassword.setAttribute("disabled");
                document.querySelector("#update-email-container").remove();
                document.querySelector("#collaborator-disable-1").remove();
            }
            if (response.data.message == "Verified user found") {
                await username.setAttribute("value", `${response.data.response.name}`);
                await companyname.setAttribute("value", `${response.data.response.companyName}`);
                options.forEach((option) => {
                    const optionsValue = option.getAttribute("value").toLowerCase();
                    const responseValue = response.data.response.role.toLowerCase();
                    if (responseValue === optionsValue) {
                        option.setAttribute("selected", "true");
                    } else {
                        emptyOption.setAttribute("selected", "true");
                    }
                });
            } else if (response.data.message == "Unverified user found") {
                location.href = "{{ env('APP_URL') }}/verify-email";
            }
            else {
                location.href = "{{ env('APP_URL') }}/login";
            }
        }

        updateProfileBtn.addEventListener("click", async () => {
            const response = await axios.post("{{ env('APP_URL') }}/api/v1/user/change", {
                token: `${tokenValue}`,
                name: `${username.value}`,
                companyName: `${companyname.value}`,
                role: `${role.value}`
            });
        });
        updateEmailBtn.addEventListener("click", async () => {
            const response = await axios.post("{{ env('APP_URL') }}/api/v1/user/change", {
                token: `${tokenValue}`,
                email: `${updateEmail.value}`,
                password: `${updatePassword.value}`,
                command: "change email"
            });
            console.log(response);
            if (response.data.response.email == "The email field is required.") {
                updateEmail.classList.add("is-danger");
                emailMsg.innerText = `The email field is required`;
            } else if (response.data.response.email == "The email must be a valid email address.") {
                updateEmail.classList.add("is-danger");
                emailMsg.innerText = `The email address must be valid`;
            }
            if (response.data.response.password == "The password field is required.") {
                updatePassword.classList.add("is-danger");
                passwordMsg.innerText = `The password field is required`;
            }
            else if (response.data.message == "Incorrect password") {
                updatePassword.classList.add("is-danger");
                passwordMsg.innerText = `Incorrect password`;
            }
            if (response.data.message == "Email changed") {
                updateEmail.classList.add("is-success");
                updatePassword.classList.add("is-success");
                updateEmailBtn.innerText = "Email Changed";
            }
        });

        document.addEventListener("DOMContentLoaded", () => {
            checkUser();
            signoutBtn.addEventListener("click", async () => {
                const response = await axios.post("{{ env('APP_URL') }}/api/v1/user/logout", {
                    token: `${tokenValue}`
                });
                if (response.data.message == "You have been logged out") {
                    window.location = "{{ env('APP_URL') }}/login";
                } else if (response.data.message == "Incorrect Logout Credentials") {
                    // console.log(response);
                } else {
                    // console.log(response);
                }
            });
            deleteAccount.addEventListener("click", async () => {
                const response = await axios.post("{{ env('APP_URL') }}/api/v1/user/delete", {
                    token: `${tokenValue}`
                });
                if (response.data.message == "Your account was deleted") {
                    location.href = `env('APP_URL')/login`;
                }
            });
        });

        updateEmail.addEventListener("keyup", function() {
            updateEmail.classList.remove("is-danger");
            updateEmail.classList.remove("is-success");
            emailMsg.innerText = ``;
            updateEmailBtn.innerText = "Update email";
        });
        updatePassword.addEventListener("keyup", function() {
                updatePassword.classList.remove("is-danger");
                updatePassword.classList.remove("is-success");
                passwordMsg.innerText = ``;
                updateEmailBtn.innerText = "Update email";
        });
    </script>
@stop
