@extends("layouts.simpleLayout")
@section('content')
    <div class="continaer p-1">
        <div class="box has-text-centered my-5"
            style="max-width: 450px; position: relative; left: 50%; transform:translate(-50%,0)">
            <div>
                <h2 class="has-text-weight-bold is-size-3 is-size-4-mobile">Forgot Password</h2>
            </div>
            <div class="my-5">
                <input id="email" class="remove-border-radius input" type="email" placeholder="Your Work Email" />
                <div class="email-msg has-text-danger has-text-left"></div>
            </div>
            <div class="has-text-left">
                <p>
                    Please enter your email address in the field above, once completed, you will receive an email containing
                    a <strong>password reset link</strong>. Click on that link for the final step in resetting your
                    password.
                </p>
            </div>
            <div class="my-5">
                <button id="send-btn" style="width:100%;" class="button is-danger">
                    <span>Send Reset Link</span>
                    <span class="icon is-small"><i class="fa fa-arrow-right"></i></span>
                </button>
            </div>
        </div>
    </div>

    <div id="message" class="modal">
        <div onclick="removeModal();" class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <button onclick="removeModal();" class="delete" aria-label="close"></button>
            </header>
            <section class="modal-card-body">
                <!-- Content ... -->
            </section>
            <footer class="modal-card-foot">
                <button onclick="removeModal();" class="button">Close</button>
            </footer>
        </div>
    </div>


@stop
@section('script')
    <script>
        function removeModal() {
            message.classList.remove("is-active");
        }
        document.addEventListener("DOMContentLoaded", () => {
            var sendBtn, email, emailMsg, message;
            sendBtn = document.querySelector("#send-btn");
            email = document.querySelector("#email");
            emailMsg = document.querySelector(".email-msg");
            message = document.querySelector("#message");
            sendBtn.addEventListener("click", async () => {
                const response = await axios.post("{{ env('APP_URL') }}/api/v1/admin/forgot", {
                    email: `${email.value}`
                });
                if (response.data.message == "Something went wrong") {
                    if (response.data.response.email == "The email field is required.") {
                        email.classList.add("is-danger");
                        emailMsg.innerText = `The email field is required`;
                    }
                } else if (response.data.message == "Email is not valid") {
                    email.classList.add("is-danger");
                    emailMsg.innerText = `The email address is not valid`;
                } else if (response.data.message == "Mail Sent With Reset Link") {
                    email.classList.add("is-success");
                    emailMsg.innerText = `Email Sent`;
                    message.classList.add("is-active");
                    message.querySelector("modal-card-body").innerHtml = `
                             <div class="is-flex is-justify-content-center">
                                  <svg xmlns="http://www.w3.org/2000/svg" style="width:100px;height:100px;" class="has-text-link" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                                  </svg>
                             </div>
                             <div class="has-text-centered">
                                  <h3 class="title mt-4 is-size-5-mobile">Check Your Email</h3>
                                  <p class="subtitle mt-5 is-size-6-mobile">Reset password link was successfully sent.</p>
                             </div>
                        `;
                }
            });
            email.addEventListener("keyup", () => {
                email.classList.remove("is-danger");
                emailMsg.innerText = ``;
            });
        });

    </script>
@stop
