<?php
declare(strict_types=1);

namespace AlexPeregrina\ValueObject\Domain\Web;

use AlexPeregrina\ValueObject\Domain\AbstractValueObject;
use AlexPeregrina\ValueObject\Domain\String\StringVO;

class Url extends AbstractValueObject
{
    public function __construct(
        private SchemeName $scheme,
        private StringVO $user,
        private StringVO $password,
        private Domain $domain,
        private Port $port,
        private Path $path,
        private QueryString $query,
        private FragmentIdentifier $fragment
    ) {}

    public function scheme(): SchemeName
    {
        return $this->scheme;
    }

    public function user(): StringVO
    {
        return $this->user;
    }

    public function password(): StringVO
    {
        return $this->password;
    }

    public function domain(): Domain
    {
        return $this->domain;
    }

    public function port(): Port
    {
        return $this->port;
    }

    public function path(): Path
    {
        return $this->path;
    }

    public function query(): QueryString
    {
        return $this->query;
    }

    public function fragment(): FragmentIdentifier
    {
        return $this->fragment;
    }

    protected function equalValues(AbstractValueObject|Url $object): bool
    {
        return $this->scheme->equals($object->scheme()) &&
            $this->user->equals($object->user()) &&
            $this->password->equals($object->password()) &&
            $this->domain->equals($object->domain()) &&
            $this->port->equals($object->port()) &&
            $this->path->equals($object->path()) &&
            $this->query->equals($object->query()) &&
            $this->fragment->equals($object->fragment())
        ;
    }
}