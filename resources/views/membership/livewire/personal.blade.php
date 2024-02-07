<!-- Personal Info Card -->
<div
    class="mt-6 flex flex-col overflow-hidden hover:shadow-blue-300 items-center relative bg-white shadow-md rounded-md p-4 min-w-[300px]">
    <div
        class="absolute pl-4 pr-6 py-1 left-0 top-0 text-lg md:text-xl lg:text-2xl shadow-md rounded-br-full bg-[#002e59] text-white">
        Application Personal Details</div>
    <div class="mt-8 grid grid-cols-2 gap-x-2 gap-y-6 w-full">
        <div class="flex align-middle gap-x-1">
            <!-- Title -->
            <div>
                <x-input-label for="title">
                    Title<span class="text-[#da251c]">*</span>
                </x-input-label>
                <x-select wire:model="title" class="block mt-1 w-full" required>
                    <option value="Mr." selected>Mr.</option>
                    <option value="Mrs.">Mrs.</option>
                    <option value="Miss.">Miss.</option>
                    <option value="Ms.">Ms.</option>
                    <option value="Dr.">Dr.</option>
                    <option value="Sir.">Sir.</option>
                </x-select>
                <x-input-error :messages="$errors->get('title')" class="mt-2" />
            </div>
            <!-- Given Name -->
            <div class="w-full">
                <x-input-label for="given_name">
                    Given Name<span class="text-[#da251c]">*</span>
                </x-input-label>
                <x-text-input type="text" id="given_name" class="block mt-1 w-full" wire:model="given_name"
                    :value="old('given_name')" required />
                <x-input-error :messages="$errors->get('given_name')" class="mt-2" />
            </div>
        </div>
        <!-- Family Name -->
        <div>
            <x-input-label for="family_name">
                Family Name<span class="text-[#da251c]">*</span>
            </x-input-label>
            <x-text-input type="text" id="family_name" class="block mt-1 w-full" wire:model="family_name"
                :value="old('family_name')" required />
            <x-input-error :messages="$errors->get('family_name')" class="mt-2" />
        </div>
        <!-- Preferred Name -->
        <div>
            <x-input-label for="preferred_name">
                Preferred Name<span class="text-[#da251c]">*</span>
            </x-input-label>
            <x-text-input type="text" id="preferred_name" class="block mt-1 w-full" wire:model="preferred_name"
                :value="old('preferred_name')" required />
            <x-input-error :messages="$errors->get('preferred_name')" class="mt-2" />
        </div>
        <!-- Date of Birth -->
        <div>
            <x-input-label for="date_of_birth">
                Date of Birth
            </x-input-label>
            <x-text-input type="date" id="date_of_birth" class="block mt-1 w-full" wire:model="date_of_birth"
                :value="old('date_of_birth')" />
            <x-input-error :messages="$errors->get('date_of_birth')" class="mt-2" />
        </div>

        <!-- Address Info -->
        <!-- Number & Street -->
        <div>
            <x-input-label for="number_street">
                Number & Street<span class="text-[#da251c]">*</span>
            </x-input-label>
            <x-text-input id="number_street" class="block mt-1 w-full" type="text"
                wire:model="number_street" required />
            <x-input-error :messages="$errors->get('number_street')" class="mt-2" />
        </div>
        <!-- Suburb -->
        <div>
            <x-input-label for="suburb">
                Suburb<span class="text-[#da251c]">*</span>
            </x-input-label>
            <x-text-input id="suburb" class="block mt-1 w-full" type="text" wire:model="suburb"
                required />
            <x-input-error :messages="$errors->get('suburb')" class="mt-2" />
        </div>
        <!-- State -->
        <div>
            <x-input-label for="state">
                State
            </x-input-label>
            <x-select id="state" wire:model="state" class="block mt-1 w-full">
                <option value="">select state</option>
                <option value="South Australia">South Australia</option>
                <option value="New South Wales">New South Wales</option>
                <option value="Victoria">Victoria</option>
                <option value="Western Australia">Western Australia</option>
                <option value="Tasmania">Tasmania</option>
                <option value="Queensland">Queensland</option>
            </x-select>
            <x-input-error :messages="$errors->get('state')" class="mt-2" />
        </div>
        <!-- Country -->
        <div>
            <x-input-label for="country">
                Country
            </x-input-label>
            <x-select id="country" wire:model="country" class="block mt-1 w-full">
                <option value="Australia" selected>Australia</option>
            </x-select>
            <x-input-error :messages="$errors->get('country')" class="mt-2" />
        </div>
        <!-- Post Code -->
        <div>
            <x-input-label for="post_code">
                Post Code/Zip<span class="text-[#da251c]">*</span>
            </x-input-label>
            <x-text-input id="post_code" class="block mt-1 w-full" type="text" wire:model="post_code"
                required />
            <x-input-error :messages="$errors->get('post_code')" class="mt-2" />
        </div>
        <!-- Phone (Home) -->
        <div>
            <x-input-label for="phone">
                Phone (Home)
            </x-input-label>
            <x-text-input id="phone" class="block mt-1 w-full" type="text" wire:model="phone" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>
        <!-- Phone (Mobile) -->
        <div>
            <x-input-label for="mobile">
                Phone (Mobile)
            </x-input-label>
            <x-text-input id="mobile" class="block mt-1 w-full" type="text" wire:model="mobile" />
            <x-input-error :messages="$errors->get('mobile')" class="mt-2" />
        </div>
        <!-- Journal Preferred Delivery -->
        <div>
            <x-input-label for="delivery">
                Journal Preferred Delivery<span class="text-[#da251c]">*</span>
            </x-input-label>
            <div class="flex gap-2 align-middle">
                <label for="delivery1">
                    <x-text-input id="delivery1" type="radio" wire:model="delivery"
                        value="email" required />
                    Email
                </label>
                <label for="delivery2">
                    <x-text-input id="delivery2" type="radio" wire:model="delivery"
                        value="post" />
                    Post
                </label>
            </div>
            <x-input-error :messages="$errors->get('delivery')" class="mt-2" />
        </div>
    </div>
    <!-- 2 Column Grid -->
</div>