<form method="POST" action="{{ route('profile.update.info') }}" enctype="multipart/form-data">
@csrf
    @method('PUT')

    <div class="card pb-2.5">
        <div class="card-header" id="basic_settings">
            <h3 class="card-title">Basic Settings</h3>
        </div>
        <div class="card-body grid gap-5">

            <!-- avatar -->
            <div class="flex items-center flex-wrap gap-2.5">
                <label class="form-label max-w-56">Photo</label>
                <div class="flex items-center justify-between flex-wrap grow gap-2.5">
                    <span class="text-2sm text-gray-700">150x150px JPEG, PNG Image</span>
                    <div class="image-input size-16" data-image-input="true">
                        <input accept=".png, .jpg, .jpeg" name="avatar" type="file" />
                        <input name="avatar_remove" type="hidden" />
                        <div class="btn btn-icon btn-icon-xs btn-light shadow-default absolute z-1 size-5 -top-0.5 -end-0.5 rounded-full"
                             data-image-input-remove="" data-tooltip="#image_input_tooltip" data-tooltip-trigger="hover">
                            <i class="ki-filled ki-cross"></i>
                        </div>
                        <span class="tooltip" id="image_input_tooltip">Click to remove or revert</span>
                        <div class="image-input-placeholder rounded-full border-2 border-success image-input-empty:border-gray-300"
                             style="background-image:url({{ asset('storage/' . (auth()->user()->avatar ?? 'metronic/media/avatars/blank.png')) }})">
                            <div class="image-input-preview rounded-full"
                                 style="background-image:url({{ asset('storage/' . (auth()->user()->avatar ?? 'metronic/media/avatars/300-2.png')) }})"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- last name -->
            <div class="w-full">
                <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                    <label class="form-label flex items-center gap-1 max-w-56">Last name</label>
                    <x-forms.input
                        name="last_name" type="text"
                        :value="old('last_name', auth()->user()->last_name)"
                        required class="w-full"
                        :messages="$errors->get('last_name')" />
                </div>
            </div>

            <!-- first name -->
            <div class="w-full">
                <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                    <label class="form-label flex items-center gap-1 max-w-56">First name</label>
                    <x-forms.input
                        name="first_name" type="text"
                        :value="old('first_name', auth()->user()->first_name)"
                        required class="w-full"
                        :messages="$errors->get('first_name')" />
                </div>
            </div>

            <!-- phone -->
            <div class="w-full">
                <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                    <label class="form-label flex items-center gap-1 max-w-56">Phone number</label>
                    <x-forms.input
                        name="phone" type="text"
                        :value="old('phone', auth()->user()->phone)"
                        class="w-full"
                        :messages="$errors->get('phone')" />
                </div>
            </div>
            <!-- email -->
            <div class="w-full">
                <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                    <label class="form-label max-w-56">
                        Email
                    </label>
                    <div class="flex flex-col tems-start grow gap-7.5 w-full">
                        <x-forms.input
                            name="email" type="text" :value="old('email', auth()->user()->email)"
                            required autofocus class="w-full" :messages="$errors->get('email')" />
                    </div>
                </div>
            </div>

            <!-- submit button -->
            <div class="flex justify-end pt-2.5">
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>

        </div>
    </div>
</form>
