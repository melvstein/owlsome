<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Dashboard extends Component
{
    public $users;

    public function __construct($users)
    {
        $this->users = $users;
    }
    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('user.admin.dashboard');
    }
}
