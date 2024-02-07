<section x-data="{}">
    @isset($user)
    @include('nav')
    @endisset
        <div class="flex flex-col gap-y-1 mt-2 max-w-5xl mx-auto overflow-hidden hover:shadow-blue-300 items-center relative bg-white shadow-md rounded-md p-4 min-w-[300px]">
            <div
                class="absolute pl-4 pr-6 py-1 left-0 top-0 text-lg md:text-xl lg:text-2xl  shadow-md rounded-br-full bg-[#002e59] text-white">
                Profile</div>
            <div class="mt-8"></div>
            <div class=" mb-2 border-b border-b-slate-400 font-bold w-full text-left">Personal Information</div>
            <div class="grid md:grid-cols-2 gap-x-1 w-full">
                <x-label caption="User ID">{{ $member->username }}</x-label>
                <x-label caption="Email">{{ $member->email }}</x-label>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-x-1 w-full">
                <x-label caption="Title">{{ $member->title }}</x-label>
                <x-label caption="Given Name">{{ $member->given_name }}</x-label>
                <x-label caption="Family Name">{{ $member->family_name }}</x-label>
            </div>
            <div class="grid md:grid-cols-2 gap-x-1 w-full">
                <x-label caption="Date of Birth">{{ $member->date_of_birth }}</x-label>
                <x-label caption="Suburb">{{ $member->suburb }}</x-label>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-x-1 w-full">
                <x-label caption="Number & Street">{{ $member->number_street }}</x-label>
                <x-label caption="State">{{ $member->state }}</x-label>
                <x-label caption="Contry">{{ $member->contry }}</x-label>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-x-1 w-full">
                <x-label caption="Post Code">{{ $member->post_code }}</x-label>
                <x-label caption="Phone">{{ $member->phone }}</x-label>
                <x-label caption="Mobile">{{ $member->mobile }}</x-label>
            </div>
            <div class="mt-8 mb-2 border-b border-b-slate-400 font-bold w-full text-left">Primary Ancestor</div>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-x-1 w-full">
                <x-label caption="Gender">{{ $member->ancestor->gender }}</x-label>
                <x-label caption="Full Name">{{ $member->ancestor->full_name }}</x-label>
                <x-label caption="Maiden Name">{{ $member->ancestor->maiden_name }}</x-label>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-x-1 w-full">
                <x-label caption="Place Of Origin">{{ $member->ancestor->place_of_origin }}</x-label>
                <x-label caption="Place of Arrival in SA">{{ $member->ancestor->place_of_arrival }}</x-label>
                <x-label caption="Name of the Ship">{{ $member->ancestor->name_of_the_ship }}</x-label>
            </div>
            @if (count($member->pedigree))
            <div class="mt-8 mb-2 border-b border-b-slate-400 font-bold w-full text-left">Pedigree Chart</div>
            @foreach ($member->pedigree as $pedigree)
                <div class="grid grid-cols-2 gap-1 w-full">
                    <x-label caption="Applicant's">{{ $pedigree->pedigree }}</x-label>
                    <x-label caption="Full Name">{{ $pedigree->full_name }}</x-label>
                    <x-label caption="Membership ID">{{ $pedigree->membership_id }}</x-label>
                    <x-label caption="Birth place">{{ $pedigree->birth_place }}</x-label>
                </div>
            @endforeach
            @endif
        </div>
        <div class="my-3"></div>
</section>