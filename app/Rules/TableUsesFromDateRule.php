<?php

namespace App\Rules;

use App\Models\TableUses;
use Illuminate\Contracts\Validation\Rule;

class TableUsesFromDateRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $table_id = request()->get('table_id');
        $from_date = $value;
        $to_date = request()->get('to_date');

        $id = request()->route('id');
        $exists = TableUses::whereTableId($table_id)
            ->where('id', '!=', $id)
            ->whereTableId(request()->get('table_id'))
            ->whereBetween('from_date', [$from_date, $to_date])
            ->exists();

        $exist2 = TableUses::whereTableId($table_id)
            ->where('id', '!=', $id)
            ->whereTableId(request()->get('table_id'))
            ->where('from_date', '<', $from_date)
            ->where('to_date', '>', $from_date)
            ->exists();


        return
            strtotime($from_date) < strtotime($to_date)
            && $exists === false
            && $exist2 === false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Incorrect date';
    }
}
