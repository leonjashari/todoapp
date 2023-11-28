<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Group Tasks</title>
</head>
<body>
    <h1>Group Tasks</h1>

    <a href="{{ route('groups.index') }}">Back to Groups</a>

    <h2>Group: {{ $group->name }}</h2>

    <a href="{{ route('groups.tasks.create', ['groupId' => $group->id]) }}">Create Task</a>

    <ul>
        @foreach ($groupTasks as $task)
            <li>{{ $task->task_name }}</li>
            {{-- Add other task details as needed --}}
        @endforeach
    </ul>
</body>
</html>