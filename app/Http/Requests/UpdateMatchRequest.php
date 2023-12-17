<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMatchRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'date' => 'date',
            'time' => 'string|max:255',
            'location' => 'string|max:255',
            'home_team_id' => 'exists:teams,id',
            'away_team_id' => 'exists:teams,id',
            'score' => 'nullable|string|max:255',
        ];
    }
}
