<form method="post" action="{{ url('admin/employees') }}">
{{ csrf_field() }}
    <input type="text" name="name" placeholder="Employee name" required>
    <br><br>

    <input type="email" name="email" placeholder="Employee email" required>
    <br><br>

    <input type="text" name="pin_code" placeholder="Pin code" required>
    <br><br>

    <input type="submit" name="submit" value="submit">
</form>
