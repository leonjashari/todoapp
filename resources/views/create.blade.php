<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Group</title>
</head>

<body>
    <h1>Create Group</h1>

    <form action="{{ route('groups.store') }}" method="POST">
        @csrf

        <label for="groupName">Group Name:</label>
        <input type="text" id="groupName" name="name" required>

        <label for="groupDescription">Group Description:</label>
        <textarea id="groupDescription" name="description"></textarea>

        <button type="submit">Create Group</button>
    </form>
</body>

</html>
