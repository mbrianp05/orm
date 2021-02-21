<?php

namespace Mbrianp\FuncCollection\ORM\Attributes;

use Attribute;

/**
 * An attribute to mark the ID column.
 * Every entity must have this attribute in some property.
 *
 * Because of this attribute the ORM will be able of knowing
 * what the id is and therefore, will be able of updating and deleting
 * a registry from Database.
 */
#[Attribute(Attribute::TARGET_PROPERTY)]
class Id
{
}