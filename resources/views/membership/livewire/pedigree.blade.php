<!-- Pedigree Chart Info Card -->
<div
    class="mt-6 flex flex-col overflow-hidden hover:shadow-blue-300 items-center relative bg-white shadow-md rounded-md p-4 min-w-[300px]">
    <div
        class="absolute pl-4 pr-6 py-1 left-0 top-0 text-lg md:text-xl lg:text-2xl  shadow-md rounded-br-full bg-[#002e59] text-white">
        Pedigree Chart</div>
    @for ($i = 1; $i < 5; $i++) <div class="mt-8 grid md:grid-cols-4 gap-x-2 gap-y-6 w-full">
        <!-- pedigree -->
        <div>
            <x-input-label for="application_pedigree_{{ $i }}">
                Applicant's
            </x-input-label>
            <x-select id="application_pedigree_{{ $i }}" wire:model="application_pedigree_{{ $i }}" class="block mt-1 w-full">
                <option value="">Select Pedigree</option>
                <option value="Father">Father</option>
                <option value="Mother">Mother</option>
                <option value="PaternalGrandfather">Paternal Grandfather</option>
                <option value="PaternalGrandmother">Paternal Grandmother</option>
                <option value="MaternalGrandfather">Maternal Grandfather</option>
                <option value="MaternalGrandmother">Maternal Grandmother</option>
                <option value="other">other</option>
            </x-select>
            <x-input-error :messages="$errors->get('application_pedigree_'.$i)" class="mt-2" />
        </div>
        <!-- Full Name -->
        <div>
            <x-input-label for="pedigreefullName_{{ $i }}">
                Full Name<span class="text-[#da251c]">*</span>
            </x-input-label>
            <x-text-input type="text" id="pedigreefullName_{{ $i }}" class="block mt-1 w-full" wire:model="pedigreefullName_{{ $i }}"
                :value="old('pedigreefullName_'.$i)" required />
            <x-input-error :messages="$errors->get('pedigreefullName_'.$i)" class="mt-2" />
        </div>
        <!-- Membership ID -->
        <div>
            <x-input-label for="pedigreeMemeberShipId_{{ $i }}">
                Membership ID
            </x-input-label>
            <x-text-input type="text" id="pedigreeMemeberShipId_{{ $i }}" class="block mt-1 w-full"
                wire:model="pedigreeMemeberShipId_{{ $i }}" :value="old('pedigreeMemeberShipId_'.$i)" />
            <x-input-error :messages="$errors->get('pedigreeMemeberShipId_'.$i)" class="mt-2" />
        </div>
        <div>
            <x-input-label for="pedigreeBirthPlace_{{ $i }}">
                Birth place
            </x-input-label>
            <x-text-input type="text" id="pedigreeBirthPlace_{{ $i }}" class="block mt-1 w-full"
                wire:model="pedigreeBirthPlace_{{ $i }}" :value="old('pedigreeBirthPlace_'.$i)" />
            <x-input-error :messages="$errors->get('pedigreeBirthPlace_'.$i)" class="mt-2" />
        </div>
</div>
@endfor
</div>