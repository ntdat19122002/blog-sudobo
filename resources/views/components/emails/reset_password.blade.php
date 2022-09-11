<form action="/reset-password" method="post">
    @csrf
    @method('PUT')
    {{ $email }}
    <input type="hidden" name="email" value="{{ $email }}">
    <input type="password" name="password" id="" placeholder="Password">
    <input type="password" name="password2" id="" placeholder="Password Confirm">
    <input type="submit" value="Change password">
</form>