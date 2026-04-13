<!-- <div class="min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-5xl bg-white rounded-3xl shadow-xl overflow-hidden flex flex-col md:flex-row">
        
        <div class="w-full md:w-1/2 p-10 md:p-14">
            <div class="mb-12 flex justify-start">
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </div>

            @if(isset($title))
                <h1 class="text-3xl font-bold text-[#1F2937] mb-2">{{ $title }}</h1>
            @endif
            @if(isset($description))
                <p class="text-gray-600 mb-8">{{ $description }}</p>
            @endif

            {{ $slot }}
        </div>

        <div class="w-full md:w-1/2 bg-[#A7C7E7] p-10 md:p-14 flex flex-col items-center justify-center text-center">
            
            <div class="w-64 h-64 mb-10">
                <img src="https://img.icons8.com/?size=400&id=D0U0b144K90q&format=png&color=000000" alt="Ticketing Illustration" class="w-full h-full object-contain">
            </div>

            <h2 class="text-3xl font-semibold text-[#1E40AF] mb-4">New to SupportHub?</h2>
            <p class="text-[#3A56A6] mb-10">Submit and track your support requests easily. Create an account to get started.</p>

            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="inline-flex items-center px-10 py-3 bg-white border border-gray-300 rounded-full font-semibold text-sm text-[#1E40AF] uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                    Create an Account
                </a>
            @endif
        </div>
    </div>
</div> -->