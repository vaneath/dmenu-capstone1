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

  <div x-show="createRestaurantFormOpen" class="fixed inset-0 items-center justify-center mt-24 max-w-2xl mx-auto overflow-x-hidden overflow-y-auto z-50">
      <div class="relative w-auto max-w-2xl mx-auto">
        <div class="bg-white w-full p-6 text-wrap break-words flex flex-col" style="max-height: 80vh; overflow-y: auto">
          <h2 class="text-2xl font-bold mb-4 text-center">Add Restaurant</h2>
          <form @submit.prevent="submit" action="/restaurant" method="POST" x-data="{  }">
                @csrf
            <div class="flex flex-col mb-4">
              <label class="text-gray-700 mb-2">Restaurant's Name:</label>
              <input @blur="validateName" class="border border-gray-300 rounded-md px-3 py-2" type="text" placeholder="Wonderful Restaurant" name="name" x-model="inputValues.name" />
              <p x-show="!isValid.name" class="text-red-600 text-sm mt-1" id="name-required" x-cloak>This field is required.</p>
            </div>
            <div class="flex flex-col mb-4">
              <label class="text-gray-700 mb-2">Google Map Location:</label>
              <input @blur="validateLocation" class="border border-gray-300 rounded-md px-3 py-2" type="text" placeholder="https://goo.gl/maps/..." name="location" x-model="inputValues.location" />
              <div x-show="!isValid.location" class="text-red-600 text-sm mt-1" id="location-required" x-cloak>This field is required.</div>
            </div>
            <div class="flex flex-col mb-4">
              <label class="text-gray-700 mb-2">Currency:</label>
              <!-- select tag with default value Phnom Penh --> 

              <select @blur="validateCurrency" class="border border-gray-300 rounded-md px-3 py-2" name="currency" x-model="inputValues.currency" >
                <option value="USD">USD</option>
                <option value="EUR">EUR</option>
                <option value="GBP">GBP</option>
                <option value="JPY">JPY</option>
                <option value="CHF">CHF</option>
                <option value="CAD">CAD</option>
                <option value="AUD">AUD</option>
                <option value="NZD">NZD</option>
                <option value="CNY">CNY</option>
                <option value="SEK">SEK</option>
                <option value="RUB">RUB</option>
                <option value="HKD">HKD</option>
                <option value="SGD">SGD</option>
                <option value="TRY">TRY</option>
                <option value="INR">INR</option>
                <option value="BRL">BRL</option>
                <option value="ZAR">ZAR</option>
                <option value="NOK">NOK</option>
                <option value="MXN">MXN</option>
                <option value="IDR">IDR</option>
                <option value="MYR">MYR</option>
                <option value="PHP">PHP</option>
                <option value="THB">THB</option>
                <option value="CZK">CZK</option>
                <option value="PLN">PLN</option>
                <option value="BGN">BGN</option>
                <option value="DZD">DZD</option>
                <option value="EGP">EGP</option>
                <option value="KRW">KRW</option>
                <option value="VND">VND</option>
                <option value="CLP">CLP</option>
                <option value="ILS">ILS</option>
                <option value="ARS">ARS</option>
                <option value="HUF">HUF</option>
                <option value="SAR">SAR</option>
              </select>
              <div x-show="!isValid.currency" class="text-red-600 text-sm mt-1" id="currency-required" x-cloak>This field is required.</div>
            </div>
            <div class="flex flex-col mb-4">
              <label class="text-gray-700 mb-2">Number of Table:</label>
              <input @blur="validateNoOfTables" class="border border-gray-300 rounded-md px-3 py-2" type="number" placeholder="6" name="no_of_tables" x-model="inputValues.no_of_tables"/>
              <div x-show="!isValid.no_of_tables" class="text-red-600 text-sm mt-1" id="no-of-tables-required" x-cloak>This field is required.</div>
            </div>
            <div class="flex flex-col mb-4">
              <label class="text-gray-700 mb-2">Number of Available Table:</label>
              <input @blur="validateNoOfAvailableTables" class="border border-gray-300 rounded-md px-3 py-2" type="number" placeholder="5" name="no_of_available_tables" x-model="inputValues.no_of_available_tables" />
              <div x-show="!isValid.no_of_available_tables" class="text-red-600 text-sm mt-1" id="no-of-available-tables-required" x-cloak>This field is required.</div>
            </div>
            <div class="flex justify-center space-x-4">
              <button type="button" class="bg-red-500 text-white rounded-lg px-6 py-2" @click="createRestaurantFormOpen = false">
                Close
              </button>
              <button type="submit" class="bg-green-500 text-white rounded-lg px-6 py-2" >
                Create
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div x-show="createRestaurantFormOpen" class="absolute z-40 inset-0 bg-black bg-opacity-50"></div>
  
</div>
