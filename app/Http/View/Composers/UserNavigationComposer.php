<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;

class UserNavigationComposer
{
    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('navGroups', array_to_object($this->getUserNavigations()));
    }

    /**
     * Obtain a list of navigation items.
     *
     * @return array
     */
    private function getUserNavigations()
    {
        return config('navigations.user');
    }
}
