@extends("layouts.simpleLayout")
@section("content")
<div style="position:absolute; top:50%; left:50%; transform:translate(-50%, -50%)" class="has-text-centered p-2">
     <div class="notification is-success is-light is-hidden"></div>
     <div><h1 class="custom-text-dark custom-fw-700 custom-fs-36">Confirm Your Email</h1></div>
     <div class="mb-5 mt-3"><p>Check you email and enter <span class="has-text-weight-bold">6 digits</span> confirmation code below</p></div>
     <div class="mb-5"><input id="code" class="custom-fw-400 custom-fs-14 custom-text-dark p-5 custom-br-20 custom-bg-light input remove-border-radius" type="text" placeholder="your 6 digit code" /></div>
     <div><button id="submit-btn" class="button p-5 custom-br-20 custom-bg-dark no-border custom-text-white">Verify Account</button></div>
     <div><button id="resend-btn" class="button is-white is-outlined mt-4 custom-br-20 p-5">Resend Email</button></div>
</div>
@stop

@section("script")
     <script>
          var code = document.querySelector("#code");
          var submitBtn = document.querySelector("#submit-btn");
          var resendBtn = document.querySelector("#resend-btn");
          var notification = document.querySelector(".notification");

          @if (isset($_COOKIE["token_key"]))
               var tokenValue = "{{ $_COOKIE["token_key"] }}";
            @else
                var tokenValue = "this_is_an_empty_token_just_for_holding";
            @endif

          async function checkUser() {
               if (tokenValue == null || tokenValue == undefined) {
                    window.location = "{{ env('APP_URL') }}/login";
               }
               else {
                    const response = await axios.post("{{ env("APP_URL") }}/api/v1/user/checkuser", { token : `${tokenValue}` });
                    if (response.data.message == "Verified user found") {
                         window.location = "{{ env('APP_URL') }}/dashboard";
                    }
                    else {
                         // window.location = "{{ env('APP_URL') }}/login";
                    }
               }
          }
          async function submitCode() {
               const response = await axios.post("{{ env("APP_URL") }}/api/v1/user/verify", { token : `${tokenValue}`, verification_code : `${code.value}` });
               if (response.data.response == "User Email Is Verified") {
                    window.location = "{{ env('APP_URL') }}/dashboard";
               }
               else if (response.data.response == "Wrong User") {
                    code.classList.add("is-danger");
               }
               else if (response.data.response == "Something Went Wrong") {
                    code.classList.add("is-danger");
               }
               else if (response.data.message == "Request Did Not Went Through") {
                    code.classList.add("is-danger");
               }
          }
          document.addEventListener("DOMContentLoaded", () => {
               resendBtn.addEventListener("click", async () => {
                    console.log(tokenValue);
                    const response = await axios.post("{{ env("APP_URL") }}/api/v1/user/resend", { token : `${tokenValue}` });


          
                    // if (response.data.message == "No User found with this token") {
                    //      window.location = "{{ env('APP_URL') }}/login";
                    // }
                    // else {
                    //      if (response.data.message == "Already verified") {
                    //           window.location = "{{ env('APP_URL') }}/dashboard";
                    //      }
                    //      else {
                    //           notification.classList.remove("is-hidden");
                    //           notification.innerHTML = "New Email has been sent";
                    //      }
                    // }
               });
               submitBtn.addEventListener("click", () => {
                    submitCode();
               });
               code.addEventListener("keyup", () => {
                    code.classList.remove("is-danger");
               });
               checkUser();
          });
     </script>
@stop