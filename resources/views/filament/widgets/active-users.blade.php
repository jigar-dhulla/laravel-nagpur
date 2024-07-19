<x-filament-widgets::widget>
    <x-filament::section>
        <div>
            <label>Active Users:</label>
            <span>{{count($users)}}</span>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>

@script
<script>
    window.Echo.join('active-users')
        .here((users) => {
            $wire.$set('users', users);
        })
        .joining((user) => {
            $wire.$set('users', [...$wire.users, user]);
        })
        .leaving((user) => {
            $wire.$set('users', $wire.users.filter(u => u.id !== user.id));
        })
        .error((error) => {
            console.error(error);
        });
</script>
@endscript
