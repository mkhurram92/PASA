<section x-data="{step:@entangle('step')}" class="mx-auto xl:max-w-5xl">
    <div class="mb-3 w-full text-center ">
        <div class="pl-4 pr-6 py-1 text-3xl font-bold mx-auto shadow-md rounded-t-lg bg-white text-[#da251c]">
            M1 Member
        </div>
        <div class="pl-4 pr-6 py-1 text-lg md:text-xl lg:text-2xl shadow-md rounded-b-md text-[#002e59] ">
            This application form will allow an applicant who has at least one pioneer ancestor to apply for membership.
        </div>
    </div>
    <div class="my-3 flex overflow-hidden items-center relative bg-white px-5 min-w-[300px] shadow-md rounded-md">
        <x-step active="{{ ($step == 1) ? 'active' : '' }}">Account</x-step>
        <x-step active="{{ ($step == 2) ? 'active' : '' }}">Personal</x-step>
        <x-step active="{{ ($step == 3) ? 'active' : '' }}">Ancestor</x-step>
        <x-step active="{{ ($step == 4) ? 'active' : '' }}">Pedigree</x-step>
        <x-step active="{{ ($step == 5) ? 'active' : '' }}">Payment</x-step>
    </div>
    <div x-show="step == 1">
        @include('livewire.account')
    </div>
    <div x-show="step == 2">
        @include('livewire.personal')
    </div>
    <div x-show="step == 3">
        @include('livewire.ancestor')
    </div>
    <div x-show="step == 4">
        @include('livewire.pedigree')
    </div>
    <div x-show="step == 5">
        @include('livewire.payment')
    </div>


    <div class="mt-2 text-[#002e59] text-sm font-bold">
        <span class="text-[#da251c]">*</span> Mandatory fields
    </div>
    <div class="mt-4 flex gap-x-2">
        @if ($step > 1 )
            <button wire:click='gotoPrevious()'
                class='inline-flex items-center px-4 py-2 bg-[#da251c] border border-transparent rounded-md font-semibold text-xs text-white  uppercase tracking-widest hover:bg-[#f3352b]  focus:bg-[#f3352b]  active:bg-[#7d150f] focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2  transition ease-in-out duration-150 shadow-md'>
                {{ $previous }}
            </button>
        @endif
        <button wire:click='gotoNext()'
            class='inline-flex items-center px-4 py-2 bg-[#da251c] border border-transparent rounded-md font-semibold text-xs text-white  uppercase tracking-widest hover:bg-[#f3352b]  focus:bg-[#f3352b]  active:bg-[#7d150f] focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2  transition ease-in-out duration-150 shadow-md'>
            {{ $next }}
        </button>
    </div>
</section>