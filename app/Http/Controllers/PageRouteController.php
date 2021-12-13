<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageRouteController extends Controller
{
    public function home() {
        return view('pages.home');
    }
    public function about() {
        return view('pages.about');
    }
    public function knowledgebase() {
        return view('pages.knowledgebase');
    }
    public function pricing() {
        return view('pages.pricing');
    }
    public function signup() {
        return view('pages.signup');
    }
    public function login() {
        return view('pages.login');
    }
    public function forgotpassword() {
        return view('pages.forgotpassword');
    }
    public function forgotpass() {
        return view('pages.forgot-password');
    }
    public function changepassword() {
        return view('pages.changepassword');
    }
    public function settings() {
        return view('pages.settings');
    }
    public function logincomplete() {
        return view('pages.logincomplete');
    }
    public function verifyemail() {
        return view('pages.verify-email');
    }
    public function dashboard() {
        return view('pages.dashboard');
    }

    public function privacy() {
        return view('pages.privacy');
    }
    public function terms() {
        return view('pages.terms');
    }
    public function contact() {
        return view('pages.contact-us');
    }
    public function reportbug() {
        return view('pages.report-bug');
    }
    public function newfeatures() {
        return view('pages.new-features');
    }


    public function admin() {
        return view('pages.admin.admin');
    }
    public function adminUsers() {
        return view('pages.admin.admin-users');
    }
    public function adminAbout() {
        return view('pages.admin.admin-about');
    }
    public function adminPricing() {
        return view('pages.admin.admin-pricing');
    }
    public function adminKnowledgebase() {
        return view('pages.admin.admin-knowledgebase');
    }
    public function adminPrivacy() {
        return view('pages.admin.admin-privacy');
    }
    public function adminTerms() {
        return view('pages.admin.admin-terms');
    }
    public function adminLogin() {
        return view('pages.admin.admin-login');
    }
    public function adminSetting() {
        return view('pages.admin.admin-settings');
    }
    public function adminForgotPassword() {
        return view('pages.admin.admin-forgotpassword');
    }
}
