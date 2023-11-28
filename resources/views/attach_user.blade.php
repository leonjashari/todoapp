<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User to Group</title>
</head>

<body>
    <h1>Add User to Group</h1>

    <form action="{{ route('groups.users.attach', $group->id) }}" method="POST">
        @csrf

        <label for="userSelect">Select User:</label>
        <select id="userSelect" name="user_id">
            @foreach ($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select>

        <button type="submit">Add User to Group</button>
    </form>
</body>

</html>
