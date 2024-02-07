<x-layout.wp>
    <section class="m-2 mx-auto xl:max-w-5xl">
        <div class="my-6 w-full text-center ">
            <div class="pl-4 pr-6 py-1 text-3xl font-bold mx-auto shadow-md rounded-t-full bg-white text-[#da251c]">
            Membership Checkout
            </div>
            <div class="pl-4 pr-6 py-1 text-lg md:text-xl lg:text-2xl shadow-md rounded-b-md text-[#002e59] ">
                You have selected the 
                <span class="bg-[#da251c] text-white rounded-full px-4 shadow-sm">Junior</span>     
                membership level. The price for membership is
                <span class="bg-[#da251c] text-white rounded-full px-4 shadow-sm">$50.00</span>     
                per Year.    
            </div>
        </div>
        @include('membership.account')

        <!-- Personal Info Card -->
        <div
            class="mt-6 flex flex-col overflow-hidden hover:shadow-blue-300 items-center relative bg-white shadow-md rounded-md p-4 min-w-[300px]">
            <div
                class="absolute pl-4 pr-6 py-1 left-0 top-0 text-lg md:text-xl lg:text-2xl  shadow-md rounded-br-full bg-[#002e59] text-white">
                Junior Pioneer Application Personal Details</div>
            <div class="mt-8 grid md:grid-cols-2 gap-x-2 gap-y-6 w-full">
                <div class="flex align-middle gap-x-1">
                    <!-- Title -->
                    <div>
                        <x-input-label for="title" :value="__('Title')" />
                        <x-select name="title" class="block mt-1 w-full">
                            <option value="Mr.">Mr.</option>
                            <option value="Mrs.">Mrs.</option>
                            <option value="Miss.">Miss.</option>
                            <option value="Ms.">Ms.</option>
                            <option value="Dr.">Dr.</option>
                            <option value="Sir.">Sir.</option>
                        </x-select>
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>
                    <!-- First Name -->
                    <div class="w-full">
                        <x-input-label for="firstname" :value="__('First Name')" />
                        <x-text-input type="text" id="firstname" class="block mt-1 w-full" name="firstname"
                            :value="old('firstname')" required autofocus autocomplete="firstname" />
                        <x-input-error :messages="$errors->get('firstname')" class="mt-2" />
                    </div>
                </div>
                <!-- Last Name -->
                <div>
                    <x-input-label for="lastname" :value="__('Last Name')" />
                    <x-text-input type="text" id="lastname" class="block mt-1 w-full" name="lastname"
                        :value="old('lastname')" autofocus autocomplete="lastname" />
                    <x-input-error :messages="$errors->get('lastname')" class="mt-2" />
                </div>
                <!-- Preferred Name -->
                <div>
                    <x-input-label for="preferredname" :value="__('Preferred Name')" />
                    <x-text-input type="text" id="preferredname" class="block mt-1 w-full" name="preferredname"
                        :value="old('preferredname')" autofocus autocomplete="preferredname" />
                    <x-input-error :messages="$errors->get('preferredname')" class="mt-2" />
                </div>
                <!-- Date of Birth -->
                <div class="flex flex-nowrap w-full align-middle gap-x-1">
                    <!-- Date -->
                    <div class="w-full">
                        <x-input-label for="birth_month" :value="__('Date of Birth')" />
                        <x-select name="birth_month" class=" mt-1">
                            <option value="1">Jan</option>
                            <option value="2">Feb</option>
                            <option value="3">Mar</option>
                            <option value="4">Apr</option>
                            <option value="5">May</option>
                            <option value="6">Jun</option>
                            <option value="7">Jul</option>
                            <option value="8">Aug</option>
                            <option value="9">Sep</option>
                            <option value="10">Oct</option>
                            <option value="11">Nov</option>
                            <option value="12">Dec</option>
                        </x-select>
                        <x-text-input type="text" id="birth_date" class=" mt-1" name="birth_date"
                            :value="old('birth_date')" required autofocus autocomplete="birth_date"
                            placeholder="Date" />
                        <x-text-input type="text" id="birth_year" class=" mt-1" name="birth_year"
                            :value="old('birth_year')" required autofocus autocomplete="birth_year"
                            placeholder="Year" />
                    </div>
                </div>
            </div>
            <!-- 2 Column Grid -->
        </div>

        <!-- Parent Contact Details -->
        <div
            class="mt-6 flex flex-col overflow-hidden hover:shadow-blue-300 items-center relative bg-white shadow-md rounded-md p-4 min-w-[300px]">
            <div
                class="absolute pl-4 pr-6 py-1 left-0 top-0 text-lg md:text-xl lg:text-2xl  shadow-md rounded-br-full bg-[#002e59] text-white">
                Parent Contact Details</div>
            <div class="mt-8 grid md:grid-cols-2 gap-x-2 gap-y-6 w-full">
                <!-- Mother's Full Name -->
                <div>
                    <x-input-label for="mother_full_name" :value="__('Mother\'s Full  Name')" />
                    <x-text-input type="text" id="mother_full_name" class="block mt-1 w-full" name="mother_full_name"
                        :value="old('mother_full_name')" autofocus autocomplete="mother_full_name" />
                    <x-input-error :messages="$errors->get('mother_full_name')" class="mt-2" />
                </div>
                <!-- Preferred Name -->
                <div>
                    <x-input-label for="mother_preferredname" :value="__('Preferred Name')" />
                    <x-text-input type="text" id="mother_preferredname" class="block mt-1 w-full" name="mother_preferredname"
                        :value="old('mother_preferredname')" autofocus autocomplete="mother_preferredname" />
                    <x-input-error :messages="$errors->get('mother_preferredname')" class="mt-2" />
                </div>
                <!-- Father's Full Name -->
                <div>
                    <x-input-label for="father_full_name" :value="__('Father\'s Full  Name')" />
                    <x-text-input type="text" id="father_full_name" class="block mt-1 w-full" name="father_full_name"
                        :value="old('father_full_name')" autofocus autocomplete="father_full_name" />
                    <x-input-error :messages="$errors->get('father_full_name')" class="mt-2" />
                </div>
                <!-- Preferred Name -->
                <div>
                    <x-input-label for="father_preferredname" :value="__('Preferred Name')" />
                    <x-text-input type="text" id="father_preferredname" class="block mt-1 w-full" name="father_preferredname"
                        :value="old('father_preferredname')" autofocus autocomplete="father_preferredname" />
                    <x-input-error :messages="$errors->get('father_preferredname')" class="mt-2" />
                </div>
                <!-- Phone (Home) -->
                <div>
                    <x-input-label for="application_phone" :value="__('Phone (Home)')" />
                    <x-text-input id="application_phone" class="block mt-1 w-full" type="text"
                        name="application_phone" />
                    <x-input-error :messages="$errors->get('application_phone')" class="mt-2" />
                </div>
                <!-- Phone (Mobile) -->
                <div>
                    <x-input-label for="application_mobile" :value="__('Phone (Mobile)')" />
                    <x-text-input id="application_mobile" class="block mt-1 w-full" type="text"
                        name="application_mobile" />
                    <x-input-error :messages="$errors->get('application_mobile')" class="mt-2" />
                </div>
                <!-- Email Address -->
                <div>
                    <x-input-label for="application_email" :value="__('Email')" />
                    <x-text-input id="application_email" class="block mt-1 w-full" type="email" name="application_email"
                        :value="old('application_email')" required />
                    <x-input-error :messages="$errors->get('application_email')" class="mt-2" />
                </div>
                <!-- Pastal Address -->
                <div>
                    <x-input-label for="application_pastal_address" :value="__('Pastal Address')" />
                    <x-text-input id="application_pastal_address" class="block mt-1 w-full" type="text"
                        name="application_pastal_address" />
                    <x-input-error :messages="$errors->get('application_pastal_address')" class="mt-2" />
                </div>
                <!-- Number & Street -->
                <div>
                    <x-input-label for="application_number_street" :value="__('Number & Street')" />
                    <x-text-input id="application_number_street" class="block mt-1 w-full" type="text"
                        name="application_number_street" />
                    <x-input-error :messages="$errors->get('application_number_street')" class="mt-2" />
                </div>
                <!-- State -->
                <div>
                    <x-input-label for="application_state" :value="__('State')" />
                    <x-select id="application_state" name="application_state" class="block mt-1 w-full">
                        <option value="South Australia">South Australia</option>
                        <option value="New South Vales">New South Vales</option>
                        <option value="Victoria">Victoria</option>
                        <option value="West Australia">West Australia</option>
                        <option value="Tasmania">Tasmania</option>
                        <option value="Queensland">Queensland</option>
                    </x-select>
                    <x-input-error :messages="$errors->get('application_state')" class="mt-2" />
                </div>
                <!-- Country -->
                <div>
                    <x-input-label for="application_country" :value="__('Country')" />
                    <x-select id="application_country" name="application_country" class="block mt-1 w-full">
                        <option value="Australia">Australia</option>
                    </x-select>
                    <x-input-error :messages="$errors->get('application_country')" class="mt-2" />
                </div>
                <!-- Post Code -->
                <div>
                    <x-input-label for="application_post_code" :value="__('Post Code')" />
                    <x-text-input id="application_post_code" class="block mt-1 w-full" type="text"
                        name="application_post_code" />
                    <x-input-error :messages="$errors->get('application_post_code')" class="mt-2" />
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
                <!-- Earliest Arrival in SA Name -->
                <div>
                    <x-input-label for="earliest_arrival_in_sa" :value="__('Earliest Arrival in SA (Name)')" />
                    <x-text-input type="text" id="earliest_arrival_in_sa" class="block mt-1 w-full"
                        name="earliest_arrival_in_sa" :value="old('earliest_arrival_in_sa')" required
                        autocomplete="earliest_arrival_in_sa" />
                    <x-input-error :messages="$errors->get('earliest_arrival_in_sa')" class="mt-2" />
                </div>
                <!-- Place Of Origin (Town/City/State/Country) -->
                <div>
                    <x-input-label for="place_of_origin" :value="__('Earliest Arrival in SA (Name)')" />
                    <x-text-input type="text" id="place_of_origin" class="block mt-1 w-full" name="place_of_origin"
                        :value="old('place_of_origin')" required autocomplete="place_of_origin" />
                    <x-input-error :messages="$errors->get('place_of_origin')" class="mt-2" />
                </div>
                <!-- Place Of Arrival -->
                <div>
                    <x-input-label for="place_of_arrival" :value="__('Place Of Arrival')" />
                    <x-select id="place_of_arrival" name="place_of_arrival" class="block mt-1 w-full">
                        <option value="PORT ADELAIDE">PORT ADELAIDE</option>
                        <option value="NEPEAN BAY">NEPEAN BAY</option>
                        <option value="HOLDFAST BAY">HOLDFAST BAY</option>
                        <option value="KINGSCOTE">KINGSCOTE</option>
                        <option value="COORONG">COORONG</option>
                        <option value="KANGAROO ISLAND">KANGAROO ISLAND</option>
                    </x-select>
                    <x-input-error :messages="$errors->get('place_of_arrival')" class="mt-2" />
                </div>

                <!-- Date Of Arrival -->
                <div class="flex align-middle gap-x-1">
                    <!-- Date -->
                    <div>
                        <x-input-label for="date_of_arrival_m" :value="__('Date Of Arrival')" />
                        <x-select id="date_of_arrival_m" name="date_of_arrival_m" class=" mt-1">
                            <option value="1">Jan</option>
                            <option value="2">Feb</option>
                            <option value="3">Mar</option>
                            <option value="4">Apr</option>
                            <option value="5">May</option>
                            <option value="6">Jun</option>
                            <option value="7">Jul</option>
                            <option value="8">Aug</option>
                            <option value="9">Sep</option>
                            <option value="10">Oct</option>
                            <option value="11">Nov</option>
                            <option value="12">Dec</option>
                        </x-select>
                        <x-text-input type="text" id="date_of_arrival_d" class=" mt-1" name="date_of_arrival_d"
                            :value="old('date_of_arrival_d')" required  autocomplete="date_of_arrival_d"
                            placeholder="Day" />
                        <x-text-input type="text" id="date_of_arrival_y" class=" mt-1" name="date_of_arrival_y"
                            :value="old('date_of_arrival_y')" required  autocomplete="date_of_arrival_y"
                            placeholder="Year" />
                    </div>
                </div>
                <!-- Name of the Ship -->
                <div>
                    <x-input-label for="name_of_the_ship" :value="__('Name of the Ship')" />
                    <x-text-input type="text" id="name_of_the_ship" class="block mt-1 w-full"
                        name="name_of_the_ship" :value="old('name_of_the_ship')" required
                        autocomplete="name_of_the_ship" />
                    <x-input-error :messages="$errors->get('name_of_the_ship')" class="mt-2" />
                </div>
            </div>
            <!-- 2 Column Grid -->
        </div>
        
        @include('membership.payment')

        <div class="mt-4">
            <button type = 'submit' class = 'inline-flex items-center px-4 py-2 bg-[#da251c]  border border-transparent rounded-md font-semibold text-xs text-white  uppercase tracking-widest hover:bg-[#f3352b]  focus:bg-[#f3352b]  active:bg-[#7d150f] focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2  transition ease-in-out duration-150 shadow-md'>
                Submit and Check Out
            </button>
        </div>
    </section>
</x-layout.wp>