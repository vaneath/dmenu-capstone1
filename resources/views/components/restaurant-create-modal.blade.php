<div x-data="{ open: false }"
  @create-restaurant-form-open.window="open = $event.detail.createRestaurantFormOpen">


  <div x-show="createRestaurantFormOpen" class="fixed inset-0 flex justify-center items-center z-50 w-200 overflow-x-hidden overflow-y-auto">
      <div class="relative w-auto max-w-2xl mx-auto">
        <div class="bg-white w-full p-6 text-wrap break-words flex flex-col" style="max-height: 80vh; overflow-y: auto">
          <h2 class="text-2xl font-bold mb-4 text-center">Add Restaurant</h2>
            <form action="/restaurant" method="POST">
                @csrf
            <div class="flex flex-col mb-4">
              <label class="text-gray-700 mb-2">Restaurant's Name:</label>
              <input class="border border-gray-300 rounded-md px-3 py-2" type="text" placeholder="Wonderful Restaurant" name="name" />
            </div>
            <!-- google map location -->
            <div class="flex flex-col mb-4">
              <label class="text-gray-700 mb-2">Google Map Location:</label>
              <input class="border border-gray-300 rounded-md px-3 py-2" type="text" placeholder="https://goo.gl/maps/..." name="location" />
            </div>
            <div class="flex flex-col mb-4">
              <label class="text-gray-700 mb-2">Currency:</label>
              <select class="border border-gray-300 rounded-md px-3 py-2" name="currency" >
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
            </div>
            <div class="flex flex-col mb-4">
              <label class="text-gray-700 mb-2">Number of Table:</label>
              <input class="border border-gray-300 rounded-md px-3 py-2" type="number" placeholder="6" name="no_of_tables" />
            </div>
            <div class="flex flex-col mb-4">
              <label class="text-gray-700 mb-2">Number of Available Table:</label>
              <input class="border border-gray-300 rounded-md px-3 py-2" type="number" placeholder="5" name="no_of_available_tables" />
            </div>

            <!-- <div class="flex items-center mb-6"> -->
            <!-- <input type="hidden" name="is_visible" value="false">
              <input value="true" type="checkbox" class="form-checkbox h-5 w-5 text-green-500 mr-2" name="is_visible" x-model.lazy="is_visible" />
              <label class="text-gray-700">Is Visible</label> -->
            <!-- </div> -->
            <div class="flex justify-center space-x-4">
              <button type="button" class="bg-red-500 text-white rounded-lg px-6 py-2" @click="createRestaurantFormOpen = false">
                Close
              </button>
              <button type="submit" class="bg-green-500 text-white rounded-lg px-6 py-2" @click="createRestaurantFormOpen = false">
                Create
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div x-show="createRestaurantFormOpen" class="absolute z-40 inset-0 bg-black bg-opacity-50"></div>


  
</div>