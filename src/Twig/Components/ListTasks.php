<?php

namespace App\Twig\Components;

use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent]
final class ListTasks
{
    use DefaultActionTrait;

    public function __construct(
        // inject services here
    ) {}

    public $tasks;



}
