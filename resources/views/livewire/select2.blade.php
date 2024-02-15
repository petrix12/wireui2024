<div class="m-5">
    <p>{{ $opcion }}</p>
    <div wire:ignore>
        <select class="select2" wire:model="opcion">
            <option value="1">Laravel</option>
            <option value="2">Vue.js</option>
            <option value="3">PHP</option>
            <option value="4">Javascript</option>
            <option value="5">MySQL</option>
            <option value="6">Node.js</option>
            <option value="7">React.js</option>
        </select>
    </div>

    <script>
        $(document).ready(function() {
            $('.select2').select2();
            $('.select2').on('change', function() {
                @this.set('opcion', this.value);
            });
        });
    </script>
</div>
