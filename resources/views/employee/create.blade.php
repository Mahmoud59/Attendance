<form method="post" action="{{ route('employees.store') }}">
{{ csrf_field() }}
    <input type="text" name="name" placeholder="Employee name">
    <br>
    <input type="email" name="email" placeholder="Employee email">
    <br>

    <input type="text" name="pin_code" placeholder="Pin code">
    <br>

    <input type="submit" name="submit" value="submit">
</form>
