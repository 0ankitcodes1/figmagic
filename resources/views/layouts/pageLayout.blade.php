<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
     @include("layouts.head")
</head>
<body>
     <div id="body">
          @include("layouts.components.navbar")
          @yield("content")
     </div>
     @yield("content-2")
     @yield("content-3")
     @include("layouts.components.footer")
     @yield("script")
     <script>
          var aboutLink, knowledgebaseLink, pricingLink;
          aboutLink = document.querySelector("#navbar-about-link");
          knowledgebaseLink = document.querySelector("#navbar-knowledgebase-link");
          pricingLink = document.querySelector("#navbar-pricing-link");

          var url = location.href;

          var linkPart = url.split("{{ env('APP_URL') }}/")[1];

          if (linkPart == "pricing" || linkPart =="pricing/") {
               pricingLink.classList.add("has-text-link");
          }
          else if (linkPart == "knowledgebase" || linkPart =="knowledgebase/") {
               knowledgebaseLink.classList.add("has-text-link");
          }
          else if (linkPart == "about-us" || linkPart =="about-us/") {
               aboutLink.classList.add("has-text-link");
          }

          var signoutBtn = document.querySelector("#signout-btn");

          @if (isset($_COOKIE["token_key"]))
               var tokenValue = "{{ $_COOKIE["token_key"] }}";
            @else
                var tokenValue = "this_is_an_empty_token_just_for_holding";
            @endif

        async function checkUser() {

            let userEditable = await document.querySelector("#user-editable");

            let userEditableSpan = await userEditable.querySelector("#user-editable-span");
            let userEditableLink = await userEditable.querySelector("#user-editable-link");

            let signupForFree = await document.querySelector("#start-free-trial-navbar");

            const response = await axios.post("{{ env('APP_URL') }}/api/v1/user/checkuser", {
                token: `${tokenValue}`
            });
            if (response.data.message == "Verified user found") {
                userEditableSpan.innerText = `${response.data.response.name}`;
                userEditableLink.href = "{{ env('APP_URL') }}/dashboard";
                if(!signupForFree.classList.contains("is-hidden")) { signupForFree.classList.add("is-hidden"); }
                signoutBtn.classList.remove("is-hidden");
            } else if (response.data.message == "Unverified user found") {
                userEditableSpan.innerHTML =
                    `${response.data.response.name} <span class="has-text-danger">not verified</span>`;
                userEditableLink.href = "{{ env('APP_URL') }}/verify-email";
                if(!signoutBtn.classList.contains("is-hidden")) { signoutBtn.classList.add("is-hidden"); }
                signupForFree.classList.remove("is-hidden");
            } else {
                userEditableSpan.innerText = `Login`;
                userEditableLink.href = "{{ env('APP_URL') }}/login";
                if(!signoutBtn.classList.contains("is-hidden")) { signoutBtn.classList.add("is-hidden"); }
                signupForFree.classList.remove("is-hidden");
            }
        }
        document.addEventListener("DOMContentLoaded", () => {
            checkUser();
            signoutBtn.addEventListener("click", async () => {
               const response = await axios.post("{{ env("APP_URL") }}/api/v1/user/logout", { token : `${tokenValue}` });
               if (response.data.message == "You have been logged out") {
                    window.location = "{{ env('APP_URL') }}/login";
               }
               else if (response.data.message == "Incorrect Logout Credentials") {
                    console.log(response);
               }
               else {
                    console.log(response);
               }
          });
        });



     </script>
     <script src="src="{{ env('APP_URL') }}/js/app.js""></script>
</body>
</html>