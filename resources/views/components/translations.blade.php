
<script>
    window.translations = {
        @php
            $messages = trans('messages');
        @endphp
        @foreach($messages as $key => $value)
            '{{ $key }}': '{{ addslashes($value) }}',
        @endforeach
    };
</script>