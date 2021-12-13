@extends("layouts.dashboardLayout")
@section("content")
<div class="container p-4" style="max-width: 1080px;">

     <div id="team_model" class="modal add-team-member-sect">
          <div class="modal-background" onclick="closeTeamModel()"></div>
          <div class="modal-card">
            <header class="modal-card-head">
              <p class="modal-card-title">Add Team Member</p>
              <button class="delete" aria-label="close" onclick="closeTeamModel()"></button>
            </header>
            <section class="modal-card-body">
               <div class="mt-1">
                    <input id="team_member_email" class="custom-fw-400 custom-fs-14 custom-text-dark p-5 custom-br-20 custom-bg-light input remove-border-radius" type="email" placeholder="Add your team member email" />
                    <p class="has-text-left has-text-danger team-email-msg"></p>
               </div>
            </section>
            <footer class="modal-card-foot">
              <button onclick="addTeamMember();" class="button p-5 custom-br-20 custom-bg-primary no-border">Save changes</button>
            </footer>
          </div>
     </div>

     <div class="mb-6">
          <h1 class="custom-fw-700 custom-fs-36 custom-text-dark">Welcome <span id="first-name"></span></h1>
          <p class="custom-fs-18 custom-fw-500 custom-text-dark">Plan: Small Design Agencies</p>
          {{-- <div class="columns">
               <div class="column">
                    <p><small>Plan: Free</small></p>
                    <div style="width:100%;height:5px;" class="has-background-light my-2"></div>
                    <p><small><span id="initial-count">0</span>/<span id="total-count">100</span> notes, images, screenshots, links used</small></p>
               </div>
               <div class="column">
                    <p><small>Plan: Free</small></p>
                    <div style="width:100%;height:5px;" class="has-background-light my-2"></div>
                    <p><small><span>0</span>/<span>3</span> projects</small></p>
               </div>
          </div> --}}
     </div>
     <div class="mb-6">
          <h1 class="custom-fw-700 custom-fs-36 custom-text-dark is-flex is-align-items-center">
               <span>Teams</span>
               <span class="mx-2"></span>
               <button  class="add-team-member-sect button custom-bg-primary custom-br-20 custom-fs-16 custom-fw-500 custom-text-dark" onclick="openMemberModel()">Add Member</button>
          </h1>
          <p class="add-team-member-sect custom-fs-14 custom-fw-400 seat_count"></p>
          <table class="table">
               <thead>
                    <tr>
                         <th>Email</th>
                         <th>Actions</th>
                    </tr>
               </thead>
               <tbody>
                    <tr>
                         <td class="current_email"></td>
                         <td><a href="{{ env('APP_URL') }}/settings" class="button is-outlined is-small no-border custom-fw-600">Change Email</a></td>
                    </tr>
               </tbody>
               <tbody id="team_table" class="add-team-member-sect">
               </tbody>
          </table>
     </div>
     <div class="mb-6 add-team-member-sect">
          <h1 class="custom-fw-700 custom-fs-36 custom-text-dark">Plan Details</h1>
          <table class="table">
               <thead>
                    <tr>
                         <th>Purchase</th>
                         <th>Seats</th>
                         <th>Next Billing Date</th>
                    </tr>
               </thead>
               <tbody>
                    <tr>
                         <td>No Transaction Made</td>
                    </tr>
               </tbody>
          </table>
     </div>

     <div class="mb-6">
          <h1 class="custom-fw-700 custom-fs-36 custom-text-dark">Plan Details</h1>
          <div class="button-group">
               <button class="button no-border">
                   <span class="icon is-small">

                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                         <path d="M0 8C0 3.58173 3.58173 0 8 0C12.4183 0 16 3.58173 16 8C16 12.4183 12.4183 16 8 16C3.58173 16 0 12.4183 0 8Z" fill="#333333"/>
                         <path d="M6.39981 12.8001C7.28347 12.8001 7.9998 12.0838 7.9998 11.2001V9.6001H6.39981C5.51614 9.6001 4.7998 10.3165 4.7998 11.2001C4.7998 12.0838 5.51614 12.8001 6.39981 12.8001Z" fill="#0ACF83"/>
                         <path d="M4.7998 8.00015C4.7998 7.11648 5.51614 6.40015 6.39981 6.40015H7.9998V9.60015H6.39981C5.51614 9.60015 4.7998 8.88378 4.7998 8.00015Z" fill="#A259FF"/>
                         <path d="M4.7998 4.79996C4.7998 3.91629 5.51614 3.19995 6.39981 3.19995H7.9998V6.39996H6.39981C5.51614 6.39996 4.7998 5.68359 4.7998 4.79996Z" fill="#F24E1E"/>
                         <path d="M8 3.19995H9.6C10.4837 3.19995 11.2 3.91629 11.2 4.79996C11.2 5.68359 10.4837 6.39996 9.6 6.39996H8V3.19995Z" fill="#FF7262"/>
                         <path d="M11.2 8.00015C11.2 8.88378 10.4837 9.60015 9.6 9.60015C8.71633 9.60015 8 8.88378 8 8.00015C8 7.11648 8.71633 6.40015 9.6 6.40015C10.4837 6.40015 11.2 7.11648 11.2 8.00015Z" fill="#1ABCFE"/>
                    </svg>
                         
                   </span>
                   <span class="has-text-weight-bold">Install Figma Plugin</span>
               </button>
               <button class="button no-border">
                   <span class="icon is-small">

                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                         <path d="M1.06961 12.0042C1.71317 13.1195 2.61675 14.0627 3.70339 14.7535C4.79002 15.4443 6.02752 15.8622 7.31048 15.9717L10.9336 9.69624L8.00004 8.00282L5.06849 9.69544L4.09111 8.00233L3.37538 6.76291L1.44634 3.42163C0.573509 4.66814 0.0744266 6.1378 0.0076952 7.65805C-0.0590362 9.1783 0.309354 10.686 1.06961 12.0042Z" fill="#00AC47"/>
                         <path d="M7.99989 2.67259e-07C6.71224 -0.000332754 5.44359 0.310563 4.30199 0.906206C3.16039 1.50185 2.17967 2.36459 1.44336 3.42095L5.0665 9.69636L7.99989 8.00288V4.61758H15.2439C14.6008 3.2385 13.5777 2.07151 12.2945 1.2536C11.0114 0.435686 9.52154 0.000802792 7.99989 2.67259e-07Z" fill="#EA4435"/>
                         <path d="M14.9298 12.0041C15.5737 10.8892 15.9387 9.63511 15.9937 8.34872C16.0486 7.06234 15.7918 5.78174 15.2452 4.61597H7.99901V8.00287L10.9308 9.69549L9.95342 11.3886L9.23769 12.6283L7.30859 15.9695C8.82455 16.1021 10.3469 15.7994 11.6968 15.097C13.0468 14.3946 14.1683 13.3216 14.9298 12.0041Z" fill="#FFBA00"/>
                         <path d="M7.99951 11.3896C9.86966 11.3896 11.3857 9.87357 11.3857 8.00341C11.3857 6.13325 9.86966 4.61719 7.99951 4.61719C6.12935 4.61719 4.61328 6.13325 4.61328 8.00341C4.61328 9.87357 6.12935 11.3896 7.99951 11.3896Z" fill="white"/>
                         <path d="M7.99944 10.6202C9.44456 10.6202 10.6161 9.44871 10.6161 8.00359C10.6161 6.55847 9.44456 5.38696 7.99944 5.38696C6.55432 5.38696 5.38281 6.55847 5.38281 8.00359C5.38281 9.44871 6.55432 10.6202 7.99944 10.6202Z" fill="#4285F4"/>
                         </svg>
                         
                   </span>
                   <span class="has-text-weight-bold">Install Chrome Extension</span>
               </button>
           </div>
     </div>

     <div class="has-text-left custom-fs-24 custom-fw-700 cutom-text-dark">If you have any question fell free to reach out at <a class="custom-text-secondary">yogesh@nizeed.com</a></div>
