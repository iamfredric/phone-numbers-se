<?php

namespace Iamfredric\Phone;

class PhoneNumber
{
    protected string $number;

    protected string $areaCode = '';

    public function __construct(string $number, protected string $countryCode = '46')
    {
        [$this->areaCode, $this->number] = $this->split($this->trim($number));
    }

    public function exists(): bool
    {
        return strlen($this->number) > 0;
    }

    /**
     * @param string $number
     * @return string[]
     */
    protected function split(string $number): array
    {
        return [
            $areaCode = $this->areaCode($number),
            empty($number) ? '' : substr($number, strlen($areaCode))
        ];
    }

    protected function trim(string $number): string
    {
        $number = str_replace([" ", "-", "(0)", "+{$this->countryCode}", "00{$this->countryCode}"], '', $number);

        $number = trim($number);
        return str_starts_with($number, '0') ? $number : "0{$number}";
    }

    public function tel(): string
    {
        if (empty($this->number)) {
            return '';
        }

        return implode([
            '+',
            $this->countryCode,
            substr($this->areaCode, 1),
            $this->number
        ]);
    }

    public function full(): string
    {
        if (empty($this->number)) {
            return '';
        }

        $number = substr($this->readable(), 1);

        return "00{$this->countryCode} (0){$number}";
    }

    public function readable(): string
    {
        if (empty($this->number)) {
            return '';
        }

        $number = strlen($this->number) % 2 === 0
            ? implode(' ', str_split($this->number, 2))
            : implode(' ', [
                substr($this->number, 0, 3),
                ...str_split(substr($this->number, 3), 2)
            ]);

        return "{$this->areaCode} {$number}";
    }

    protected function areaCode(string $number): string
    {
        if (empty($number)) {
            return '';
        }

        if ($this->areaCode) {
            return $this->areaCode;
        }

        $areaCodes = include dirname(__FILE__, 2) . '/areacodes.php';
        usort($areaCodes, fn ($a, $b) => strlen($b) <=> strlen($a));

        foreach ($areaCodes as $areaCode) {
            if (str_starts_with($number, $areaCode)) {
                return $this->areaCode = $areaCode;
            }
        }

        return '';
    }

    public function __toString(): string
    {
        return $this->readable();
    }
}
