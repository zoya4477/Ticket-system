@extends('layouts.agent')

@section('title', 'My Efficiency')

@section('content')
<div class="container-fluid px-6 py-4">
    
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-10">
        <div>
            <h1 class="text-3xl font-extrabold text-white tracking-tight flex items-center gap-3">
                <i class="fas fa-chart-line text-blue-500"></i>
                Performance Analytics
            </h1>
            <p class="text-gray-400 mt-1 text-sm font-medium">Monitoring your ticket resolution speed and efficiency metrics.</p>
        </div>
        
        <a href="{{ route('agent.dashboard') }}" 
           class="inline-flex items-center justify-center px-5 py-2.5 bg-gray-800 hover:bg-gray-700 text-gray-200 border border-gray-700 rounded-xl transition-all duration-300 group">
            <i class="fas fa-chevron-left mr-2 group-hover:-translate-x-1 transition-transform"></i>
            Back to Overview
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        
        <div class="relative bg-gray-800/40 backdrop-blur-md border border-gray-700 p-8 rounded-3xl overflow-hidden group hover:border-blue-500/50 transition-all duration-500 shadow-2xl">
            <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:scale-110 transition-transform duration-500">
                <i class="fas fa-percentage text-8xl text-blue-500"></i>
            </div>
            
            <div class="relative z-10 flex flex-col items-center">
                <div class="mb-4 p-4 bg-blue-500/10 rounded-2xl">
                    <i class="fas fa-microchip text-blue-500 text-3xl"></i>
                </div>
                <h3 class="text-gray-400 text-xs font-black uppercase tracking-[0.2em]">Efficiency Score</h3>
                <div class="flex items-baseline gap-1 mt-4">
                    <span class="text-5xl font-black text-white">
                        {{ $totalCount > 0 ? round(($resolvedCount / $totalCount) * 100) : 0 }}
                    </span>
                    <span class="text-xl font-bold text-blue-500">%</span>
                </div>
                <div class="w-full bg-gray-900 h-1.5 mt-6 rounded-full overflow-hidden">
                    <div class="bg-gradient-to-r from-blue-600 to-cyan-400 h-full transition-all duration-1000" 
                         style="width: {{ $totalCount > 0 ? ($resolvedCount / $totalCount) * 100 : 0 }}%"></div>
                </div>
            </div>
        </div>

        <div class="relative bg-gray-800/40 backdrop-blur-md border border-gray-700 p-8 rounded-3xl overflow-hidden group hover:border-emerald-500/50 transition-all duration-500 shadow-2xl">
            <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:scale-110 transition-transform duration-500">
                <i class="fas fa-check-circle text-8xl text-emerald-500"></i>
            </div>
            
            <div class="relative z-10 flex flex-col items-center">
                <div class="mb-4 p-4 bg-emerald-500/10 rounded-2xl">
                    <i class="fas fa-shield-check text-emerald-500 text-3xl"></i>
                </div>
                <h3 class="text-gray-400 text-xs font-black uppercase tracking-[0.2em]">Closed Tickets</h3>
                <p class="text-5xl font-black text-white mt-4">{{ $resolvedCount }}</p>
                <p class="text-emerald-400/70 text-[10px] mt-4 font-bold uppercase tracking-tighter italic">Successfully Documented</p>
            </div>
        </div>

        <div class="relative bg-gray-800/40 backdrop-blur-md border border-gray-700 p-8 rounded-3xl overflow-hidden group hover:border-amber-500/50 transition-all duration-500 shadow-2xl">
            <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:scale-110 transition-transform duration-500">
                <i class="fas fa-bolt text-8xl text-amber-500"></i>
            </div>
            
            <div class="relative z-10 flex flex-col items-center">
                <div class="mb-4 p-4 bg-amber-500/10 rounded-2xl">
                    <i class="fas fa-layer-group text-amber-500 text-3xl"></i>
                </div>
                <h3 class="text-gray-400 text-xs font-black uppercase tracking-[0.2em]">Total Workload</h3>
                <p class="text-5xl font-black text-white mt-4">{{ $totalCount }}</p>
                <p class="text-amber-400/70 text-[10px] mt-4 font-bold uppercase tracking-tighter italic">Assigned Lifetime</p>
            </div>
        </div>
    </div>

    <div class="mt-8 bg-gradient-to-r from-gray-800/50 to-transparent p-6 rounded-2xl border border-gray-700/50">
        <div class="flex items-center gap-4 text-gray-400">
            <i class="fas fa-info-circle text-blue-400"></i>
            <span class="text-sm">Efficiency is calculated based on <strong>Resolved vs Total Assigned</strong> tickets within your current profile.</span>
        </div>
    </div>
</div>

<style>
    /* Custom Background Glow Effects */
    body {
        background-color: #0f172a; /* Deep Navy Dark Mode */
    }
    
    /* Animation for the progress bar on load */
    @keyframes slideIn {
        from { width: 0; }
    }
    .transition-all {
        animation: slideIn 1.5s cubic-bezier(0.4, 0, 0.2, 1);
    }
</style>
@endsection