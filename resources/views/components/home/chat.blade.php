<div class="chat col-2">
    <select class="js-example-basic-single" name="state" style="width: 100%">
        @foreach ($usernames as $username)
            <option value="{{ $username }}">{{ $username }}</option>
        @endforeach
        {{-- <option value="WY">Wyoming</option> --}}
      </select>
</div>
<script>
    // In your Javascript (external .js resource or <script> tag)
    $(document).ready(function() {
        $('.js-example-basic-single').select2({
            theme:"classic"
        });
    });
    $('.js-example-basic-single').on('select2:select', function (e) {
        var data = e.params.data;
        window.location.href = data.text;
    });
</script>