</div>
@stop
@section("script")
<script>
     var signoutBtn = document.querySelector("#signout-btn");
     var firstName = document.querySelector("#first-name");
     var initialCount = document.querySelector("#initial-count");
     var totalCount = document.querySelector("#total-count");
     var team_table = document.querySelector("#team_table");

          @if (isset($_COOKIE["token_key"]))
               var tokenValue = "{{ $_COOKIE["token_key"] }}";
          @else
               var tokenValue = "this_is_an_empty_token_just_for_holding";
          @endif

     async function removeEmail(e) {
          const id = await e.getAttribute("data-id");
          const response = await axios.post(`{{ env("APP_URL") }}/api/v1/collaborator/delete/${id}`, { token : `${tokenValue}` });
          checkUser();
     }

     async function checkUser() {
          const response = await axios.post("{{ env("APP_URL") }}/api/v1/user/checkuser", { token : `${tokenValue}` });
          console.log(response);
          if (response.data.note == "collaborator") {
               document.querySelectorAll(".add-team-member-sect").forEach(item => {
                    item.remove();
               });
            }

          if (response.data.message == "Verified user found") {
               firstName.innerHTML = response.data.response.name;
               document.querySelector(".current_email").innerHTML = response.data.response.email;
               document.querySelector(".seat_count").innerHTML = response.data.response.shareCount+" Seat";
               // totalCount.innerHTML = "100";
               // initialCount = 100 - response.data.response.apiLimiter;
               team_table.innerHTML = ``;
               const response2 = await axios.post("{{ env("APP_URL") }}/api/v1/collaborator/show/specific", { token : `${tokenValue}` });

               if (response2.data.message == "No email found") {
                    const create_row = document.createElement("tr");
                    create_row.innerHTML = `
                         <td>empty</td>
                         <td></td>
                    `;
                    team_table.appendChild(create_row);
               }
               else {
                    response2.data.response.forEach(email => {
                         const create_row = document.createElement("tr");
                         create_row.innerHTML = `
                              <td class="current_email">${email.email}</td>
                              <td><a class="button is-outlined is-small no-border custom-fw-600" onclick="removeEmail(this);" data-id="${email.id}">Remove</a></td>
                         `;
                         team_table.appendChild(create_row);  
                    });
               }

          }
          else if (response.data.message == "Unverified user found") {
               window.location = "{{ env('APP_URL') }}/verify-email";
          }
          else {
               window.location = "{{ env('APP_URL') }}/login";
          }
     }

     var teamModel = document.querySelector("#team_model");
     var teamMemberEmail = document.querySelector("#team_member_email");
     var teamEmailMsg = document.querySelector(".team-email-msg");

     async function addTeamMember() {
          teamMemberEmail.classList.remove("is-success");
          const response = await axios.post("{{ env("APP_URL") }}/api/v1/collaborator", {
               token : `${tokenValue}`,
               email : `${teamMemberEmail.value}`
          });

          console.log(response);

          if (response.data.message == "Something went wrong") {
               if (response.data.response.email == "The email field is required.") {
                    teamMemberEmail.classList.add("is-danger");
                    teamEmailMsg.innerText = "The email field is required.";
               }
               if (response.data.response.email == "The email has already been taken.") {
                    teamMemberEmail.classList.add("is-danger");
                    teamEmailMsg.innerText = "Email already exists";
               }
               if (response.data.response.email == "The email must be a valid email address.") {
                    teamMemberEmail.classList.add("is-danger");
                    teamEmailMsg.innerText = "The email must be a valid email address.";
               }
          }
          else if (response.data.message == "New User Added") {
               teamMemberEmail.classList.add("is-success");
               checkUser();
               // setTimeout(function(){
               //      window.location.reload(1);
               // }, 1000);
          }
          // console.log(response);
     }

     teamMemberEmail.onkeyup = function() {
          teamMemberEmail.classList.remove("is-danger");
          teamEmailMsg.innerText = "";
     };

     function closeTeamModel() {
          if (teamModel.classList.contains("is-active")) {
               teamModel.classList.remove("is-active");
          }
     }

     function openMemberModel() {
          if (!teamModel.classList.contains("is-active")) {
               teamModel.classList.add("is-active");
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
                    // console.log(response);
               }
               else {
                    // console.log(response);
               }
          });
     });
</script>
@stop