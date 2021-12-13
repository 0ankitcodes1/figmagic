@extends("layouts.simpleLayout")
@section("content")
<div class="continaer p-1">
     <div id="form" class="box has-text-centered my-5" style="max-width: 450px; position: relative; left: 50%; transform:translate(-50%,0)">
          <div><h2 class="has-text-weight-bold is-size-3 is-size-4-mobile">Nizeed Admin Panel</h2></div>
          <div class="mt-5">
               <input id="email" class="input remove-border-radius" type="email" placeholder="Your Work Email" />
               <p class="has-text-left has-text-danger email-msg"></p>
          </div>
          <div class="my-5">
               <input id="password" class="input remove-border-radius" type="password" placeholder="Your Password" />
               <p class="has-text-left has-text-danger password-msg"></p>
          </div>
          <div class="has-text-right my-5"><a href="{{ env('APP_URL') }}/admin/forgotpassword" class="has-text-black has-text-weight-bold">Forgot Password?</a></div>
          <div>
               <button id="login-btn" style="width:100%;" class="button is-danger">
                    <span>Login</span>
                    <span class="icon is-small"><i class="fa fa-arrow-right"></i></span>
               </button>
          </div>
     </div>
</div>
<div id="user-editable" class="container p-1 has-text-centered is-hidden">
     <a id="user-editable-link" class="button" href="#">
          <span class="icon is-small">
               {{-- <img src="{{ URL::asset('images/google.svg') }}" alt="figma logo" /> --}}
               <i class="fa fa-user"></i>
          </span>
          <span id="user-editable-span" class="has-text-weight-bold ml-1"></span>
     </a>
</div>
@stop

@section("script")
<script>
     var form, email, password, loginBtn, emailMsg, passwordMsg;

     form = document.querySelector("#form");
     email = form.querySelector("#email");
     emailMsg = form.querySelector(".email-msg");
     password = form.querySelector("#password");
     passwordMsg = form.querySelector(".password-msg");
     loginBtn = form.querySelector("#login-btn");

     async function checkUser() {
          const token = await Cookies.get();
          const tokenValue = await token.token2;

          let userEditable = await document.querySelector("#user-editable");
          let userEditableSpan = await userEditable.querySelector("#user-editable-span");
          let userEditableLink = await userEditable.querySelector("#user-editable-link");

          const response = await axios.post("{{ env("APP_URL") }}/api/v1/admin/checkuser", { token : `${tokenValue}` });

          if (response.data.message == "Verified user found") {
               userEditableSpan.innerText = `Sign in as ${response.data.response.name}`;
               userEditableLink.href = "{{ env('APP_URL') }}/admin/dashboard";
               userEditable.classList.remove("is-hidden");
          }
          else if (response.data.message == "Unverified user found") {
               userEditableSpan.innerHTML = `${response.data.response.name} <span class="has-text-danger">not verified</span>`;
               userEditableLink.href = "{{ env('APP_URL') }}/verify-email";
               userEditable.classList.remove("is-hidden");
          }
     }

     document.addEventListener("DOMContentLoaded", () => {
          loginBtn.addEventListener("click", async () => {
               const response = await axios.post("{{ env("APP_URL") }}/api/v1/admin/login", { email : `${email.value}`, password : `${password.value}` });
               if (response.data.message === "Something went wrong") {
                    if (response.data.response.email == "The email field is required.") {
                         email.classList.add("is-danger");
                         emailMsg.innerText = `The email field is required`;
                    }
                    else if (response.data.response.email == "The email must be a valid email address.") {
                         email.classList.add("is-danger");
                         emailMsg.innerText = `The email address must be valid`;
                    }
                    if (response.data.response.password == "The password field is required.") {
                         password.classList.add("is-danger");
                         passwordMsg.innerText = `The password field is required`;
                    }
               }
               else if (response.data.message == "Incorrect password" || response.data.message == "Email is not valid") {
                    email.classList.add("is-danger");
                    emailMsg.innerText = `Incorrect email or password field`;
                    password.classList.add("is-danger");
                    passwordMsg.innerText = `Incorrect email or password field`;
               }
               else if (response.data.message == "Successfully logged in") {
                    const token = response.data.response.token;
                    Cookies.set("token2", token, { expires: 30 });
                    console.log("cookie was set");
                    if (response.data.response.status == "verified") {
                         window.location = "{{ env('APP_URL') }}/admin/dashboard"
                    }
                    else if (response.data.response.status == "not verified") {
                         window.location = "{{ env('APP_URL') }}/verify-email"
                    }
               }
          });
          checkUser();
          email.addEventListener("keyup", function() {
               email.classList.remove("is-danger");
               emailMsg.innerText = ``;
          });
          password.addEventListener("keyup", function() {
               password.classList.remove("is-danger");
               passwordMsg.innerText = ``;
          });
     });
</script>
@stop