@props(['results', 'showResults'])

@if (! $showResults)
    <span class="text-gray-400">Type at least 2 characters to search</span>
@elseif (empty($results))
    <span class="text-red-500">No matching records found</span>
@else
    <div class="space-y-4">
        @foreach ($results as $result)
            <div class="p-3 bg-white border border-gray-200 rounded-lg shadow-sm hover:bg-gray-50">
                {{-- Reference number --}}
                <div class="flex items-center justify-between mb-2">
                    <span class="text-lg font-medium text-primary-600">{{ $result['reference_number'] }}</span>
                </div>

                {{-- Details --}}
                <div class="space-y-1 text-sm">
                    <div><span class="font-medium">Group:</span> {{ $result['group'] }}</div>
                    <div><span class="font-medium">Subgroup:</span> {{ $result['subgroup'] }}</div>

                    @if (!empty($result['subject']))
                        <div><span class="font-medium">Subject:</span> {{ $result['subject'] }}</div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
@endif
