<?php
$currencies = [
    ['id' => 'USD', 'full_name' => 'United States Dollar', 'country' => 'America'],
    ['id' => 'KHR', 'full_name' => 'Khmer Riels', 'country' => 'Cambodia'],
];
?>

<div x-data="{ open: false,
    isValid: { name: true, location: true, currency: true, no_of_tables: true, no_of_available_tables: true },
    inputValues: { name: '', location: '', currency: '', no_of_tables: '', no_of_available_tables: '' },
    submit() {
      this.validateName();
      this.validateLocation();
      this.validateCurrency();
      this.validateNoOfTables();
      this.validateNoOfAvailableTables();

      console.log(this.inputValues);

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
    validateLocation() {
      this.isValid.location = this.inputValues.location.trim() !== '';
    },
    validateCurrency() {
      this.isValid.currency = this.inputValues.currency.trim() !== '';
    },
    validateNoOfTables() {
      this.isValid.no_of_tables = this.inputValues.no_of_tables !== '';
    },
    validateNoOfAvailableTables() {
      this.isValid.no_of_available_tables = this.inputValues.no_of_available_tables.trim() !== '';
    }
 }"
  @create-restaurant-form-open.window="open = $event.detail.createRestaurantFormOpen">

  <div x-show="createRestaurantFormOpen" class=" fixed inset-0 items-center justify-center mt-24 max-w-2xl mx-auto overflow-x-hidden overflow-y-auto z-50">
      <div class="relative w-auto max-w-2xl mx-auto">
        <div class="bg-white w-full p-6 text-wrap break-words flex flex-col" style="max-height: 80vh; overflow-y: auto">
          <h2 class="text-2xl font-bold mb-4 text-center">Add Restaurant</h2>
          <form @submit.prevent="submit" action="/restaurants" method="POST" x-data="{  }">
                @csrf
            <div class="flex flex-col mb-4">
              <x-form.input-label for="name">
                  Restaurant's Name:
              </x-form.input-label>
                <x-form.text-input name="name" x-model="inputValues.name" @blur="validateName" placeholder="Wonderful Restaurant"/>
              <p x-show="!isValid.name" class="text-red-600 text-sm mt-1" id="name-required" x-cloak>This field is required.</p>
            </div>
            <div class="flex flex-col mb-4">
                <x-form.input-label for="location">
                    Google Map Location:
                </x-form.input-label>
                <x-form.text-input name="location" x-model="inputValues.location" @blur="validateLocation" placeholder="https://goo.gl/maps/..."/>
              <div x-show="!isValid.location" class="text-red-600 text-sm mt-1" id="location-required" x-cloak>This field is required.</div>
            </div>
            <div class="flex flex-col mb-4">
                <x-form.input-label for="currency">
                    Currency:
                </x-form.input-label>
              <!-- select tag with default value Phnom Penh -->

              <select @blur="validateCurrency" class="border border-gray-300 rounded-md px-3 py-2" name="currency" x-model="inputValues.currency" >
              @foreach ($currencies as $currency)
                <option value="{{ $currency['id'] }}">{{ $currency['full_name'] }} ({{ $currency['id'] }})</option>
              @endforeach
              </select>
              <p x-show="!isValid.currency" class="text-red-600 text-sm mt-1" id="currency-required" x-cloak>This field is required.</p>
            </div>
            <div class="flex flex-col mb-4">
                <x-form.input-label for="no_of_tables">
                    Number of Table:
                </x-form.input-label>
                <x-form.text-input min="1" max="10" type="number" name="no_of_tables" x-model="inputValues.no_of_tables" @blur="validateNoOfTables" placeholder="6"/>
              <div x-show="!isValid.no_of_tables" class="text-red-600 text-sm mt-1" id="no-of-tables-required" x-cloak>This field is required.</div>
            </div>
            <div class="flex flex-col mb-4">
                <x-form.input-label for="no_of_available_tables">
                    Number of Available Table:
                </x-form.input-label>
                <x-form.text-input min="1" max="10" type="number" name="no_of_available_tables" x-model="inputValues.no_of_available_tables" @blur="validateNoOfAvailableTables" placeholder="5"/>
              <div x-show="!isValid.no_of_available_tables" class="text-red-600 text-sm mt-1" id="no-of-available-tables-required" x-cloak>This field is required.</div>
            </div>
            <div class="flex justify-center space-x-4">
              <button type="button" class="inline-flex items-center px-6 py-2 bg-red-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150" @click="createRestaurantFormOpen = false">
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
