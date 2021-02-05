<form method="POST" action="{{ route('update_user_password', $user) }}">
    @csrf

    <div class="form-group row">
        <label for="current_password" class="col-md-4 col-form-label ">Current Password</label>

        <div class="col-md-6">
            <input id="current_password" type="password" class="form-control" name="current_password" required>

        </div>
    </div>

    <div class="form-group row">
        <label for="new_password" class="col-md-4 col-form-label ">New Password</label>

        <div class="col-md-6">
            <input id="new_password" type="password" class="form-control" name="new_password" required>

        </div>
    </div>

    <div class="form-group row">
        <label for="password-confirm" class="col-md-4 col-form-label ">Confirm Password</label>

        <div class="col-md-6">
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
        </div>
    </div>


    <div class="form-group row mb-0">
        <div class="col-md-6 offset-md-4">
            <button type="submit" class="btn btn-primary">
                Save
            </button>
        </div>
    </div>
</form>

