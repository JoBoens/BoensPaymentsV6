<?php
/**
 * ------------------------------------------------------------
 * Boens Payments V6
 * ------------------------------------------------------------
 * Bestand : app/Core/Validator.php
 * Versie  : 6.5.0
 * Doel    : Centrale validatieklasse
 * ------------------------------------------------------------
 */

declare(strict_types=1);

namespace App\Core;

class Validator
{
    /**
     * Validatiefouten
     */
    private array $errors = [];

    /**
     * Gevalideerde data
     */
    private array $data = [];

    /**
     * Constructor
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Factory
     */
    public static function make(array $data): self
    {
        return new self($data);
    }

    /**
     * Valideren
     */
    public function validate(array $rules): self
    {
        foreach ($rules as $field => $ruleString) {

            $value = $this->data[$field] ?? null;

            $ruleList = explode('|', $ruleString);

            foreach ($ruleList as $rule) {

                $parameter = null;

                if (str_contains($rule, ':')) {

                    [$rule, $parameter] = explode(':', $rule, 2);

                }

                switch ($rule) {

                    case 'required':

                        if (
                            $value === null ||
                            $value === ''
                        ) {
                            $this->addError(
                                $field,
                                'Dit veld is verplicht.'
                            );
                        }

                        break;

                    case 'integer':

                        if (
                            $value !== '' &&
                            filter_var($value, FILTER_VALIDATE_INT) === false
                        ) {
                            $this->addError(
                                $field,
                                'Moet een geheel getal zijn.'
                            );
                        }

                        break;

                    case 'numeric':

                        if (
                            $value !== '' &&
                            !is_numeric($value)
                        ) {
                            $this->addError(
                                $field,
                                'Moet numeriek zijn.'
                            );
                        }

                        break;

                    case 'email':

                        if (
                            $value !== '' &&
                            !filter_var($value, FILTER_VALIDATE_EMAIL)
                        ) {
                            $this->addError(
                                $field,
                                'Ongeldig e-mailadres.'
                            );
                        }

                        break;

                    case 'date':

                        if (
                            $value !== '' &&
                            strtotime((string)$value) === false
                        ) {
                            $this->addError(
                                $field,
                                'Ongeldige datum.'
                            );
                        }

                        break;

                    case 'min':

                        if ($value !== null) {

                            if (is_numeric($value)) {

                                if ((float)$value < (float)$parameter) {

                                    $this->addError(
                                        $field,
                                        "Minimum waarde is {$parameter}."
                                    );

                                }

                            } else {

                                if (mb_strlen((string)$value) < (int)$parameter) {

                                    $this->addError(
                                        $field,
                                        "Minimum {$parameter} tekens."
                                    );

                                }

                            }

                        }

                        break;

                    case 'max':

                        if ($value !== null) {

                            if (is_numeric($value)) {

                                if ((float)$value > (float)$parameter) {

                                    $this->addError(
                                        $field,
                                        "Maximum waarde is {$parameter}."
                                    );

                                }

                            } else {

                                if (mb_strlen((string)$value) > (int)$parameter) {

                                    $this->addError(
                                        $field,
                                        "Maximum {$parameter} tekens."
                                    );

                                }

                            }

                        }

                        break;
                }
            }
        }

        return $this;
    }

    /**
     * Fout toevoegen
     */
    private function addError(
        string $field,
        string $message
    ): void {

        $this->errors[$field][] = $message;

    }

    /**
     * Zijn er fouten?
     */
    public function fails(): bool
    {
        return !empty($this->errors);
    }

    /**
     * Geen fouten?
     */
    public function passes(): bool
    {
        return empty($this->errors);
    }

    /**
     * Alle fouten
     */
    public function errors(): array
    {
        return $this->errors;
    }

    /**
     * Eerste fout van een veld
     */
    public function first(string $field): ?string
    {
        return $this->errors[$field][0] ?? null;
    }
}