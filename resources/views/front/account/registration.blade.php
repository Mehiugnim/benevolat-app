@extends('front.layouts.app')

@section('main')
<section class="section-5">
    <div class="container my-5">
        <div class="py-lg-2">&nbsp;</div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-5">
                <div class="card shadow border-0 p-5">
                    <h1 class="h3">Register</h1>
                    <form action="{{ route('account.processRegistration') }}" name="registrationForm" id="registrationForm" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="mb-2">Name*</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Enter Name" required>
                            <p></p>
                        </div> 
                        <div class="mb-3">
                            <label for="email" class="mb-2">Email*</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Enter Email" required>
                            <p></p>
                        </div> 
                        <div class="mb-3">
                            <label for="password" class="mb-2">Password*</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Enter Password" required>
                            <p></p>
                        </div> 
                        <div class="mb-3">
                            <label for="confirm_password" class="mb-2">Confirm Password*</label>
                            <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Please confirm Password" required>
                            <p></p>
                        </div> 
                        <button type="submit" class="btn btn-primary mt-2">Register</button>
                    </form>                    
                </div>
                <div class="mt-4 text-center">
                    <p>Have an account? <a href="{{ route('account.login') }}">Login</a></p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('customJs')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $("#registrationForm").submit(function(e) {
        e.preventDefault(); // Empêche la soumission normale du formulaire

        $.ajax({
            url: '{{ route("account.processRegistration") }}',
            type: 'POST',
            data: $(this).serialize(), // Sérialise les données du formulaire
            dataType: 'json',
            success: function(response) {
                if (response.status == false) {
                    // Gérer les erreurs de validation
                    var errors = response.errors;

                    if (errors.name) {
                        $("#name").addClass('is-invalid')
                            .siblings('p')
                            .addClass('invalid-feedback')
                            .html(errors.name);
                    } else {
                        $("#name").removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback')
                            .html('');
                    }

                    if (errors.email) {
                        $("#email").addClass('is-invalid')
                            .siblings('p')
                            .addClass('invalid-feedback')
                            .html(errors.email);
                    } else {
                        $("#email").removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback')
                            .html('');
                    }

                    if (errors.password) {
                        $("#password").addClass('is-invalid')
                            .siblings('p')
                            .addClass('invalid-feedback')
                            .html(errors.password);
                    } else {
                        $("#password").removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback')
                            .html('');
                    }

                    if (errors.confirm_password) {
                        $("#confirm_password").addClass('is-invalid')
                            .siblings('p')
                            .addClass('invalid-feedback')
                            .html(errors.confirm_password);
                    } else {
                        $("#confirm_password").removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback')
                            .html('');
                    }
                } else {
                    // Si l'inscription réussit, redirige vers la page de connexion
                    window.location.href = '{{ route("account.login") }}';
                }
            },
            error: function(xhr) {
                console.log(xhr.responseText); // Affiche les erreurs dans la console
            }
        });
    });
});
</script>
@endsection