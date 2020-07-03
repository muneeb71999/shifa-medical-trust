<form action="{{ $action }}" method={{ $method }}>
    @csrf
    <div class="form-row">
        @include('common.input', [
        'label' => 'Name',
        'name' => 'name',
        'type' => 'text',
        'focus' => true,
        'col' => 'col-md-4'
        ])

        @include('common.input', [
        'label' => 'Guardian Name',
        'name' => 'guardian_name',
        'type' => 'text',
        'col' => 'col-md-4'
        ])
        @include('common.input', [
        'label' => 'Phone',
        'name' => 'phone',
        'type' => 'text',
        'maxlength' => 11,
        'required' => true,
        'col' => 'col-md-4'
        ])
    </div>
    <div class="form-row">

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
        'label' => 'Monthly Salary',
        'name' => 'monthly_salary',
        'type' => 'number',
        'col' => 'col-md-4',
        ])
        @include('common.input', [
        'label' => 'Age',
        'name' => 'age',
        'type' => 'number',
        'col' => 'col-md-4'
        ])
    </div>
    <div class="form-row">
        @include('common.input', [
        'label' => 'Address',
        'name' => 'address',
        'type' => 'text',
        'col' => 'col-md-8'
        ])

        @include('common.input', [
        'label' => 'Education',
        'name' => 'education',
        'type' => 'text',
        'col' => 'col-md-4'
        ])

    </div>
    <div class="form-row">
        @include('common.input', [
        'label' => 'Designation',
        'name' => 'designation',
        'type' => 'text',
        'col' => 'col-md-4'
        ])
        @include('common.input', [
        'label' => 'Cnic',
        'name' => 'cnic',
        'type' => 'text',
        'maxlength' => 13,
        'col' => 'col-md-6'
        ])
    </div>
    <button type="submit" class="btn btn-success" id="submit">Save Employee Record</button>
</form>
