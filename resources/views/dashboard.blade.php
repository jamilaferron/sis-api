@extends('layouts.app')

@section('content')
    <div class="col-md-10 col-sm-11 px-5 pl-md-2 pt-2 main mx-auto">
        <div class="card">
            <div class="card-header">Dashboard</div>

            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="alert alert-success" role="alert">
                    <p>You are logged in as a <span>{{ Auth::user()->role }}</span></p>
                </div>

                @if(Auth::user()->role == 'admin')
                    <h1>Add User</h1>
                    <form id="userForm">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" id="name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" id="email" class="form-control">
                        </div>
                        <input type="submit" value="submit" class="btn btn-primary">
                    </form>
                    <hr>
                    <ul id="users" class="list-group">

                    </ul>

            </div>


                @endif


            </div>
        </div>

    </div>
@endsection
@section('scripts')
    <script   src="https://code.jquery.com/jquery-3.3.1.js"   integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="   crossorigin="anonymous"></script>
    <script type="text/javascript">

        $(document).ready(function (){

            getUsers();

            // Submit event
            $('#userForm').on('submit', function (e) {
                e.preventDefault();

                let name = $('#name').val();
                let email = $('#email').val();

                addUser(name, email);

            });

            // Delete Event
            $('body').on('click', '.deleteLink', function (e) {
                e.preventDefault();

                let id = $(this).data('id');

                deleteUser(id);

            });

            //Delete user using API
            function deleteUser(id)
            {
                $.ajax({
                    method: 'POST',
                    url: 'http://127.0.0.1:8000/api/users/' + id,
                    data: {_method: 'DELETE'}
                }).done(function (user){

                    alert('User Removed');
                    location.reload();
                });
            }

            // Insert user using API
            function addUser(name, email)
            {
                $.ajax({
                    method: 'POST',
                    url: 'http://127.0.0.1:8000/api/users',
                    data: {name: name, email: email}
                }).done(function (user){

                    alert('Item # ' + user.id + ' added');
                    location.reload();
                });
            }


            // Get Users from API
            function getUsers()
            {
                $.ajax({
                    url: 'http://127.0.0.1:8000/api/users'
                }).done(function (users)
                {
                    let output = '';


                    $.each(users, function(key, user)
                    {

                        output += `
                            <li class="list-group-item">
                                <strong>${user.name}:</strong> ${user.username} <br>
                                <a href="#" class="deleteLink" data-id="${user.id}">Delete</a>


                            </li>
                        `;
                    });
                    $('#users').append(output);
                });
            }
        });
    </script>
@endsection