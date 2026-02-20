<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\User;

class UserManagementTable extends Component
{
    public $users; // Paginator instance
    public $perPage = 10;

    public function render()
    {
        // Fetch paginated users
        $this->users = User::orderBy('id', 'desc')->paginate($this->perPage);

        [
            $users =>


        ]

        return view('components.user-management-table');
    }
}