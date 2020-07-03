<form action="{{ $action }}" method={{ $method }}>
    @csrf
    <div class="form-row">
        @include('common.input', [
        'label' => 'Patient Name',
        'name' => 'name',
        'type' => 'text',
        'focus' => true,
        'col' => 'col-md-4'
        ])
        @include('common.select', [
        'name' => 'relation',
        'label' => 'Relation',
        'options' => [
        [
        'name' => 'S/o',
        'value' => 'S/o'
        ],
        [
        'name' => 'D/o',
        'value' => 'D/o'
        ],
        [
        'name' => 'W/o',
        'value' => 'W/o'
        ]
        ]
        ])
        @include('common.input', [
        'label' => 'Guardian Name',
        'name' => 'guardian_name',
        'type' => 'text',
        'col' => 'col-md-4'
        ])
    </div>
    <div class="form-row">
        @include('common.input', [
        'label' => 'Phone',
        'name' => 'phone',
        'type' => 'text',
        'maxlength' => 11,
        'required' => false
        ])
        @include('common.select', [
        'name' => 'gender',
        'label' => 'Gender',
        'options' => [
        [
        'name' => 'Male',
        'value' => 'male'
        ],
        [
        'name' => 'Female',
        'value' => 'female'
        ]
        ]
        ])
        @include('common.input', [
        'label' => 'Fee',
        'name' => 'fee',
        'type' => 'number',
        'col' => 'col-md-2',
        'value' => 50
        ])
    </div>
    <div class="form-row">
        @include('common.input', [
        'label' => 'Age',
        'name' => 'age',
        'type' => 'number',
        'col' => 'col-md-4'
        ])
        @include('common.select', [
        'name' => 'doctor_id',
        'label' => 'Doctor',
        'options' => [
        [
        'name' => 'M.Ali',
        'value' => 1
        ],
        [
        'name' => 'Fatime',
        'value' => 2,
        ]
        ]
        ])
    </div>
    <button type="submit" class="btn btn-success" id="submit">Save & Print</button>
</form>
