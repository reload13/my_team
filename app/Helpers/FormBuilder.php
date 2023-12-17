<?php

// app/Helpers/FormBuilder.php

namespace App\Helpers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\Team;

class FormBuilder
{

    protected $model;

    public function setModel(Model $model)
    {
        $this->model = $model;
        return $this;
    }
    protected $columnTypeMap = [
        'string' => 'text',
        'varchar' => 'text',
        'text' => 'textarea',
        'integer' => 'number',
        'bigint' => 'number',
        'boolean' => 'checkbox',
        'date' => 'datetime',
        'datetime' => 'datetime',
        'float' => 'number',
        'decimal' => 'number',
        'enum' => 'select',
        // Relationships
        'foreignId' => 'select', // BelongsTo
        'id' => 'number', // HasOne or HasMany

    ];

    protected $htmlValidationAttributes = [
        'text' => 'maxlength="255"',
        'datetime' => 'datetime',
        'integer' => 'step="1" min="0"',
        'bigint' => 'step="1" min="0"',
        'varchar' => 'string',
        'timestamp' => 'datetime',
    ];

    protected $select_fields = [
        'home_team_id' => 'homeTeam',
        'away_team_id' => 'awayTeam',
    ];
    public function generateFieldsFromModel($action, $submitButtonText = 'Submit', $method='PUT')
    {
        $fields = [];
        $form = [];
        $unset_array= ['created_at','updated_at','time'];

        // Get the columns of the table associated with the model
        $columns = Schema::getColumnListing($this->model->getTable());


        foreach ($columns as $column) {

            // Get the type of the column
            $columnType = Schema::getColumnType($this->model->getTable(), $column);

            if(in_array($column,$unset_array)){
                continue;
            }


            // Use the mapping or default to 'text' if no mapping is found
            $fieldType = $this->columnTypeMap[$columnType] ?? 'text';

            // Use the HTML validation attributes or default to an empty string if no attributes are found
//            echo($this->htmlValidationAttributes[$columnType]);
//            $htmlAttributes = $this->htmlValidationAttributes[$columnType] ?? '';

            // Use the human-readable column name as the label
            $label = ucwords(str_replace('_', ' ', $column));

            if (isset($this->select_fields[$column])) {
//                dd($this->select_fields[$column]);
                $fieldType = 'select';
                $relatedModel = $this->model->{$this->select_fields[$column]}()->getRelated();

                // Fetch options using the related model instance
                $options = $relatedModel->pluck('name', 'id')->toArray();
                $fields[] = [
                    'type' => $fieldType,
                    'label' => $label,
                    'name' => $column,
                    'options' => $options,
                ];
            } else {
                $fields[] = [
                    'type' => $fieldType,
//                    'html_attributes' => $htmlAttributes,
                    'label' => $label,
                    'name' => $column,
                ];
            }
        }

        // Add button text to fields
        $form['fields'] = $fields;
        $form['action'] = $action;
        $form['method'] = $method;
        $form['submit_button_text'] = $submitButtonText;

        return $form;
    }

    public function addCustomField($name, $type, $label, $htmlAttributes = '')
    {
        $this->customFields[] = [
            'name' => $name,
            'type' => $type,
            'label' => $label,
            'html_attributes' => $htmlAttributes,
        ];
    }

    protected function getRelatedModelName($method)
    {
        // Use the relationship method to get the related model class name
//        $relationMethod = Str::camel($column);
//        dd($method->homeTeam());
        $relatedModel = get_class($this->model->{$method}()->getRelated());
//dd($relatedModel);
        return class_basename($relatedModel);
    }
}
