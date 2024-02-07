<x-layout.wp>
    <section class="text-center m-2">
        @if (session('message'))
            <div class="text-[#002e59] text-left font-bold bg-white p-2 shadow-md border-l-8 border-l-[#da251c] rounded-r-lg">
                {{ session('message') }}
            </div>
        @endif
        <h1 class="text-5xl w-full mx-auto  text-[#da251c]">Membership Levels</h1>
        <div class="flex gap-4 mx-auto mt-5 flex-wrap max-w-5xl items-center justify-center">
            {{-- CARD --}}
            <div class="flex flex-col hover:shadow-blue-300 items-center relative bg-white shadow-md rounded-md p-4 min-w-[300px]">
                <div class="absolute px-2 left-1 top-1 shadow-sm rounded-full bg-[#da251c] text-white">Level</div>
                <h1 class="font-bold text-2xl mx-auto border-b-2 w-full ">Pioneers</h1>
                <div class="inline-flex my-4">
                    <h2>$65.00</h2>
                    <div>/ Year</div>
                </div>
                <a href="{{ route('level',['level' => 1]) }}" class="bg-[#002e59] hover:bg-[#0a477f] text-white hover:text-black font-bold cursor-pointer rounded p-2 w-full">Subscribe</a>
            </div>
            {{-- CARD --}}
            <div class="flex flex-col hover:shadow-blue-300 items-center relative bg-white shadow-md rounded-md p-4 min-w-[300px]">
                <div class="absolute px-2 left-1 top-1 shadow-sm rounded-full bg-[#da251c] text-white">Level</div>
                <h1 class="font-bold text-2xl mx-auto border-b-2 w-full ">Junior</h1>
                <div class="inline-flex my-4">
                    <h2>$50.00</h2>
                    <div>/ Year</div>
                </div>
                <a href="{{ route('level',['level' => 1]) }}" class="bg-[#002e59] hover:bg-[#0a477f] text-white hover:text-black font-bold cursor-pointer rounded p-2 w-full">Subscribe</a>
            </div>
            {{-- CARD --}}
            <div class="flex flex-col hover:shadow-blue-300 items-center relative bg-white shadow-md rounded-md p-4 min-w-[300px]">
                <div class="absolute px-2 left-1 top-1 shadow-sm rounded-full bg-[#da251c] text-white">Level</div>
                <h1 class="font-bold text-2xl mx-auto border-b-2 w-full ">Associate</h1>
                <div class="inline-flex my-4">
                    <h2>$65.00</h2>
                    <div>/ Year</div>
                </div>
                <a href="{{ route('level',['level' => 1]) }}" class="bg-[#002e59] hover:bg-[#0a477f] text-white hover:text-black font-bold cursor-pointer rounded p-2 w-full">Subscribe</a>
            </div>
            {{-- CARD --}}
            <div class="flex flex-col hover:shadow-blue-300 items-center relative bg-white shadow-md rounded-md p-4 min-w-[300px]">
                <div class="absolute px-2 left-1 top-1 shadow-sm rounded-full bg-[#da251c] text-white">Level</div>
                <h1 class="font-bold text-2xl mx-auto border-b-2 w-full ">Life</h1>
                <div class="inline-flex my-4">
                    <h2>$1000.00</h2>
                    <div>/ Year</div>
                </div>
                <a href="{{ route('level',['level' => 1]) }}" class="bg-[#002e59] hover:bg-[#0a477f] text-white hover:text-black font-bold cursor-pointer rounded p-2 w-full">Subscribe</a>
            </div>
            {{-- CARD --}}
            <div class="flex flex-col hover:shadow-blue-300 items-center relative bg-white shadow-md rounded-md p-4 min-w-[300px]">
                <div class="absolute px-2 left-1 top-1 shadow-sm rounded-full bg-[#da251c] text-white">Level</div>
                <h1 class="font-bold text-2xl mx-auto border-b-2 w-full ">Associate Life</h1>
                <div class="inline-flex my-4">
                    <h2>$100.00</h2>
                    <div>/ Year</div>
                </div>
                <a href="{{ route('level',['level' => 1]) }}" class="bg-[#002e59] hover:bg-[#0a477f] text-white hover:text-black font-bold cursor-pointer rounded p-2 w-full">Subscribe</a>
            </div>
        </div>
    </section>
</x-layout.wp>