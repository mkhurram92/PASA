<x-layout.wp>
    <section class="m-2 mx-auto xl:max-w-5xl">
        <div class="my-6 w-full text-center ">
            <div class="pl-4 pr-6 py-1 text-3xl font-bold mx-auto shadow-md rounded-t-full bg-white text-[#da251c]">
            Membership Checkout
            </div>
            <div class="pl-4 pr-6 py-1 text-lg md:text-xl lg:text-2xl shadow-md rounded-b-md text-[#002e59] ">
                You have selected the 
                <span class="bg-[#da251c] text-white rounded-full px-4 shadow-sm">Associate</span>     
                membership level. The price for membership is
                <span class="bg-[#da251c] text-white rounded-full px-4 shadow-sm">$65.00</span>     
                per Year.    
            </div>
        </div>
        @include('membership.account')
        
        @include('membership.payment')

        <div class="mt-4">
            <button type = 'submit' class = 'inline-flex items-center px-4 py-2 bg-[#da251c]  border border-transparent rounded-md font-semibold text-xs text-white  uppercase tracking-widest hover:bg-[#f3352b]  focus:bg-[#f3352b]  active:bg-[#7d150f] focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2  transition ease-in-out duration-150 shadow-md'>
                Submit and Check Out
            </button>
        </div>
    </section>
</x-layout.wp>