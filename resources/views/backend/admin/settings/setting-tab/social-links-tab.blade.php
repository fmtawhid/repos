<div class="card">
    <form action="{{ route('admin.settings.store') }}"
          method="POST"
          class="social-links-tab settingsForm"
          enctype="multipart/form-data"
          id="social-links-form">
        <div class="card-header">
            <h5 class="mb-0">{{ localize('Invoice Settings') }}</h5>
        </div>
        <div class="card-body">
            <div class="tab-content">

                @csrf
                <div class="row g-3">
                    <div class="col-md-12">
                        <x-form.label for="order_code_prefix" label="{{ localize('Facebook Link') }}" isRequired=true />
                        <x-form.input name="settings[facebook_link]"
                                      id="facebook_link"
                                      type="text"
                                      placeholder="https://facebook.com/YourLink"
                                      value="{{ getSetting('facebook_link') }}"
                                      showDiv=false
                        />
                    </div>

                    <div class="col-md-12">
                        <x-form.label for="order_code_start" label="{{ localize('Twitter Link') }}" isRequired=true />
                        <x-form.input name="settings[twitter_link]"
                                      id="twitter_link"
                                      type="text"
                                      placeholder="https://twitter.com/YourLink"
                                      value="{{ getSetting('twitter_link') }}"
                                      showDiv=false
                        />
                    </div>

                    <div class="col-md-12">
                        <x-form.label for="order_code_prefix" label="{{ localize('Instagram Link') }}" isRequired=true />
                        <x-form.input name="settings[instagram_link]"
                                      id="instagram_link"
                                      type="text"
                                      placeholder="https://facebook.com/YourLink"
                                      value="{{ getSetting('instagram_link') }}"
                                      showDiv=false
                        />
                    </div>

                    <div class="col-md-12">
                        <x-form.label for="order_code_start" label="{{ localize('Linked-IN') }}" isRequired=true />
                        <x-form.input name="settings[linkedin_link]"
                                      id="linkedin_link"
                                      type="text"
                                      placeholder="https://linkedin.com/YourLink"
                                      value="{{ getSetting('linkedin_link') }}"
                                      showDiv=false
                        />
                    </div>

                </div>

            </div>
        </div>
        <div class="card-footer bg-transparent mt-3">
            <x-form.button type="submit" class="settingsSubmitButton btn-sm"><i data-feather="save"></i>{{ localize('Save Configuration') }}</x-form.button>
        </div>
    </form>
</div>
