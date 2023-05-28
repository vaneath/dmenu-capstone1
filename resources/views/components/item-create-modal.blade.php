@props(['category', 'restaurant'])
<div x-data="{ open: false,
    isValid: { name: true, description: true, img_url: true, price: true, discount_price: false, weight: true },
    inputValues: { name: '', description: '', img_url: '', price: '', discount_price: '', weight: '', is_available: false },
    submit() {
      // this.validateName();
      {{-- console.log(event.target.name.value);
      console.log(this.inputValues.name);
      if (Object.values(this.isValid).every(Boolean)) { --}}
        event.target.submit();
        this.createItemFormOpen = false;
        // fetch post to /restaurants/{{ $restaurant->id }}/menu/{{ $category->id }}/items
      {{-- } --}}
    },
    validateName() {
      this.isValid.name = this.inputValues.name.trim() !== '';
    },
    validateDescription() {
      this.isValid.description = this.inputValues.description.trim() !== '';
    },
    validateImgUrl() {
      this.isValid.img_url = this.inputValues.img_url.trim() !== '';
    },
    validatePrice() {
      this.isValid.price = this.inputValues.price.trim() !== '';
    },
    validateDiscountPrice() {
      {{-- this.isValid.discount_price = this.inputValues.old_price.trim() !== ''; --}}
      this.isValid.discount_price = false;
    },
    validateWeight() {
      this.isValid.weight = this.inputValues.weight.trim() !== '';
    },
 }"
  @create-restaurant-form-open.window="open = $event.detail.createItemFormOpen"
>

    <div x-show="createItemFormOpen" class="fixed top-0 left-0 w-full h-full z-40 bg-black bg-opacity-80">
        <div class="fixed inset-0 items-center justify-center mt-24 max-w-2xl mx-auto overflow-x-hidden overflow-y-auto z-50">
            <div class="relative max-w-2xl mx-auto">
                <div class="bg-white w-full p-6 text-wrap break-words flex flex-col" style="max-height: 80vh; overflow-y: auto">
                    <h2 class="text-2xl font-bold mb-4 text-center">Add Item</h2>
                    <form @submit.prevent="submit" action="/items" method="POST">
                        @csrf
                        <input type="hidden" name="category_id" value="{{ $category->id }}">
                        <div class="flex flex-col mb-4">
                            <x-form.input-label for="name">Item Name:</x-form.input-label>
                            <x-form.text-input @blur="validateName" placeholder="Item's Name" name="name" x-model="inputValues.name" />
                            <p x-show="!isValid.name" class="text-red-600 text-sm mt-1" id="name-required" x-cloak>Item's name required.</p>
                        </div>
                        <div class="flex flex-col mb-4">
                            <x-form.input-label for="description">Item Description:</x-form.input-label>
                            <x-form.text-input @blur="validateDescription" placeholder="Item's Description" name="description" x-model="inputValues.description" />
                            <p x-show="!isValid.description" class="text-red-600 text-sm mt-1" id="name-required" x-cloak>Item's description required.</p>
                        </div>
                        <div class="flex flex-col mb-4">
                            <x-form.input-label for="img_url">Item Image URL:</x-form.input-label>
                            <x-form.text-input @blur="validateImgUrl" placeholder="Item's Image URL" name="img_url" x-model="inputValues.img_url" />
                            <p x-show="!isValid.img_url" class="text-red-600 text-sm mt-1" id="name-required" x-cloak>Item's image URL required.</p>
                        </div>
                        <div class="flex flex-col mb-4">
                            <x-form.input-label for="price">Item Price:</x-form.input-label>
                            <x-form.text-input @blur="validatePrice" placeholder="Item's Price" name="price" x-model="inputValues.price" />
                            <p x-show="!isValid.price" class="text-red-600 text-sm mt-1" id="name-required" x-cloak>Item's price required.</p>
                        </div>
                        <div class="flex flex-col mb-4">
                            <x-form.input-label for="weight">Item Weight:</x-form.input-label>
                            <x-form.text-input @blur="validateWeight" placeholder="Item's Weight" name="weight" x-model="inputValues.weight" />
                            <p x-show="!isValid.weight" class="text-red-600 text-sm mt-1" id="name-required" x-cloak>Item's weight required.</p>
                        </div>
                        <div class="flex flex-col mb-4">
                            <x-form.input-label for="discount_price">Discounted Price:</x-form.input-label>
                            <x-form.text-input @blur="validateDiscountPrice" placeholder="Item's Discounted Price" name="discount_price" x-model="inputValues.discount_price" />
                            <p x-show="!isValid.discount_price" class="text-red-600 text-sm mt-1" id="name-required" x-cloak>Item's discounted price required.</p>
                        </div>
                        <div class="inline-flex items-center">
                            <label
                                class="relative flex cursor-pointer items-center rounded-full p-3"
                                for="is_available"
                                data-ripple-dark="true"
                            >
                                <input
                                    id="is_available"
                                    name="is_available"
                                    type="checkbox"
                                    class="before:content[''] peer relative h-5 w-5 cursor-pointer appearance-none rounded-md border border-gray-300 transition-all before:absolute before:top-2/4 before:left-2/4 before:block before:h-12 before:w-12 before:-translate-y-2/4 before:-translate-x-2/4 before:rounded-full before:bg-gray-300 before:opacity-0 before:transition-opacity checked:border-gray-300 checked:bg-gray-300 checked:before:bg-gray-300 hover:before:opacity-100"
                                />
                                <div class="pointer-events-none absolute top-2/4 left-2/4 -translate-y-2/4 -translate-x-2/4 text-gray-700 opacity-0 transition-opacity peer-checked:opacity-100">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-3.5 w-3.5"
                                        viewBox="0 0 20 20"
                                        fill="currentColor"
                                        stroke="currentColor"
                                        stroke-width="1"
                                    >
                                        <path
                                            fill-rule="evenodd"
                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                            clip-rule="evenodd"
                                        ></path>
                                    </svg>
                                </div>
                            </label>
                            <label
                                class="mt-px cursor-pointer select-none text-gray-700"
                                for="is_available"
                            >
                                Is Item Available?
                            </label>
                        </div>
                        <div class="flex justify-center space-x-4">
                            <button type="button" class="bg-red-500 text-white rounded-lg px-6 py-2" @click="createItemFormOpen = false">
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
    </div>
</div>
