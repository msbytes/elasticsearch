<?php

/**
 * This file is part of elasticsearch, a Matchory application.
 *
 * Unauthorized copying of this file, via any medium, is strictly prohibited.
 * Its contents are strictly confidential and proprietary.
 *
 * @copyright 2020–2021 Matchory GmbH · All rights reserved
 * @author    Moritz Friedrich <moritz@matchory.com>
 */

declare(strict_types=1);

namespace Matchory\Elasticsearch\Compatibility\Exceptions;

use RuntimeException;

use function get_class;

class InvalidCastException extends RuntimeException
{
    /**
     * The name of the affected Eloquent model.
     *
     * @var string
     */
    public $model;

    /**
     * The name of the column.
     *
     * @var string
     */
    public $column;

    /**
     * The name of the cast type.
     *
     * @var string
     */
    public $castType;

    /**
     * Create a new exception instance.
     *
     * @param object $model
     * @param string $column
     * @param string $castType
     */
    public function __construct($model, $column, $castType)
    {
        $class = get_class($model);

        parent::__construct(
            "Call to undefined cast [{$castType}] on column " .
            "[{$column}] in model [{$class}]."
        );

        $this->model = $class;
        $this->column = $column;
        $this->castType = $castType;
    }
}
