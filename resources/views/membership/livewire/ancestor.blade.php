<!-- Ancestor Info Card -->
<div
    class="mt-6 flex flex-col overflow-hidden hover:shadow-blue-300 items-center relative bg-white shadow-md rounded-md p-4 min-w-[300px]">
    <div
        class="absolute pl-4 pr-6 py-1 left-0 top-0 text-lg md:text-xl lg:text-2xl  shadow-md rounded-br-full bg-[#002e59] text-white">
        Primary Ancestor</div>
    <div class="mt-8 grid md:grid-cols-2 gap-x-2 gap-y-6 w-full">
        <!-- Gender -->
        <div>
            <x-input-label for="gender">
                Gender
            </x-input-label>
            <x-select id="gender" wire:model="gender" class="block mt-1 w-full">
                <option value="male">Male</option>
                <option value="female">Female</option>
            </x-select>
            <x-input-error :messages="$errors->get('gender')" class="mt-2" />
        </div>
        <!-- Full Name -->
        <div>
            <x-input-label for="full_name">
                Full Name<span class="text-[#da251c]">*</span>
            </x-input-label>
            <x-text-input type="text" id="full_name" class="block mt-1 w-full" wire:model="full_name"
                :value="old('full_name')" required />
            <x-input-error :messages="$errors->get('full_name')" class="mt-2" />
        </div>
        <!-- Maiden Name -->
        <div>
            <x-input-label for="maiden_name">
                Maiden Name<span class="text-[#da251c]">*</span>
            </x-input-label>
            <x-text-input type="text" id="maiden_name" class="block mt-1 w-full" wire:model="maiden_name"
                :value="old('maiden_name')" required />
            <x-input-error :messages="$errors->get('maiden_name')" class="mt-2" />
        </div>
        <!-- Place Of Origin (Town/City/State/Country) -->
        <div>
            <x-input-label for="place_of_origin">
                Place Of Origin
            </x-input-label>
            <x-text-input type="text" id="place_of_origin" class="block mt-1 w-full" wire:model="place_of_origin"
                :value="old('place_of_origin')" />
            <x-input-error :messages="$errors->get('place_of_origin')" class="mt-2" />
        </div>
        <!-- Place of Arrival in South Australia (Town/City, Sate, Country) -->
        <div>
            <x-input-label for="place_of_arrival">
                Place of Arrival in SA<span class="text-[#da251c]">*</span>
            </x-input-label>
            <x-select id="place_of_arrival" wire:model="place_of_arrival" class="block mt-1 w-full" required>
                <option value="">Select</option>
                <option value="PORT ADELAIDE">PORT ADELAIDE</option>
                <option value="NEPEAN BAY">NEPEAN BAY</option>
                <option value="HOLDFAST BAY">HOLDFAST BAY</option>
                <option value="KINGSCOTE">KINGSCOTE</option>
                <option value="COORONG">COORONG</option>
                <option value="KANGAROO ISLAND">KANGAROO ISLAND</option>
            </x-select>
            <x-input-error :messages="$errors->get('place_of_arrival')" class="mt-2" />
        </div>
        <!-- Name of the Ship -->
        <div>
            <x-input-label for="name_of_the_ship">
                Name of the Ship<span class="text-[#da251c]">*</span>
            </x-input-label>
            <x-select id="name_of_the_ship" wire:model="name_of_the_ship" class="block mt-1 w-full" required>
                <option value="">Select</option>
                @foreach (App\Models\Ship::all() as $ship)
                    <option value="{{ $ship->id }}">{{ $ship->name_of_ship }}</option>
                @endforeach
            </x-select>
            <x-input-error :messages="$errors->get('name_of_the_ship')" class="mt-2" />
        </div>
    </div>
    <!-- 2 Column Grid -->
</div>
