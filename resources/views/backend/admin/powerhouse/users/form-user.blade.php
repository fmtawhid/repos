<div class="row">

    {{-- Name Start --}}

    <div class="col-lg-4">
        <div class="mb-3">
            <label for="first_name" class="form-label">{{localize('First Name')}} <?= showRequiredStar() ?>  </label>
            <input
                class="form-control"
                type="text"
                id="first_name"
                name="first_name"
                value="{{ isset($user) ? $user->first_name : old('first_name')}}"
                placeholder="Ex. John"
            />

            <?= errorName('first_name') ?>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="mb-3">
            <label for="middle_name" class="form-label">{{ localize('Middle Name')}}  </label>
            <input
                class="form-control"
                type="text"
                id="middle_name"
                name="middle_name"
                value="{{ isset($user) ? $user->middle_name : old('middle_name')}}"
                placeholder="Ex. Cristian"
            />

            <?= errorName('middle_name') ?>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="mb-3">
            <label for="last_name" class="form-label">{{ localize('Last Name') }}  </label>
            <input
                class="form-control"
                type="text"
                id="last_name"
                name="last_name"
                value="{{ isset($user) ? $user->last_name : old('last_name')}}"
                placeholder="Ex. Doe"
            />

            <?= errorName('last_name') ?>
        </div>
    </div>

    {{-- Name End --}}

    <div class="col-lg-12">
        <h5> {{ localize("Authentication") }} </h5>
    </div>

    <div class="col-lg-4">
        <div class="mb-3">
            <label for="email" class="form-label">{{ localize('Email') }}  </label>
            <input
                class="form-control"
                type="email"
                id="email"
                name="email"
                value="{{ isset($user) ? $user->email : old('email')}}"
                placeholder="Ex. example@email.com"
            />

            <?= errorName('email') ?>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="mb-3">
            <label for="username" class="form-label">{{ localize('User Name') }} <?= showRequiredStar() ?> </label>
            <input
                class="form-control"
                type="text"
                id="username"
                name="username"
                value="{{ isset($user) ? $user->username : old('username')}}"
                placeholder="Ex. john123/Jeni123"
            />

            <?= errorName('username') ?>
        </div>
    </div>

    @if(!isset($user))
        <div class="col-lg-4">
            <div class="mb-3">
                <label for="password" class="form-label">{{ localize('Password (Min:6)') }} <?= showRequiredStar() ?> </label>
                <input
                    class="form-control"
                    type="password"
                    id="password"
                    name="password"
                    value="{{  old('password')}}"
                    placeholder="******" />

                    <?= errorName('password') ?>
            </div>
        </div>
    @endif

    <div class="col-lg-12">
        <h4>{{ localize("Account For ?") }}</h4>
    </div>

    <div class="col-lg-4">
        <label for="accountFor">{{ localize("Select") }}</label>
        <select name="accountFor" id="accountFor" class="form-control">
            @forelse($isMerchant as $key=>$value)
                <option value="{{ $key }}"> {{ $value }} </option>
            @empty
            @endforelse
        </select>

        <?= errorName('accountFor') ?>
    </div>

    <div class="col-lg-4">
        <label id="role_id">{{ localize("Select Roles") }}</label>
        <select name="role_id[]" id="role_id" class="form-control select2" multiple>
            @forelse($roles as $role_title=>$role_id)
                <option
                    @isset($user)
                        @if(in_array($role_id,$user->roles->pluck('id')->toArray()))
                            selected
                        @endif
                    @endisset
                    value="{{ $role_id }}"> {{ ucwords($role_title)  }} </option>
            @empty
            @endforelse
        </select>

        <?= errorName('role_id') ?>

    </div>

    @include("admin.includes.form-active-field",["active"=> isset($user) ? $user->is_active : 0])

</div>


@include("admin.includes.form-submit-cancel",["button"=>$button, "cancelRoute" => isset($cancelRoute) ? $cancelRoute : null])
