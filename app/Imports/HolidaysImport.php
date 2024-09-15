<?php

namespace App\Imports;

use App\Models\Holiday;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class HolidaysImport implements
    ToModel,
    WithHeadingRow,
    WithMapping
// , WithValidation
{
    use Importable;
    public $user_id;
    public function __construct($user_id)
    {
        $this->user_id = $user_id;
    }

    public function model(array $row)
    {
        if ($row['date'] === null) {
            throw new \Exception("Invalid date format for occasion: " . $row['occasion']);
        }
        $holidays = Holiday::whereDate('date', '=', $row['date']);
        if ($holidays->count() > 0) {
            $holidays->update([
                'occasion' => $row['occasion'],
            ]);
        } else {
            return new Holiday([
                'occasion' => $row['occasion'],
                'date' => $row['date'],
                'user_id' => $this->user_id,
            ]);
        }
    }
    public function map($row): array
    {
        if (is_numeric($row['date'])) {
            $row['date'] = date('Y-m-d', Date::excelToTimestamp($row['date']));
        }
        if (gettype($row['date']) == 'double') {
            $row['date'] = Date::excelToDateTimeObject($row['date'])->format('Y-m-d');
        }
        return $row;
    }
    public function rules(): array
    {
        return [
            'occasion' => 'required',
            'date' => 'required|date',
        ];
    }
    public function customValidationMessages(): array
    {
        return [
            'occasion.required' => 'The occasion field is required.',
            'date.required' => 'The date field is required.',
            'date.date' => 'The date field must be a valid date.',
        ];
    }
}
