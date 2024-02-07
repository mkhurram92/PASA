<x-layout.wp>
    <section class="m-2 mx-auto xl:max-w-5xl">
        <div class="my-6 w-full text-center ">
            <div class="pl-4 pr-6 py-1 text-3xl font-bold mx-auto shadow-md rounded-t-full bg-white text-[#da251c]">
                Membership Checkout
            </div>
            <div class="pl-4 pr-6 py-1 text-lg md:text-xl lg:text-2xl shadow-md rounded-b-md text-[#002e59] ">
                You have selected the
                <span class="bg-[#da251c] text-white rounded-full px-4 shadow-sm">Pioneers</span>
                membership level. The price for membership is
                <span class="bg-[#da251c] text-white rounded-full px-4 shadow-sm">$65.00</span>
                per Year.
            </div>
        </div>
        <form method="POST" action="{{ route('subscribe') }}">
            @csrf
            <!-- Account Info Card -->
            @include('membership.account')

            <!-- Personal Info Card -->
            <div
                class="mt-6 flex flex-col overflow-hidden hover:shadow-blue-300 items-center relative bg-white shadow-md rounded-md p-4 min-w-[300px]">
                <div
                    class="absolute pl-4 pr-6 py-1 left-0 top-0 text-lg md:text-xl lg:text-2xl  shadow-md rounded-br-full bg-[#002e59] text-white">
                    Application Personal Details</div>
                <div class="mt-8 grid grid-cols-2 gap-x-2 gap-y-6 w-full">
                    <div class="flex align-middle gap-x-1">
                        <!-- Title -->
                        <div>
                            <x-input-label for="title">
                                Title<span class="text-[#da251c]">*</span>
                            </x-input-label>
                            <x-select name="title" class="block mt-1 w-full" required>
                                <option value="Mr.">Mr.</option>
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
                            <x-text-input type="text" id="given_name" class="block mt-1 w-full" name="given_name"
                                :value="old('given_name')" required />
                            <x-input-error :messages="$errors->get('given_name')" class="mt-2" />
                        </div>
                    </div>
                    <!-- Family Name -->
                    <div>
                        <x-input-label for="family_name">
                            Family Name<span class="text-[#da251c]">*</span>
                        </x-input-label>
                        <x-text-input type="text" id="family_name" class="block mt-1 w-full" name="family_name"
                            :value="old('family_name')" required />
                        <x-input-error :messages="$errors->get('family_name')" class="mt-2" />
                    </div>
                    <!-- Preferred Name -->
                    <div>
                        <x-input-label for="preferred_name">
                            Preferred Name<span class="text-[#da251c]">*</span>
                        </x-input-label>
                        <x-text-input type="text" id="preferred_name" class="block mt-1 w-full" name="preferred_name"
                            :value="old('preferred_name')" required />
                        <x-input-error :messages="$errors->get('preferred_name')" class="mt-2" />
                    </div>
                    <!-- Date of Birth -->
                    <div>
                        <x-input-label for="date_of_birth">
                            Date of Birth
                        </x-input-label>
                        <x-text-input type="date" id="date_of_birth" class="block mt-1 w-full" name="date_of_birth"
                            :value="old('date_of_birth')" />
                        <x-input-error :messages="$errors->get('date_of_birth')" class="mt-2" />
                    </div>

                    <!-- Address Info -->
                    <!-- Number & Street -->
                    <div>
                        <x-input-label for="number_street">
                            Number & Street<span class="text-[#da251c]">*</span>
                        </x-input-label>
                        <x-text-input id="number_street" class="block mt-1 w-full" type="text" name="number_street"
                            required :value="old('number_street')" />
                        <x-input-error :messages="$errors->get('number_street')" class="mt-2" />
                    </div>
                    <!-- Suburb -->
                    <div>
                        <x-input-label for="suburb">
                            Suburb<span class="text-[#da251c]">*</span>
                        </x-input-label>
                        <x-text-input id="suburb" class="block mt-1 w-full" type="text" name="suburb" required
                            :value="old('suburb')" />
                        <x-input-error :messages="$errors->get('suburb')" class="mt-2" />
                    </div>
                    <!-- State -->
                    <div>
                        <x-input-label for="state">
                            State
                        </x-input-label>
                        <x-select id="state" name="state" class="block mt-1 w-full">
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
                        <x-select id="country" name="country" class="block mt-1 w-full">
                            <option value="Australia">Australia</option>
                        </x-select>
                        <x-input-error :messages="$errors->get('country')" class="mt-2" />
                    </div>
                    <!-- Post Code -->
                    <div>
                        <x-input-label for="post_code">
                            Post Code/Zip<span class="text-[#da251c]">*</span>
                        </x-input-label>
                        <x-text-input id="post_code" class="block mt-1 w-full" type="text" name="post_code" required
                            :value="old('post_code')" />
                        <x-input-error :messages="$errors->get('post_code')" class="mt-2" />
                    </div>
                    <!-- Phone (Home) -->
                    <div>
                        <x-input-label for="phone">
                            Phone (Home)
                        </x-input-label>
                        <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone"
                            :value="old('phone')" />
                        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                    </div>
                    <!-- Phone (Mobile) -->
                    <div>
                        <x-input-label for="mobile">
                            Phone (Mobile)
                        </x-input-label>
                        <x-text-input id="mobile" class="block mt-1 w-full" type="text" name="mobile"
                            :value="old('mobile')" />
                        <x-input-error :messages="$errors->get('mobile')" class="mt-2" />
                    </div>
                    <!-- Email Address -->
                    <div>
                        <x-input-label for="email">
                            Email<span class="text-[#da251c]">*</span>
                        </x-input-label>
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                            :value="old('email')" required :value="old('email')" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                    <!-- Journal Preferred Delivery -->
                    <div>
                        <x-input-label for="delivery">
                            Journal Preferred Delivery<span class="text-[#da251c]">*</span>
                        </x-input-label>
                        <div class="flex gap-2 align-middle">
                            <label for="delivery1">
                                <x-text-input id="delivery1" type="radio" name="delivery" value="email"
                                    required />
                                Email
                            </label>
                            <label for="delivery2">
                                <x-text-input id="delivery2" type="radio" name="delivery" value="post" />
                                Post
                            </label>
                        </div>
                        <x-input-error :messages="$errors->get('delivery')" class="mt-2" />
                    </div>
                </div>
                <!-- 2 Column Grid -->
            </div>

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
                        <x-select id="gender" name="gender" class="block mt-1 w-full">
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
                        <x-text-input type="text" id="full_name" class="block mt-1 w-full" name="full_name"
                            :value="old('full_name')" required />
                        <x-input-error :messages="$errors->get('full_name')" class="mt-2" />
                    </div>
                    <!-- Maiden Name -->
                    <div>
                        <x-input-label for="maiden_name">
                            Maiden Name<span class="text-[#da251c]">*</span>
                        </x-input-label>
                        <x-text-input type="text" id="maiden_name" class="block mt-1 w-full" name="maiden_name"
                            :value="old('maiden_name')" required />
                        <x-input-error :messages="$errors->get('maiden_name')" class="mt-2" />
                    </div>
                    <!-- Place Of Origin (Town/City/State/Country) -->
                    <div>
                        <x-input-label for="place_of_origin">
                            Place Of Origin
                        </x-input-label>
                        <x-text-input type="text" id="place_of_origin" class="block mt-1 w-full"
                            name="place_of_origin" :value="old('place_of_origin')" />
                        <x-input-error :messages="$errors->get('place_of_origin')" class="mt-2" />
                    </div>
                    <!-- Place of Arrival in South Australia (Town/City, Sate, Country) -->
                    <div>
                        <x-input-label for="place_of_arrival">
                            Place of Arrival in SA<span class="text-[#da251c]">*</span>
                        </x-input-label>
                        <x-select id="place_of_arrival" name="place_of_arrival" class="block mt-1 w-full" required>
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
                        <x-select id="name_of_the_ship" name="name_of_the_ship" class="block mt-1 w-full" required>
                            @foreach (App\Models\Ship::all() as $ship)
                                <option value="{{ $ship->id }}">{{ $ship->name_of_ship }}</option>
                            @endforeach
                        </x-select>
                        <x-input-error :messages="$errors->get('name_of_the_ship')" class="mt-2" />
                    </div>
                </div>
                <!-- 2 Column Grid -->
            </div>

            <!-- Payment Information -->
            @include('membership.payment')

            <div class="mt-2 text-[#002e59] text-sm font-bold">
                <span class="text-[#da251c]">*</span> Mandatory fields
            </div>
            <div class="mt-4">
                <input type="submit"
                    class = 'inline-flex items-center px-4 py-2 bg-[#da251c] border border-transparent rounded-md font-semibold text-xs text-white  uppercase tracking-widest hover:bg-[#f3352b]  focus:bg-[#f3352b]  active:bg-[#7d150f] focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2  transition ease-in-out duration-150 shadow-md'
                    value="Submit and Check Out" />
            </div>
        </form>
    </section>
</x-layout.wp>
