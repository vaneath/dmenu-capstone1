<div x-data="{
    open: false,
    isValid: { name: true, no_of_tables: true, village: true, commune: true, district: true, province: true, logo_url: true },
    inputValues: { name: '', no_of_tables: '', village: '', commune: '', district: '', province: '', logo_url: '' },
    submit() {

        if (Object.values(this.isValid).every(Boolean)) {
            event.target.submit();
            this.createRestaurantFormOpen = false;
        }
    },
    validateName() {
        this.isValid.name = this.inputValues.name.trim() !== '';
        // if(!this.isValid.name){
        //  document.getElementById('name-required').textContent = 'Restaurant's Name is required';
        // }
    },
    validateNoOfTables() {
        this.isValid.no_of_tables = this.inputValues.no_of_tables.trim() !== '';
    },
    validateVillage() {
        this.isValid.village = this.inputValues.village.trim() !== '';
    },
    validateCommune() {
        this.isValid.commune = this.inputValues.commune.trim() !== '';
    },
    validateDistrict() {
        this.isValid.district = this.inputValues.district.trim() !== '';
    },
    validateProvince() {
        this.isValid.province = this.inputValues.province.trim() !== '';
    },
    validateLogo() {
        console.log(typeof this.inputValues.logo_url);
        console.log(this.inputValues.logo_url);
        // check extention of this.inputValues.logo_url if it's jpg, jpeg, png, gif
        if (this.inputValues.logo_url.trim() == '') {
             this.isValid.logo_url = true;
        } else{
            let ext = this.inputValues.logo_url.split('.').pop().toLowerCase();
            if (['jpg', 'jpeg', 'png', 'gif'].includes(ext)) {
                this.isValid.logo_url = true;
            } else {
                this.isValid.logo_url = false;
            }
        }
    }
}" @create-restaurant-form-open.window="open = $event.detail.createRestaurantFormOpen">

    <div x-show="createRestaurantFormOpen"
        class=" fixed inset-0 items-center justify-center mt-24 max-w-2xl mx-auto overflow-x-hidden overflow-y-auto z-50">
        <div class="relative w-auto max-w-2xl mx-auto">
            <div class="bg-white w-full p-6 text-wrap break-words flex flex-col"
                style="max-height: 80vh; overflow-y: auto">
                <h2 class="text-2xl font-bold mb-4 text-center">Add Restaurant</h2>
                <form @submit.prevent="submit" action="/restaurants" method="POST" x-data="{}" enctype="multipart/form-data">
                    @csrf
                    <div class="flex flex-col mb-4">
                        <x-form.input-label for="name">
                            Restaurant's Name:
                        </x-form.input-label>
                        <x-form.text-input name="name" x-model="inputValues.name" @blur="validateName"
                            placeholder="Wonderful Restaurant" />
                        <p x-show="!isValid.name" class="text-red-600 text-sm mt-1" id="name-required" x-cloak>This
                            field is required.</p>
                    </div>
                    <div class="flex flex-col mb-4">
                        <x-form.input-label for="logo_url">
                            Logo:
                        </x-form.input-label>
                        <input type="file" name="logo_url" placeholder="Choose an image." id="logo_url" x-model="inputValues.logo_url" @blur="validateLogo">
                        <p x-show="!isValid.logo_url" class="text-red-600 text-sm mt-1" id="logo-required" x-cloak>Invalid type. Supported types: jpeg, jpg, png, gif.</p>
                    </div>
                    <div class="preview mb-3">
                        <img id="preview-image">
                      </div>
                    <div class="flex flex-col mb-4">
                        <x-form.input-label for="no_of_tables">
                            Number of Table:
                        </x-form.input-label>
                        <x-form.text-input min="1" max="10" type="number" name="no_of_tables"
                            x-model="inputValues.no_of_tables" @blur="validateNoOfTables" placeholder="6" />
                        <div x-show="!isValid.no_of_tables" class="text-red-600 text-sm mt-1" id="no-of-tables-required"
                            x-cloak>This field is required.</div>
                    </div>
                    <div class="flex flex-col mb-4">
                        <x-form.input-label for="province">
                            Province/Khan:
                        </x-form.input-label>
                        <x-form.text-input name="province" x-model="inputValues.province" @blur="validateLocation"
                            placeholder="Province" />
                        <div x-show="!isValid.province" class="text-red-600 text-sm mt-1" id="province-required"
                            x-cloak>This field is required.</div>
                    </div>
                    <div class="flex flex-col mb-4">
                        <x-form.input-label for="district">
                            District/Sangkat:
                        </x-form.input-label>
                        <x-form.text-input name="district" x-model="inputValues.district" @blur="validateLocation"
                            placeholder="District" />
                        <div x-show="!isValid.district" class="text-red-600 text-sm mt-1" id="district-required"
                            x-cloak>This field is required.</div>
                    </div>
                    <div class="flex flex-col mb-4">
                        <x-form.input-label for="commune">
                            Commune:
                        </x-form.input-label>
                        <x-form.text-input name="commune" x-model="inputValues.commune" @blur="validateLocation"
                            placeholder="Commune" />
                        <div x-show="!isValid.commune" class="text-red-600 text-sm mt-1" id="commune-required" x-cloak>
                            This field is required.</div>
                    </div>
                    <div class="flex flex-col mb-4">
                        <x-form.input-label for="village">
                            Village:
                        </x-form.input-label>
                        <x-form.text-input name="village" x-model="inputValues.village" @blur="validateLocation"
                            placeholder="Village" />
                        <div x-show="!isValid.village" class="text-red-600 text-sm mt-1" id="village-required" x-cloak>
                            This field is required.</div>
                    </div>
                    <div class="flex justify-center space-x-4">
                        <button type="button"
                            class="inline-flex items-center px-6 py-2 bg-red-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                            @click="createRestaurantFormOpen = false">
                            Close
                        </button>
                        <x-primary-button type="submit">
                            Create
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div x-show="createRestaurantFormOpen" class="absolute z-40 inset-0 bg-black bg-opacity-80"></div>

</div>

<script>
    const input = document.getElementById('logo_url');
    const previewImage = document.getElementById('preview-image');

    input.addEventListener('change', function() {
      const file = input.files[0];
      const objectURL = URL.createObjectURL(file);
      previewImage.style.width = '200px';
      previewImage.style.height = '200px';
      previewImage.src = objectURL;
    });
  </script>
