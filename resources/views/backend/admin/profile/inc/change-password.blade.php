<form action="{{ route('admin.change-password') }}" method="POST" id="userChangePassword">
    @csrf
    <div class="mb-3 password_wrapper">
        <x-form.label for="old_password" label="{{ localize('Old Password') }}" isRequired=true />
        <x-form.input name="old_password" id="old_password" type="password" placeholder="{{ localize('Old Password') }}" value=""
            showDiv=false />
    </div>
    <div class="mb-3 password_wrapper">
        <x-form.label for="password" label="{{ localize('Password') }}" isRequired=true />
        <x-form.input name="password" id="password" type="password" placeholder="{{ localize('Password') }}" value=""
            showDiv=false />
    </div>
    <div class="mb-3 password_wrapper">
        <x-form.label for="password" label="{{ localize('Confirmed Password') }}" isRequired=true />
        <x-form.input name="password_confirmation" id="password_confirmation" type="password"
            placeholder="{{ localize('Confirmed Password') }}" value="" showDiv=false />
    </div>
    <div class="d-flex gap-3">
        <x-form.button id="addUserBtn" class="addUserBtn">{{ localize('Update') }}</x-form.button>
    </div>
</form>
