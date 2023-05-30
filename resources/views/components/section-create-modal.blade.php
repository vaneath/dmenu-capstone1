@props(['restaurant'])

<style>
    input:checked ~ .dot {
    transform: translateX(100%);
    background-color: #48bb78;
    }
</style>

<div x-data="{ open: false,
    isValid: { name: true },
    inputValues: { name: '' },
    submit() {
      this.validateName();

      if (Object.values(this.isValid).every(Boolean)) {
        event.target.submit();
        this.createSectionFormOpen = false;
      }
    },
    validateName() {
      this.isValid.name = this.inputValues.name.trim() !== '';
    },
 }"
  @create-restaurant-form-open.window="open = $event.detail.createSectionFormOpen"
>

    <div x-show="createSectionFormOpen" class="fixed top-0 w-full h-full z-40 bg-black bg-opacity-80">
        <div class="fixed inset-0 items-center justify-center mt-24 max-w-2xl mx-auto overflow-x-hidden overflow-y-auto z-50">
            <div class="relative w-auto max-w-2xl mx-auto">
                <div class="bg-white w-full p-6 text-wrap break-words flex flex-col" style="max-height: 80vh; overflow-y: auto">
                    <h2 class="text-2xl font-bold mb-4 text-center">Add Section</h2>
                    <form @submit.prevent="submit" action="/sections" method="POST" x-data="{  }">
                        


                        @csrf
                        <div class="flex flex-col mb-4">
                            <x-form.input-label for="name">Section Name:</x-form.input-label>
                            <x-form.text-input @blur="validateName" placeholder="Wonderful Section" name="name" x-model="inputValues.name" />
                            <p x-show="!isValid.name" class="text-red-600 text-sm mt-1" id="name-required" x-cloak>This field is required.</p>
                        </div>
                        <div class="flex items-center w-full mb-12 ml-5">
                            <label 
                              for="toogleA"
                              class="flex items-center cursor-pointer"
                            >
                              <div class="relative">
                                <input id="toogleA" name="is_visible" type="checkbox" class="sr-only" />
                                <div class="w-10 h-4 bg-gray-400 rounded-full shadow-inner"></div>
                                <div class="dot absolute w-6 h-6 bg-white rounded-full shadow shadow-gray-500 -left-1 -top-1 transition"></div>
                              </div>
                              <div class="ml-3 text-gray-700 font-medium">
                                Is Section Visible?
                              </div>
                            </label>
                          </div>
                        <input type="hidden" name="restaurant_id" value="{{ $restaurant->id }}">
                        <div class="flex justify-center space-x-4">
                            <button type="button" class="bg-red-500 text-white rounded-lg px-6 py-2" @click="createSectionFormOpen = false">
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
    <!-- <div x-show="createSectionFormOpen" class="absolute z-40 inset-0 bg-black bg-opacity-50"></div> -->

</div>
