<div class="fi-role-badges" style="display:flex; flex-direction:column; align-items:flex-end; gap:2px; margin-right:8px;">

    <span class="fi-role-name">
        {{ collect([
            auth()->user()?->first_name,


            auth()->user()?->last_name,

        ])->filter()->implode(' ') }}
    </span>

    @if ($roles->isNotEmpty())
        <div style="display:flex; gap:4px;">
            @foreach ($roles as $role)
                <span class="fi-role-badge-label">
                    {{ strtoupper($role->name) }}
                </span>
            @endforeach
        </div>
    @endif
</div>
