<?php

namespace App\Exceptions;

use Exception;
use GraphQL\Error\ClientAware;
use GraphQL\Error\ProvidesExtensions;

final class CustomErrorHandler extends Exception implements ClientAware, ProvidesExtensions
{
    /** @var @string */
    protected $status;
    protected $error;
    protected $update;
    protected $message;
    protected $code;

    public function __construct(string $message, bool $error, string $status, bool $update, int $code)
    {
        // parent::__construct($message);

        $this->message = $message;
        $this->status = $status;
        $this->error = $error;
        $this->update = $update;
        $this->code = $code;
    }

    /**
     * Returns true when exception message is safe to be displayed to a client.
     */
    public function isClientSafe(): bool
    {
        return true;
    }

    public function getCategory(): string
    {
        return 'internal';

    }
    /**
     * Data to include within the "extensions" key of the formatted error.
     *
     * @return array<string, mixed>
     */
    public function getExtensions(): array
    {
        return [
            'message' => $this->message,
            'status' => $this->status,
            'error' => $this->error,
            'update' => $this->update,
            'code' => $this->code,
        ];
    }
}
