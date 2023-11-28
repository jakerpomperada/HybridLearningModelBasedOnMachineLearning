<?php

namespace App\Listeners;

use Domain\Shared\AcademicTerm;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NavbarDisplaySemesterListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $term = $event->term;

        setCurrentTermToDisplay(new AcademicTerm(
           $term->from, $term->to, $term->semester
       ));
    }
}
