<?php
declare(strict_types=1);


namespace App\Share\Infrastructure\Services\Billing\Service\Response;

class BasicResponse implements \JsonSerializable
{
    public function __construct(
        private int     $httpStatus,
        private ?array  $data,
        private ?string $message,
        private ?array  $errors
    )
    {
    }

    /**
     * @return array|null
     */
    public function getErrors(): ?array
    {
        return $this->errors;
    }

    public function isSuccess(): bool
    {
        return $this->getHttpStatus() >= 200 && $this->getHttpStatus() < 300;
    }

    /**
     * @return int
     */
    public function getHttpStatus(): int
    {
        return $this->httpStatus;
    }

    /**
     * @return array|null
     */
    public function getData(): ?array
    {
        return $this->data;
    }

    /**
     * @return bool
     */
    public function isEmptySet(): bool
    {
        return []===$this->data;
    }

    /**
     * @return string|null
     */
    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }
}