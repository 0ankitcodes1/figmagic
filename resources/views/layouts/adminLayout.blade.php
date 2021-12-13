<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
     @include("layouts.head")
     <!-- Include stylesheet -->
     <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet" />
     <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
     <script src="{{ env('APP_URL') }}/js/image-resize.min.js"></script>
</head>
<body>
     @include("layouts.components.admin-navbar")
     @yield("content")
     {{-- @include("layouts.components.footer") --}}
     <script src="{{ URL::asset('js/app.js') }}"></script>
     <!-- Include the Quill library -->
     @yield("script")
     <script>
          var usersLink, aboutLink, privacyLink, termsLink, knowledgebaseLink, pricingLink;

          usersLink = document.querySelector("#navbar-users-link");
          aboutLink = document.querySelector("#navbar-about-link");
          pricingLink = document.querySelector("#navbar-pricing-link");
          knowledgebaseLink = document.querySelector("#navbar-knowledgebase-link");
          privacyLink = document.querySelector("#navbar-privacy-link");
          termsLink = document.querySelector("#navbar-terms-link");

          var url = location.href;

          var linkPart = url.split("{{ env('APP_URL') }}/admin/")[1];

          if (linkPart == "users" || linkPart =="users/") {
               usersLink.classList.add("has-text-link");
          }
          else if (linkPart == "about-us" || linkPart =="about-us/") {
               aboutLink.classList.add("has-text-link");
          }
          else if (linkPart == "pricing" || linkPart =="pricing/") {
               pricingLink.classList.add("has-text-link");
          }
          else if (linkPart == "knowledgebase" || linkPart =="knowledgebase/") {
               knowledgebaseLink.classList.add("has-text-link");
          }
          else if (linkPart == "privacy-policy" || linkPart =="privacy-policy/") {
               privacyLink.classList.add("has-text-link");
          }
          else if (linkPart == "terms-of-service" || linkPart =="terms-of-service/") {
               termsLink.classList.add("has-text-link");
          }



     var signoutBtn = document.querySelector("#signout-btn");

     // var firstName = document.querySelector("#first-name");
     // var initialCount = document.querySelector("#initial-count");
     // var totalCount = document.querySelector("#total-count");

     var token = Cookies.get();
     var tokenValue = token.token2;
     async function checkUser() {
          const response = await axios.post("{{ env("APP_URL") }}/api/v1/admin/checkuser", { token : `${tokenValue}` });
          if (response.data.message == "Verified user found") {
               // firstName.innerHTML = response.data.response.name;
               // totalCount.innerHTML = "100";
               // initialCount = 100 - response.data.response.apiLimiter;
          }
          else if (response.data.message == "Unverified user found") {
               window.location = "{{ env('APP_URL') }}/verify-email";
          }
          else {
               window.location = "{{ env('APP_URL') }}/admin/login";
          }
     }
     document.addEventListener("DOMContentLoaded", () => {
          checkUser();
          signoutBtn.addEventListener("click", async () => {
               const response = await axios.post("{{ env("APP_URL") }}/api/v1/admin/logout", { token : `${tokenValue}` });
               if (response.data.message == "You have been logged out") {
                    Cookies.remove("token2");
                    window.location = "{{ env('APP_URL') }}/admin/login";
               }
               else if (response.data.message == "Incorrect Logout Credentials") {
                    Cookies.remove("token2");
                    window.location = "{{ env('APP_URL') }}/admin/login";
               }
               else {
                    console.log(response);
               }
          });
     });
     </script>
</body>
</html>