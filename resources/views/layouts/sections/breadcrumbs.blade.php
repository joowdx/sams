<ol class="breadcrumb float-sm-right">
    @if ($breadcrumbs ?? '')
        @foreach ($breadcrumbs as $breadcrumb)
            @php
                $breadcrumb = json_decode(json_encode($breadcrumb));
            @endphp
            <li class="breadcrumb-item {{ $loop->last ? 'active' : '' }}">
                @if ($loop->last)
                    {{ $breadcrumb->text }}
                    @continue
                @endif
                <a href="{{ $breadcrumb->link ?? 'javascript:void(0)' }}">{{ $breadcrumb->text }}</a>
            </li>
        @endforeach
    @endif
</ol>
