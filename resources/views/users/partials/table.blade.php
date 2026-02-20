@foreach($users as $user)
<tr class="border-b">
    <td class="p-4">{{ $user->name }}</td>
    <td class="p-4">{{ $user->email }}</td>
    <td class="p-4">{{ $user->role ?? 'Subscriber' }}</td>
    <td class="p-4">{{ $user->status ?? 'Active' }}</td>
    <td class="p-4 text-right space-x-2">

        <button onclick="editUser({{ $user->id }}, '{{ $user->name }}', '{{ $user->email }}')"
            class="text-blue-500">Edit</button>

        <button onclick="deleteUser({{ $user->id }})"
            class="text-red-500">Delete</button>

    </td>
</tr>
@endforeach

<tr>
    <td colspan="5" class="p-4">
        {{ $users->links() }}
    </td>
</tr>