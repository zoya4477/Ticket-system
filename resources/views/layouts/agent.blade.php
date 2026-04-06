<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title', 'Agent Dashboard') | Ticketing System</title>

<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<style>
    body { background-color: #1a1c1e; color: #e2e8f0; }
    .card-custom { background-color: #2b3035; border: 1px solid #3d444b; }
    .active-link { background-color: #3b82f6; color: white; }
</style>
</head>

<body class="font-sans antialiased">

<div class="min-h-screen flex flex-col">

    <!-- TOPBAR -->
    <header class="bg-blue-600 h-16 flex items-center justify-between px-6 sticky top-0 z-50">

        <!-- LEFT -->
        <div class="flex items-center gap-6">
            <div class="text-lg font-bold flex items-center gap-2">
                <i class="fas fa-headset text-blue-300"></i> Agent Hub
            </div>

            <nav class="hidden md:flex items-center gap-2">

                <a href="{{ route('agent.dashboard') }}"
                   class="px-4 py-2 rounded-lg text-sm hover:bg-gray-700 transition {{ request()->is('agent/dashboard*') ? 'active-link' : '' }}">
                    Overview
                </a>

                <a href="{{ route('tickets.index') }}"
                   class="px-4 py-2 rounded-lg text-sm hover:bg-gray-700 transition {{ request()->is('tickets*') ? 'active-link' : '' }}">
                    Tickets
                </a>

                <a href="{{ route('agent.dashboard', ['efficiency' => 1]) }}"
                   class="px-4 py-2 rounded-lg text-sm hover:bg-gray-700 transition {{ request('efficiency') ? 'active-link' : '' }}">
                    My Efficiency
                </a>

                <a href="{{ route('kb.index') }}"
                   class="px-4 py-2 rounded-lg text-sm hover:bg-gray-700 transition {{ request()->is('kb*') ? 'active-link' : '' }}">
                    Knowledge Base
                </a>

            </nav>
        </div>

        <!-- RIGHT SIDE -->
        <div class="flex items-center gap-4">

            <!-- 🔔 NOTIFICATIONS -->
            <div class="relative">

                <button onclick="toggleNotifDropdown()" class="relative focus:outline-none text-white">
                    <i class="fas fa-bell text-lg"></i>

                    @if(auth()->user()->unreadNotifications->count() > 0)
                        <span class="absolute -top-1 -right-1 bg-red-500 text-xs rounded-full px-1.5">
                            {{ auth()->user()->unreadNotifications->count() }}
                        </span>
                    @endif
                </button>

                <!-- DROPDOWN -->
                <div id="notifDropdown"
                     class="hidden absolute right-0 mt-3 w-80 bg-[#2b3035] border border-gray-700 rounded-lg shadow-lg z-50">

                    <div class="p-3 border-b border-gray-700 text-sm font-semibold">
                        Notifications ({{ auth()->user()->unreadNotifications->count() }})
                    </div>

                    <div class="max-h-64 overflow-y-auto">

                        @forelse(auth()->user()->unreadNotifications as $notification)
                            <a href="{{ route('tickets.show', $notification->data['ticket_id'] ?? '#') }}"
                               class="flex justify-between items-start px-4 py-3 text-sm hover:bg-gray-700 transition">

                                <div>
                                    <i class="fas fa-envelope mr-2 text-blue-400"></i>
                                    {{ \Illuminate\Support\Str::limit($notification->data['title'] ?? 'Ticket Update', 30) }}
                                </div>

                                <span class="text-xs text-gray-400 ml-2">
                                    {{ $notification->created_at->diffForHumans() }}
                                </span>

                            </a>
                        @empty
                            <div class="p-4 text-center text-gray-400 text-sm">
                                No new notifications
                            </div>
                        @endforelse

                    </div>
                </div>
            </div>

            <!-- SEARCH -->
            <div class="relative hidden lg:block">
                <i class="fas fa-search absolute left-3 top-2 text-gray-500 text-xs"></i>
                <input type="text"
                       class="bg-gray-800 text-sm border border-gray-600 rounded-full py-1.5 pl-8 pr-4 focus:outline-none focus:border-blue-500 w-64 text-gray-200"
                       placeholder="Search tickets...">
            </div>

            <!-- USER DROPDOWN -->
            <div class="relative">
                <button onclick="toggleDropdown()" class="flex items-center gap-2 focus:outline-none">

                    <img src="{{ Auth::user()->profile_photo_url ?? 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name) }}"
                         class="w-9 h-9 rounded-full border-2 border-blue-500 object-cover">

                    <span class="hidden md:block text-sm">
                        {{ Auth::user()->name }}
                    </span>

                    <i class="fas fa-chevron-down text-xs text-gray-400"></i>
                </button>

                <!-- DROPDOWN -->
                <div id="userDropdown"
                     class="hidden absolute right-0 mt-3 w-48 bg-[#2b3035] border border-gray-700 rounded-lg shadow-lg overflow-hidden z-50">

                    <a href="{{ route('profile.edit') }}"
                       class="flex items-center gap-2 px-4 py-2 text-sm hover:bg-gray-700 transition">
                        <i class="fas fa-user"></i> Profile
                    </a>

                    <div class="border-t border-gray-700"></div>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="w-full text-left flex items-center gap-2 px-4 py-2 text-sm text-red-400 hover:bg-red-500/10 transition">
                            <i class="fas fa-sign-out-alt"></i> Sign Out
                        </button>
                    </form>

                </div>
            </div>

        </div>
    </header>

    <!-- MOBILE MENU -->
    <div class="md:hidden px-4 py-3 bg-[#212529] border-b border-gray-700 flex gap-2 overflow-x-auto">

        <a href="{{ route('agent.dashboard') }}"
           class="px-3 py-1 rounded text-xs {{ request()->is('agent/dashboard*') ? 'active-link' : '' }}">
            Overview
        </a>

        <a href="{{ route('tickets.index') }}"
           class="px-3 py-1 rounded text-xs {{ request()->is('tickets*') ? 'active-link' : '' }}">
            Tickets
        </a>

        <a href="{{ route('agent.dashboard', ['efficiency' => 1]) }}"
           class="px-3 py-1 rounded text-xs {{ request('efficiency') ? 'active-link' : '' }}">
            Efficiency
        </a>

        <a href="{{ route('kb.index') }}"
           class="px-3 py-1 rounded text-xs {{ request()->is('kb*') ? 'active-link' : '' }}">
            Knowledge Base
        </a>
    </div>

    <!-- CONTENT -->
    <main class="p-8 flex-1">
        @yield('content')
    </main>

</div>

<!-- JS -->
<script>
function toggleDropdown() {
    document.getElementById('userDropdown').classList.toggle('hidden');
}

function toggleNotifDropdown() {
    document.getElementById('notifDropdown').classList.toggle('hidden');
}

// Close dropdowns when clicking outside
window.addEventListener('click', function(e) {
    if (!e.target.closest('.relative')) {
        document.getElementById('userDropdown')?.classList.add('hidden');
        document.getElementById('notifDropdown')?.classList.add('hidden');
    }
});
</script>

@stack('scripts')

</body>
</html>