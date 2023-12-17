<form class="ajax-form" action="{{ $form['action'] }}" method="{{ $form['method']??'POST' }}">
    @csrf
    @method($form['method'] === 'PUT' ? 'PUT' : 'POST')
    <input type="hidden" id="resource_id" value={{$id}} />
    @foreach($form['fields'] as $key => $field)
{{--        {{dd($form)}}--}}
        @switch($field['type'])
            @case('text' && ($field['name'] == 'photo' || $field['name'] == 'logo'))
                @include('CRUD.forms.file', ['value'=>$data[$field['name']]??false,'id' => $field['name'], 'label' => $field['label'], 'name' => $field['name']])
                @break
            @case('text')
                @include('CRUD.forms.text-input', ['value'=>$data[$field['name']]??false,'id' => $field['name'], 'label' => $field['label'], 'name' => $field['name']])
                @break
            @case('textarea')
                @include('CRUD.forms.textarea', ['value'=>$data[$field['name']]??false,'id' => $field['name'], 'label' => $field['label'], 'name' => $field['name'], 'rows' => 3])
                @break
            @case('select')
                @include('CRUD.forms.select-dropdown', ['value'=>$data[$field['name']]??false,'id' => $field['name'], 'label' => $field['label'], 'name' => 'team', 'options' => $field['options']])
                @break
            @case('datetime')
                @include('CRUD.forms.datepicker', ['value'=>$data[$field['name']]??false,'id' => $field['name'], 'label' => $field['label'], 'name' => 'team'])
                @break
            @case('file')
                @break
            @endswitch
    @endforeach

    <button type="submit" class="btn btn-primary">Submit</button>
</form>

