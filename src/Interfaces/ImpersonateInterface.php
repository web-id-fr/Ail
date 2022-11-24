<?php

namespace Webid\Ail\Interfaces;

interface ImpersonateInterface
{
    public function getImpersonateName(): string;

    public function getImpersonateAttributeToSearch(): string;
}
