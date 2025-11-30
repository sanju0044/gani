<table>
    <thead>
    <tr>
        <th>User Name</th>
        <th>First Name</th>
        <th>Middle Name</th>
        <th>Last Name</th>
        <th>School No</th>
        <th>Email</th>
        <th>DOB</th>
        <th>Age</th>
        <th>Standard</th>
        <th>City</th>
        <th>State</th>
        <th>Address</th>
        <th>Pincode</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $obj)
        <tr>
            <td>{{ $obj->user_name }}</td>
            <td>{{ $obj->first_name }}</td>
            <td>{{ $obj->middle_name }}</td>
            <td>{{ $obj->last_name }}</td>
            <td>{{ $obj->school_no }}</td>
            <td>{{ $obj->email }}</td>
            <td>{{ $obj->DOB }}</td>
            <td>{{ $obj->age }}</td>
            <td>{{ $obj->standard }}</td>
            <td>{{ $obj->cityModel?$obj->cityModel->city_name:"NA" }}</td>
            <td>{{ $obj->stateModel?$obj->stateModel->state_name:"NA" }}</td>
            <td>{{ $obj->address }}</td>
            <td>{{ $obj->pincode }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
