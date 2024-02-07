<!-- Payment Information -->
<div
    class="mt-6 flex flex-col overflow-hidden hover:shadow-blue-300 items-center relative bg-white shadow-md rounded-md p-4 min-w-[300px]">
    <div
        class="absolute pl-4 pr-6 py-1 left-0 top-0 text-lg md:text-xl lg:text-2xl  shadow-md rounded-br-full bg-[#002e59] text-white">
        Payment Information</div>
    <div class="mt-8 grid md:grid-cols-2 gap-x-2 gap-y-6 w-full">
        <!-- Card Number -->
        <div>
            <x-input-label for="card_number" :value="__('Card Number')" />
            <x-text-input type="text" id="card_number" class="block mt-1 w-full" wire:model="card_number"
                :value="old('card_number')" required placeholder="1234 1234 1234 1234" />
            <x-input-error :messages="$errors->get('card_number')" class="mt-2" />
        </div>
        <div></div>
        <!-- Expiration Date -->
        <div>
            <x-input-label for="card_expiry" :value="__('Expiration Date')" />
            <x-text-input type="text" id="card_expiry" class="block mt-1 w-full" wire:model="card_expiry"
                :value="old('card_expiry')" required placeholder="MM / YY" />
            <x-input-error :messages="$errors->get('card_expiry')" class="mt-2" />
        </div>
        <!-- CVC -->
        <div>
            <x-input-label for="card_cvc" :value="__('CVC')" />
            <x-text-input type="text" id="card_cvc" class="block mt-1 w-full" wire:model="card_cvc"
                :value="old('card_cvc')" required placeholder="CVC" />
            <x-input-error :messages="$errors->get('card_cvc')" class="mt-2" />
        </div>
    </div>
    <!-- 2 Column Grid -->
</div>