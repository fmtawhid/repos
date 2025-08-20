<div class="card">
    <form action="{{ route('admin.settings.store') }}" class="stable-diffusion-form settingsForm"
    enctype="multipart/form-data" id="stable-diffusion-form">
    <div class="card-header">
        <h5 class="mb-0">{{ localize('Stable Diffusion Setup') }}</h5>
    </div>
    <div class="card-body">
        <div class="tab-content">
            @csrf
            <div class="row g-3">
                <div class="col-md-12">
                    <x-form.label for="SD_API_KEY"
                        label="{{ localize('Stable Diffusion API KEY') }}"
                        isRequired=true />
                    <x-form.input name="env[SD_API_KEY]" id="SD_API_KEY"
                        type="text" placeholder="************************************"
                        value="{{getSetting('SD_API_KEY')}}" showDiv=false />
                </div>
                <div class="col-md-12">
                    <x-form.label for="sd_api_key_use"
                        label="{{ localize('Stable Diffusion Key Usage Model') }}" />
                    <x-form.select name="settings[sd_api_key_use]" id="sd_api_key_use">
                        <option value="main"
                            {{ getSetting('sd_api_key_use') == 'main' || !getSetting('sd_api_key_use') ? 'selected' : '' }}>
                            {{ localize('Main Api key') }}
                        </option>
                       
                    </x-form.select>
                </div>
                <div class="col-md-12">
                    <x-form.label for="image_upscaler_engine"
                        label="{{ localize('Image Upscaler Engine') }}" />
                    <x-form.select name="settings[image_upscaler_engine]"
                        id="image_upscaler_engine">
                        <option value='esrgan-v1-x2plus'
                            @if (getSetting('image_upscaler_engine') == 'esrgan-v1-x2plus') selected @endif>
                            Real-ESRGAN x2
                        </option>
                        <option value='stable-diffusion-x4-latent-upscaler'
                            @if (getSetting('image_upscaler_engine') == 'stable-diffusion-x4-latent-upscaler') selected @endif>
                            Stable Diffusion x4 Latent Upscaler</option>
                    </x-form.select>
                </div>
                <div class="col-md-12">
                    <x-form.label for="image_stable_diffusion_engine"
                        label="{{ localize('Stable Diffusion Engine ID') }}" />
                    <x-form.select name="settings[image_stable_diffusion_engine]"
                        id="image_stable_diffusion_engine">
                        <option value='stable-diffusion-v1-6'
                            @if (getSetting('image_stable_diffusion_engine') == 'stable-diffusion-v1-6') selected @endif>
                            {{ localize('Stable Diffusion v1.6') }}
                        </option>
                        <option value='stable-diffusion-512-v2-1'
                            @if (getSetting('image_stable_diffusion_engine') == 'stable-diffusion-512-v2-1') selected @endif>
                            {{ localize('Stable Diffusion v2.1') }}
                        </option>
                        <option value='stable-diffusion-768-v2-1'
                            @if (getSetting('image_stable_diffusion_engine') == 'stable-diffusion-768-v2-1') selected @endif>
                            {{ localize('Stable Diffusion v2.1-768') }}
                        </option>
                        <option value='stable-diffusion-xl-beta-v2-2-2'
                            @if (getSetting('image_stable_diffusion_engine') == 'stable-diffusion-xl-beta-v2-2-2') selected @endif>
                            {{ localize('Stable Diffusion v2.2.2-XL Beta') }}
                        </option>
                        <option value='stable-diffusion-xl-1024-v1-0'
                            @if (getSetting('image_stable_diffusion_engine') == 'stable-diffusion-xl-1024-v1-0') selected @endif>
                            {{ localize('SDXL v1.0') }}
                        </option>
                        <option value='stable-diffusion-xl-1024-v0-9'
                            @if (getSetting('image_stable_diffusion_engine') == 'stable-diffusion-xl-1024-v0-9') selected @endif>
                            {{ localize('SDXL v0.9') }}
                        </option>
                    </x-form.select>
                </div>
            </div>

        </div>
    </div>
    <div class="card-footer bg-transparent mt-3">
        <x-form.button type="submit" class="settingsSubmitButton btn-sm"><i data-feather="save"></i>{{ localize('Save Configuration') }}</x-form.button>
    </div>
</form>
</div>