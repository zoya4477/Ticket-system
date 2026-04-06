@extends('layouts.agent')

@section('title', 'Agent Dashboard')

@section('content')
<div class="container-fluid">
    
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-white tracking-tight">Overview</h1>
        <p class="text-gray-400 text-sm">Track your progress and manage assigned tickets.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        @php
            $stats = [
                ['label' => 'Total Assigned', 'count' => $totalTickets, 'route' => route('agent.dashboard'), 'icon' => 'fa-ticket-alt', 'color' => 'blue'],
                ['label' => 'Open Tickets', 'count' => $openTickets, 'route' => route('agent.dashboard', ['status' => 'open']), 'icon' => 'fa-envelope-open', 'color' => 'emerald'],
                ['label' => 'In Progress', 'count' => $inProgressTickets, 'route' => route('agent.dashboard', ['status' => 'in_progress']), 'icon' => 'fa-spinner', 'color' => 'amber'],
                ['label' => 'Resolved', 'count' => $closedTickets, 'route' => route('agent.dashboard', ['status' => 'closed']), 'icon' => 'fa-check-circle', 'color' => 'gray'],
            ];
        @endphp

        @foreach($stats as $stat)
        <a href="{{ $stat['route'] }}" class="bg-gray-800 border border-gray-700 p-6 rounded-xl hover:border-{{ $stat['color'] }}-500 transition-all group shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-xs font-bold uppercase tracking-widest">{{ $stat['label'] }}</p>
                    <h3 class="text-3xl font-extrabold text-white mt-1 group-hover:text-{{ $stat['color'] }}-400 transition-colors">{{ $stat['count'] }}</h3>
                </div>
                <div class="bg-gray-900 p-3 rounded-lg">
                    <i class="fas {{ $stat['icon'] }} text-{{ $stat['color'] }}-500 text-xl group-hover:scale-110 transition-transform"></i>
                </div>
            </div>
        </a>
        @endforeach
    </div>

    <div class="bg-gray-800/50 p-4 rounded-xl border border-gray-700 mb-6">
        <form method="GET" action="{{ route('agent.dashboard') }}" class="flex flex-wrap gap-4 items-center">
            <div class="flex-1 min-w-[160px]">
                <select name="status" class="w-full bg-gray-900 border border-gray-700 text-gray-300 text-sm rounded-lg p-2 focus:ring-1 focus:ring-blue-500 focus:outline-none transition-all">
                    <option value="">All Statuses</option>
                    <option value="open" {{ request('status') == 'open' ? 'selected' : '' }}>Open</option>
                    <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="closed" {{ request('status') == 'closed' ? 'selected' : '' }}>Closed</option>
                </select>
            </div>

            <div class="flex-1 min-w-[160px]">
                <select name="priority" class="w-full bg-gray-900 border border-gray-700 text-gray-300 text-sm rounded-lg p-2 focus:ring-1 focus:ring-blue-500 focus:outline-none transition-all">
                    <option value="">All Priorities</option>
                    <option value="low" {{ request('priority') == 'low' ? 'selected' : '' }}>Low</option>
                    <option value="medium" {{ request('priority') == 'medium' ? 'selected' : '' }}>Medium</option>
                    <option value="high" {{ request('priority') == 'high' ? 'selected' : '' }}>High</option>
                </select>
            </div>

            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg text-sm font-bold transition shadow-lg shadow-blue-900/20">
                Filter Results
            </button>
            
            @if(request()->anyFilled(['status', 'priority', 'query']))
                <a href="{{ route('agent.dashboard') }}" class="text-gray-500 hover:text-white text-sm transition">Clear All</a>
            @endif
        </form>
    </div>

    <div class="bg-gray-800 rounded-xl border border-gray-700 overflow-hidden shadow-2xl">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-900/50 text-gray-400 text-[11px] uppercase font-black tracking-widest border-b border-gray-700">
                    <tr>
                        <th class="px-6 py-4">ID</th>
                        <th class="px-6 py-4">Ticket Details</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4">Priority</th>
                        <th class="px-6 py-4">Last Updated</th>
                        <th class="px-6 py-4 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700/50">
                    @forelse($tickets as $ticket)
                    <tr onclick="window.location='{{ route('tickets.show', $ticket->id) }}';" 
                        class="hover:bg-gray-700/30 cursor-pointer transition-all group">
                        
                        <td class="px-6 py-5 font-mono text-sm text-blue-400 font-bold">
                            #{{ $ticket->id }}
                        </td>
                        
                        <td class="px-6 py-5">
                            <div class="text-white font-medium group-hover:text-blue-400 transition-colors leading-tight">
                                {{ Str::limit($ticket->title, 60) }}
                            </div>
                            <div class="text-gray-500 text-xs mt-1 flex items-center gap-2">
                                <i class="far fa-folder text-[10px]"></i> {{ $ticket->category?->name ?? 'N/A' }}
                            </div>
                        </td>
                        
                        <td class="px-6 py-5">
                            <span class="px-3 py-1 rounded-md text-[10px] font-black uppercase tracking-tighter status-badge-{{ $ticket->status }}">
                                {{ str_replace('_', ' ', $ticket->status) }}
                            </span>
                        </td>
                        
                        <td class="px-6 py-5">
                            <div class="flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full priority-dot-{{ $ticket->priority }}"></span>
                                <span class="text-xs font-semibold text-gray-300">{{ ucfirst($ticket->priority) }}</span>
                            </div>
                        </td>
                        
                        <td class="px-6 py-5 text-gray-500 text-sm">
                            {{ $ticket->updated_at->diffForHumans() }}
                        </td>

                        <td class="px-6 py-5 text-center">
                            <div class="flex items-center justify-center gap-3">
                                <a href="{{ route('tickets.show', $ticket->id) }}" class="text-gray-400 hover:text-blue-400 transition-colors" title="View Ticket">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @if($ticket->status != 'closed')
                                <form action="{{ route('tickets.resolve', $ticket->id) }}" method="POST" class="inline" onclick="event.stopPropagation();">
                                    @csrf
                                    <button type="submit" class="text-gray-400 hover:text-emerald-400 transition-colors" title="Mark as Resolved">
                                        <i class="fas fa-check-circle"></i>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-16 text-center">
                            <i class="fas fa-inbox text-gray-700 text-4xl mb-4"></i>
                            <p class="text-gray-500 italic">No tickets found in this view.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($tickets->hasPages())
        <div class="px-6 py-4 bg-gray-900/30 border-t border-gray-700">
            {{ $tickets->links() }}
        </div>
        @endif
    </div>
</div>

@push('styles')
<style>
    /* Dynamic Status Badges */
    .status-badge-open { background: rgba(59, 130, 246, 0.1); color: #60a5fa; border: 1px solid rgba(59, 130, 246, 0.2); }
    .status-badge-in_progress { background: rgba(245, 158, 11, 0.1); color: #fbbf24; border: 1px solid rgba(245, 158, 11, 0.2); }
    .status-badge-closed { background: rgba(107, 114, 128, 0.1); color: #9ca3af; border: 1px solid rgba(107, 114, 128, 0.2); }

    /* Priority Indicator Dots */
    .priority-dot-high { background-color: #ef4444; box-shadow: 0 0 10px rgba(239, 68, 68, 0.4); }
    .priority-dot-medium { background-color: #f59e0b; }
    .priority-dot-low { background-color: #6b7280; }

    /* Pagination Styling Fix for Dark Mode */
    .pagination { justify-content: center; gap: 5px; }
</style>
@endpush
@endsection