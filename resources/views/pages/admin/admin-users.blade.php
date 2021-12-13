@extends("layouts.adminLayout")
@section('content')
    <div class="container">
        <div class="px-3">
            <div class="field is-grouped">
                <p class="control is-expanded">
                    <input class="input" type="text" placeholder="Find a repository">
                </p>
                <p class="control">
                    <a class="button is-black">
                        Search
                    </a>
                </p>
            </div>
        </div>
        <div class="mx-3 mt-3 p-3 has-background-black">
            <p class="has-text-white">Search Result</p>
        </div>
        <div class="px-3 mt-3">
            <div class="table-container">
                <table style="width:100%;" class="table">
                    <thead class="has-background-black">
                        <tr>
                            <th class="has-text-white">Name</th>
                            <th class="has-text-white">Email</th>
                            <th class="has-text-white">Company Name</th>
                            <th class="has-text-white">Profile</th>
                            <th class="has-text-white">Role</th>
                            <th class="has-text-white">Api Limiter</th>
                            <th class="has-text-white">Share Count</th>
                            <th class="has-text-white">Identifier</th>
                            <th class="has-text-white">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="has-background-light">Ankit Thapa</td>
                            <td class="has-background-light">ankit@gmail.com</td>
                            <td class="has-background-light">cnkit</td>
                            <td class="has-background-light">http://www.profile.com/</td>
                            <td class="has-background-light">designer</td>
                            <td class="has-background-light">100</td>
                            <td class="has-background-light">3</td>
                            <td class="has-background-light">asjgfasgf</td>
                            <td class="has-background-light">
                                <a class="button is-small is-danger">Delete</a>
                            </td>
                        </tr>
                        <tr>
                                <td class="has-background-light">Ankit Thapa</td>
                                <td class="has-background-light">ankit@gmail.com</td>
                                <td class="has-background-light">cnkit</td>
                                <td class="has-background-light">http://www.profile.com/</td>
                                <td class="has-background-light">designer</td>
                                <td class="has-background-light">100</td>
                                <td class="has-background-light">3</td>
                                <td class="has-background-light">asjgfasgf</td>
                                <td class="has-background-light">
                                    <a class="button is-small is-danger">Delete</a>
                                </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
@section('script')
@stop
