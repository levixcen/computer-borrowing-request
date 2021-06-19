<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;

class AdministratorNavigationComposer
{
    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('navGroups', array_to_object($this->getAdministratorNavigations()));
    }

    /**
     * Obtain a list of navigation items.
     *
     * @return array
     */
    private function getAdministratorNavigations()
    {
        return config('navigations.admin');
    }
}
