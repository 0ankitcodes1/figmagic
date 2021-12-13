@extends("layouts.adminLayout")
@section('content')
<div class="continaer p-1">
     <div id="form" class="box has-text-centered my-5" style="max-width: 450px; position: relative; left: 50%; transform:translate(-50%,0)">
          <div><h2 class="has-text-weight-bold is-size-3 is-size-4-mobile">Change Password</h2></div>
          <div class="my-5">
                <input id="current-password" class="input remove-border-radius" type="password" placeholder="Current Password" />
                <p class="has-text-left has-text-danger current-password-msg"></p>
        </div>
          <div class="my-5">
               <input id="new-password" class="input remove-border-radius" type="password" placeholder="New Password" />
               <p class="has-text-left has-text-danger new-password-msg"></p>
          </div>
          <div class="my-5">
                <input id="confirm-password" class="input remove-border-radius" type="password" placeholder="Confirm Password" />
                <p class="has-text-left has-text-danger confirm-password-msg"></p>
           </div>
          <div class="mt-5">
               <button id="change-btn" style="width:100%;" class="button is-danger">
                    <span>Change Password</span>
                    <span class="icon is-small"><i class="fa fa-arrow-right"></i></span>
               </button>
          </div>
     </div>
</div>
@stop
@section('script')
@stop