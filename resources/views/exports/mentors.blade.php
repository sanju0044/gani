<table>
    <thead>
    <tr>
        <th>First Name</th>
        <th>Last Name</th>
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

            <td>{{ $obj->first_name }}</td>
            <td>{{ $obj->last_name }}</td>
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
