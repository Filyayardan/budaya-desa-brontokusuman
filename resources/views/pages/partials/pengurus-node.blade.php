<li>
    <div class="org-node relative bg-white rounded-xl border border-gold-500/40 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300 w-48 text-center px-4 py-5 mx-auto {{ $node->jabatan === 'Ketua' ? 'ring-2 ring-gold-500/60' : '' }}">
        <div
            class="w-16 h-16 rounded-full mx-auto mb-3 overflow-hidden bg-gradient-to-br from-gold-600/20 to-dark-700 border-2 border-gold-500/40">
            @if ($node->foto)
                <img src="{{ asset('storage/' . $node->foto) }}" alt="{{ $node->nama }}"
                    class="w-full h-full object-cover">
            @else
                <div class="w-full h-full flex items-center justify-center">
                    <i class="fas fa-user-tie text-gold-500/50 text-2xl"></i>
                </div>
            @endif
        </div>
        <h3 class="font-display text-sm font-bold text-main_txt leading-snug">{{ $node->nama }}</h3>
        <p class="text-tertiary text-xs font-medium mt-1">{{ $node->jabatan }}</p>
    </div>

    @if (count($children))
        <ul>
            @foreach ($children as $child)
                @include('pages.partials.pengurus-node', ['node' => $child['node'], 'children' => $child['children']])
            @endforeach
        </ul>
    @endif
</li>