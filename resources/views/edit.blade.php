<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Group</title>
</head>

<body>
    <h1>Edit Group</h1>

    <form action="{{ route('groups.update', $group->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="groupName">Group Name:</label>
        <input type="text" id="groupName" name="name" value="{{ $group->name }}" required>

        <label for="groupDescription">Group Description:</label>
        <textarea id="groupDescription" name="description">{{ $group->description }}</textarea>

        <button type="submit">Update Group</button>
    </form>
</body>

</html>
